<?php

/* @var $this yii\web\View */

use common\components\encrypt\CryptHelper;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Cart');
$this->params['breadcrumbs'][] = $this->title;
$cdnUrl = Yii::$app->params['frontend'];
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCssFile(Url::toRoute("css/cart.css"));
$this->registerCssFile(Url::toRoute("css/success_error-icon.css"));
$this->registerJsFile(Url::toRoute('js/cart.js'));
?>
<?php if (empty($cart)): ?>
    <?php if (Yii::$app->session->hasFlash('creatOrderSuccess')): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
                id='btnModalSuccess' hidden>
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
                            <p class="mx-0 mb-4"><?= Yii::t('app', Yii::$app->session->getFlash('creatOrderSuccess')) ?></p>
                            <button type="button" data-bs-dismiss="modal" id='btnModalClose' hidden></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="w-100 mx-0 text-center my-4 my-md-5 py-md-5">
        <img src="<?= Url::toRoute('img/cart.png') ?>" class="w-25 my-2"><br>
        <a href="<?= Url::toRoute('shop/ ') ?>" class="text-decoration-none"><small
                    class="text-dark"><?= Yii::t('app', 'Continue shopping') ?> <i
                        class="fas fa-arrow-right"></i></small></a>
    </div>
<?php else: ?>
    <div class="w-100 row mx-0 px-2 py-2 my-2 border-bottom d-none d-lg-flex">
        <div class="col-4 col-sm-3 col-md-2 col-xxl-1 m-0 px-0 py-3 d-flex">
            <span class="text-uppercase fs-5 fw-bold"><?= Yii::t('app', 'product') ?></span>
        </div>
        <div class="col-8 col-sm-9 col-md-10 col-xxl-11 m-0 px-0 py-3 row mx-0">
            <div class="col-4 col-xl-3 col-xxl-4 row m-0 p-0"></div>
            <div class="col-4 col-xl-5 col-xxl-4 row m-0 p-0">
                <div class="col-6 text-uppercase px-0"><?= Yii::t('app', 'unit price') ?></div>
                <div class="col-6 text-uppercase px-0"><?= Yii::t('app', 'quantity') ?></div>
            </div>
            <div class="col-4 row m-0 p-0">
                <div class="col-8 p-0 text-uppercase text-center"><?= Yii::t('app', 'Total price') ?></div>
                <div class="col-4 p-0 text-uppercase text-center"><?= Yii::t('app', 'action') ?></div>
            </div>
        </div>
    </div>
    <?php foreach ($cart as $key => $value): ?>
        <?php $idEncrypt = CryptHelper::encryptString($value['id']) ?>
        <div class="w-100 row mx-0 py-2 my-3 my-md-2 border-bottom border-top p-0 row-product"
             data-id="<?= $idEncrypt ?>">
            <div class="col-4 col-sm-3 col-md-2 col-xl-1 row m-0 px-0 d-flex justify-content-center align-items-center">
                <img src="<?= $imgUrl . '/' . $value['p-img'] ?>" class="object-fit-cover w-100 px-0">
            </div>
            <!--information-->
            <div class="col-8 col-sm-9 col-md-10 col-xl-11 m-0 px-0 row d-flex justify-content-center align-items-center px-2 px-md-0 px-md-0">
                <div class="col-12 col-md-4 fs__14px px-0 px-md-3 my-1">
                    <p class="w-100 fs-name m-0"><?= $value['p-name'] ?></p>
                </div>
                <!--price-->
                <div class="col-12 col-md-3 col-lg-4 row m-0 my-1 p-0 align-items-center justify-content-center">
                    <div class="col-lg-6 d-none d-lg-flex p-0 justify-sm-content-center price_<?= $idEncrypt ?>"
                         data-price="<?= $value['p-price'] ?>">
                        <span class="d-md-none me-2"><?= Yii::t('app', 'Price') ?>:</span>
                        <?= number_format($value['p-price'], 0, ',', '.') ?>đ
                    </div>
                    <!--quantity-->
                    <div class="col-12 col-lg-6 p-0 text-md-center">
                        <p class="d-lg-none my-0"><?= Yii::t('app', 'Quantity') ?>: </p>
                        <div class="d-flex justify-content-md-center justify-content-lg-start">
                            <button type="button" data-id="<?= $idEncrypt ?>"
                                    class="btn btn-gray border-end border-0 border-dark btnDESC d-md-flex justify-content-center align-items-center">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" id="amount<?= $idEncrypt ?>" data-id="<?= $idEncrypt ?>"
                                   value="<?= $value['quantity'] ?>"
                                   onchange="totalPrice()"
                                   class="text-center d-inline-block amountInput">
                            <button type="button" data-id="<?= $idEncrypt ?>"
                                    class="btn btn-gray border-start border-0 border-dark btnASC d-md-flex justify-content-center align-items-center">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="d-block w-100 text-start">
                            <small class="existing-product<?= $idEncrypt ?> w-100 text-md-center text-lg-start d-block"
                                   data-existing-product="<?= $value['p-quantity'] ?>"><?= Yii::t('app', 'Warehouse') ?>
                                : <?= ($value['p-quantity'] > 1) ? $value['p-quantity'] . ' ' . Yii::t('app', 'products') : $value['p-quantity'] . ' ' . Yii::t('app', 'product') ?></small>
                            <small id="notify_<?= $idEncrypt ?>"
                                   class="d-none text-md-center text-lg-start text-danger"><?= Yii::t('app', 'Not enough') ?></small>
                        </div>
                    </div>
                </div>
                <!--total price-->
                <div class="col-12 col-md-5 col-lg-4 row m-0 p-0 my-1">
                    <div class="col-8 p-0 text-md-center text-red">
                        <p class="d-lg-none d-inline-block d-md-block text-black my-0"><?= Yii::t('app', 'Total') ?>
                            :</p>
                        <span id="total_price_product<?= $idEncrypt ?>" class="total-price_<?= $key ?>"
                              data-total-price="<?= $value['total_price'] ?>"><?= number_format($value['total_price'], 0, ',', '.') ?>đ</span>
                    </div>
                    <!--action-->
                    <div class="col-4 p-0 text-md-center">
                        <a href="<?= Url::toRoute(['cart/delete-cart', 'id' => $idEncrypt]) ?>"
                           class="btn bg-transparent w-100 p-0"><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="w-100 row mx-0 px-2 my-4 d-flex align-items-center justify-content-center">
        <div class="col-12 col-md-6 m-0 px-0 d-flex">
        </div>
        <div class="col-12 col-md-6 m-0 px-0 row text-end">
            <div class="col-12 px-0 mb-1">
                <p class="m-0 text-uppercase fs-6"><?= Yii::t('app', 'Total payment') ?>: <span class="fs-3 text-red"
                                                                                                id="totalPrice"></span>
                </p>

            </div>
            <div class="col-12 text-uppercase p-0">
                <a href="<?= Url::toRoute('checkout/') ?>"
                   class="btn bg-black text-white fw-light"><?= Yii::t('app', 'Checkout') ?></a>
            </div>
        </div>
    </div>
<?php endif; ?>