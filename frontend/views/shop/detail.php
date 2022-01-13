<?php

/* @var $this yii\web\View */

use common\components\encrypt\CryptHelper;
use yii\helpers\Url;

$this->title = Yii::t('app', $detail['name']);
$this->params['breadcrumbs'][] = $this->title;
$cdnUrl = Yii::$app->params['frontend'];
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCssFile(Url::toRoute("css/swiper.min.css"));
$this->registerCssFile(Url::toRoute("css/product-detail.css"));
$this->registerCssFile(Url::toRoute("css/easyzoom.css"));
$this->registerJsFile(Url::toRoute('js/easyzoom.js'));
$this->registerJsFile(Url::toRoute('js/swiper-bundle.min.js'));
$this->registerJsFile(Url::toRoute('js/product-detail.js'));
$this->registerCss('
    .swiper {
      width: 100%;
      height: 100%;
    }
    .swiper-button-next,.swiper-button-prev {
  background-image: none;
  background-size: 0;
  background-repeat: no-repeat;
  background-position: 0;
  margin-top: -1rem;
}
.swiper-button-next .arrow-icon,.swiper-button-prev .arrow-icon {
  font-size: 2rem;
  color: #000;
}
');
?>
<div class="visually-hidden" id="sth" data-id="<?= Yii::$app->user->isGuest ? 1 : 0 ?>"></div>
<div class="row py-3 m-0 px-auto w-100 overflow-hidden justify-content-center">
    <div class="col-12 col-md-5 px-auto">
        <div class="product__carousel ps-md-3 ps-lg-4 ps-xl-5 mt-0">
            <!-- Swiper and EasyZoom plugins start -->
            <div class="swiper-container gallery-top">
                <div class="swiper-wrapper">
                    <div class="swiper-slide easyzoom easyzoom--overlay">
                        <a href="<?= $imgUrl . '/' . $detail['image'] ?>">
                            <img src="<?= $imgUrl . '/' . $detail['image'] ?>">
                        </a>
                    </div>
                    <?php if (!empty($detail['images'])): ?>
                        <?php $imgArr = explode(',', $detail['images']);
                        foreach ($imgArr as $key => $value): ?>
                            <div class="swiper-slide easyzoom easyzoom--overlay">
                                <a href="<?= $imgUrl . '/' . $value ?>">
                                    <img src="<?= $imgUrl . '/' . $value ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next swiper-button-white"></div>
                <div class="swiper-button-prev swiper-button-white"></div>
            </div>
            <div class="swiper-container gallery-thumbs">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="<?= $imgUrl . '/' . $detail['image'] ?>">
                    </div>
                    <?php if (!empty($detail['images'])): ?>
                        <?php $imgArr = explode(',', $detail['images']);
                        foreach ($imgArr as $key => $value): ?>
                            <div class="swiper-slide">
                                <img src="<?= $imgUrl . '/' . $value ?>">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Swiper and EasyZoom plugins end -->
        </div>
    </div>
    <div class="col-12 col-md-7 product-information" data-id="<?= CryptHelper::encryptString($detail['id']) ?>">
        <span class="mt-md-3 fs-3 m-0 fw-bolder text-uppercase d-block"><span
                    class="badge rounded-0 bg-danger"
                    id="outOfStock"><?= Yii::t('app', 'Out of stock') ?></span> <?= $detail['name'] ?></span>
        <div class="d-flex w-100 mb-3 mb-md-4">
            <?php if ($detail['viewed'] >= 1000): ?>
                <span class="fw-light px-3 fs-6 border-end text-secondary"><span
                            class="border-bottom border-dark text-danger fs-5"><?= number_format($detail['viewed'] / 1000, 1, ',', '.') ?>K</span> <?= Yii::t('app', 'Viewed') ?></span>
            <?php else: ?>
                <span class="fw-light px-3 border-end fs-6 text-secondary"><span
                            class="border-bottom border-dark text-danger fs-5"><?= $detail['viewed'] ?></span> <?= Yii::t('app', 'Viewed') ?></span>
            <?php endif; ?>
            <?php if ($detail['sold'] >= 1000): ?>
                <span class="fw-light px-3 fs-6 text-secondary"><span
                            class="border-bottom border-dark text-danger fs-5"><?= number_format($detail['sold'] / 1000, 1, ',', '.') ?>K</span> <?= Yii::t('app', 'Sold') ?></span>
            <?php else: ?>
                <span class="fw-light px-3 fs-6 text-secondary"><span
                            class="border-bottom border-dark text-danger fs-5"><?= $detail['sold'] ?></span> <?= Yii::t('app', 'Sold') ?></span>
            <?php endif; ?>
        </div>
        <div class="w-100 my-3 py-2 py-md-3 px-1 px-md-3 bg-lighter-gray">
            <?php if (!empty($detail['discount'])): ?>
                <div class="my-2 fs-3 m-0 fw-bold text-danger">
                    <span class="fw-light price text-decoration-line-through text-dark fs-6"
                          data-price="<?= $detail['selling_price'] ?>"><?= number_format($detail['regular_price'], 0, ',', '.') ?>đ</span> <?= number_format($detail['selling_price'], 0, ',', '.') ?>
                    đ
                    <span class="badge bg-danger fs-6 text-light text-uppercase fw-light mx-md-3">-<?= $detail['discount'] ?>%</span>
                </div>
            <?php else: ?>
                <span class="my-2 fs-4 m-0 fw-bold price d-block text-danger"
                      data-price="<?= $detail['selling_price'] ?>"><?= number_format($detail['selling_price'], 0, ',', '.') ?>đ</span>
            <?php endif; ?>
        </div>
        <div class="w-100 row m-0 p-0">
            <span class="fw-light col-12 col-sm-3 px-1 fs-5 d-block mb-2"><?= Yii::t('app', 'Commit') ?>:</span>
            <ul class="col-12 col-sm-9 mx-0 px-0 list-unstyled">
                <li class="d-flex my-2">
                    <img src="<?= Url::toRoute('img/box_ico.png') ?>" class="me-3 my-auto">
                    <p class="p-0 m-0 fw-light"><?= Yii::t('app', '100% genuine product') ?></p>
                </li>
                <li class="d-flex my-3">
                    <img src="<?= Url::toRoute('img/product_deliverly_ico.png') ?>" class="me-3 my-auto">
                    <p class="p-0 m-0 fw-light"><?= Yii::t('app', 'Expected delivery') ?>:<br>
                        <span class="fw-bold"><?= Yii::t('app', 'Monday - Friday from 9:00 am - 5:00 pm') ?></span></p>
                </li>
                <li class="d-flex my-2">
                    <img src="<?= Url::toRoute('img/tel_ico.png') ?>" class="me-3 my-auto">
                    <p class="p-0 m-0 fw-light"><?= Yii::t('app', '24/7 support') ?><br>
                        <?= Yii::t('app', 'With chat, email & phone channels') ?></p>
                </li>
            </ul>
        </div>
        <div class="w-100 row mx-0 my-2 p-0">
            <span class="fw-light col-12 col-sm-3 px-1 fs-5"><?= Yii::t('app', 'Quantity') ?>:</span>
            <div class="col-12 col-sm-9 m-0 p-0">
                <div class="w-100 d-flex">
                    <button type="button" onclick="reduceProductQuantity()" id="btnDESC"
                            class="btn btn-gray d-inline-block fw-bolder border-top-0 border-bottom-0 border-start-0 border-dark">
                        -
                    </button>
                    <input type="text" id="amountInput" value="1" class="text-center d-inline-block">
                    <button type="button" onclick="increaseProductQuantity()" id="btnASC"
                            class="btn btn-gray d-inline-block fw-bolder border-top-0 border-bottom-0 border-end-0 border-dark">
                        +
                    </button>
                </div>
                <i class="notifyColor mt-md-2 mt-lg-2 mt-xl-0 ml-2 d-block" id="quantity"
                   data-quantity="<?= $detail['quantity'] ?>"><?= Yii::t('app', 'Warehouse') ?>
                    : <?= ($detail['quantity'] > 1) ? $detail['quantity'] . ' ' . Yii::t('app', 'products') : $detail['quantity'] . ' ' . Yii::t('app', 'product') ?></i>
                <small id="notify" class="text-danger w-100 my-2"
                       data-out-of-stock="<?= Yii::t('app', 'Out of stock') ?>"
                       data-validate="<?= Yii::t('app', 'Choose product types') ?>"></small>
            </div>
        </div>
        <div class="w-100 row mx-0 px-0">
            <button class="btn btn-outline-danger p-2 me-lg-3 my-2 my-sm-0 my-md-2 my-lg-0 col-12 col-sm-6 col-md-12 col-lg-5 text-danger bg-white border border-danger rounded-0"
                    id="btnAddToCart"><i class="fas fa-cart-plus"></i> <?= Yii::t('app', 'Add to cart') ?>
            </button>
            <a class="btn p-2 btn-danger text-light col-12 col-sm-6 col-md-12 col-lg-5 text-light bg-danger rounded-0"
               href="<?= Url::toRoute('checkout/') ?>"
               id="btnBuyNow"><?= Yii::t('app', 'Buy now') ?></a>

        </div>
    </div>
    <div class="w-100 my-2 mx-0 px-md-3">
        <div class="accordion p-0" id="accordionInformation">
            <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingInf">
                    <button class="fs-6 accordion-button text-uppercase bg-white fw-bold text-dark px-0 rounded-0 border-bottom border-dark"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseInf"
                            aria-expanded="true"
                            aria-controls="collapseInf">
                        <?= Yii::t('app', 'Product details') ?>
                    </button>
                </h2>
                <div id="collapseInf" class="accordion-collapse collapse show" aria-labelledby="headingInf"
                     data-bs-parent="#accordionInformation">
                    <div class="accordion-body fw-light border-bottom border-dark">
                        <?= $detail['description'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (count(\frontend\models\Product::getBestSellingProduct($detail['id'], 5)) > 0): ?>
    <div class="w-100 my-2 mx-0 px-3 px-md-0">
        <p class="m-0 text-uppercase border-bottom border-dark px-0 fw-bolder fs-4 pt-3 pb-2">
            <?= Yii::t('app', 'Best-seller') ?>
        </p>
    </div>
    <div class="row m-0 px-0 px-md-5 w-100">
        <div class="w-100 row p-0 m-0 overflow-hidden" id="bestsellers">
            <div class="swiper position-relative">
                <div class="swiper-wrapper">
                    <?php foreach (\frontend\models\Product::getBestSellingProduct($detail['id'], 10) as $key => $value): ?>
                        <div class="swiper-slide col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2_4 mx-0 py-3 position-relative product-card overflow-hidden">
                            <div class="position-relative overflow-hidden w-100 img-shadow">
                                <a href="<?= Url::toRoute(['shop/detail', 'detail' => \common\components\encrypt\CryptHelper::encryptString($value['id'])]) ?>"
                                   class="text-decoration-none text-dark px-0 w-100 position-relative">
                                    <div class="position-relative product-img w-100 mb-2">
                                        <img class="img-product"
                                             src="<?= $imgUrl . '/' . $value['image'] ?>">
                                    </div>
                                    <div class="pr-inf px-2 px-lg-1 px-xl-2 py-2 w-100 border-top">
                                        <?php if (!empty($value['discount'])): ?>
                                            <span class="px-0 fw-bold mt-2 p-price text-danger">
                                    <span class="text-decoration-line-through text-dark fw-light fs-regular-price"><?= number_format($value['regular_price'], 0, ',', '.') ?>đ</span> <?= number_format($value['selling_price'], 0, ',', '.') ?>đ
                                </span>
                                        <?php else: ?>
                                            <span class="px-0 fw-bold mt-2 p-price"><?= number_format($value['selling_price'], 0, ',', '.') ?>đ</span>
                                        <?php endif; ?>
                                        <p class="m-0 product-name"><?= $value['name'] ?></p>
                                    </div>
                                </a>
                                <?php if (!empty($value['discount'])): ?>
                                    <div class="sale-tag"><span>-<?= $value['discount'] ?>%</span></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <i class="col-12 p-0 m-0 text-end mb-3">
                <a href="<?= Url::toRoute('shop/product') ?>"
                   class="text-decoration-none text-dark"><?= Yii::t('app', 'View all products') ?> >></a>
            </i>
        </div>
    </div>
<?php endif; ?>
<?php if (count(\frontend\models\Product::getOnSaleProduct($detail['id'], 5)) > 0) : ?>
    <div class="w-100 my-2 mx-0 px-3 px-md-0">
        <p class="m-0 text-uppercase border-bottom border-dark px-0 fw-bolder fs-4 pt-3 pb-2">
            <?= Yii::t('app', 'Promotions') ?>
        </p>
    </div>
    <div class="row m-0 px-0 pb-5 px-md-5 w-100">
        <div class="w-100 row p-0 m-0 overflow-hidden" id="onSale">
            <div class="swiper position-relative">
                <div class="swiper-wrapper">
                    <?php foreach (\frontend\models\Product::getOnSaleProduct($detail['id'], 10) as $key => $value): ?>
                        <div class="swiper-slide col-12 col-sm-6 col-lg-4 col-xl-3 col-xxl-2_4 mx-0 py-3 position-relative product-card overflow-hidden">
                            <div class="position-relative overflow-hidden w-100 img-shadow">
                                <a href="<?= Url::toRoute(['shop/detail', 'detail' => \common\components\encrypt\CryptHelper::encryptString($value['id'])]) ?>"
                                   class="text-decoration-none text-dark px-0 w-100 position-relative">
                                    <div class="position-relative product-img w-100 mb-2">
                                        <img class="img-product"
                                             src="<?= $imgUrl . '/' . $value['image'] ?>">
                                    </div>
                                    <div class="pr-inf px-2 px-lg-1 px-xl-2 py-2 w-100 border-top">
                                        <?php if (!empty($value['discount'])): ?>
                                            <span class="px-0 fw-bold mt-2 p-price text-danger">
                                    <span class="text-decoration-line-through text-dark fw-light fs-regular-price"><?= number_format($value['regular_price'], 0, ',', '.') ?>đ</span> <?= number_format($value['selling_price'], 0, ',', '.') ?>đ
                                </span>
                                        <?php else: ?>
                                            <span class="px-0 fw-bold mt-2 p-price"><?= number_format($value['selling_price'], 0, ',', '.') ?>đ</span>
                                        <?php endif; ?>
                                        <p class="m-0 product-name"><?= $value['name'] ?></p>
                                    </div>
                                </a>
                                <?php if (!empty($value['discount'])): ?>
                                    <div class="sale-tag"><span>-<?= $value['discount'] ?>%</span></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <i class="col-12 p-0 m-0 text-end mb-3">
                <a href="<?= Url::toRoute('shop/product') ?>"
                   class="text-decoration-none text-dark"><?= Yii::t('app', 'View all products') ?> >></a>
            </i>
        </div>
    </div>
<?php endif; ?>
<div id="toastBoard" class="position-fixed rounded">
    <div id="liveToast" class="toast py-3 px-2 text-light border-2 fw-bold" role="alert"
         aria-live="assertive" aria-atomic="true">
        <span id="toastNotify"></span>
    </div>
</div>
<script src="<?= Url::toRoute('js/swiper-bundle.min.js') ?>"></script>
<script>
    var swiper = new Swiper('.swiper', {
        slidesPerView: 1,
        // spaceBetween: 5,
        // loop: true,
        // init: false,
        // pagination: {
        //     el: '.swiper-pagination',
        //     clickable: true,
        // },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            576: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
            1400: {
                slidesPerView: 5,
            },
        }
    });
</script>