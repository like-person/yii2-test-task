<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Repositories $model */

$this->title = 'Create Repositories';
$this->params['breadcrumbs'][] = ['label' => 'Repositories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repositories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
