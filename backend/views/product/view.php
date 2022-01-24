<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$imgUrl = Yii::$app->params['common'] . '/media';
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
$arrHide = [Yii::t('app', 'Show'), Yii::t('app', 'Hide')];
$arrFeature = [Yii::t('app', 'Featured'), Yii::t('app', 'Non-featured')];
$modelType = $model['type'];
$modelCate = $model['category'];
$modelRelated = $model->related_product;
$action = Yii::$app->controller->action->id;
?>
<input type="hidden" value="<?= $action ?>" id="action">
<div class="product-view p-4">
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
            'attribute' => 'SKU',
            'value' => (!empty($model->SKU)) ? $model->SKU : null,
        ],
        [
            'attribute' => 'type',
            'value' => function ($model) use ($type, $modelType) {
                if (!empty($modelType)) {
                    $html = '';
                    if (is_array($modelType)) {
                        $arrType = $modelType;
                    } else {
                        $arrType = explode(",",substr($modelType,1,strlen($modelType)-2));
                    }
                    foreach ($arrType as $key => $types) {
                        if (!empty($type[$types])) {
                            $html .= '<div class="badge badge-info me-3 p-2">' . $type[$types] . '</div>';
                        }
                    }
                } else {
                    $html = null;
                }
                return $html;
            },
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $type,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Product Types') . ' --'],
                'pluginOptions' => ['allowClear' => true, 'multiple' => true]
            ],
            'format' => 'raw'
        ],
        [
            'attribute' => 'category',
            'value' => '<div class="badge badge-info me-3 p-2">' . $productCate[$modelCate] . '</div>',
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $productCate,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Product Categories') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
            'format' => 'raw'
        ],
        [
            'attribute' => 'relatedProduct',
            'value' => function ($model) use ($products, $modelRelated) {
                if (!empty($modelRelated)) {
                    $arrRelated = explode(',', $modelRelated);
                    $html = '<ol class="mb-0">';
                    foreach ($arrRelated as $key => $relatedProduct) {
                        if(!empty($products[$relatedProduct])) {
                            $html .= '<li>' . $products[$relatedProduct] . '</li>';
                        }
                    }
                    $html .= '</ol>';
                } else {
                    $html = null;
                }
                return $html;
            },
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $products,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Related Products') . ' --'],
                'pluginOptions' => ['allowClear' => true, 'multiple' => true]
            ],
            'format' => 'raw'
        ],
        [
            'attribute' => 'short_description',
            'value' => strip_tags($model->short_description),
            'type' => 'widget',
            'widgetOptions' => ['class' => \yii\redactor\widgets\Redactor::class],
            'format' => 'raw'
        ],
        [
            'attribute' => 'description',
            'value' => $model->description,
            'type' => 'widget',
            'widgetOptions' => ['class' => \yii\redactor\widgets\Redactor::class],
//            'displayOnly' => true,
            'format' => 'raw'
        ],
        [
            'attribute' => 'regular_price',
            'value' => (!empty($model->regular_price)) ? $model->regular_price : null,
        ],
        [
            'attribute' => 'discount',
            'value' => (!empty($model->discount)) ? $model->discount : null,
        ],
        [
            'attribute' => 'quantity',
            'value' => (!empty($model->quantity)) ? $model->quantity : null,
        ],
        [
            'attribute' => 'trademark_id',
            'type' => DetailView::INPUT_SELECT2,
            'value' => (!empty($trademark[$model->trademark_id])) ? $trademark[$model->trademark_id] : null,
            'widgetOptions' => [
                'data' => $trademark,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Trademark') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
        ],
        [
            'attribute' => 'is_feature',
            'value' => (!empty($arrFeature[$model->is_feature])) ? $arrFeature[$model->is_feature] : null,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $arrFeature,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Is featured?') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
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
            'url' => \yii\helpers\Url::toRoute(['product/delete', 'id' => \common\components\encrypt\CryptHelper::encryptString($model->id)]),
            'params' => ['id' => \common\components\encrypt\CryptHelper::encryptString($model->id), 'kvdelete' => true],
        ],
        'attributes' => $columns
    ]); ?>

</div>
