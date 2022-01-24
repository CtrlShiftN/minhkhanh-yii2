<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\SiteContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Site Contacts');
$this->params['breadcrumbs'][] = $this->title;
$imgUrl = Yii::$app->params['common'] . "/media";
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
?>
<div class="site-contact-index">

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
                'attribute' => 'gps_link',
                'label' => Yii::t('app', 'GPS link'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['gps_link'];
                },
                'format' => 'raw',
                'enableSorting' => false,
                'filter' => false,
            ],
            [
                'attribute' => 'logo_link',
                'label' => Yii::t('app', 'Logo link'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '70px',
                'value' => function ($model, $key, $index, $widget) use ($imgUrl) {
                    return Html::img($imgUrl . '/' . $model['logo_link'], ['width' => '100%', 'alt' => $model['logo_link']]);
                },
                'filter' => false,
                'format' => 'raw',
                'enableSorting' => false
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'company_address',
                'label' => Yii::t('app', 'Company address'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['company_address'];
                },
                // edit field
                'editableOptions' => [
                    'asPopover' => false,
                ],
                'enableSorting' => false,
                'filter' => false,
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'tel',
                'label' => Yii::t('app', 'Tel'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '70px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['tel'];
                },
                // edit field
                'editableOptions' => [
                    'asPopover' => false,
                ],
                'enableSorting' => false,
                'filter' => false,
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'email',
                'label' => Yii::t('app', 'Email'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['email'];
                },
                // edit field
                'editableOptions' => [
                    'asPopover' => false,
                ],
                'enableSorting' => false,
                'filter' => false,
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
                'enableSorting' => false,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $arrStatus,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- ' . Yii::t('app', 'Status') . ' --']
            ],
            [
                'attribute' => 'created_at',
                'label' => Yii::t('app', 'Created_at'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'filter' => false,
                'width' => '150px',
                'enableSorting' => false,
            ],
            [
                'label' => Yii::t('app', 'Actions'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '100px',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a(Yii::t('app', 'View'), Url::toRoute(
                        [
                            'site-contact/view',
                            'id' => \common\components\encrypt\CryptHelper::encryptString($key)
                        ]), ['class' => 'btn btn-info mb-2']);
                },
                'format' => 'raw'
            ]
        ];
        Pjax::begin();
        echo GridView::widget([
            'id' => 'gridview',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true, // pjax is set to always true for this demo
            'toggleDataContainer' => ['class' => 'btn-group mr-2'],
            // set export properties
            'export' => [
                'fontAwesome' => true,
                'label' => '<i class="far fa-file-alt"></i>  ' . Yii::t('app', 'Export files'),
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
                '{export}',
                '{toggleData}',
            ],
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => Yii::t('app', 'Contact List'),
            ],
        ]);
        Pjax::end();
        ?>
    </div>
</div>
