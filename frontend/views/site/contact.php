<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\bootstrap5\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Contact');
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCssFile(Url::toRoute('css/contact.css'));
$this->registerCss("
    .container {
        padding: 0 !important;
    }
");
$config = ['template' => "{input}\n{error}\n{hint}"];
?>
<div class="site-contact">
    <div class="w-100">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.898403696425!2d105.77755721264259!3d21.036750747392258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1fbc860633a49839!2zMjHCsDAyJzEyLjMiTiAxMDXCsDQ2JzQzLjYiRQ!5e0!3m2!1svi!2s!4v1638886832247!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="row border-bottom w-100 mx-0 px-0">
        <div class="p-3 text-center my-3">
            <h5><?= Yii::t('app', 'If you have a business inquiry or other question, please fill out the following form to contact us. Thank you!') ?>
                !</h5>
        </div>
    </div>
    <div class="row mt-3 align-items-center justify-content-center w-100 px-0 mx-0">
        <div class="col-12 col-lg-6 h-100">
            <?php if (Yii::$app->session->hasFlash('contactSuccess')): ?>
                <div class="alert alert-success alert-dismissible fade show my-3">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h4><i class="icon fa fa-check"></i> <?= Yii::t('app', 'SUCCESS') ?>!</h4>
                    <?= Yii::t('app', Yii::$app->session->getFlash('contactSuccess')) ?>
                </div>
            <?php endif; ?>
            <?php if (Yii::$app->session->hasFlash('contactError')): ?>
                <div class="alert alert-danger alert-dismissible fade show my-3">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h4><i class="fas fa-times"></i> <?= Yii::t('app', 'ERROR') ?>!</h4>
                    <?= Yii::t('app', Yii::$app->session->getFlash('contactError')) ?>
                </div>
            <?php endif; ?>
            <h3 class="fw-bold mb-4 text-center"><span
                        class=" border-3 border-dark border-bottom "><?= Yii::t('app', 'SUBMIT YOUR QUESTION') ?>!</span>
            </h3>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => 'rounded-pill form-control'])->label(Yii::t('app', 'Name'), ['class' => 'fw-bold fs-5 px-3']) ?>
            <div class="row">
                <div class="col-md-6 my-3">
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'rounded-pill form-control'])->label('Email', ['class' => 'fw-bold fs-5 px-3']) ?>
                </div>
                <div class="col-md-6 my-3">
                    <?= $form->field($model, 'tel')->textInput(['autofocus' => true, 'class' => 'rounded-pill form-control'])->label(Yii::t('app', 'Phone number'), ['class' => 'fw-bold fs-5 px-3']) ?>
                </div>
            </div>

            <?= $form->field($model, 'content')->textarea(['rows' => 5])->label(Yii::t('app', 'Content'), ['class' => 'fw-bold fs-5 px-3']) ?>

            <div class="form-group mt-2 mt-md-3">
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-danger p-2 col-12 rounded-pill', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-12 col-lg-6 my-3">
            <div class="text-center w-100 my-3">
                    <img src="<?= $imgUrl ?>/logo.png" class="w-50 d-none d-lg-inline-block">
                <h3 class="fw-bold mb-4 text-center text-md-start d-lg-none"><span
                            class=" border-3 border-dark border-bottom text-uppercase"><?= Yii::t('app', 'Contact') ?></span>
                </h3>
            </div>
            <div class="w-100 row m-0">
                    <p class="col-12 mx-0"><span
                                class="fw-bold"><?= Yii::t('app', 'Address') ?>:</span><br> Số 1 đường Khương Đình, Kim Giang, Hà Nội
                    </p>
                    <p class="d-inline-block col-12 col-sm-6"><span
                                class="fw-bold">Email:</span><br> <?= Yii::$app->params['supportEmail'] ?></p>
                    <p class="d-inline-block col-12 col-sm-6"><span
                                class="fw-bold"><?= Yii::t('app', 'Tel') ?>:</span><br> <?= Yii::$app->params['adminTel'] ?>
                    </p>

            </div>
            <img src="<?= Url::toRoute('img/contact/cskh.jpg') ?>"
                 class="shadow-lg rounded w-100">
        </div>
    </div>
</div>
