<?php

namespace backend\controllers;

use backend\models\GeoLocation;
use backend\models\Order;
use backend\models\OrderSearch;
use backend\models\Product;
use backend\models\TrackingStatus;
use backend\models\User;
use common\components\encrypt\CryptHelper;
use common\components\SystemConstant;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST', 'GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->layout = 'adminlte3';
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true; // or false to not run the action
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $arrOrder = $dataProvider->query->all();
        $arrUser = User::getAllUser();
        $arrProduct = Product::getAllProduct();
        if (Yii::$app->request->post('hasEditable')) {
            // which rows has been edited?
            $_key = $_POST['editableKey'];
            // get order id from the array
            $_id = $arrOrder[$_key]['id'];
            $_index = $_POST['editableIndex'];
            // which attribute has been edited?
            $attribute = $_POST['editableAttribute'];
            $value = $_POST[$attribute];
            if ($attribute == 'notes') {
                // update to db
                $result = Order::updateOrderNotes($_id, $attribute, $value);
            } else {
                // update to db
                $result = Order::updateOrder($_id, $attribute, $value);
            }
            return json_encode($result);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => ArrayHelper::map($arrUser, 'id', 'name'),
            'products' => ArrayHelper::map($arrProduct, 'id', 'name'),
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);
        $arrCustomer = User::getAllCustomer();
        $arrTrackingStatus = TrackingStatus::getAllStatus();
        $post = Yii::$app->request->post();
        // return messages on update of record
        if ($model->load($post)) {
            $model->address = $model->specific_address . ', ' .
                \frontend\models\GeoLocation::getNameGeoLocationById($model->village_id) . ', ' .
                \frontend\models\GeoLocation::getNameGeoLocationById($model->district_id) . ', ' .
                \frontend\models\GeoLocation::getNameGeoLocationById($model->province_id);
            $model->admin_id = Yii::$app->user->identity->getId();
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save(false)) {
                Yii::$app->session->setFlash('kv-detail-success', 'Cập nhật thành công!');
            } else {
                Yii::$app->session->setFlash('kv-detail-warning', 'Không thể cập nhật!');
            }
        }
        return $this->render('view', [
            'model' => $model,
            'customers' => ArrayHelper::map($arrCustomer, 'id', 'name'),
            'trackingStatus' => ArrayHelper::map($arrTrackingStatus, 'id', 'name'),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $users = User::getAllUser();
        $products = Product::getAllProduct();
        $provinces = ArrayHelper::map(GeoLocation::getAllProvince(), 'id', 'name');
        $locations = ArrayHelper::map(GeoLocation::getAllGeoLocation(), 'id', 'name');
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->BL_code = 'DE'.date('YmdHis').chr(rand(97,122)).rand(1,9);
                $model->address = $model['specific_address'] . ', ' . \frontend\models\GeoLocation::getNameGeoLocationById($model['village_id']) . ', ' . \frontend\models\GeoLocation::getNameGeoLocationById($model['district_id']) . ', ' . \frontend\models\GeoLocation::getNameGeoLocationById($model['province_id']);
                $model->admin_id = Yii::$app->user->identity->getId();
                $model->created_at = date('Y-m-d H:i:s');
                $model->updated_at = date('Y-m-d H:i:s');
                $model->status = SystemConstant::STATUS_ACTIVE;
                if ($model->save()) {
                    return $this->redirect(Url::toRoute('order/'));
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'users' => $users,
            'products' => $products,
            'provinces' => $provinces
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $id = CryptHelper::decryptString($id);
        // Not allow anyone to delete
//        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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
                $out = GeoLocation::getDistrictByProvinceID($province_id);
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
                $out = GeoLocation::getDistrictByProvinceID($district_id);
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
}
