<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
$cdnUrl = Yii::$app->params['frontend'];
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?= $this->render('_mainHead') ?>
        <style>
            footer .footer-content {
                background: url('<?= $cdnUrl ?>/img/bg-footer.jpg') no-repeat;
                background-size: cover;
            }
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div id="wrapper">
        <div id="content">
<!--            sidebar-->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <span class="offcanvas-title" id="offcanvasExampleLabel">
                        <img src="<?= Url::toRoute('img/logo200.png') ?>" class="w-50 objectfit-cover">
                    </span>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body border-top p-0">
                    <?php if (!Yii::$app->user->isGuest) : ?>
                        <!-- User -->
                        <div class="d-flex align-items-center p-3 bg-cr-sidebar text-light">
                            <div class="col-3 p-0">
                                <div class="user__avatar img-circle">
                                    <!-- Avatar image -->
                                    <i class="far fa-user fa-2x"></i>
                                </div>
                            </div>
                            <div class="col-9 ps-2">
                                <h5 class="m-0 sidebar-user-name">Hello, <?= Yii::$app->user->identity->name ?></h5>
                                <span><i class="fas fa-circle success-icon text-success"></i></span>
                                Online
                            </div>
                        </div>
                        <!-- End user -->
                        <!-- Login & signup -->
                    <?php endif; ?>
                    <!-- sm,md Navbar -->
                    <div class="border-light border-top">
                        <nav class="sidebar-nav">
                            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column"
                                data-widget="treeview" role="menu">
                                <li class="nav-item border-bottom">
                                    <a href="<?= Url::toRoute('shop/') ?>"
                                       class="nav-link text-uppercase text-dark p-3">
                                        <p class="m-0 fs__15px"><?= Yii::t('app', 'Shop') ?></p>
                                    </a>
                                </li>
                                <li class="nav-item border-bottom">
                                    <a href="<?= Url::toRoute('site/') ?>"
                                       class="nav-link text-uppercase text-dark p-3">
                                        <p class="m-0 fs__15px"><?= Yii::t('app', 'Introductions') ?></p>
                                    </a>
                                </li>
                                <li class="nav-item border-bottom">
                                    <a href="<?= Url::toRoute('post/') ?>"
                                       class="nav-link text-uppercase text-dark p-3">
                                        <p class="m-0 fs__15px"><?= Yii::t('app', 'News') ?></p>
                                    </a>
                                </li>
                                <li class="nav-item border-bottom">
                                    <a href="<?= Url::toRoute('site/') ?>"
                                       class="nav-link text-uppercase text-dark p-3">
                                        <p class="m-0 fs__15px"><?= Yii::t('app', 'Documents') ?></p>
                                    </a>
                                </li>
                                <li class="nav-item border-bottom">
                                    <a href="<?= Url::toRoute('site/') ?>"
                                       class="nav-link text-uppercase text-dark p-3">
                                        <p class="m-0 fs__15px"><?= Yii::t('app', 'Support') ?></p>
                                    </a>
                                </li>
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <li class="nav-item border-bottom">
                                        <a href="<?= Url::toRoute('site/logout?ref=' . Yii::$app->request->url) ?>"
                                           class="nav-link text-uppercase text-dark p-3">
                                            <p class="m-0 fs__15px"><?= Yii::t('app', 'Logout') ?></p>
                                        </a>
                                    </li>
                                <?php else : ?>
                                    <li class="nav-item border-bottom">
                                        <a href="<?= Url::toRoute('site/login?ref=' . Yii::$app->request->url) ?>"
                                           class="nav-link text-uppercase text-dark p-3">
                                            <p class="m-0 fs__15px"><?= Yii::t('app', 'Login/Signup') ?></p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="copy-right bg-cr-sidebar text-center">
                    <span>Copyright &copy; <?= date('Y') ?> by MinhKhanh</span>
                </div>
            </div>
