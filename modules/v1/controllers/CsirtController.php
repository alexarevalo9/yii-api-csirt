<?php

namespace app\modules\v1\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;

class CsirtController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\Csirt';

    //Returns a list of behaviors that this component should behave as.
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);

        // add CORS filter before authentication
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];


        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['options', 'authenticate'],
        ];

        /*

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
               'application/json' => Response::FORMAT_JSON,
                //'application/xml' => Response::FORMAT_XML,
            ],
        ];*/
        return $behaviors;
    }

/*

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
        return new ActiveDataProvider(['query' => Csirt::find()->where('id=' . $uid)->orderBy('id')]);
    }

    public function actionRequest($id){

        echo $id;

    }
*/

}
