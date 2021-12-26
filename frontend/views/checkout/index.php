<?php

/* @var $this yii\web\View */

use kartik\depdrop\DepDrop;
use kartik\form\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Payment');
$this->params['breadcrumbs'][] = $this->title;
$cdnUrl = Yii::$app->params['frontend'];
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCssFile(Url::toRoute("css/check-out.css"));
$this->registerCssFile(Url::toRoute("css/success_error-icon.css"));
$this->registerJsFile(Url::toRoute('js/check-out.js'));
?>
<?php if (Yii::$app->session->hasFlash('creatOrderError')): ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id='btnModalError'
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
                        <p class="mx-0 mb-4"><?= Yii::t('app', Yii::$app->session->getFlash('creatOrderError')) ?></p>
                        <button type="button" data-bs-dismiss="modal" id='btnModalClose' hidden></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $form = ActiveForm::begin(['id' => 'order-form', 'options' => ['class' => 'w-100 m-0 p-0']]); ?>
    <div class="w-100 row mx-0 px-1 pt-3 pt-md-5 pt-lg-5 px-sm-0 d-flex">
        <div class="col-12 col-lg-6 order-1 order-lg-0 mx-0 d-flex p-0 mt-4 mt-lg-0">
            <div class="w-100 m-0 p-0">
                <h3 class="w-100 pb-1 border-bottom px-0"><?= Yii::t('app', 'Billing information') ?>:</h3>

                <div class="w-100 row py-3 px-1 m-0" id="consignee-contact">
                    <small id="notify-consignee-information" class="d-none"><i
                                class="text-danger">*<?= Yii::t('app', 'You must fill in all the fields') ?></i></small>
                    <div class="col-12 col-sm-6 px-1">
                        <?= $form->field($model, 'name')->label(Yii::t('app', "Consignee's name")) ?>
                    </div>
                    <div class="col-12 col-sm-6 px-1">
                        <?= $form->field($model, 'tel')->label(Yii::t('app', 'Phone number')) ?>
                    </div>
                    <div class="col-12 px-1">
                        <?= $form->field($model, 'email')->label(Yii::t('app', 'Email address')) ?>
                    </div>
                    <?= $form->field($model, 'cart', ['options' => ['class' => 'm-0', 'id' => 'cart_id']])->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'quantity', ['options' => ['class' => 'm-0', 'id' => 'quantity']])->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'product_id', ['options' => ['class' => 'm-0', 'id' => 'product_id']])->hiddenInput()->label(false) ?>
                </div>

                <div class="accordion accordion-flush w-100 px-1 my-1" id="accordionPaymentOnDelivery">
                    <div class="accordion-item border rounded-0">
                        <div class="accordion-header px-2 py-3 bg-lighter-gray w-100" id="flush-heading-home-delivery">
                            <?= $form->field($model, 'logistic_method', ['options' => ['class' => 'm-0']])->radio(['label' => Yii::t('app', 'Home delivery'), 'id' => 'sm-home-delivery', 'value' => 0, 'checked' => 'checked', 'onClick' => '$(this).parent().closest(".accordion-header").find("button").trigger("click");']) ?>
                            <button class="accordion-button" hidden type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-home-delivery" aria-expanded="true"
                                    aria-controls="flush-home-delivery">
                            </button>
                        </div>
                        <div id="flush-home-delivery" class="accordion-collapse collapse border-top show"
                             aria-labelledby="flush-heading-home-delivery" data-bs-parent="#accordionPaymentOnDelivery">
                            <small id="notify-consignee-address" class="d-none"><i
                                        class="text-danger">*<?= Yii::t('app', 'You must fill in all the fields') ?></i></small>
                            <div class="accordion-body row m-0 p-2">
                                <div class="col-12 col-sm-6 px-1">
                                    <?= $form->field($model, 'province_id')->dropDownList($provinces, ['id' => 'province-id', 'prompt' => Yii::t('app', '- Choose province/city -')])->label(Yii::t('app', 'Province')) ?>
                                </div>
                                <div class="col-12 col-sm-6 px-1">
                                    <?= $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                                        'options' => ['id' => 'district-id'],
                                        'pluginOptions' => [
                                            'depends' => ['province-id'],
                                            'placeholder' => Yii::t('app', '- Choose district -'),
                                            'url' => Url::to(['/checkout/get-district'])
                                        ]
                                    ])->label(Yii::t('app', 'District')); ?>
                                </div>
                                <div class="col-12 col-sm-6 px-1">
                                    <?= $form->field($model, 'village_id')->widget(DepDrop::classname(), [
                                        'options' => ['id' => 'village-id'],
                                        'pluginOptions' => [
                                            'depends' => ['district-id'],
                                            'placeholder' => Yii::t('app', '- Choose village/ward -'),
                                            'url' => Url::to(['/checkout/get-village'])
                                        ]
                                    ])->label(Yii::t('app', 'Village')); ?>
                                </div>
                                <div class="col-12 col-sm-6 px-1">
                                    <?= $form->field($model, 'specific_address')->label(Yii::t('app', 'Specific address')) ?>
                                </div>
                                <div class="col-12 px-1">
                                    <?= $form->field($model, 'notes', ['options' => ['class' => 'm-0']])->textarea(['placeholder' => Yii::t('app', 'Note to the seller'), 'class' => 'm-0'])->label(Yii::t('app', 'Message') . ' (' . Yii::t('app', 'Optional') . '):') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border">
                        <div class="accordion-header px-2 py-3 bg-lighter-gray" id="flush-heading-receive-at-store">
                            <?= $form->field($model, 'logistic_method', ['options' => ['class' => 'm-0']])->radio(['label' => Yii::t('app', 'Get at the store'), 'value' => 1, 'id' => 'sm-receive-at-store', 'onClick' => '$(this).parent().closest(".accordion-header").find("button").trigger("click");']) ?>
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-receive-at-store" aria-expanded="false"
                                    aria-controls="flush-receive-at-store" hidden>
                            </button>
                        </div>
                        <div id="flush-receive-at-store" class="accordion-collapse collapse"
                             aria-labelledby="flush-heading-receive-at-store"
                             data-bs-parent="#accordionPaymentOnDelivery">
                            <div class="accordion-body row m-0 p-2 text-center" hidden></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 order-0 order-lg-1 p-0 ps-lg-4 ps-xl-5 m-0 my-4 my-lg-0">
            <h3 class="pb-1 border-bottom px-0"><?= Yii::t('app', 'Cart') ?>:</h3>
            <div class="w-100 m-0 p-0 <?= (count($cart) > 3) ? 'product-in-cart' : '' ?>">
                <?php foreach ($cart as $key => $value): ?>
                    <div class="w-100 row m-0 pb-2 p-0 d-flex align-items-center border-bottom row-product"
                         data-id="<?= \common\components\encrypt\CryptHelper::encryptString($cart[$key]['p-id']) ?>"
                         data-cart-id="<?= \common\components\encrypt\CryptHelper::encryptString($cart[$key]['id']) ?>">
                        <div class="col-8 col-sm-6 col-md-7 col-lg-8 row m-0 p-0">
                            <div class="col-4 col-md-2 position-relative p-0">
                                <img src="<?= $imgUrl . '/' . $cart[$key]['p-img'] ?>" class="w-100 position-relative">
                                <span class="product-quantity"
                                      data-quantity="<?= $cart[$key]['quantity'] ?>"><?= $cart[$key]['quantity'] ?></span>
                            </div>
                            <div class="col-8 col-md-10 ps-3 d-flex align-items-center">
                                <div class="w-100">
                                    <p class="m-0 product-name"><?= $cart[$key]['p-name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-6 col-md-5 col-lg-4 row m-0 py-0 px-2">
                            <p class="m-0 px-1 text-end price" id="total_price_<?= $key ?>"
                               data-total-price="<?= $cart[$key]['total_price'] ?>"><?= number_format($cart[$key]['total_price'], 0, ',', '.') ?>
                                đ</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="w-100 row m-0 p-0 bg-lighter-gray border-top mt-3">
        <div class="col-12 col-md-6 m-0 p-0">
        </div>
        <div class="col-12 col-md-6 m-0 p-2">
            <div class="my-1 py-2 w-100"><?= Yii::t('app', "Total product's price") ?>: <span class="fs-5 m-0 float-end"
                                                                                              id="total_price_product"></span>
            </div>
            <div class="my-1 py-2 w-100"><?= Yii::t('app', 'VAT') ?>: <span class="fs-5 m-0 float-end"
                                                                            id="vat"
                                                                            data-vat="<?= \common\components\SystemConstant::VAT ?>"></span>
            </div>
            <div class="my-1 py-2 w-100"><?= Yii::t('app', 'Total payment') ?>: <span
                        class="fs-4 text-danger m-0 float-end"
                        id="total_price"></span></div>
        </div>
        <div class="w-100 row m-0 py-3 px-0 px-sm-auto border-top d-flex align-items-center">
            <div class="col-7 col-sm-8 fs-xsm__12px">
                <?= Yii::t('app', 'Clicking "Order" means you agree to abide by') ?> <a
                        href="<?= Url::toRoute('site/terms') ?>"
                        class="text-decoration-none text-primary"><?= Yii::t('app', 'the De Obelly terms') ?>.</a>
            </div>
            <div class="col-5 col-sm-4 px-2">
                <button type="submit" class="btn bg-red rounded-0 px-3 px-sm-4 py-2 text-white float-end"
                        id="order"><?= Yii::t('app', 'Order') ?></button>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>