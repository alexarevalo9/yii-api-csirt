<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Csirt;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;

class CsirtController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\Csirt';

    //when i add verb function, its work but don't want to add everytime in each controller.

    protected function verbs() {
       $verbs = parent::verbs();
        $verbs =  [
            'index' => ['GET', 'POST', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
       return $verbs;
    }


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

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                //'application/xml' => Response::FORMAT_XML,
            ],
        ];

        return $behaviors;
    }

    public function actionGetcsirt($token)
    {
        $model = new Csirt;

        if ($token != null) {
            return $model->findCsirt($token);
        } else {
            return "Debe ingresar el parametro token";
        }

    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdatecsirt($token)
    {
        $model = $this->findModel($token);
        $model->attributes = Yii::$app->getRequest()->getBodyParams();

        if ($model->save()) {
            return array($model->findCsirt($token));
                //array(array_filter($model->attributes));
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => $model->errors), JSON_PRETTY_PRINT);
        }
    }

    /* function to find the requested record/model */
    protected function findModel($id)
    {
        if (($model = Csirt::findOne($id)) !== null) {
            return $model;
        } else {
            echo json_encode(array('status' => 0, 'error_code' => 400, 'message' => 'Bad request'), JSON_PRETTY_PRINT);
            exit;
        }
    }
}
