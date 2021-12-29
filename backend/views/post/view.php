<?php

use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$imgUrl = Yii::$app->params['common'] . '/media';
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
?>
<div class="post-view py-4">
    <?php
    $columns = [
        [
            'attribute' => 'file',
            'type' => DetailView::INPUT_FILEINPUT,
            'label' => Yii::t('app', 'Image'),
            'value' => Html::img($imgUrl . '/' . $model->avatar, ['alt' => $model->title, 'class' => 'img-fluid']),
            'format' => 'raw'
        ],
        [
            'attribute' => 'title',
            'value' => (!empty($model->title)) ? $model->title : null,
        ],
        [
            'attribute' => 'content',
            'type' => 'widget',
            'value' => (!empty($model->content)) ? $model->content : null,
            'widgetOptions' => ['class' => \yii\redactor\widgets\Redactor::class],
//            'displayOnly' => true,
            'format' => 'raw'
        ],
        [
            'attribute' => 'tags',
            'value' => function () use ($tags) {
                if (!empty($tags)) {
                    $html = '';
                    foreach ($tags as $key => $tag) {
                        $html .= '<div class="badge badge-info me-3 p-2">' . $tag . '</div>';
                    }
                } else {
                    $html = null;
                }
                return $html;
            },
            'format' => 'raw',
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(\backend\models\PostTag::getAllTags(), 'id', 'title'),
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Post Tags') . ' --'],
                'pluginOptions' => ['allowClear' => true, 'multiple' => true]
            ],
        ],
        [
            'attribute' => 'post_category_id',
            'value' => (!empty(\backend\models\PostCategory::findOne($model->post_category_id)['title'])) ? \backend\models\PostCategory::findOne($model->post_category_id)['title'] : null,
            'format' => 'raw',
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => ArrayHelper::map(\backend\models\PostCategory::getAllCategory(), 'id', 'title'),
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Post Categories') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
        ],
        [
            'attribute' => 'status',
            'value' => (!empty($arrStatus[$model->status])) ? $arrStatus[$model->status] : null,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $arrStatus,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Status') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'value' => (!empty($model->created_at)) ? $model->created_at : null,
            'displayOnly' => true
        ]
    ]
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'bordered' => true,
//        'enableEditMode' => false,
//        'buttons1' => '{delete}',
        'hAlign' => DetailView::ALIGN_CENTER,
        'vAlign' => DetailView::ALIGN_MIDDLE,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'deleteOptions' => [
            'url' => \yii\helpers\Url::toRoute(['post/delete', 'id' => \common\components\encrypt\CryptHelper::encryptString($model->id)]),
            'params' => ['id' => \common\components\encrypt\CryptHelper::encryptString($model->id), 'kvdelete' => true],
        ],
        'attributes' => $columns
    ]); ?>

</div>
