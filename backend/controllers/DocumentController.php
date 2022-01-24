<?php

namespace backend\controllers;

use backend\models\Document;
use backend\models\DocumentSearch;
use common\components\encrypt\CryptHelper;
use common\components\helpers\StringHelper;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
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
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $arrType = ['Camera', 'Elevator'];
        if (Yii::$app->request->post('hasEditable')) {
            // which rows has been edited?
            $_id = $_POST['editableKey'];
            $_index = $_POST['editableIndex'];
            // which attribute has been edited?
            $attribute = $_POST['editableAttribute'];
            $value = $_POST['Document'][$_index][$attribute];
            $result = Document::updateDocument($_id, $attribute, $value);
            // response to gridview
            return json_encode($result);
        }
        return $this->render('index', [
            'arrType' => $arrType,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $id = CryptHelper::decryptString($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();
        $arrType = ['Camera', 'Elevator'];
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->documentFile = UploadedFile::getInstance($model, 'documentFile');
                $slug = StringHelper::toSlug($model->title);
                if ($model->imageFile) {
                    if (!file_exists(Yii::getAlias('@common/media/document'))) {
                        mkdir(Yii::getAlias('@common/media/document'), 0777);
                    }
                    $imageUrl = Yii::getAlias('@common/media');
                    $imgPath = 'document/' . date('YmdHis') . $slug . '.' . $model->imageFile->getExtension();
                    $isUploadedImage = $model->imageFile->saveAs($imageUrl . '/' . $imgPath);
                    if ($isUploadedImage){
                        $model->image = $imgPath;
                    }
                }
                if ($model->documentFile) {
                    if (!file_exists(Yii::getAlias('@common/documents'))) {
                        mkdir(Yii::getAlias('@common/documents'), 0777);
                    }
                    $documentUrl = Yii::getAlias('@common/documents');
                    $documentPath = date('YmdHis') . $slug . '.' . $model->documentFile->getExtension();
                    $isUploadedDocument = $model->documentFile->saveAs($documentUrl . '/' . $documentPath);
                    if ($isUploadedDocument){
                        $model->link = $documentPath;
                    }
                }
                $model->admin_id = Yii::$app->user->identity->getId();
                $model->created_at = date('Y-m-d H:i:s');
                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    return $this->redirect(Url::toRoute('document/'));
                } else {
                    return $model->errors;die;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'arrType' => $arrType,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);
        $arrType = ['Camera', 'Elevator'];
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->documentFile = UploadedFile::getInstance($model, 'documentFile');
                $slug = StringHelper::toSlug($model->title);
                if ($model->imageFile) {
                    if (!file_exists(Yii::getAlias('@common/media/document'))) {
                        mkdir(Yii::getAlias('@common/media/document'), 0777);
                    }
                    $imageUrl = Yii::getAlias('@common/media');
                    $imgPath = 'document/' . date('YmdHis') . $slug . '.' . $model->imageFile->getExtension();
                    $isUploadedImage = $model->imageFile->saveAs($imageUrl . '/' . $imgPath);
                    if ($isUploadedImage){
                        $model->image = $imgPath;
                    }
                }
                if ($model->documentFile) {
                    if (!file_exists(Yii::getAlias('@common/documents'))) {
                        mkdir(Yii::getAlias('@common/documents'), 0777);
                    }
                    $documentUrl = Yii::getAlias('@common/documents');
                    $documentPath = date('YmdHis') . $slug . '.' . $model->documentFile->getExtension();
                    $isUploadedDocument = $model->documentFile->saveAs($documentUrl . '/' . $documentPath);
                    if ($isUploadedDocument){
                        $model->link = $documentPath;
                    }
                }
                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    return $this->redirect(Url::toRoute('document/'));
                } else {
                    return $model->errors;die;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'arrType' => $arrType,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Document model.
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
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