<!--            end sidebar-->
            <div class="w-100 px-0 py-1 m-0 topbar-content d-none d-md-flex">
                <nav class="container text-light">
                    <div class="row w-100 m-0 p-0">
                        <div class="col-5 mx-0 px-0 d-none d-lg-flex">
                            <ul class="list-unstyled w-100 p-0 m-0 d-flex">
                                <li>
                                    <strong>Hotline:</strong> <?= Yii::$app->params['adminTel'] ?>
                                </li>
                                <li>
                                    <div class="vr"></div>
                                </li>
                                <li>
                                    <strong>Email:</strong> <?= Yii::$app->params['supportEmail'] ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-7 d-none d-md-flex mx-0 px-0">
                            <ul class="list-unstyled w-100 p-0 m-0 d-flex align-items-center justify-content-md-center justify-content-lg-end">
                                <li class="site-nav-top"><a
                                            href="<?= Url::toRoute('site/terms') ?>"
                                            class="text-decoration-none text-light"><span><?= Yii::t('app', 'Terms & Services') ?></span></a>
                                </li>
                                <li class="site-nav-top">
                                    <div class="vr"></div>
                                </li>
                                <li class="site-nav-top"><a
                                            href="<?= Url::toRoute('site/contact') ?>"
                                            class="text-decoration-none text-light"><span><?= Yii::t('app', 'Contact') ?></span></a>
                                </li>
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <li class="site-nav-top">
                                        <div class="vr"></div>
                                    </li>
                                    <li class="site-nav-top">
                                        <div class="dropdown header_login ps-2">
                                            <a class="dropdown-toggle text-decoration-none text-light" type="button"
                                               id="dropdownUserLogin"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-user"></i> <?= Yii::$app->user->identity->name ?>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownUserLogin">
                                                <a class="dropdown-item"
                                                   href="<?= Url::toRoute('site/logout?ref
                                           =' . Yii::$app->request->url) ?>"><?= Yii::t('app', 'Log out') ?></a>
                                            </div>
                                        </div>
                                    </li>
                                <?php else : ?>
                                    <li class="site-nav-top">
                                        <div class="vr mx-2"></div>
                                    </li>
                                    <li class="site-nav-top"><a
                                                href="<?= Url::toRoute('site/login?ref=' . Yii::$app->request->url) ?>"
                                                class="text-decoration-none text-light"><span><?= Yii::t('app', 'Login') ?></span></a>
                                    </li>
                                    <li class="site-nav-top">
                                        <div class="vr mx-2"></div>
                                    </li>
                                    <li class="site-nav-top"><a href="<?= Url::toRoute('site/signup') ?>"
                                                                class="text-decoration-none text-light"><span><?= Yii::t('app', 'Signup') ?></span></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <li class="site-nav-top">
                                        <div class="vr mx-2"></div>
                                    </li>
                                    <li class="site-nav-top">
                                        <div class="shopping-cart d-inline pe-0">
                                            <a href="<?= Url::toRoute('cart/') ?>"
                                               class="text-decoration-none text-light">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class='badge bg-light rounded-circle text-danger'
                                                      id='lblCartCount'><?= count(\frontend\models\Cart::getCartByUserId(Yii::$app->user->identity->getId())) ?></span>
                                            </a>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="w-100 p-0 m-0 bottombar-content sticky-top shadow bg-light">
                <nav class="container p-0">
                    <div class="row w-100 m-0 p-0">
                        <div class="col-1 d-flex align-items-center justify-content-center d-md-none">
                            <button class="btn rounded-0 border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="col-10 col-md-12 col-lg-2 p-0 mx-0 d-flex justify-content-center justify-content-xl-start">
                            <a href="<?= Url::home() ?>" class="logo-align">
                                <img src="<?= Url::toRoute('img/logo200.png') ?>" class=" objectfit-cover">
                            </a>
                        </div>
                        <div class="col-1 d-md-none"></div>
                        <div class="col-10 d-none d-lg-flex align-items-center mx-0 px-0">
                            <ul class="list-unstyled w-100 h-100 p-0 m-0 d-flex justify-content-end bar-menu">
                                <li class="bar-item">
                                    <a class="text-dark bar-link text-decoration-none fw-bold"
                                       href="<?= Url::toRoute('shop/') ?>"><?= Yii::t('app', 'Shop') ?></a>
                                </li>
                                <li class="bar-item">
                                    <a class="text-dark bar-link text-decoration-none fw-bold"
                                       href="#"><?= Yii::t('app', 'Introductions') ?></a>
                                </li>
                                <li class="bar-item">
                                    <a class="text-dark bar-link text-decoration-none fw-bold"
                                       href="<?= Url::toRoute('post/') ?>"><?= Yii::t('app', 'News') ?></a>
                                </li>
                                <li class="bar-item">
                                    <a class="text-dark bar-link text-decoration-none fw-bold"
                                       href="#"><?= Yii::t('app', 'Documents') ?></a>
                                </li>
                                <li class="bar-item">
                                    <a class="text-dark bar-link text-decoration-none fw-bold"
                                       href="#"><?= Yii::t('app', 'Support') ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-100 p-0 m-0 d-none d-md-flex d-lg-none">
                        <ul class="list-unstyled w-100 p-0 m-0 d-flex justify-content-center bar-md-menu">
                            <li class="bar-md-item py-3">
                                <a class="text-dark bar-link text-decoration-none fw-bold"
                                   href="#"><?= Yii::t('app', 'New Arrivals') ?></a>
                            </li>
                            <li class="bar-md-item py-3">
                                <a class="text-dark bar-link text-decoration-none fw-bold"
                                   href="#"><?= Yii::t('app', 'Introductions') ?></a>
                            </li>
                            <li class="bar-md-item py-3">
                                <a class="text-dark bar-link text-decoration-none fw-bold"
                                   href="#"><?= Yii::t('app', 'Introductions') ?></a>
                            </li>
                            <li class="bar-md-item py-3">
                                <a class="text-dark bar-link text-decoration-none fw-bold"
                                   href="#"><?= Yii::t('app', 'News') ?></a>
                            </li>
                            <li class="bar-md-item py-3">
                                <a class="text-dark bar-link text-decoration-none fw-bold"
                                   href="#"><?= Yii::t('app', 'Documents') ?></a>
                            </li>
                            <li class="bar-md-item py-3">
                                <a class="text-dark bar-link text-decoration-none fw-bold"
                                   href="#"><?= Yii::t('app', 'Support') ?></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container py-3 py-md-4 py-xxl-5">
                <?= $content ?>
            </div>

            <footer class="footer">
                <div class="footer-content">
                    <div class="ft-bg-overlay"></div>
                    <div class="container inner bg-transparent">
                        <!--TODO: footer -->
                        <!--                <div class="row d-none d-lg-flex m-0 p-0">-->
                        <!--                    -->
                        <!--                </div>-->
                        <div class="row m-0 p-0">
                            <div class="col-sm-12 col-md-6 col-lg-3 pb-3 px-auto">
                                <ul class="footer-nav no-bullets px-2 py-0">
                                    <h3 class="mb-1"><?= Yii::t('app', 'CONTACT INFO') ?></h3>
                                    <li><span class="ft-content"><i
                                                    class="fas fa-home"></i> AAA, BBB street, CCC district, DDD </span>
                                    </li>
                                    <li><span class="ft-content"><i class="fas fa-phone-square"></i> <a
                                                    href="tel:<?= Yii::$app->params['adminTel'] ?>"><?= Yii::$app->params['adminTel'] ?></a></span>
                                    </li>
                                    <li><span class="ft-content"><i class="fas fa-envelope"></i><a
                                                    href="mailto:<?= Yii::$app->params['adminEmail'] ?>"> <?= Yii::$app->params['adminEmail'] ?></a></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 pb-3 px-auto">
                                <ul class="footer-nav no-bullets px-2 py-0">
                                    <h3 class="mb-1"><?= Yii::t('app', 'SIGN UP TO RECEIVE NEWS') ?></h3>
                                    <li class="mb-3"><span
                                                class="ft-content"><?= Yii::t('app', 'Promotion news / Brand news') ?></span>
                                    </li>
                                    <li>
                                        <form action="<?= Url::toRoute('api/ajax/create-contact') ?>" method="POST"
                                              class="d-flex">
                                            <input name="nameNewsLetter" type="hidden" value="newsletter">
                                            <input type="email" class="form-control rounded-0 d-inline w-75 border-0"
                                                   id="exampleInputEmail1" name="emailNewsLetter"
                                                   aria-describedby="emailHelp"
                                                   placeholder="<?= Yii::t('app', 'Enter your email...') ?>">
                                            <?php if (Yii::$app->user->isGuest): ?>
                                                <a href="<?= Url::toRoute('site/login?ref=' . $_SERVER['PHP_SELF']) ?>"
                                                   class="btn btn-dark d-inline align-baseline rounded-0"><i
                                                            class="fas fa-paper-plane"></i></a>
                                            <?php else: ?>
                                                <button type="submit"
                                                        class="btn btn-dark d-inline align-baseline rounded-0"><i
                                                            class="fas fa-paper-plane"></i></button>
                                            <?php endif; ?>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 pb-3 px-auto">
                                <ul class="footer-nav no-bullets px-2 py-0">
                                    <h3 class="mb-1"><?= Yii::t('app', 'CONNECT WITH US') ?></h3>
                                    <li class="mb-3"><span
                                                class="ft-content"><?= Yii::t('app', 'Social networks') ?></span></li>
                                    <li>
                                        <div class="ft-social-network">
                                            <a href="javascript:void(0)" class="mt-1"><i class="fab fa-facebook-f"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3 pb-3 px-auto">
                                <ul class="footer-nav no-bullets px-2 py-0">
                                    <h3 class="mb-1"><?= Yii::t('app', 'CERTIFICATE') ?></h3>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank"><img class="pt-2"
                                                                                          src="//theme.hstatic.net/1000180292/1000232392/14/footer_payment_logo_1.png?v=3509"></a>
                                        <a href="javascript:void(0)" target="_blank"><img class="pt-2"
                                                                                          src="//theme.hstatic.net/1000180292/1000232392/14/footer_payment_logo_2.png?v=3509"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copy-right bg-dark text-center">
                    <span>Copyright &copy; <?= date('Y') ?> by MinhKhanh</span>
                </div>
            </footer>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
