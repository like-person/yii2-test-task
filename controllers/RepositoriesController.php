<?php

namespace app\controllers;

use app\models\Repositories;
use app\models\RepositoriesUser;
use app\models\SiteParams;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepositoriesController implements the CRUD actions for Repositories model.
 */
class RepositoriesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Repositories models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Repositories::find(),
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Repositories model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Run import function.
     * If import is successful, the browser will be redirected to the 'index' page.
     * @return \yii\web\Response
     */
    public function actionCreate()
    {
        $this->actionImport();

        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Repositories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Repositories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Repositories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Repositories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Repositories::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**
     * Compare array elements.
     * @return int
     */
    private static function cmp($a, $b)
    {
        if ($a['DT'] == $b['DT']) {
            return 0;
        }

        return ($a['DT'] < $b['DT']) ? 1 : -1;
    }
    /**
     * Import function of githab repositories
     */
    public function actionImport()
    {
        $this->clearRepositories();

        libxml_use_internal_errors(false);
        $users = RepositoriesUser::find()->all();
        $doc = new \DOMDocument();
        $repositories = [];
        $maxNum = \Yii::$app->params['maxReps'];
        foreach($users as $user) {
            @$doc->loadHTMLFile(\Yii::$app->params['githubUrl']."/{$user->login}?tab=repositories");
            $links = $doc->getElementsByTagName('a');
            $userRepositories = [];
            $k = 0;
            foreach($links as $link)
            {
                if($link->getAttribute('itemprop') == 'name codeRepository' && $k < $maxNum) {
                    $userRepositories[] = [
                        'NAME' => $link->nodeValue,
                        'LINK' => $link->getAttribute('href'),
                        'USER' => $user,
                    ];
                    $k++;
                }
            }
            $datetimes = $doc->getElementsByTagName('relative-time');
            foreach($datetimes as $i => $datetime) {
                if ($i < $maxNum) {
                    $userRepositories[$i]['DATETIME'] = $datetime->getAttribute('datetime');
                    $userRepositories[$i]['DT'] = new \DateTime($datetime->getAttribute('datetime'));
                }
            }

            $repositories = array_merge($repositories, $userRepositories);
        }
    
        usort($repositories, ['app\controllers\RepositoriesController', 'cmp']);

        $reps = array_slice($repositories, 0, $maxNum);
        foreach ($reps as $rep) {
            $model = new Repositories();
            $model->url = \Yii::$app->params['githubUrl'].$rep['LINK'];
            $model->user_id = $rep['USER']->user_id;
            $model->history = 1;
            $model->update_datetime = date('Y-m-d H:i:s', $rep['DT']->getTimestamp());
            $model->save();
        }
    }
    /**
     * Clear function of githab repositories
     */
    private function clearRepositories() {
        $model = new Repositories();
        if (\Yii::$app->params['saveHistory']) {
            Repositories::updateAll(['history' => 0]);
        } else {
            Repositories::deleteAll();
        }
    }
    /**
     * Cron handler of githab repositories
     *  @return bool $run
     */
    public function cronHandler() {
        $run = false;
        if (\Yii::$app->params['cronHandler']) {
            return false;
        }
        if ($param = SiteParams::find()->where(['name' => 'runCronRep'])->one()) {
            $DT = (\DateTime::createFromFormat('Y-m-d H:i:s', $param->value))->add(\DateInterval::createFromDateString("10 minutes"));
            $currentDT = new \DateTime();
            if ($DT < $currentDT) {
                $run = true;
            }
        } else {
            $param = new SiteParams();
            $param->name = 'runCronRep';
            $run = true;
        }
        if ($run) {
            $this->actionImport();
            $param->value = date("Y-m-d H:i:s");
            $param->save();
        }
        return $run;
    }

    public function beforeAction($event)
    {
        if ($result = $this->cronHandler())
        {
            return $this->redirect(['index']);
        }
        else
        {
            return true;         
        }
    }
}
