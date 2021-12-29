<?php

namespace backend\controllers;

use backend\models\PostCategory;
use backend\models\PostCategorySearch;
use common\components\encrypt\CryptHelper;
use common\components\helpers\StringHelper;
use common\components\SystemConstant;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostCategoryController implements the CRUD actions for PostCategory model.
 */
class PostCategoryController extends Controller
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
     * Lists all PostCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if (Yii::$app->request->post('hasEditable')) {
            // which rows has been edited?
            $_id = $_POST['editableKey'];
            $_index = $_POST['editableIndex'];
            // which attribute has been edited?
            $attribute = $_POST['editableAttribute'];
            if ($attribute == 'title') {
                // update to db
                $value = $_POST['PostCategory'][$_index][$attribute];
                $result = PostCategory::updatePostCategoryTitle($_id, $attribute, $value);
                // response to gridview
                return json_encode($result);
            } elseif ($attribute == 'status') {
                // update to db
                $value = $_POST['PostCategory'][$_index][$attribute];
                $result = PostCategory::updatePostCategoryStatus($_id, $attribute, $value);
                // response to gridview
                return json_encode($result);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PostCategory model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PostCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->slug = StringHelper::toSlug($model->title);
                $model->created_at = date('Y-m-d H:m:s');
                $model->updated_at = date('Y-m-d H:m:s');
                $model->status = SystemConstant::STATUS_ACTIVE;
                if ($model->save()) {
                    return $this->redirect(Url::toRoute('post-category/'));
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PostCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PostCategory model.
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
     * Finds the PostCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PostCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
    }
}
