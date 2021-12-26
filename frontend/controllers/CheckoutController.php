<?php

namespace frontend\controllers;

use common\components\MailServer;
use common\components\SystemConstant;
use common\models\Product;
use frontend\models\GeoLocation;
use common\components\encrypt\CryptHelper;
use common\models\Order;
use frontend\models\Cart;
use frontend\models\OrderForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class CheckoutController extends \yii\web\Controller
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
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $model = new OrderForm();
        $provinces = ArrayHelper::map(\backend\models\GeoLocation::getAllProvince(), 'id', 'name');
        $cart = Cart::getCartByUserId(Yii::$app->user->identity->getId());
        if (count($cart) < 1) {
            return $this->redirect(\yii\helpers\Url::toRoute('cart/index'));
        } else {
            if ($model->load(Yii::$app->request->post())) {
                $order = Yii::$app->request->post('OrderForm');
                $arrCartId = CryptHelper::decryptAllElementInArray(explode(',', $order['cart']));
                $arrProductId = CryptHelper::decryptAllElementInArray(explode(',', $order['product_id']));
                $count = 0;
                $arrOrderInformMail = [];
                $BL_code = 'MK'.date('YmdHis').chr(rand(97,122)).rand(1,9);
                foreach ($arrCartId as $key => $cartId) {
                    $orderModel = new Order();
                    $orderModel->BL_code = $BL_code;
                    $orderModel->user_id = Yii::$app->user->identity->getId();
                    $orderModel->product_id = intval($arrProductId[$key]);
                    $orderModel->quantity = intval(explode(',', $order['quantity'])[$key]);
                    if (intval($order['logistic_method']) != 1) {
                        $orderModel->province_id = intval($order['province_id']);
                        $orderModel->district_id = intval($order['district_id']);
                        $orderModel->village_id = intval($order['village_id']);
                        $orderModel->specific_address = $order['specific_address'];
                        $orderModel->address = $order['specific_address'] . ', ' . GeoLocation::getNameGeoLocationById(intval($order['village_id'])) . ', ' . GeoLocation::getNameGeoLocationById(intval($order['district_id'])) . ', ' . GeoLocation::getNameGeoLocationById(intval($order['province_id']));
                    }
                    $orderModel->tel = $order['tel'];
                    $orderModel->name = $order['name'];
                    $orderModel->email = $order['email'];
                    $orderModel->admin_id = 1;
                    $orderModel->logistic_method = $order['logistic_method'];
                    $orderModel->created_at = date('Y-m-d H:i:s');
                    $orderModel->updated_at = date('Y-m-d H:i:s');
                    if ($orderModel->save(false)) {
                        $productModel = Product::findOne($orderModel->product_id);
                        $arrOrderInformMail[$key]['BL_code'] = $BL_code;
                        $arrOrderInformMail[$key]['product_id'] = $orderModel->product_id;
                        $arrOrderInformMail[$key]['SKU'] = $productModel->SKU;
                        $arrOrderInformMail[$key]['product_image'] = $productModel->image;
                        $arrOrderInformMail[$key]['product_price'] = $productModel->selling_price;
                        $arrOrderInformMail[$key]['quantity'] = $orderModel->quantity;
                        $cartModel = \common\models\Cart::findOne($cartId);
                        $cartModel->status = SystemConstant::STATUS_INACTIVE;
                        if (!$cartModel->save()) {
                            var_dump($cartModel->errors);
                            die;
                        };
                        $count++;
                    } else {
                        var_dump($orderModel->errors);
                        die;
                    }
                }
                // send mail to inform admin & client
                $mailSubjectAdmin = 'MinhKhanh - '.Yii::t('app', 'A new order has been initialized!') . ' '.Yii::t('app','Billing code:') . $BL_code;
                MailServer::sendMailOrderInformAdmin($mailSubjectAdmin, $arrOrderInformMail);
                $mailSubjectCustomer = Yii::t('app','MinhKhanh - Order placed successfully!'). ' '.Yii::t('app','Your billing code:') . $BL_code;
                MailServer::sendMailOrderInformCustomer($mailSubjectCustomer, $model['email'], $arrOrderInformMail);
                // ./ send mail to inform admin & client
                if ($count == count($cart)) {
                    Yii::$app->session->setFlash('creatOrderSuccess', Yii::t('app', 'Your order has been initialized.'));
                    return $this->redirect(\yii\helpers\Url::toRoute('cart/index'));
                } else {
                    Yii::$app->session->setFlash('creatOrderError', Yii::t('app', 'Unable to initiate order.'));
                }
            }
            return $this->render('index', [
                'model' => $model,
                'provinces' => $provinces,
                'cart' => $cart
            ]);
        }
    }

    /**
     * @return array|string[]
     */
    public function actionGetDistrict()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = \backend\models\GeoLocation::getDistrictByProvinceID($province_id);
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    /**
     * @return array|string[]
     */
    public function actionGetVillage()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $district_id = $parents[0];
                $out = \backend\models\GeoLocation::getDistrictByProvinceID($district_id);
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
}