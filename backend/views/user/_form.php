<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss('.help-block, .fill-red {color: red}');
$this->registerCss('.help-block {padding-left: 5px}');
$action = Yii::$app->controller->action->id;
$this->title = ($action != 'update') ? Yii::t('app', 'Add new account'):Yii::t('app', 'Update account');
?>
<input type="hidden" value="<?= $action ?>" id="action">

<div class="container user-form p-3">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row pb-3">
        <div class="col-12 col-sm-2 col-md-3 col-lg-3"><h4><?= Yii::t('app', 'Name') ?> <sup
                        class="fill-red fs-6">(*)</sup></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Nguyễn Văn A'])->label(false) ?>
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12 col-sm-2 col-md-3 col-lg-3"><h4><?= Yii::t('app', 'Email') ?> <sup
                        class="fill-red fs-6">(*)</sup></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'support.deobelly@gmail.com'])->label(false) ?>
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12 col-sm-2 col-md-3 col-lg-3"><h4><?= Yii::t('app', 'Password') ?> <sup class="fill-red fs-6">(*)</sup>
            </h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'password_hash')->textInput(['placeholder' => 'Nhập vào mật khẩu...', 'value' => ''])->label(false) ?>
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12 col-sm-2 col-md-3 col-lg-3"><h4><?= Yii::t('app', 'Tel') ?></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'tel')->textInput(['placeholder' => '0912 668 668'])->label(false) ?>
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12 col-sm-2 col-md-3 col-lg-3"><h4><?= Yii::t('app', 'Address') ?></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'address')->textInput(['placeholder' => 'Số 1 Trung Hòa, Cầu Giấy, Hà Nội'])->label(false) ?>
        </div>
    </div>
    <div class="row pb-3">
        <div class="col-12 col-sm-2 col-md-3 col-lg-3"><h4><?= Yii::t('app', 'Role') ?> <sup
                        class="fill-red fs-6">(*)</sup></h4></div>
        <div class="col-12 col-sm-6 col-md-5 col-lg-6">
            <?= $form->field($model, 'role')->dropDownList(\common\models\User::ROLES)->label(false) ?>
        </div>
    </div>
    <div class="form-group mb-0">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
