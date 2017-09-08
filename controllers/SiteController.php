<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Users;
use app\models\UsersInformation;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\UserLog;
use app\models\BaseModel;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
        if (!\Yii::$app->user->isGuest) {

            /*Yii::$app->session->setFlash('info',[
                'type' => 'info',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'message' => 'You are in Homepage. Please enjoy using the system.',
                'title' => 'Hi, ' . BaseModel::getUserFullName(Yii::$app->user->identity->id) . '!',
            ]);*/

            return $this->render('index');
        } else {
            return $this->actionLogin();
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'LoginLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $userLog = new UserLog();
            $userLog->user_id = Yii::$app->user->identity->id;
            $userLog->login_date = date('Y-m-d m:h:s');
            $userLog->logout_date = "0000-00-00 00:00:00";
            $userLog->remarks = "Login";
            $userLog->save();

            return $this->goBack();
        }
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
        $userID = Yii::$app->user->identity->id;

        Yii::$app->user->logout();

        $userLog = new UserLog();
        $userLog->user_id = $userID;
        $userLog->login_date = "0000-00-00 00:00:00";
        $userLog->logout_date = date('Y-m-d m:h:s');
        $userLog->remarks = "Logout";
        $userLog->save();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    /*public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }*/

    /**
     * Displays about page.
     *
     * @return string
     */
    /*public function actionAbout()
    {
        return $this->render('about');
    }
*/

    public function actionSignup() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Users();
        $this->layout = 'LoginLayout';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            //$hash = Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);

            $model->password_hash = $hash;
            $model->password_hash2 = $hash; // this line if commented shows do not match error from model
            $model->status = 0; //10 is for active and inactive is 0
            $model->created_at = $created_at = strtotime(date("Y-m-d H:i:s"));
            $model->profile_pic = '/uploads/profile_pictures/avatar.jpg';
            if ($model->save()) {

                $userInfo = new UsersInformation();
                $userInfo->user_id = $model->id;
                $userInfo->firstName = 'YourFirstName';
                $userInfo->middleName = 'YourMiddleName';
                $userInfo->lastName = 'YourLastName';
                $userInfo->save();

                Yii::$app->session->setFlash('success',[
                    'type' => 'success',
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'message' => 'Account successfully created.',
                    'title' => 'Well done, ' . $model->username . '!',
                ]);
                return $this->redirect('login');

            } else {
                Yii::$app->session->setFlash('danger',[
                    'type' => 'danger',
                    'icon' => 'glyphicon glyphicon-remove-sign',
                    'message' => 'Account not created',
                    'title' => 'Please try again!',
                ]);
                return $this->redirect('login');
            }
        }
        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /*----------------*
 * PASSWORD RESET *
 *----------------*/

    /**
     * Sends email that contains link for password reset action.
     *
     * @return string|\yii\web\Response
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = "loginLayout";
        $model = new PasswordResetRequestForm();

        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            return $this->render('requestPasswordResetToken', ['model' => $model]);
        }

        if (!$model->sendEmail()) {
            Yii::$app->session->setFlash('danger',[
                'type' => 'danger',
                'icon' => 'glyphicon glyphicon-remove-sign',
                'message' => 'Sorry, we are unable to reset password for email provided.',
                'title' => 'Please try again!',
            ]);
            return $this->refresh();
        }

        Yii::$app->session->setFlash('success',[
            'type' => 'success',
            'icon' => 'glyphicon glyphicon-ok-sign',
            'message' => 'Check your email for further instructions.',
            'title' => 'Well done!',
        ]);
        return $this->goHome();
    }

    /**
     * Resets password.
     *
     * @param  string $token Password reset token.
     * @return string|\yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = "loginLayout";
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if (!$model->load(Yii::$app->request->post()) || !$model->validate() || !$model->resetPassword()) {
            return $this->render('resetPassword', ['model' => $model]);
        }

        Yii::$app->session->setFlash('success',[
            'type' => 'success',
            'icon' => 'glyphicon glyphicon-ok-sign',
            'message' => 'Your password has been changed.',
            'title' => 'Well done!',
        ]);
        return $this->goHome();      
    }        
}
