<?php

namespace frontend\controllers;

use common\components\encrypt\CryptHelper;
use frontend\models\Cart;
//use frontend\models\OrderForm;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class CartController extends \yii\web\Controller
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

    public function beforeAction($action)
    {
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) {
            $currentUrl = Yii::$app->request->getUrl();
            return $this->redirect('/site/login?ref=' . $currentUrl);
        }
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true; // or false to not run the action
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

    /**
     * @return string|void
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest){
            $cart = Cart::getCartByUserId(\Yii::$app->user->identity->getId());
            return $this->render('index', [
                'cart' => $cart,
            ]);
        }
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteCart($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = new \common\models\Cart();
        $model->findOne($id)->delete();
        return $this->redirect(['index']);
    }
}
