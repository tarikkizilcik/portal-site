<?php
namespace kouosl\site\controllers\backend;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kouosl\site\models\LoginForm;

/**
 * Site controller
 */
class AuthController extends DefaultController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        // return [
        //     'access' => [
        //         'class' => AccessControl::className(),
        //         'rules' => [
        //             [
        //                 'actions' => ['login', 'error','lang'],
        //                 'allow' => true,
        //             ],
        //             [
        //                 'actions' => ['logout', 'index'],
        //                 'allow' => true,
        //                 'roles' => ['@'],
        //             ],
        //         ],
        //     ],
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'logout' => ['post'],
        //         ],
        //     ],
        // ];
        $behaviors = parent::behaviors();
        return $behaviors;
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
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLang($lang){
        yii::$app->session->set('lang',$lang);
        return $this->goHome();
    }
}
