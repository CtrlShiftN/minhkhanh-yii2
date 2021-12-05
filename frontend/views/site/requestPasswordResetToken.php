<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$imgUrl = Yii::$app->params['common'] . "/media";
$this->title = Yii::t('app', 'Forgot password');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Url::toRoute("css/login.css"));
$this->registerCssFile(Url::toRoute("css/success_error-icon.css"));
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
<?php if (Yii::$app->session->hasFlash('requestSuccess')): ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
            id='btnModalRequestSuccess' hidden>
    </button>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="swal2-icon swal2-success swal2-animate-success-icon d-flex">
                        <div class="swal2-success-circular-line-left"></div>
                        <span class="swal2-success-line-tip"></span>
                        <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix"></div>
                        <div class="swal2-success-circular-line-right"></div>
                    </div>
                    <div class='text-center text-uppercase'>
                        <h2 class="mx-0 mb-3 text-success fw-light"><?= Yii::t('app', 'Successfully!') ?></h2>
                        <p class="mx-0 mb-4"><?= Yii::t('app', Yii::$app->session->getFlash('requestSuccess')) ?></p>
                        <button type="button" data-bs-dismiss="modal" id='btnModalRequestClose'
                                hidden></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('requestError')): ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
            id='btnModalRequestError'
            hidden>
    </button>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="swal2-icon swal2-error swal2-animate-error-icon d-flex">
                        <span class="swal2-x-mark">
                            <span class="swal2-x-mark-line-left"></span>
                            <span class="swal2-x-mark-line-right"></span>
                        </span>
                    </div>
                    <div class='text-center'>
                        <h2 class="mx-0 mb-3 text-success fw-light"><?= Yii::t('app', 'Error!') ?></h2>
                        <p class="mx-0 mb-4"><?= Yii::t('app', Yii::$app->session->getFlash('requestError')) ?></p>
                        <button type="button" data-bs-dismiss="modal" id='btnModalRequestClose'
                                hidden></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
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
                            ->textInput(['type' => 'email', 'class' => 'border-0 border-bottom rounded-0 form-control py-2', 'placeholder' => Yii::t('app', 'Enter email')])
                            ->label(false) ?>
                    </div>
                    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary rounded-pill fs-5 text-uppercase w-100 mt-3']) ?>
                    <?php ActiveForm::end(); ?>
                    <div class="my-3 text-center">
                        <?= Html::a(Yii::t('app', 'Back to login page.'), ['site/login'], ['class' => 'text-primary text-decoration-none']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if (Yii::$app->session->hasFlash('requestSuccess')): ?>
    <script>
        $('#btnModalRequestSuccess').trigger("click");
        setTimeout(function () {
            $('#btnModalRequestClose').trigger("click");
        }, 2000);
    </script>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('requestError')): ?>
    <script>
        $('#btnModalRequestError').trigger("click");
        setTimeout(function () {
            $('#btnModalRequestClose').trigger("click");
        }, 2000);
    </script>
<?php endif; ?>