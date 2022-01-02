<?php

namespace backend\controllers;

use backend\models\Product;
use backend\models\ProductAssoc;
use backend\models\ProductCategory;
use backend\models\ProductSearch;
use backend\models\ProductType;
use backend\models\Trademark;
use common\components\encrypt\CryptHelper;
use common\components\helpers\StringHelper;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if (Yii::$app->request->post('hasEditable')) {
            // which rows has been edited?
            $_id = $_POST['editableKey'];
            $_index = $_POST['editableIndex'];
            // which attribute has been edited?
            $attribute = $_POST['editableAttribute'];
            $value = $_POST['Product'][$_index][$attribute];
            if ($attribute == 'name') {
                $result = Product::updateProductTitle($_id, $attribute, $value);
            } elseif ($attribute == 'discount') {
                $result = Product::updateDiscount($_id, $value);
            } else {
                $result = Product::updateProductAttr($_id, $attribute, $value);
            }
            return json_encode($result);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);
        $assocModel = ProductAssoc::findOne([
            'product_id' => $id
        ]);
        $model->type = $assocModel->type_id;
        $model->category = $assocModel->category_id;
        $arrTrademark = Trademark::getAllTrademark();
        $arrType = ProductType::getAllTypes();
        $arrCate = ProductCategory::getAllProductCategory();
        $arrProduct = Product::getAllProduct();
        $post = Yii::$app->request->post();
        // process ajax delete
        if (Yii::$app->request->isAjax && isset($post['kvdelete'])) {
            echo Json::encode([
                'success' => true,
                'messages' => [
                    'kv-detail-info' => Yii::t('app', 'Delete successfully!')
                ]
            ]);
            return;
        }
        // return messages on update of record
        if ($model->load($post)) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->slug = trim(StringHelper::toSlug(trim($model->name)));
            if ($model->file) {
                if (!file_exists(Yii::getAlias('@common/media/product'))) {
                    mkdir(Yii::getAlias('@common/media/product'), 0777);
                }
                $imageUrl = Yii::getAlias('@common/media');
                $fileName = 'product/' . $model->slug . '.' . $model->file->getExtension();
                $isUploadedFile = $model->file->saveAs($imageUrl . '/' . $fileName);
                if ($isUploadedFile) {
                    $model->image = $fileName;
                }
            }
            if (!empty($model->discount)) {
                $salePrice = $model->regular_price * (100 - $model->discount) / 100;
                $model->sale_price = round($salePrice, -3);
                $model->selling_price = $model->sale_price;
            }
            $model->admin_id = Yii::$app->user->identity->getId();
            $model->updated_at = date('Y-m-d H:i:s');
            $model->related_product = (!empty($model->relatedProduct)) ? implode(',', $model->relatedProduct) : null;
            // assoc
            if (!empty($model->type)) {
                $assocModel->type_id = implode(',', $model->type);
            }
            if (!empty($model->category)) {
                $assocModel->category_id = $model->category;
            }
            $assocModel->admin_id = Yii::$app->user->identity->getId();
            $assocModel->updated_at = date('Y-m-d H:i:s');
            if ($model->save(false) && $assocModel->save(false)) {
                Yii::$app->session->setFlash('kv-detail-success', 'Cập nhật thành công!');
            } else {
                Yii::$app->session->setFlash('kv-detail-warning', 'Không thể cập nhật!');
            }
        }
        return $this->render('view', [
            'model' => $model,
            'trademark' => ArrayHelper::map($arrTrademark, 'id', 'name'),
            'type' => ArrayHelper::map($arrType, 'id', 'name'),
            'productCate' => ArrayHelper::map($arrCate, 'id', 'name'),
            'products' => ArrayHelper::map($arrProduct, 'id', 'name')
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->scenario = 'create';
        $assocModel = new ProductAssoc();
        $arrTrademark = Trademark::getAllTrademark();
        $arrType = ProductType::getAllTypes();
        $arrCate = ProductCategory::getAllProductCategory();
        $arrProduct = Product::getAllProduct();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->files = UploadedFile::getInstances($model, 'files');
                $arrImages = [];
                $model->slug = StringHelper::toSlug($model->name);
                if(!empty($model->discount) && !empty($model->sale_price)) {
                    $model->selling_price = ($model->sale_price >= $model->regular_price) ? $model->regular_price : $model->sale_price;
                    $model->discount = ($model->sale_price >= $model->regular_price) ? 0 : round(100 -$model->sale_price / $model->regular_price * 100);
                } else {
                    if (!empty($model->discount)) {
                        $model->sale_price = round($model->regular_price * (100 - $model->discount) / 100, -3);
                        $model->selling_price = $model->sale_price;
                    }
                    if (empty($model->sale_price)) {
                        $model->selling_price = $model->regular_price;
                    } else {
                        $model->selling_price = ($model->sale_price >= $model->regular_price) ? $model->regular_price : $model->sale_price;
                        $model->discount = ($model->sale_price >= $model->regular_price) ? 0 : round(100 - $model->sale_price / $model->regular_price * 100);
                    }
                }
                $model->related_product = (!empty($model->relatedProduct)) ? implode(',', $model->relatedRecords) : null;
                $model->admin_id = Yii::$app->user->identity->getId();
                $model->created_at = date('Y-m-d H:i:s');
                $model->updated_at = date('Y-m-d H:i:s');
                $sold = rand(201, 996);
                $model->fake_sold = $sold;
                $model->sold = $sold;
                $model->viewed = rand(345, 9876);
                if ($model->file) {
                    if (!file_exists(Yii::getAlias('@common/media/product'))) {
                        mkdir(Yii::getAlias('@common/media/product'), 0777);
                    }
                    $imageUrl = Yii::getAlias('@common/media');
                    $imgPath = 'product/' . implode("-", $model->type) . '_' . $model->category . '_' . $model->slug . '.' . $model->file->getExtension();
                    $isUploadedImage = $model->file->saveAs($imageUrl . '/' . $imgPath);
                    if ($isUploadedImage){
                        $model->image = $imgPath;
                    }
                    if ($model->files) {
                        $count = 1;
                        foreach ($model->files as $key => $file) {
                            $imagePath = 'product/' . implode("-", $model->type) . '_' . $model->category . '_' . $model->slug . '_' . $count . '.' . $file->getExtension();
                            $arrImages[$key] = $imagePath;
                            $file->saveAs($imageUrl . '/' . $imagePath);
                            $count++;
                        }
                    }
                    $model->images = implode(",", $arrImages);
                }
                $typeStr = (!empty($model->type)) ? ','.implode(',', $model->type).',' : null;
                $cateStr = $model->category;
                if ($model->save(false)) {
                    $assocModel->product_id = $model->id;
                    $assocModel->type_id = $typeStr;
                    $assocModel->category_id = $cateStr;
                    $assocModel->admin_id = Yii::$app->user->identity->getId();
                    $assocModel->created_at = date('Y-m-d H:i:s');
                    $assocModel->updated_at = date('Y-m-d H:i:s');
                    if ($assocModel->save(false)) {
                        return $this->redirect(Url::toRoute('product/'));
                    } else {
                        return $assocModel->errors;die;
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'trademark' => $arrTrademark,
            'type' => $arrType,
            'productCate' => $arrCate,
            'products' => $arrProduct
        ]);
    }

    /**
     * Updates an existing Product model.
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
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $id = CryptHelper::decryptString($id);
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
