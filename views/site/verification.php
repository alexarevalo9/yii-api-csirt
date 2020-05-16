<?php
/* @var $message string that has message from controller */

use yii\helpers\Html;

$this->title = 'Verificación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?> de Correo</h1><br>
    <h4><?= $message; ?></h4>
</div>