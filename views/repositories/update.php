<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Repositories $model */

$this->title = 'Update Repositories: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Repositories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repositories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
