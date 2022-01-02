<?php

use kartik\form\ActiveField;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Social */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss('.help-block, .fill-red {color: red}');
$this->registerCss('.help-block {padding-left: 5px}');
?>

<div class="social-form container px-3 py-0">
    <?php $form = ActiveForm::begin(); ?>
    <div class="w-100 row px-0 mx-0">
        <?= $form->field($model, 'icon', ['hintType' => ActiveField::HINT_SPECIAL])->textInput(['placeholder' => 'Ex: <i class="nav-icon fas fa-globe"></i>'])->hint(Yii::t('app', 'Go to https://fontawesome.com/ or search for keyword "fontawesome" to get code of Fontawesome Icon')) ?>
    </div>
    <div class="w-100 row px-0 mx-0">
        <?= $form->field($model, 'link')->textInput(['placeholder' => 'https://...']) ?>
    </div>
    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success px-3 py-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
