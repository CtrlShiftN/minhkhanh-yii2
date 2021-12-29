<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SocialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Socials');
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="social-index">

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
                'attribute' => 'icon',
                'label' => Yii::t('app', 'Icon'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '70px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['icon'];
                },
                'format' => 'raw',
                'filter' => false,
                'enableSorting' => false
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'icon',
                'label' => Yii::t('app', 'Fontawesome Icon'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['icon'];
                },
                // edit field
                'editableOptions' => [
                    'asPopover' => false,
                ],
                'filter' => false,
                'enableSorting' => false
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'link',
                'label' => Yii::t('app', 'Link'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return $model['link'];
                },
                // edit field
                'editableOptions' => [
                    'asPopover' => false,
                ],
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
                'format' => 'raw'
            ],
            [
                'label' => Yii::t('app', 'Actions'),
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '150px',
                'value' => function ($model, $key, $index, $widget) {
                    return Html::a('Xóa', Url::toRoute(['social/delete', 'id' => \common\components\encrypt\CryptHelper::encryptString($key)]), ['class' => 'btn btn-danger', 'data' => [
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
                [
                    'content' => Html::button('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add New Social Network'), [
                        'value' => Url::toRoute('social/create'),
                        'class' => 'btn btn-success',
                        'id' => 'modalSocialButton',
                        'data-bs-toggle' => 'modal',
                        'data-bs-target' => '#modalSocial'
                    ]),
                    'options' => ['class' => 'btn-group mr-2']
                ],
                '{export}',
                '{toggleData}',
            ],
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => Yii::t('app', 'Social Network List'),
            ],
        ]);
        Pjax::end();
        ?>
        <!-- Modal -->
        <div class="modal fade" id="modalSocial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= Yii::t('app', 'Add New Social Network') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal-social-content"></div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.modal-social-content').load($('#modalSocialButton').attr('value'));
            });
        </script>
    </div>
</div>
