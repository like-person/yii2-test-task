<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\SiteParams $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Site Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="site-params-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'param_id' => $model->param_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'param_id' => $model->param_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'param_id',
            'name',
            'value',
        ],
    ]) ?>

</div>
