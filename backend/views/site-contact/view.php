<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SiteContact */

$this->title = Yii::t('app', 'Site Contacts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Site Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$imgUrl = Yii::$app->params['common'] . '/media';
$arrStatus = [Yii::t('app', 'Inactive'), Yii::t('app', 'Active')];
?>
<div class="site-contact-view">

    <?php
    $columns = [
        [
            'attribute' => 'gps_link',
            'label' => Yii::t('app', 'GPS link'),
            'value' => (!empty($model->gps_link)) ? $model->gps_link : null,
            'valueColOptions' => ['style' => 'overflow: auto; word-break: break-all !important;'],
            'format' => 'raw'
        ],
        [
            'attribute' => 'file',
            'type' => DetailView::INPUT_FILEINPUT,
            'label' => Yii::t('app', 'Logo'),
            'value' => Html::img($imgUrl . '/' . $model->logo_link, ['alt' => $model->logo_link, 'class' => 'img-fluid']),
            'format' => 'raw'
        ],
        [
            'attribute' => 'company_address',
            'label' => Yii::t('app', 'Company address'),
            'value' => (!empty($model->company_address)) ? $model->company_address : null,
        ],
        [
            'attribute' => 'tel',
            'label' => Yii::t('app', 'Tel'),
            'value' => (!empty($model->tel)) ? $model->tel : null,
        ],
        [
            'attribute' => 'email',
            'label' => Yii::t('app', 'Email'),
            'value' => (!empty($model->email)) ? $model->email : null,
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
        'buttons1' => '{update}',
//        'enableEditMode' => false,
//        'buttons1' => '{delete}',
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
