<?php

namespace app\controllers;

use app\models\SiteParams;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SiteParamsController implements the CRUD actions for SiteParams model.
 */
class SiteParamsController extends Controller
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
     * Lists all SiteParams models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SiteParams::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'param_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SiteParams model.
     * @param int $param_id Param ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($param_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($param_id),
        ]);
    }

    /**
     * Creates a new SiteParams model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SiteParams();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'param_id' => $model->param_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SiteParams model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $param_id Param ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($param_id)
    {
        $model = $this->findModel($param_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'param_id' => $model->param_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SiteParams model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $param_id Param ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($param_id)
    {
        $this->findModel($param_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SiteParams model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $param_id Param ID
     * @return SiteParams the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($param_id)
    {
        if (($model = SiteParams::findOne(['param_id' => $param_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
