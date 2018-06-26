<?php

namespace app\controllers;

use app\components\EmailHelper;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['user/login']);
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    /*public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = Users::findOne(Yii::$app->user->id);
            if (!empty($user->categories[0]->id)) {
                return $this->redirect(['category/clean-view', 'id' => base64_encode($user->categories[0]->id)]);
            } else {
                return $this->redirect(['site/index']);
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }*/

    /**
     * Logout action.
     *
     * @return string
     */
    /*public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }*/

    /**
     * ForgotPassword action.
     *
     * @return string
     */
    /*public function actionForgotPassword()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (Yii::$app->request->post()) {
            $email = @$_POST['email_address'];
            $model = Users::find()->where(['email' => $email])->one();
            if (!empty($model)) {
                $html = "Your Password is : {$model->password}";
                $sub = 'Project FollowUps :: Password';
                EmailHelper::Send($model->email, Yii::$app->params['adminEmail'], $sub, $html);
                \Yii::$app->getSession()->setFlash('passwordSent', 'Your password has been sent to your email');
            } else {
                \Yii::$app->getSession()->setFlash('passwordSent', 'We could not find your Email Address. Please enter a valid Email Address');
            }
        }
        return $this->render('forgot-password');
    }*/

    /**
     * Displays contact page.
     *
     * @return string
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
    }*/
}
