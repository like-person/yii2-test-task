<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RepositoriesUser $users */
/** @var app\models\Repositories $repositories */

$this->title = 'Test task for PHP developer';
?>
<div class="site-index">

<h1>Тестовое задание про Гитхаб:</h1>

<p>Есть список пользователей Github, который можно изменять. Нужно сделать страницу, на которой показать 10 самых свежих (по дате обновления) репозиториев этих пользователей. Сами репозитории нужно обновлять каждые 10 минут.</p>

<h2>GITHUB users:</h2>

<ul>
    <?php foreach ($users as $user) :?>
        <li><?= $user->login ?></li>
    <?php endforeach;?>
</ul>
<p>
    <?= Html::a('Manage users', ['repositories-user/index']) ?>
</p>
<h2>Last repositories:</h2>

<ul>
    <?php foreach ($repositories as $repa) :?>
        <li>[<?= $repa->update_datetime ?>] <a href="<?= $repa->url ?>" target="_blank"><?= $repa->url ?></a></li>
    <?php endforeach;?>
</ul>

<p>Основная логика тестового задания в методе: <b>actionImport</b> класса <b>RepositoriesController</b>
    </p>
</div>
