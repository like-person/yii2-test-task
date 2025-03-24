<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SiteParams $model */

$this->title = 'Create Site Params';
$this->params['breadcrumbs'][] = ['label' => 'Site Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-params-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
