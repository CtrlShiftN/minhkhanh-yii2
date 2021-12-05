<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$imgUrl = Yii::$app->params['common'] . "/media";
$this->title = Yii::t('app', 'Resend verification email');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Url::toRoute("css/login.css"));
$this->registerCss("
#wrapper {
    background-image: url('$imgUrl/background/wp3416113.jpg');
    min-height: 100%;
    background-position: top;
    background-repeat: no-repeat;
    background-size: cover;
}
");
?>
<div class="pt-4 pt-md-5">
    <div class="row bg-transparent mt-md-5 mt-0 p-0">
        <div class="col-lg-6 col-xl-7 d-lg-flex d-none">
        </div>
        <div class="col-12 col-lg-6 col-xl-5 py-0 d-flex align-items-center bg-input-field">
            <div class="mx-md-4 my-md-3 py-md-4 p-3 w-100 text-center">
                <div class="my-3">
                    <h4 class="text-center text-uppercase m-0 text-secondary line-title"><?= Html::encode($this->title) ?></h4>
                    <p><?= Yii::t('app', 'Please fill in your email. A link to reset the password will be sent there.') ?></p>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="my-4">
                    <?= $form->field($model, 'email')
                        ->textInput(['type' => 'email', 'class' => 'border-0 border-bottom rounded-0 form-control py-2', 'placeholder' => Yii::t('app', 'Enter new password')])
                        ->label(false) ?>
                </div>
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary rounded-pill fs-4 w-100 mt-3']) ?>
                <?php ActiveForm::end(); ?>
                <div class="my-3 text-center">
                    <?= Html::a(Yii::t('app', 'Back to login page.'), ['site/login'], ['class' => 'text-primary text-decoration-none']) ?>
                </div>
            </div>
        </div>
    </div>
</div>