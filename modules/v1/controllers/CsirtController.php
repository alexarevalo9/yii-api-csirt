<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Csirt;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;

class CsirtController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\Csirt';

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
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'getcsirt' => ['GET'],
                'updatecsirt' => ['PUT'],
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

    /**
     * function to find the requested record/model.
     * @param string $id
     * @return Csirt|null
     */
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
