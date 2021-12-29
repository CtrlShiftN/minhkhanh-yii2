<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$arrStatus = \backend\models\TrackingStatus::getAllStatus();
$arrStatus = \yii\helpers\ArrayHelper::map($arrStatus, 'id', 'name');
$arrLogisticMethod = [Yii::t('app', 'Home delivery'), Yii::t('app', 'Get at the store')];
?>
<div class="order-index">
    <div class="pt-3">
        <?php
        $defaultExportConfig = [
            GridView::EXCEL => [
                'label' => 'Excel',
                'icon' => 'file-excel-o',
                'iconOptions' => ['class' => 'text-success'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => 'grid-export',
                'alertMsg' => Yii::t('app', 'The EXCEL export file will be generated for download.'),
                'options' => ['title' => 'Microsoft Excel 95+'],
                'mime' => 'application/vnd.ms-excel',
                'config' => [
                    'worksheet' => 'ExportWorksheet',
                    'cssFile' => ''
                ]
            ],
        ];
        $gridColumns = [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            [
                'attribute' => 'BL_code',
                'label' => Yii::t('app', 'Bill of lading code'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['BL_code'];
                },
            ],
            [
                'attribute' => 'user_name',
                'label' => Yii::t('app', 'Customer Name'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['user_name'];
                },
                'format' => 'raw',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $users,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- ' . Yii::t('app', 'Accounts') . ' --']
            ],
            [
                'attribute' => 'product_name',
                'label' => Yii::t('app', 'Product'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['product_name'];
                },
                'format' => 'raw',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $products,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- ' . Yii::t('app', 'Products') . ' --']
            ],
            [
                'attribute' => 'quantity',
                'label' => Yii::t('app', 'Quantity'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '70px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['quantity'];
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'tel',
                'label' => Yii::t('app', 'Tel'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['tel'];
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'name',
                'label' => Yii::t('app', 'Consignee'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['name'];
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'address',
                'label' => Yii::t('app', 'Address'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['address'];
                },
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'notes',
                'label' => Yii::t('app', 'Notes'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['notes'];
                },
                'editableOptions' => function ($model, $key, $index) use ($arrStatus) {
                    return [
                        'name' => 'notes',
                        'asPopover' => false,
                        'header' => Yii::t('app', 'Notes'),
                        'size' => 'md',
                        'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                        // default value in the text box
                        'value' => $model['notes'],
                    ];
                },
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'logistic_method',
                'label' => Yii::t('app', 'Logistic method'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '70px',
                'value' => function ($model, $key, $index, $widget) use ($arrLogisticMethod) {
                    return Yii::t('app', $arrLogisticMethod[$model['logistic_method']]);
                },
                'editableOptions' => function ($model, $key, $index) use ($arrLogisticMethod) {
                    return [
                        'name' => 'logistic_method',
                        'asPopover' => false,
                        'header' => Yii::t('app', 'Logistic method'),
                        'size' => 'md',
                        'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                        'data' => $arrLogisticMethod,
                        // default value in the text box
                        'value' => Yii::t('app', $arrLogisticMethod[$model['logistic_method']]),
                        'displayValueConfig' => $arrLogisticMethod
                    ];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $arrLogisticMethod,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- ' . Yii::t('app', 'Logistic method') . ' --']
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'label' => Yii::t('app', 'Status'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '70px',
                'value' => function ($model, $key, $index, $widget) use ($arrStatus) {
                    return Yii::t('app', $arrStatus[$model['status']]);
                },
                'editableOptions' => function ($model, $key, $index) use ($arrStatus) {
                    return [
                        'name' => 'status',
                        'asPopover' => false,
                        'header' => Yii::t('app', 'Status'),
                        'size' => 'md',
                        'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                        'data' => $arrStatus,
                        // default value in the text box
                        'value' => Yii::t('app', $arrStatus[$model['status']]),
                        'displayValueConfig' => $arrStatus
                    ];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $arrStatus,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- ' . Yii::t('app', 'Status') . ' --']
            ],
            [
                'label' => Yii::t('app', 'Actions'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a(
                        Yii::t('app', 'See more'),
                        Url::toRoute(['order/view', 'id' => \common\components\encrypt\CryptHelper::encryptString($model['id'])]),
                        ['class' => 'btn btn-info me-3']);
                },
                'format' => 'raw'
            ]
        ];
        Pjax::begin();
        echo GridView::widget([
            'id' => 'gridview',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
//            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true, // pjax is set to always true for this demo
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            // set export properties
            'export' => [
                'fontAwesome' => true,
                'label' => '<i class="far fa-file-alt"></i> ' . Yii::t('app', 'Export files'),
            ],
            'responsive' => true,
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
            'rowOptions' => function ($model, $index, $widget, $grid) {
                return [
                    'class' => GridView::TYPE_DEFAULT
                ];
            },
            'condensed' => true,
            'hover' => true,
            'columns' => $gridColumns,
            'exportConfig' => $defaultExportConfig,
            'toolbar' => [
                [
                    'content' => Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add New Order'), ['create'], [
                        'class' => 'btn btn-success',
                        'title' => 'Reset Grid',
                        'data-pjax' => 0,
                        'target' => '_blank'
                    ]),
                    'options' => ['class' => 'btn-group mr-2']
                ],
                '{export}',
                '{toggleData}',
            ],
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => Yii::t('app', 'Order List'),
            ],
        ]);
        Pjax::end();
        ?>
    </div>
</div>
