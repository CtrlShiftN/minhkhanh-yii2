<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\MixAndMatch;
use backend\models\Order;
use backend\models\TailorMadeOrder;
use backend\models\User;
use common\components\SystemConstant;
use common\models\Product;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
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
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = 'adminlte3';
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true; // or false to not run the action
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $latestProduct = Product::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->orderBy('created_at DESC')->limit(5)->asArray()->all();
        $latestOrders = Order::getLatestOrder(5);
        $statusBG = Order::getStatusColor();
        $totalActiveUsers = User::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->count();
        $totalOrders = Order::find()->where(['<=', 'status', 4])->count();
        return $this->render('index', [
            'products' => $latestProduct,
            'orders' => $latestOrders,
            'statusBG' => $statusBG,
            'totalActiveUsers' => $totalActiveUsers,
            'totalOrder' => $totalOrders,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

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
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
