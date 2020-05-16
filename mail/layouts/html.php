<?php

use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div align="center"
     style="border-style:solid; border-width:thin; border-color:#dadce0; border-radius:8px; padding:40px 20px; width: 600px">
    <h1 style="color: #000000">Por favor verifique su correo electrónico</h1>
    <h2 style="color: #000000">Saludos <?= $this->params['username'] ?></h2>
    <h3 style="color: #000000">Necesitamos verificar su dirección de correo electrónico antes de activar su cuenta en
        CSIRT API.</h3><br><br>
    <div>
        <a style="background-color:#447fb4;color:#ffffff;display:inline-block;line-height:44px;text-align:center;text-decoration:none;width:180px;border-radius:4px"
           target="_blank"
           href="http://csirt-api.test/site/verification?email=<?= $this->params['email'] ?>&hash=<?= $this->params['hash'] ?>">
            VERIFICAR
        </a>
    </div>
    <br><br>
    <p align="center">Enlace de Verificación: <a
                href="http://csirt-api.test/site/verification?email=<?= $this->params['email'] ?>&hash=<?= $this->params['hash'] ?>">http://csirt-api.test/site/verification?email=<?= $this->params['email'] ?>
            &hash=<?= $this->params['hash'] ?></a></p>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
