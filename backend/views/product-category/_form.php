<?php

use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductCategory */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss('.help-block, .fill-red {color: red}');
$this->registerCss('.help-block {padding-left: 5px}');
$this->title = Yii::t('app', 'Create new category');
$this->registerCss('.select2-search--inline{width: 100%}');
$this->registerCss('.select2-search__field{width: 100% !important}');
?>

<div class="product-category-form container p-3">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row pb-3">
        <div class="col-12 col-sm-4 col-md-4 col-lg-4"><h4><?= Yii::t('app', 'Title') ?> <sup
                        class="fill-red fs-6">(*)</sup></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Quần áo'])->label(false) ?>
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12 col-sm-4 col-md-4 col-lg-4"><h4><?= Yii::t('app', 'Product Types') ?> <sup
                        class="fill-red fs-6">(*)</sup></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'types')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($types, 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose product types')],
                'pluginOptions' => [
                    'multiple' => true,
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create new category'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
