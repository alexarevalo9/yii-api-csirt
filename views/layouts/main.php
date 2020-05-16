<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use lo\modules\noty\Wrapper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['pageName'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            Yii::$app->user->isGuest ? (['label' => 'Registro', 'url' => ['/site/register']]) : (['label' => '', 'options' => ['style' => 'display:none;']]),
            Yii::$app->user->isGuest ? (['label' => '', 'options' => ['style' => 'display:none;']]) : (['label' => 'Documentación', 'url' => ['/site/documentation']]),
            Yii::$app->user->isGuest ? (['label' => 'Iniciar Sesión', 'url' => ['/site/login']]) : (['label' => 'Cerrar Sesión (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout']])
        ],
    ]);
    NavBar::end();

    echo Wrapper::widget([
        'layerClass' => 'lo\modules\noty\layers\Noty',
        'layerOptions' => [
            // for every layer (by default)
            'layerId' => 'noty-layer',
            'customTitleDelimiter' => '|',
            'overrideSystemConfirm' => true,
            'showTitle' => false,

            // for custom layer
            'registerAnimateCss' => true,
            'registerButtonsCss' => true
        ],

        // clientOptions
        'options' => [
            'dismissQueue' => true,
            'layout' => 'topRight',
            'timeout' => 5000,
            'theme' => 'metroui',
            //metroui, relax
        ],
    ]);
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => Yii::t('yii', 'Inicio'),
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CSIRT EC <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
