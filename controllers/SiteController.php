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
use app\models\ContactForm;
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            return $this->goBack();
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
     * Displays contact page.
     *
     * @return Response|string
     */
//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Displays about page.
     *
     * @return string
     */
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }

    private function randKey($str = '', $long = 0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str) - 1;
        for ($x = 0; $x < $long; $x++) {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
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

    public function actionVerification($email, $hash)
    {
        $table = new User;
        $message = null;
        $user = $table->find()->where(["email" => $email, "email_hash" => $hash])->one();

        if ($user && $user->active == 0) {
            $user->updateAttributes(['active' => 1]);
            $message = 'Su cuenta <b style="color: #0a73bb">' . $user->email . '</b> ha sido verificada exitosamente.';
        } else if ($user && $user->active == 1) {
            $message = 'Su cuenta <b style="color: #0a73bb">' . $user->email . '</b> ya ha sido verificada exitosamente.';
        } else {
            $message = 'No se ha podido verificar su cuenta.';
        }
        return $this->render('verification', ['message' => $message]);
    }

    public function actionMessage($email)
    {
        $table = new User;
        $msg = null;

        $user = $table->find()->where(["email" => $email])->one();
        $user && $user->active == 0 ? $msg = 'Se ha enviado un correo de verificación a <b style="color: #0a73bb">' . $user->email . '</b> por favor revisar su correo electrónico.' : $this->redirect(['/']);;

        return $this->render('message', ['message' => $msg]);
    }

    protected function sendEmail($email, $username, $hash)
    {
        $message = '<div align="center" style="border-style:solid; border-width:thin; border-color:#dadce0; border-radius:8px; padding:40px 20px; width: 600px">' .
            '<h1 style="color: #000000">Por favor verifique su correo electrónico</h1>' .
            '<h2 style="color: #000000">Saludos ' . $username . ',</h2>' .
            '<h3 style="color: #000000">Necesitamos verificar su dirección de correo electrónico antes de activar su cuenta en CSIRT API.</h3>' . '<br><br>' .
            '<div>' .
            '<a style=\'background-color:#447fb4;color:#ffffff;display:inline-block;line-height:44px;text-align:center;text-decoration:none;width:180px;border-radius:4px\'
                            target=\'_blank\' href=\'http://csirt-api.test/site/verification?email=' . $email . '&hash=' . $hash . '\'>
                            VERIFICAR
                            </a>' .
            '</div>' . '<br><br>' .
            '<p align="center">Enlace de Verificación: <a href="http://csirt-api.test/site/verification?email=' . $email . '&hash=' . $hash . '">http://csirt-api.test/site/verification?email=' . $email . '&hash=' . $hash . '</a></p>' .
            '</div>';
        //Yii::$app->params['adminEmail']

        Yii::$app->mailer->compose()
            ->setFrom('arevaloalex9@hotmail.com')
            ->setTo($email)
            ->setSubject('Verifique su correo electrónico CSIRT API')
            ->setHtmlBody($message)
            ->send();
    }
}
