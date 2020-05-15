<?php


use yii\helpers\Html;

$this->title = 'Message';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1><br>
    <h4><?= $message; ?></h4>
</div>