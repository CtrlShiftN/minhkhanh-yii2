<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = $this->title;
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
$commonUrl = Yii::$app->params['common'];
?>
<div class="document-index">
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
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'title',
                'label' => Yii::t('app', 'Title'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '280px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['title'];
                },
                // edit field
                'editableOptions' => [
                    'asPopover' => false,
                ],
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'image',
                'label' => Yii::t('app', 'Image'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) use ($commonUrl) {
                    return Html::img($commonUrl . '/media/' . $model['image'], ['width' => '100%', 'alt' => $model['title']]);
                },
                'filter' => false,
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'link',
                'label' => Yii::t('app', 'File'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) use ($commonUrl) {
                    return Html::a('<i class="fas fa-cloud-download-alt"></i> '.basename($model['link']),$commonUrl .'/documents/' . $model['link'], ['width' => '100%', 'alt' => $model['title'],'download'=> true]);
                },
                'filter' => false,
                'format' => 'raw'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'product_type_id',
                'label' => Yii::t('app', 'Type'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) use ($arrType) {
                    return $arrType[$model['product_type_id']];
                },
                'editableOptions' => function ($model, $key, $index) use ($arrType) {
                    return [
                        'name' => 'product_type_id',
                        'asPopover' => false,
                        'header' => Yii::t('app', 'Type'),
                        'size' => 'md',
                        'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                        'data' => $arrType,
                        // default value in the text box
                        'value' => $arrType[$model['product_type_id']],
                        'displayValueConfig' => $arrType
                    ];
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $arrType,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- ' . Yii::t('app', 'Type') . ' --']
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'label' => Yii::t('app', 'Status'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
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
                'width' => '140px',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a('<i class="fas fa-eye"></i> ' . Yii::t('app', 'Update'), Url::toRoute(['document/update', 'id' => \common\components\encrypt\CryptHelper::encryptString($key)]), ['class' => 'btn btn-info mb-2', 'target' => '_blank']) . '<br/>' .
                        Html::a('<i class="far fa-trash-alt"></i> ' . Yii::t('app', 'Delete'), Url::toRoute(['document/delete', 'id' => \common\components\encrypt\CryptHelper::encryptString($key)]), ['class' => 'btn btn-danger mt-2', 'data' => [
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
                    'content' => Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add New Document'), ['create'], [
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
                'heading' => Yii::t('app', 'Document List'),
            ],
        ]);
        Pjax::end();
     ?>
    </div>

</div>
