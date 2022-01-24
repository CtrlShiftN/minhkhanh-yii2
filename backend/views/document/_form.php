<?php

use kartik\file\FileInput;
use kartik\form\ActiveField;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form container p-3">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-12 col-md-6 px-2">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Enter title')]) ?>
        </div>
        <div class="col-12 col-md-6 px-2">
            <?= $form->field($model, 'product_type_id')->widget(Select2::classname(), [
                'data' => $arrType,
                'options' => ['placeholder' => Yii::t('app', 'Choose Type')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
        </div>
        <div class="col-12 col-md-6 px-2">
            <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
                'options' => ['multiple' => false, 'accept' => 'image/*'],
                'pluginOptions' => ['previewFileType' => 'image', 'showUpload' => false]
            ])->label(Yii::t('app', 'Image')); ?>
        </div>
        <div class="col-12 col-md-6 px-2">
            <?= $form->field($model, 'documentFile')->widget(FileInput::classname(), [
                'options' => ['multiple' => false]
            ])->label(Yii::t('app', 'Document')); ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success w-100']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>

</div>
