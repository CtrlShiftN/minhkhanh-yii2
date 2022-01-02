<?php

namespace backend\controllers;

use backend\models\Post;
use backend\models\PostCategory;
use backend\models\PostSearch;
use backend\models\PostTag;
use common\components\encrypt\CryptHelper;
use common\components\helpers\StringHelper;
use common\components\SystemConstant;
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
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if (Yii::$app->request->post('hasEditable')) {
            // which rows has been edited?
            $_id = $_POST['editableKey'];
            $_index = $_POST['editableIndex'];
            // which attribute has been edited?
            $attribute = $_POST['editableAttribute'];
            // update to db
            $value = $_POST['Post'][$_index][$attribute];
            if ($attribute == 'title') {
                $result = Post::updatePostTitle($_id, $attribute, $value);
            } else {
                $result = Post::updatePost($_id, $attribute, $value);
            }
            // response to gridview
            return json_encode($result);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);
        $arrTag = PostTag::find()->where(
            [
                'status' => SystemConstant::STATUS_ACTIVE,
                'id' => explode(',', $model->tag_id)
            ])->asArray()->all();
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
            $model->slug = trim(StringHelper::toSlug(trim($model->title)));
            if ($model->file) {
                if (!file_exists(Yii::getAlias('@common/media/post'))) {
                    mkdir(Yii::getAlias('@common/media/post'), 0777);
                }
                $imageUrl = Yii::getAlias('@common/media');
                $fileName = 'post/' . $model->slug . '.' . $model->file->getExtension();
                $isUploadedFile = $model->file->saveAs($imageUrl . '/' . $fileName);
                if ($isUploadedFile) {
                    $model->avatar = $fileName;
                }
            }
            if (!empty($model->tags)) {
                $model->tag_id = implode(',', $model->tags);
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
            'tags' => ArrayHelper::map($arrTag, 'id', 'title'),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->scenario = 'create';
        $arrTagId = PostTag::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
        $arrPostCategory = PostCategory::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->slug = trim(StringHelper::toSlug(trim($model->title)));
                if ($model->file) {
                    if (!file_exists(Yii::getAlias('@common/media/post'))) {
                        mkdir(Yii::getAlias('@common/media/post'), 0777);
                    }
                    $imageUrl = Yii::getAlias('@common/media');
                    $fileName = 'post/' . $model->slug . '.' . $model->file->getExtension();
                    $isUploadedFile = $model->file->saveAs($imageUrl . '/' . $fileName);
                    if ($isUploadedFile) {
                        $model->avatar = $fileName;
                    }
                }
                if (!empty($model->tags)) {
                    $model->tag_id = implode(",", $model->tags);
                }
                $model->admin_id = Yii::$app->user->identity->getId();
                $model->created_at = date('Y-m-d H:i:s');
                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    return $this->redirect(Url::toRoute('post/'));
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'postTag' => $arrTagId,
            'postCate' => $arrPostCategory
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $id = CryptHelper::decryptString($id);
        $model = $this->findModel($id);
        $arrTagId = PostTag::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
        $arrPostCategory = PostCategory::find()->where(['status' => SystemConstant::STATUS_ACTIVE])->asArray()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->slug = trim(StringHelper::toSlug(trim($model->title)));
                if ($model->file) {
                    if (!file_exists(Yii::getAlias('@common/media'))) {
                        mkdir(Yii::getAlias('@common/media'), 0777);
                    }
                    $imageUrl = Yii::getAlias('@common/media');
                    $fileName = $model->slug . '.' . $model->file->getExtension();
                    $isUploadedFile = $model->file->saveAs($imageUrl . '/post/' . $fileName);
                    if ($isUploadedFile) {
                        $model->avatar = 'post/' . $fileName;
                    }
                }
                if (!empty($model->tags)) {
                    $model->tag_id = implode(",", $model->tags);
                }
                $model->admin_id = Yii::$app->user->identity->getId();
                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    return $this->redirect(Url::toRoute('post/'));
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'postTag' => $arrTagId,
            'postCate' => $arrPostCategory
        ]);
    }

    /**
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
