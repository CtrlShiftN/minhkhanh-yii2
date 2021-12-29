<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$imgUrl = Yii::$app->params['common'] . '/media';
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
$arrSegment = [Yii::t('app', 'Casual'), Yii::t('app', 'Luxury')];
$arrShopShow = [Yii::t('app', 'Hide'), Yii::t('app', 'Show')];
?>
<div class="product-type-view">
    <?php
    $columns = [
        [
            'attribute' => 'file',
            'type' => DetailView::INPUT_FILEINPUT,
            'label' => Yii::t('app', 'Image'),
            'value' => Html::img($imgUrl . '/' . $model->image, ['alt' => $model->name, 'class' => 'img-fluid']),
            'format' => 'raw'
        ],
        [
            'attribute' => 'name',
            'value' => (!empty($model->name)) ? $model->name : null,
        ],
        [
            'attribute' => 'segment',
            'value' => (!empty($arrSegment[$model->segment])) ? $arrSegment[$model->segment] : null,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $arrSegment,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Product Types') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
            'format' => 'raw'
        ],
        [
            'attribute' => 'shop_show',
            'value' => (!empty($arrShopShow[$model->shop_show])) ? $arrShopShow[$model->shop_show] : null,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $arrShopShow,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Hide/Show') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
            'format' => 'raw'
        ],
        [
            'attribute' => 'created_at',
            'format' => 'datetime',
            'value' => (!empty($model->created_at)) ? $model->created_at : null,
            'displayOnly' => true,
        ],
    ]
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'bordered' => true,
        'hAlign' => DetailView::ALIGN_CENTER,
        'vAlign' => DetailView::ALIGN_MIDDLE,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'deleteOptions' => [
            'url' => \yii\helpers\Url::toRoute(['product-type/delete', 'id' => \common\components\encrypt\CryptHelper::encryptString($model->id)]),
            'params' => ['id' => \common\components\encrypt\CryptHelper::encryptString($model->id), 'kvdelete' => true],
        ],
        'attributes' => $columns
    ]); ?>
</div>
