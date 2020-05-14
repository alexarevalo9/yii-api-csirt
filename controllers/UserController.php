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

        $model = new User;
        $data = $model->validateUser($email, $password);

        if ($data != null) {

            $auth_key = $model->generateAuthToken("abcdef0123456789", '50');
            $model->saveAuthToken($data->id, $auth_key);
            return ["Su token de autenticacion es" => $auth_key];
        } else {
            return ["Credenciales Invalidas"];
        }

    }


}