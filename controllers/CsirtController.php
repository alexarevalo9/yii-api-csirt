<?php

namespace app\controllers;

use app\models\Csirt;
use Codeception\Command\Console;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\CompositeAuth;
use yii\web\Response;

class CsirtController extends ActiveController
{
    public $modelClass = 'app\models\Csirt';



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
                //'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ],
    ];
        return $behaviors;
    }

    public function actions() {
        $actions = parent::actions();
        //Eliminamos acciones de crear y eliminar apuntes. Eliminamos update para personalizarla
        unset($actions['delete'], $actions['create'],$actions['update']);
        // Redefinimos el método que prepara los datos en el index
        $actions['index']['prepareDataProvider'] = [$this, 'indexProvider'];
        return $actions;
    }


    public function indexProvider() {
        $uid=Yii::$app->user->identity->id;
        return new ActiveDataProvider([
            'query' => \app\models\Csirt::find()->where('id='.$uid )->orderBy('id')
        ]);
    }

    


/*
    public function beforeAction($action)
    {
        //$params = json_decode(file_get_contents("php://input"), false);
        //@$token = $params->token;
        // Si se envían los datos de la forma habitual (form-data), se reciben en $_POST:
        $token=$_GET['token'];
        echo $token;
        $u = \app\models\Csirt::findOne(['token' => $token]);
        echo $u->id;
        echo $u->nombreCsirt;
        //$password=$_POST['password' ];

        if ($u = \app\models\Csirt::findIdentityByAccessToken(['token' => $token])) {
            if ($u->token == $token) { //o crypt, según esté en la BD
                echo "true";
                return true;
            }
        } else {
            echo "false";
            return false;
        }
    }
    */
}
