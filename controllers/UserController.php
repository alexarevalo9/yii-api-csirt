<?php


namespace app\controllers;

use app\models\User;
use Yii;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actions()
    {
        $action = parent::actions();
        unset($action['index']);
        unset($action['create']);
        unset($action['update']);
        unset($action['delete']);
        unset($action['login']);
    }

    /**
     * User Login
     * @param string $email
     * @param string $password
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