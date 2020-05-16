<?php
/* @active
*/
namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'login' => ['POST']
            ],
        ];

        return $behaviors;
    }

    /**
     * User Login
     * @return array
     */
    public function actionLogin()
    {
        $bodydata = Yii::$app->getRequest()->getBodyParams();
        $email = $bodydata['email'];
        $password = $bodydata['password'];
        $res = null;

        $model = new User;
        $data = $model->validateUser($email, $password);

        if ($data && $data->active == 1) {
            $auth_key = $model->generateAuthToken("abcdef0123456789", '50');
            $model->saveAuthToken($data->id, $auth_key);
            $res = ["Su token de autenticacion es" => $auth_key];
        } elseif ($data && $data->active == 0) {
            $res = ["Por favor active su cuenta antes de utilizar CSIRT API. Correo de verificación enviado a: $data->email"];
        } else {
            $res = ["Credenciales Invalidas"];
        }

        return $res;
    }

}