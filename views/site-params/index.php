<?php

use app\models\SiteParams;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Site Params';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-params-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Site Params', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'param_id',
            'name',
            'value',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SiteParams $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'param_id' => $model->param_id]);
                 }
            ],
        ],
    ]); ?>


</div>
