<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RepositoriesUser $model */

$this->title = 'Update Repositories User: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Repositories Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repositories-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
