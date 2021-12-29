<?php

use kartik\depdrop\DepDrop;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = Yii::t('app', 'Orders') . ' DO' . $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view p-4">

    <?php
    $columns = [
        [
            'attribute' => 'user_id',
            'label' => Yii::t('app', 'Accounts'),
            'type' => DetailView::INPUT_SELECT2,
            'value' => (!empty(\backend\models\User::findNameByID($model->user_id))) ? \backend\models\User::findNameByID($model->user_id) : null,
            'widgetOptions' => [
                'data' => $customers,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Accounts') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
            'format' => 'raw'
        ],
        [
            'attribute' => 'name',
            'value' => (!empty($model->name)) ? $model->name : null,
        ],
        [
            'attribute' => 'email',
            'value' => (!empty($model->email)) ? $model->email : null,
        ],
        [
            'attribute' => 'tel',
            'value' => (!empty($model->tel)) ? $model->tel : null,
        ],
        [
            'attribute' => 'product_id',
            'type' => DetailView::INPUT_SELECT2,
            'value' => (!empty(\backend\models\Product::findNameByID($model->product_id))) ? \backend\models\Product::findNameByID($model->product_id) : null,
            'widgetOptions' => [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Product::getAllProduct(), 'id', 'name'),
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Products') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
        ],
        [
            'attribute' => 'quantity',
            'value' => (!empty($model->quantity)) ? $model->quantity : 0,
        ],
        [
            'attribute' => 'province_id',
            'value' => \backend\models\GeoLocation::findNameByID($model->province_id),
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\GeoLocation::getAllProvince(), 'id', 'name'),
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Province') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
        ],
        [
            'attribute' => 'district_id',
            'value' => \backend\models\GeoLocation::findNameByID($model->district_id),
            'type' => DetailView::INPUT_DEPDROP,
            'widgetOptions' => [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\GeoLocation::getAllGeoLocation(), 'id', 'name'),
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'District') . ' --'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['order-province_id'],
                    'url' => Url::to(['/order/get-district']),
                    //'params'=>['input-type-1', 'input-type-2']
                ]
            ],
        ],
        [
            'attribute' => 'village_id',
            'value' => \backend\models\GeoLocation::findNameByID($model->village_id),
            'type' => DetailView::INPUT_DEPDROP,
            'widgetOptions' => [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\GeoLocation::getAllGeoLocation(), 'id', 'name'),
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Village') . ' --'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['order-district_id'],
                    'url' => Url::to(['/order/get-village']),
                ]
            ],
        ],
        [
            'attribute' => 'specific_address',
            'value' => (!empty($model->specific_address)) ? $model->specific_address : null,
        ],
        [
            'attribute' => 'notes',
            'value' => (!empty($model->notes)) ? $model->notes : null,
            'type' => 'widget',
            'widgetOptions' => ['class' => \yii\redactor\widgets\Redactor::class],
//            'displayOnly' => true,
            'format' => 'raw'
        ],
        [
            'attribute' => 'status',
            'value' => (!empty($trackingStatus[$model->status])) ? $trackingStatus[$model->status] : null,
            'type' => DetailView::INPUT_SELECT2,
            'widgetOptions' => [
                'data' => $trackingStatus,
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Tracking Status') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
        ],
        [
            'attribute' => 'logistic_method',
            'type' => DetailView::INPUT_SELECT2,
            'value' => (!empty(\common\models\Order::getLogisticMethod()[$model->logistic_method])) ? \common\models\Order::getLogisticMethod()[$model->logistic_method] : null,
            'widgetOptions' => [
                'data' => \common\models\Order::getLogisticMethod(),
                'options' => ['placeholder' => '-- ' . Yii::t('app', 'Logistic Method') . ' --'],
                'pluginOptions' => ['allowClear' => true]
            ],
        ],
    ]
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'bordered' => true,
        'buttons1' => '{update}',
        'hAlign' => DetailView::ALIGN_CENTER,
        'vAlign' => DetailView::ALIGN_MIDDLE,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => $columns
    ]); ?>

</div>
