<?php

namespace backend\controllers;

use backend\models\SiteContact;
use backend\models\SiteContactSearch;
use common\components\encrypt\CryptHelper;
use common\components\helpers\StringHelper;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SiteContactController implements the CRUD actions for SiteContact model.
 */
class SiteContactController extends Controller
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
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function beforeAction($action)
    {
        $this->layout = 'adminlte3';
        if (!parent::beforeAction($action))
        {
            return false;
        }
        return true;
    }

    /**
     * Lists all SiteContact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiteContactSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if(\Yii::$app->request->post('hasEditable')) {
            $_id = $_POST['editableKey'];
            $_index = $_POST['editableIndex'];
            //which attribute has been edited?
            $attribute = $_POST['editableAttribute'];
            //update to db
            $value = $_POST['SiteContact'][$_index][$attribute];
            $result = SiteContact::updateSiteContact($_id, $attribute, $value);
            return json_encode($result);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SiteContact model.
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
                if (!file_exists(Yii::getAlias('@common/media/contact-logo'))) {
                    mkdir(Yii::getAlias('@common/media/contact-logo'), 0777);
                }
                $imageUrl = Yii::getAlias('@common/media/contact-logo');
                $fileName =  date('YmdHis') . 'contact-logo/' . $model->file->getExtension();
                $isUploadedFile = $model->file->saveAs($imageUrl.'/'.$fileName);
                if ($isUploadedFile) {
                    $model->logo_link = $fileName;
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
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SiteContact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SiteContact();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
     * Updates an existing SiteContact model.
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
     * Deletes an existing SiteContact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SiteContact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SiteContact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiteContact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
