<?php

use app\models\RepositoriesUser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Repositories Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repositories-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Repositories User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'login',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RepositoriesUser $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>
