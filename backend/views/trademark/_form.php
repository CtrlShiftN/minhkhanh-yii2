<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Trademark */
/* @var $form kartik\form\ActiveForm */

$this->registerCss('.help-block, .fill-red {color: red}');
$this->registerCss('.help-block {padding-left: 5px}');
$this->title = Yii::t('app', 'Add New Trademark');
?>

<div class="container trademark-form p-3">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row pb-3">
        <div class="col-12 col-sm-4 col-md-4 col-lg-4"><h4><?= Yii::t('app', 'Title') ?> <sup
                        class="fill-red fs-6">(*)</sup></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'De Obelly'])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Add New Trademark'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>