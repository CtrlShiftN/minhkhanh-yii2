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
    <section class="about-content pb-4">
        <div class="section-heading text-center mb-4">
            <h2 class="section-title">
                <span class="text-uppercase title-aboutus"><?= Yii::t('app', 'ABOUT US') ?></span>
            </h2>
        </div>
        <div class="section-content text-justify">
            <h3>Giới thiệu công ty MINHKHANH</h3>
            <h5 class="m-0">
                1, Thi công lắp đặt, sữa chữa, di dời hệ thống Camera Quan sát
            </h5>
            <ul class="mb-2">
                <li>Giải pháp thi công, lắp đặt camera quan sát cho tòa nhà, khối văn phòng.</li>
                <li>Giải pháp thi công, lắp đặt camera quan sát cho nhà xưởng tại TPHCM.</li>
                <li>Giải pháp thi công, lắp đặt cho Khách sạn.</li>
                <li>Giải pháp thi công, lắp đặt cho khối Ngân hàng – Tài chính.</li>
                <li>Giải pháp thi công, lắp đặt cho Siêu thị, Sàn giao dịch.</li>
                <li>Giải pháp thi công, lắp đặt cho các nút giao thông.</li>
                <li>Giải pháp thi công, lắp đặt cho nhà xưởng, kho bãi.</li>
                <li>Giải pháp thi công, lắp đặt cho cửa hàng quán tạp hóa, quán bar, quán nhậu, gia đình.</li>
            </ul>
            <h5 class="m-0">
                2, Hệ thống cầu thang máy
            </h5>
            <ul class="mb-3">
                <li>Hệ thống cầu thang máy cho tòa nhà, khối văn phòng.</li>
                <li>Hệ thống cầu thang máy cho Ngân Hàng.</li>
                <li>Hệ thống  cầu thang máy cho Siêu thị, nhà kho.</li>
            </ul>

            <h3>Cơ cấu tổ chức của Camera Thời Đại</h3>
            <p>Với hơn 10 năm hoạt động trong lĩnh vực camera an ninh,
                chúng tôi luôn nắm bắt những công nghệ mới,
                để tư vấn cho khách hàng giải pháp thi công và lắp đặt các thiết bị an ninh tốt nhất hiện tại.</p>
            <p>Với đội ngũ nhân viên của chúng tôi đã được đào tạo nhiều lượt từ các trường cao đẳng,
                đại học danh tiếng trong và ngoài nước.
                Nhiều người trong số đó đã trở thành chuyên gia trong nhiều lĩnh vực.
                Đặc biệt trong số họ có nhiều người có kinh nghiệm hàng đầu trong lĩnh vực Security.</p>

            <h3>Định hướng phát triển</h3>
            <p>
                Với quy mô hoạt động rộng rãi,
                Công ty MINHKHANH luôn cam kết mang tới khách hàng những sản phẩm và dịch vụ tốt nhất.
                Với đội ngũ nhân viên chuyên sâu, năng động,
                nhiệt tình và nhiều kinh nghiệm Công ty MINHKHANH chúng tôi luôn đem đến cho khách hang sự hài lòng và tin tưởng tuyệt đối.
                Để duy trì vị trí hàng đầu trong lĩnh vực Security.
            </p>
            <p>
                Đối với khách hàng trong nước,
                Camera Thời Đại tiếp tục xây dựng mối quan hệ truyền thống chiến lược với khách hàng.
                Với định hướng luôn đồng hành với các doanh nghiệp, cơ quan,
                ban nghành, đoàn thể trên con đường hiện đại hóa với mục tiêu luôn cung cấp cho các doanh nghiệp những giải pháp tốt nhất.
            </p>
            <p>
                Tiếp tục xây dựng và nâng cao đội ngũ cán bộ nhân viên có khả năng ứng dụng công nghệ hiện đại nhất và am hiểu sâu sắc về nghiệp vụ khách hàng.
                Có khả năng tư vấn và làm việc trong môi trường quốc tế hóa ngày càng cao.
            </p>
            <p>
                Xây dựng các đối tác nước ngoài uy tín và tin cậy,
                cung cấp các giải pháp mới,
                nhằm đáp ứng một cách cao nhất yêu cầu của khách hàng.
            </p>
            <p>
                Liên tục ứng dụng những phương pháp mới nhất để nâng cao năng lực quản lý của doanh nghiệp và mở rộng việc cung cấp sản phẩm và dịch vụ ra thị trường khu vực.
            </p>
        </div>
    </section>
    <section class="contact-content p-0 m-0">
        <div class="row m-0 p-0">
            <a href="<?= Url::toRoute('shop/') ?>" class="text-decoration-none p-0 m-0">
                <img class="w-100 objectfit-cover" src="<?= Url::toRoute('img/banner_lap_dat_camera.png') ?>">
            </a>
        </div>
    </section>
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
