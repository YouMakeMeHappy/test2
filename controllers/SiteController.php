<?php

namespace app\controllers;

use app\events\RegistrationEvent;
use app\models\RegistrationForm;
use app\models\User;
use Yii;
use yii\base\Event;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public $defaultAction = 'registration';

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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
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

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Registration action.
     *
     * @return Response|string
     */
    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('site/index');
        }

        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && ($user = $model->createUser())) {
            Yii::$app->user->trigger(RegistrationEvent::EVENT_CREATE, (new RegistrationEvent())->setUser($user));
            Yii::$app->user->login($user, 0);
            return $this->goBack();
        }

        return $this->render('registration', [
            'model' => $model,
        ]);
    }

    public function oAuthSuccess($client) {
        $userAttributes = $client->getUserAttributes();

        if (!($user = User::findByEmail($userAttributes['email']))) {
            $user = new User();
            $user->email = $userAttributes['email'];
            $user->password = uniqid('pwd_' . time());

            if ($user->save()) {
                Yii::$app->user->trigger(RegistrationEvent::EVENT_CREATE, (new RegistrationEvent())->setUser($user));
            }
        }

        Yii::$app->user->login($user, 0);
    }
}
