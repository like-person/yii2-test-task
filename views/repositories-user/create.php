<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RepositoriesUser $model */

$this->title = 'Create Repositories User';
$this->params['breadcrumbs'][] = ['label' => 'Repositories Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repositories-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
