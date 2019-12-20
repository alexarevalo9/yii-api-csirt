<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;

class CsirtController extends ActiveController
{
    public $modelClass = 'app\models\Csirt';

    //Returns a list of behaviors that this component should behave as.
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'tokenParam' => 'token',
            'class' => QueryParamAuth::className(),
            'except' => ['options', 'authenticate'],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                //'application/xml' => Response::FORMAT_XML,

            ],


        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        // Redefinimos el método que prepara los datos en el indexProvider
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }


    public function indexProvider()
    {
        $uid = Yii::$app->user->identity->id;
        return new ActiveDataProvider(['query' => \app\models\Csirt::find()->where('id=' . $uid)->orderBy('id')]);
    }
}
