<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
$arrFeature = [Yii::t('app', 'Non-featured'), Yii::t('app', 'Featured')];
$arrVisibility = [Yii::t('app', 'Show'), Yii::t('app', 'Hide')];
$commonUrl = Yii::$app->params['common'];
?>
<div class="product-index">
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
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'image',
                'label' => Yii::t('app', 'Image'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) use ($commonUrl) {
                    return Html::img($commonUrl . '/media/' . $model['image'], ['width' => '100%', 'alt' => $model['name']]);
                },
                'filter' => false,
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name',
                'label' => Yii::t('app', 'Title'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['name'];
                },
                // edit field
                'editableOptions' => [
                    'asPopover' => false,
                ],
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'SKU',
                'label' => Yii::t('app', 'SKU'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['SKU'];
                },
                'editableOptions' => [
                    'asPopover' => false,
                ],
                'format' => 'raw'
            ],
            [
                'attribute' => 'regular_price',
                'label' => Yii::t('app', 'Regular Price'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return Yii::$app->formatter->asCurrency($model['regular_price']);
                },
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'discount',
                'label' => Yii::t('app', 'Discount'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['discount'];
                },
                'editableOptions' => [
                    'asPopover' => false,
                ],
                'format' => 'raw'
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('app', 'Description'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'options' => ['style' => 'min-width:200px;'],
                'value' => function ($model, $key, $index, $widget) {
                    return substr(strip_tags($model['description']), 0, 200) . '...';
                },
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'quantity',
                'label' => Yii::t('app', 'Quantity'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['quantity'];
                },
                'editableOptions' => [
                    'asPopover' => false,
                ],
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'is_feature',
                'label' => Yii::t('app', 'Feature'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '75px',
                'value' => function ($model, $key, $index, $widget) use ($arrFeature) {
                    return $arrFeature[$model['is_feature']];
                },
                'editableOptions' => function ($model, $key, $index) use ($arrFeature) {
                    return [
                        'name' => 'is_feature',
                        'asPopover' => false,
                        'header' => Yii::t('app', 'Feature'),
                        'size' => 'md',
                        'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                        'data' => $arrFeature,
                        // default value in the text box
                        'value' => $arrFeature[$model['is_feature']],
                        'displayValueConfig' => $arrFeature
                    ];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $arrFeature,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- ' . Yii::t('app', 'Feature') . ' --']
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'label' => Yii::t('app', 'Status'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '75px',
                'value' => function ($model, $key, $index, $widget) use ($arrStatus) {
                    return $arrStatus[$model['status']];
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
                        'value' => $arrStatus[$model['status']],
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
//                'label' => Yii::t('app', 'Actions'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a('<i class="fas fa-eye"></i> ' . Yii::t('app', 'View'), Url::toRoute(['product/view', 'id' => \common\components\encrypt\CryptHelper::encryptString($key)]), ['class' => 'btn btn-info mb-2', 'target' => '_blank']) . '<br/>' .
                        Html::a('<i class="far fa-trash-alt"></i> ' . Yii::t('app', 'Delete'), Url::toRoute(['product/delete', 'id' => \common\components\encrypt\CryptHelper::encryptString($key)]), ['class' => 'btn btn-danger mt-2', 'data' => [
                            'method' => 'post',
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        ],]);
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
                    'content' => Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add New Product'), ['create'], [
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
                'heading' => Yii::t('app', 'Product List'),
            ],
        ]);
        Pjax::end();
        ?>
    </div>
</div>
