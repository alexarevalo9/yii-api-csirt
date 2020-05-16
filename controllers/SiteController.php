<?php

namespace app\controllers;

use app\models\FormRegister;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/documentation']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays Register Page.
     */
    public function actionRegister()
    {
        //Creamos la instancia con el model de validación
        $model = new FormRegister;

        //Mostrará un mensaje en la vista cuando el usuario se haya registrado
        $msg = null;

        //Validación mediante ajax
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        //Validación cuando el formulario es enviado vía post
        //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
        //También previene por si el usuario tiene desactivado javascript y la
        //validación mediante ajax no puede ser llevada a cabo
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                //Preparamos la consulta para guardar el usuario
                $table = new User;
                $table->username = $model->username;
                $table->email = $model->email;
                $table->email_hash = md5(rand(0, 1000));

                //Encriptamos el password
                $table->password = crypt($model->password, Yii::$app->params["salt"]);

                //Si el registro es guardado correctamente
                if ($table->insert()) {
                    //Nueva consulta para obtener el id del usuario
                    //Para confirmar al usuario se requiere su id y su authKey
                    $user = $table->find()->where(["email" => $model->email])->one();
                    $id = urlencode($user->id);
                    $authKey = urlencode($user->authKey);

                    $this->sendEmail($table->email, $table->username, $table->email_hash);

                    $model->username = null;
                    $model->email = null;
                    $model->password = null;
                    $model->password_repeat = null;

                    $this->redirect(['site/message?email=' . $table->email]);

                } else {
                    Yii::$app->session->setFlash('error', 'Ha ocurrido un error al realizar su registro por favor intente más tarde.');
                }
            } else {
                $model->getErrors();
            }
        }
        return $this->render("register", ["model" => $model, "msg" => $msg]);
    }

    /**
     * Displays Verification Page.
     */
    public function actionVerification($email, $hash)
    {
        $table = new User;
        $message = null;
        $user = $table->find()->where(["email" => $email, "email_hash" => $hash])->one();

        if ($user && $user->active == 0) {
            $user->updateAttributes(['active' => 1]);
            $message = 'Su cuenta <b style="color: #0a73bb">' . $user->email . '</b> ha sido verificada exitosamente. Ahora puedes <a href="/site/login">iniciar sesión</a> en con cuenta.';
        } else if ($user && $user->active == 1) {
            $message = 'Su cuenta <b style="color: #0a73bb">' . $user->email . '</b> ya ha sido verificada exitosamente. Ahora puedes <a href="/site/login">iniciar sesión</a> en con cuenta.';
        } else {
            $message = 'No se ha podido verificar su cuenta.';
        }
        return $this->render('verification', ['message' => $message]);
    }

    /**
     * Displays Message Page.
     */
    public function actionMessage($email)
    {
        $table = new User;
        $msg = null;

        $user = $table->find()->where(["email" => $email])->one();
        $user && $user->active == 0 ? $msg = 'Se ha enviado un correo de verificación a: <b style="color: #0a73bb">' . $user->email . '</b>. Por favor revisar su bandeja de entrada.' : $this->redirect(['/']);;

        return $this->render('message', ['message' => $msg]);
    }

    /**
     * Displays Message Page.
     */
    public function actionDocumentation()
    {
        return Yii::$app->user->isGuest ? ($this->redirect(['/'])) : ($this->render('documentation'));
    }

    /**
     * Method that allows to send a verification email .
     */
    protected function sendEmail($email, $username, $hash)
    {
        Yii::$app->mailer->getView()->params['email'] = $email;
        Yii::$app->mailer->getView()->params['username'] = $username;
        Yii::$app->mailer->getView()->params['hash'] = $hash;

        Yii::$app->mailer->compose('layouts/html')
            ->setFrom(Yii::$app->params["adminEmail"])
            ->setTo($email)
            ->setSubject('Verifique su correo electrónico CSIRT API')
            ->send();

        Yii::$app->mailer->getView()->params['email'] = null;
        Yii::$app->mailer->getView()->params['username'] = null;
        Yii::$app->mailer->getView()->params['hash'] = null;
    }
}
