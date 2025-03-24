<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SiteParams $model */

$this->title = 'Update Site Params: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Site Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'param_id' => $model->param_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-params-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
