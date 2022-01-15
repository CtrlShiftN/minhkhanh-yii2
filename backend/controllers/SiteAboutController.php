<?php

namespace backend\controllers;

use backend\models\SiteAbout;
use backend\models\SiteAboutSearch;
use common\components\encrypt\CryptHelper;
use common\components\helpers\StringHelper;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SiteAboutController implements the CRUD actions for SiteAbout model.
 */
class SiteAboutController extends Controller
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
                    ]
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
        return true;
    }

    /**
     * Lists all SiteAbout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiteAboutSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if (Yii::$app->request->post('hasEditable')) {
            // which rows has been edited?
            $_id = $_POST['editableKey'];
            $_index = $_POST['editableIndex'];
            // which attribute has been edited?
            $attribute = $_POST['editableAttribute'];
            // update to db
            $value = $_POST['SiteAbout'][$_index][$attribute];
            $result = SiteAbout::updateAttr($_id, $attribute, $value);
            // response to gridview
            return json_encode($result);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SiteAbout model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                if (!file_exists(Yii::getAlias('@common/media/site-our-stories'))) {
                    mkdir(Yii::getAlias('@common/media/site-our-stories'), 0777);
                }
                $imageUrl = Yii::getAlias('@common/media');
                $slug = trim(StringHelper::toSlug(trim($model->file->getBaseName())));
                $fileName = 'site-our-stories/' . '_' . date('YmdHis') . $slug . '.' . $model->file->getExtension();
                $isUploadedFile = $model->file->saveAs($imageUrl . '/' . $fileName);
                if ($isUploadedFile) {
                    $model->image = $fileName;
                }
            }
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
        ]);
    }

    /**
     * Creates a new SiteAbout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SiteAbout();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SiteAbout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SiteAbout model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $id = CryptHelper::decryptString($id);
//        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SiteAbout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SiteAbout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiteAbout::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
