<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use frontend\models\Product;
use yii\bootstrap5\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'MINHKHANH - Home');
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCssFile(Url::toRoute("css/swiper.min.css"));
$this->registerCssFile(Url::toRoute('css/index.css'));
$this->registerCssFile(Url::toRoute("css/success_error-icon.css"));
$this->registerCssFile(Url::toRoute("css/animate.min.css"));
$this->registerCss("
    .container {
        padding: 0 !important;
    }
");
?>
<?php if (Yii::$app->session->hasFlash('resetSuccess')): ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
            id='btnModalResetSuccess' hidden>
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
                        <p class="mx-0 mb-4"><?= Yii::t('app', Yii::$app->session->getFlash('resetSuccess')) ?></p>
                        <button type="button" data-bs-dismiss="modal" id='btnModalResetClose'
                                hidden></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <style>

    </style>
    <div class="full-width mb-4 mb-md-5">
        <!-- Slider main container -->
        <div class="swiper position-relative banner-slide-height" id="banner-slide">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <div class="swiper-slide w-100 position-relative">
                    <div class="position-absolute image-slide">
                        <img src="<?= Url::toRoute('img/banner-camera.jpg') ?>" class="w-100 h-100 objectfit-cover">
                    </div>
                    <div class="position-absolute bg-cover w-100 h-100"></div>
                    <div class="position-relative content-wrapper w-100 d-flex align-items-center justify-content-center animate__animated">
                        <div class="content-box text-center">
                            <div class="text-white m-0 w-100 fs-2 text-uppercase fw-light"><?= Yii::t('app', 'security camera') ?></div>
                            <div class="text-white m-0 py-md-3 py-lg-4 w-100 fs-content text-uppercase fw-bold">
                                <i><?= Yii::t('app', 'safety - security - quality') ?></i></div>
                            <a href="<?= Url::toRoute('shop/') ?>"
                               class="text-white btn btn-danger fs-6 hover-change-whiteBg px-3 px-md-4 rounded-0"><?= Yii::t('app', 'See more') ?></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide w-100 position-relative">
                    <div class="position-absolute image-slide">
                        <img src="<?= Url::toRoute('img/banner-elevator.jpg') ?>" class="w-100 h-100 objectfit-cover">
                    </div>
                    <div class="position-absolute bg-cover w-100 h-100"></div>
                    <div class="position-relative content-wrapper w-100 d-flex align-items-center justify-content-center animate__animated">
                        <div class="content-box text-center">
                            <div class="text-white m-0 w-100 fs-2 text-uppercase fw-light"><?= Yii::t('app', 'MINHKHANH - Elevator') ?></div>
                            <div class="text-white m-0 py-md-3 py-lg-4 w-100 fs-content text-uppercase fw-bold">
                                <i><?= Yii::t('app', 'Affirm the brand and quality') ?></i></div>
                            <a href="<?= Url::toRoute('shop/') ?>"
                               class="text-white btn btn-danger fs-6 hover-change-whiteBg px-3 px-md-4 rounded-0"><?= Yii::t('app', 'See more') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container m-0 p-0">
        <?php if (!empty($featuredProducts)): ?>
            <div class="row m-0 p-0">
                <section class="home-feature-product w-100 p-1">
                    <div class="section-heading text-center mb-4">
                        <h2 class="section-title">
                            <span class="text-uppercase fw-light"><?= Yii::t('app', 'Featured Products') ?></span>
                        </h2>
                    </div>
                    <div class="container px-0">
                        <div class="row w-100 mx-0 px-0">
                            <?php foreach ($featuredProducts as $key => $products): ?>
                                <div class="col-6 col-md-4 col-xl-3 text-center card-product position-relative pb-3 px-2 <?= ($key >= 6) ? 'd-none d-xl-block' : '' ?>">
                                    <div class="card box-shadow h-100 position-relative rounded-0">
                                        <a href="<?= Url::toRoute(['shop/detail', 'detail' => \common\components\encrypt\CryptHelper::encryptString($products['id'])]) ?>"
                                           class="text-decoration-none">
                                            <div class="image-holder">
                                                <img src="<?= $imgUrl . '/' . $products['image'] ?>"
                                                     class="card-img-top"
                                                     title="<?= $products['name'] ?>" alt="<?= $products['name'] ?>">
                                                <div class="img-overlay__see-more">
                                                    <a href="<?= Url::toRoute(['shop/detail', 'detail' => \common\components\encrypt\CryptHelper::encryptString($products['id'])]) ?>"
                                                       class="text-decoration-none text-white text-uppercase"><?= Yii::t('app', 'See more') ?></a>
                                                </div>
                                            </div>
                                            <div class="card-body p-1">
                                                <div class="feature-product__detail">
                                                    <p class="fs-pr-name product-name mb-2"><?= $products['name'] ?></p>
                                                    <p class="pro-price highlight fw-bold text-black mb-2">
                                                        <span class="current-price fs-5"><?= number_format($products['selling_price'], 0, ',', '.') ?>đ</span><br>
                                                        <?php if (!empty($products['discount'])) : ?>
                                                            <span class="pro-price-del"><del
                                                                        class="compare-price"><?= number_format($products['regular_price'], 0, ',', '.') ?>đ</del></span>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php if (!empty($products['discount'])) : ?>
                                        <span class="px-2 py-1 text-light bg-danger pr-discount">-<?= $products['discount'] ?>%</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="view-all-product text-center mt-3">
                        <a title="Xem tất cả" href="<?= Url::toRoute('shop/') ?>"
                           class="btn btn-danger hover-change-whiteBg shadow rounded-0 px-3 px-md-4">
                            <span class="btn-content"><?= Yii::t('app', "See more") ?></span>
                            <span class="icon"><i class="fa fa-arrow-right"></i></span>
                        </a>
                    </div>
                </section>
            </div>
        <?php endif; ?>
        <?php if (!empty($featuredOnSaleProduct)): ?>
            <div class="row m-0 p-0 py-4 py-md-5">
                <a href="<?= Url::toRoute('shop/') ?>" class="text-decoration-none p-0 m-0">
                    <img class="w-100 objectfit-cover" src="<?= Url::toRoute('img/banner-camera-ezviz-trong-nha-1024x280.jpg') ?>">
                </a>
            </div>
            <div class="row m-0 p-0">
                <section class="home-feature-product w-100 p-1">
                    <div class="section-heading text-center mb-4">
                        <h2 class="section-title">
                            <span class="text-uppercase fw-light"><?= Yii::t('app', 'Promotions') ?></span>
                        </h2>
                    </div>
                    <div class="container px-0">
                        <div class="row w-100 mx-0 px-0">
                            <?php foreach ($featuredOnSaleProduct as $key => $products): ?>
                                <div class="col-6 col-md-4 col-xl-3 text-center position-relative pb-3 px-2 <?= ($key >= 6) ? 'd-none d-xl-block' : '' ?>">
                                    <div class="card box-shadow h-100 position-relative rounded-0">
                                        <a href="<?= Url::toRoute(['shop/detail', 'detail' => \common\components\encrypt\CryptHelper::encryptString($products['id'])]) ?>"
                                           class="text-decoration-none">
                                            <div class="image-holder">
                                                <img src="<?= $imgUrl . '/' . $products['image'] ?>"
                                                     class="card-img-top"
                                                     title="<?= $products['name'] ?>" alt="<?= $products['name'] ?>">
                                                <div class="img-overlay__see-more">
                                                    <a href="<?= Url::toRoute(['shop/detail', 'detail' => \common\components\encrypt\CryptHelper::encryptString($products['id'])]) ?>"
                                                       class="text-decoration-none text-white text-uppercase"><?= Yii::t('app', 'See more') ?></a>
                                                </div>
                                            </div>
                                            <div class="card-body p-1">
                                                <div class="feature-product__detail">
                                                    <p class="fs-pr-name mb-2"><?= $products['name'] ?></p>
                                                    <p class="pro-price highlight fw-bold text-black mb-2">
                                                        <span class="current-price fs-5"><?= number_format($products['selling_price'], 0, ',', '.') ?>đ</span><br>
                                                        <?php if (!empty($products['discount'])) : ?>
                                                            <span class="pro-price-del"><del
                                                                        class="compare-price"><?= number_format($products['regular_price'], 0, ',', '.') ?>đ</del></span>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php if (!empty($products['discount'])) : ?>
                                        <span class="px-2 py-1 text-light bg-danger pr-discount">-<?= $products['discount'] ?>%</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="view-all-product text-center mt-3">
                        <a title="Xem tất cả" href="<?= Url::toRoute('shop/') ?>"
                           class="btn btn-danger hover-change-whiteBg shadow rounded-0 px-3 px-md-4">
                            <span class="btn-content"><?= Yii::t('app', "See more") ?></span>
                            <span class="icon"><i class="fa fa-arrow-right"></i></span>
                        </a>
                    </div>
                </section>
            </div>
        <?php endif; ?>
        <div class="row m-0 p-0 pt-4 pt-md-5 <?= (!empty($latestNews)) ? 'pb-4 pb-md-5':'pb-0 pb-sm-4 pb-md-5' ?>">
            <a href="<?= Url::toRoute('shop/') ?>" class="text-decoration-none p-0 m-0">
                <img class="w-100 objectfit-cover" src="<?= Url::toRoute('img/banner_lap_dat_camera.png') ?>">
            </a>
        </div>
        <?php if (!empty($latestNews)): ?>
            <div class="row m-0 p-0 pb-4 pb-md-5">
                <section class="home-latest-news pb-5">
                    <div class="section-heading text-center mb-4">
                        <h2 class="section-title">
                            <span class="text-uppercase"><?= Yii::t('app', 'Latest News') ?></span>
                        </h2>
                    </div>
                    <div class="container px-0">
                        <div class="row w-100 mx-0 px-0">
                            <?php foreach ($latestNews as $key => $value) : ?>
                                <div class="col-12 col-sm-6 col-lg-4 text-center pb-3 px-4 ">
                                    <div class="card box-shadow h-100">
                                        <a href="<?= Url::toRoute(['post/detail', 'id' => \common\components\encrypt\CryptHelper::encryptString($value['id'])]) ?>"
                                           class="text-decoration-none">
                                            <img src="<?= $imgUrl . '/' . $value['avatar'] ?>"
                                                 class="card-img-top img-fluid"
                                                 title="<?= $value['title'] ?>" alt="<?= $value['title'] ?>">
                                            <div class="card-body">
                                                <h4 class="text-black"><?= $value['title'] ?></h4>
                                                <div class="article-content text-black text-justify">
                                                    <?= substr(strip_tags($value['content']), 0, 200) . '...' ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="view-all-product text-center mt-3">
                        <a title="Xem tất cả" href="<?= Url::toRoute('post/') ?>"
                           class="btn btn-danger hover-change-whiteBg shadow rounded-0 px-3 px-md-4">
                            <span class="btn-content"><?= Yii::t('app', "See more") ?></span>
                            <span class="icon"><i class="fa fa-arrow-right"></i></span>
                        </a>
                    </div>
                </section>
            </div>
        <?php endif; ?>
    </div>
    <script src="<?= Url::toRoute('js/swiper-bundle.min.js') ?>"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
    </script>
    <script src="<?= Url::toRoute('js/index.js') ?>"></script>
<?php if (Yii::$app->session->hasFlash('resetSuccess')): ?>
    <script>
        $('#btnModalResetSuccess').trigger("click");
        setTimeout(function () {
            $('#btnModalResetClose').trigger("click");
        }, 2000);
    </script>
<?php endif; ?>