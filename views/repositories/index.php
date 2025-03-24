<?php

use app\models\Repositories;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Repositories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repositories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Run import repositories from GitHub', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'user_id',
            'update_datetime',
            'history',
            'added_datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Repositories $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
