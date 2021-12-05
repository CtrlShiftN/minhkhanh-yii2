<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Login');
$imgUrl = Yii::$app->params['common'] . '/media';
$this->registerCssFile(Url::toRoute("/css/login.css"));
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
<div class="site-login">
    <div class="row d-flex w-100">
        <div class="col-12 col-md-2 col-lg-3 col-xl-4"></div>
        <div class="col-12 col-md-8 col-lg-6 col-xl-4 bg-white p-4 rounded-3 align-self-center shadow-lg">
            <div class="text-center mb-2">
                <img src="<?= $imgUrl ?>/logo.png" alt="MinhKhanh" class="w-100">
            </div>
            <div class="mb-3 hint-text">
                <p>Để đăng nhập quản trị, vui lòng khai báo tất cả các ô trống dưới đây</p>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="my-3">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' =>Yii::t('app','Enter your email')]) ?>
            </div>
            <div class="my-3">
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('app','Enter your password')]) ?>
            </div>
            <div class="my-3">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-12 col-md-2 col-lg-3 col-xl-4"></div>
    </div>
</div>
