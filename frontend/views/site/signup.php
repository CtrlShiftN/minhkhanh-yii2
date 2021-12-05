<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$imgUrl = Yii::$app->params['common'] . "/media";
$this->title = Yii::t('app', 'Signup');
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
            <div class="mx-md-4 my-md-3 py-md-4 p-3 w-100">
                <div class="my-3">
                    <h4 class="text-center text-uppercase m-0 text-secondary line-title"><?= Yii::t('app', 'Signup') ?></h4>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="mt-2">
                    <?= $form->field($model, 'name')
                        ->textInput(['autofocus' => true, 'class' => 'border-0 border-bottom border-secondary rounded-0 form-control', 'placeholder' => Yii::t('app', 'Enter first and last name')])->label(false)
                    ?>
                </div>
                <div class="mt-2">
                    <?= $form->field($model, 'tel')
                        ->textInput(['type' => 'number', 'class' => 'border-0 border-bottom border-secondary rounded-0 form-control', 'placeholder' => Yii::t('app', 'Enter phone number')])->label(false) ?>
                </div>
                <div class="mt-2">
                    <?= $form->field($model, 'email')
                        ->textInput(['type' => 'email', 'class' => 'border-0 border-bottom border-secondary rounded-0 form-control', 'placeholder' => Yii::t('app', 'Enter email')])
                        ->label(false) ?>
                </div>
                <div class="mt-2">
                    <?= $form->field($model, 'password')
                        ->textInput(['type' => 'password', 'class' => 'border-0 border-bottom border-secondary rounded-0 form-control', 'placeholder' => Yii::t('app', 'Enter password')])
                        ->label(false) ?>
                </div>
                <?= Html::submitButton(Yii::t('app', 'Register'), ['class' => 'btn btn-primary rounded-pill fs-5 text-uppercase w-100 mt-3']) ?>
                <?php ActiveForm::end(); ?>
                <div class="my-3">
                    <h4 class="text-center text-uppercase m-0 text-secondary line-title"><?= Yii::t('app', 'Or') ?></h4>
                </div>
                <div class="my-3 text-center">
                    <span class="text-secondary"><?= Yii::t('app', 'You already have an account ?') ?> <?= Html::a(Yii::t('app', 'Login'), ['/site/login'], ['class' => 'text-primary text-decoration-none']) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>