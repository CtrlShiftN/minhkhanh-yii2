<?php

namespace frontend\controllers;

use common\components\encrypt\CryptHelper;
use common\components\helpers\ParamHelper;
use frontend\models\ProductType;
use frontend\models\Product;
use frontend\models\ProductCategory;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class ShopController extends Controller
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
                        'roles' => ['?', '@'],
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $paramCate = ParamHelper::getParamValue('type');
        $getProductType = ProductType::getAllProductType();
        return $this->render('index', [
            'productType' => $getProductType,
            'paramCate' => $paramCate,
        ]);
    }

    /**
     * @return string
     */
    public function actionDetail()
    {
        $getParamDetail = ParamHelper::getParamValue('detail');
        if (!empty($getParamDetail)) {
            $detailID = CryptHelper::decryptString($getParamDetail);
            $productDetail = Product::getProductById($detailID);
            $model = \common\models\Product::findOne($detailID);
            $model->viewed += 1;
            $model->save();
            if (!empty($productDetail)) {
                return $this->render('detail', [
                    'detail' => $productDetail,
                ]);
            } else {
                return $this->render('index');
            }
        } else {
            return $this->render('index');
        }

    }
}