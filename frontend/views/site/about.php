<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use frontend\models\Product;
use yii\bootstrap5\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Introduction');
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCssFile(Url::toRoute("css/swiper.min.css"));
$this->registerCssFile(Url::toRoute('css/introduction.css'));
$this->registerCssFile(Url::toRoute("css/animate.min.css"));
$this->registerCss("
    .container {
        padding: 0 !important;
    }
");
?>
<div class="full-width mb-4">
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
<div class="row m-0 p-0 pb-4 pb-md-5">
    <div class="shop-intro text-center pt-md-5 pb-2">
        <?php if (!empty($stories['intro'])): ?>
            <img src="<?= $imgUrl . '/' . $stories['intro']['image'] ?>" width="100%">
            <h3 class="text-uppercase py-2">MINHKHANH</h3>
            <div class="intro-text px-3">
                <?= (!empty($stories['intro']['content'])) ? $stories['intro']['content'] : '' ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="full-width pb-4 pb-md-5 d-none d-md-block">
    <?php if (!empty($stories['fullwidth'])): ?>
        <img src="<?= $imgUrl . '/' . $stories['fullwidth']['image'] ?>" width="100%">
    <?php endif; ?>
</div>
<div class="row m-0 p-0 pb-4 pb-md-5">
    <div class="container-md p-0">
        <div class="row quotes pb-4 pb-md-5 text-center w-100 mx-0 px-2 align-items-md-center justify-content-md-center">
            <?php if (!empty($stories['quote'])): ?>
                <div class="col-12 col-md-1"></div>
                <div class="col-12 col-md-5">
                    <img src="<?= $imgUrl . '/' . $stories['quote']['image'] ?>" width="100%">
                </div>
                <div class="col-12 col-md-5 intro-quote mt-3 mt-md-0 pt-md-0 pe-0">
                    <?= $stories['quote']['content'] ?>
                </div>
                <div class="col-12 col-md-1"></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (!empty($latestNews)): ?>
    <div class="row m-0 p-0 pb-4 pb-md-5">
        <section class="about-latest-news pb-5">
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
<script src="<?= Url::toRoute('js/swiper-bundle.min.js') ?>"></script>
<script src="<?= Url::toRoute('js/introduction.js') ?>"></script>
