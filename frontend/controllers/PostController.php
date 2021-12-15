<?php

namespace frontend\controllers;

use common\components\encrypt\CryptHelper;
use common\components\helpers\ParamHelper;
use common\components\SystemConstant;
use frontend\models\Post;
use frontend\models\PostCategory;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class PostController extends \yii\web\Controller
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
     * Show all post
     * @return string
     */
    public function actionIndex()
    {
        $paramPostTag = ParamHelper::getParamValue('post_tag');
        $paramPostCategory = ParamHelper::getParamValue('post_category');
        $getQueryAllPost = Post::getAllPosts($paramPostTag, $paramPostCategory);
        $pages = new Pagination(['totalCount' => $getQueryAllPost->count(), 'defaultPageSize' => SystemConstant::POST_PER_PAGE]);
        $post = $getQueryAllPost->offset($pages->offset)
            ->limit(SystemConstant::POST_PER_PAGE)
            ->all();
        return $this->render('index', [
            'post' => $post,
            'pages' => $pages,
        ]);
    }

    public function actionDetail()
    {
        $postID = ParamHelper::getParamValue('id');
        $postID = CryptHelper::decryptString($postID);
        $model = \common\models\Post::findOne($postID);
        $model->viewed += 1;
        $model->save();
        $postDetail = Post::getPostDetailByID($postID);
        return $this->render('detail', [
            'postDetail' => $postDetail,
        ]);
    }

}
