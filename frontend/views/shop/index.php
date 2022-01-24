<?php

/* @var $this yii\web\View */

use common\components\SystemConstant;
use frontend\models\ProductType;
use common\components\encrypt\CryptHelper;
use common\components\helpers\ParamHelper;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Product');
$this->params['breadcrumbs'][] = $this->title;
$cdnUrl = Yii::$app->params['frontend'];
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCssFile(Url::toRoute('css/product.css'));
$paramCate = ParamHelper::getParamValue('type');
$this->registerJsFile(Url::toRoute('js/product.js'));
$keyword = ParamHelper::getParamValue('keyWord');
$this->registerCss('
    #btn-search {
        z-index: 1;
        right: 0;
        outline: none;
        border: none;
        background-color: transparent;
        padding: 7px 15px;
    }

    #key-word {
        z-index: 0;
        padding: 7px 15px;
        border: unset;
        border-bottom: 1px solid rgba(0, 0, 0, 0.89);
        border-radius: unset;
        transition: 0.5s;
        outline: none;
    }

    #key-word:focus {
        box-shadow: none;
        border: 1px solid rgba(0, 0, 0, 0.89);
        border-radius: 20px;
    }

    @media (max-width: 992px) {
        .w-search {
            width: 100% !important;
        }
    }

    @media (min-width: 992px) {
        .w-search {
            width: 60% !important;
        }
    }
');
?>
<div class="visually-hidden" id="sth" data-id="<?= Yii::$app->user->isGuest ? 1 : 0 ?>"></div>
<div class="row d-flex align-items-center justify-content-center px-3">
    <div class="w-search position-relative p-0">
        <button type="button" class="position-absolute" id="btn-search"><i class="fas fa-search"></i></button>
        <input type="text" id="key-word" placeholder="Nhập từ khóa tìm kiếm" class="w-100 position-relative">
    </div>
</div>
<div class="row p-0 d-none" id="notify-search">
    <div class="w-100 align-items-center justify-content-center d-flex">
        <span class="fs-5 text-center">Kết quả tìm kiếm cho: <i id="content-search"></i> <button class="p-0 text-dark fs-6 m-0 btn bg-transparent" id="remove-keyword"><i class="fas fa-times-circle"></i></button></span>
    </div>
</div>
<div class="row m-0 p-0 pt-4 w-100">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCategory"
         aria-labelledby="offcanvasCategoryLabel">
        <div class="offcanvas-header border-bottom border-dark">
            <h5 class="offcanvas-title text-uppercase" id="offcanvasCategoryLabel"><?= Yii::t('app', 'Type') ?></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close" id="sm-offcanvas-close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="accordion accordion-flush ct-show" id="type_category_offcanvas">
                <?php foreach ($productType as $key => $value): ?>
                    <?php $idEncrypted = \common\components\encrypt\CryptHelper::encryptString($value['id']) ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="offcanvas-flush-heading-<?= $idEncrypted ?>">
                            <button class="accordion-button collapsed text-uppercase fw-light btn-title-category"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-type="<?= $idEncrypted ?>"
                                    data-type-name="<?= $value['name'] ?>"
                                    data-bs-target="#offcanvas-flush-collapse-<?= $idEncrypted ?>"
                                    aria-expanded="false"
                                    aria-controls="offcanvas-flush-collapse-<?= $idEncrypted ?>">
                                <?= Yii::t('app', $value['name']) ?>
                            </button>
                        </h2>
                        <div id="offcanvas-flush-collapse-<?= $idEncrypted ?>"
                             class="accordion-collapse collapse ps-4 ps-md-5"
                             aria-labelledby="offcanvas-flush-heading-<?= $idEncrypted ?>"
                             data-bs-parent="#type_category_offcanvas">
                            <?php foreach (\frontend\models\ProductCategory::getCategoryByTypeId($value['id']) as $key => $cate): ?>
                                <label class="category-checkbox"><?= $cate['name'] ?>
                                    <input type="checkbox"
                                           value="<?= $cate['id'] ?>">
                                    <span class="checkmark"></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="w-100 d-md-none m-0 p-0 text-center position-relative h-tool border-dark border-bottom" id="toolbar-mb">
        <button class="btn bg-transparent border-0 rounded-0 float-start text-uppercase p-0 py-auto m-0 fs-6 fw-bold btn-offcanvas"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCategory"
                aria-controls="offcanvasCategory">
            <?= Yii::t('app', 'Type') ?> <i class="fas fa-caret-down"></i>
        </button>
        <?php if (!empty($paramCate)): ?>
            <span class="fw-bold text-uppercase fs-6"
                  id="offcanvas-category-name"><?= ProductType::getTypeNameById(CryptHelper::decryptString($paramCate)) ?></span>
        <?php else: ?>
            <span class="fw-bold text-uppercase fs-6" id="offcanvas-category-name"
                  data-value="<?= Yii::t('app', 'Product') ?>"><?= Yii::t('app', 'Product') ?></span>
        <?php endif; ?>
        <div class="dropdown float-end offcanvas-dropdown">
            <button class="btn bg-transparent border-0 rounded-0 p-0 dropdown-toggle fs-6 fw-bold" type="button"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-sliders-h"></i> <?= Yii::t('app', 'Filter') ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <button class="dropdown-item btn border-0 rounded-0 sortByDate"><?= Yii::t('app', 'NEWEST') ?></button>
                </li>
                <li>
                    <button class="dropdown-item btn border-0 rounded-0 highToLow"><?= Yii::t('app', 'PRICE (HIGH-LOW)') ?></button>
                </li>
                <li>
                    <button class="dropdown-item btn border-0 rounded-0 lowToHigh"><?= Yii::t('app', 'PRICE (LOW-HIGH)') ?></button>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-12 col-md-3 col-xl-2 m-0 p-0 d-md-block d-none">
        <div class="w-100 px-3 py-2 m-0 border-bottom border-dark">
            <span class="fw-bold fs-5 p-0 text-uppercase"><?= Yii::t('app', 'Type') ?></span>
        </div>
        <div class="accordion accordion-flush w-100 pb-5" id="type_category">
            <?php foreach ($productType as $key => $value): ?>
                <?php $idEncrypted = \common\components\encrypt\CryptHelper::encryptString($value['id']) ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading-<?= $idEncrypted ?>">
                        <button class="accordion-button collapsed text-uppercase fw-light btn-title-category"
                                type="button"
                                data-bs-toggle="collapse"
                                data-type="<?= $idEncrypted ?>"
                                data-type-name="<?= $value['name'] ?>"
                                data-bs-target="#flush-collapse-<?= $idEncrypted ?>"
                                aria-expanded="false" aria-controls="flush-collapse-<?= $idEncrypted ?>">
                            <?= Yii::t('app', $value['name']) ?>
                        </button>
                    </h2>
                    <div id="flush-collapse-<?= $idEncrypted ?>"
                         class="accordion-collapse collapse ps-4 ps-md-5"
                         aria-labelledby="flush-heading-<?= $idEncrypted ?>" data-bs-parent="#type_category">
                        <?php foreach (\frontend\models\ProductCategory::getCategoryByTypeId($value['id']) as $key => $cate): ?>
                            <label class="category-checkbox mt-2"><?= $cate['name'] ?>
                                <input type="checkbox"
                                       value="<?= $cate['id'] ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-12 col-md-9 col-xl-10 m-0 p-0">
        <div class="px-3 w-100 d-md-block d-none" style="height:47px">
            <div class="w-100 py-2 border-bottom border-dark mb-2">
                <?php if (!empty($paramCate)): ?>
                    <span class="fw-bold text-uppercase fs-5"
                          id="category-name"><?= ProductType::getTypeNameById(CryptHelper::decryptString($paramCate)) ?></span>
                <?php else: ?>
                    <span class="fw-bold text-uppercase fs-5" id="category-name"
                          data-value="<?= Yii::t('app', 'Product') ?>"><?= Yii::t('app', 'Product') ?></span>
                <?php endif; ?>
                <div class="dropdown float-end">
                    <button class="btn bg-transparent border-0 rounded-0 p-0 dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-sliders-h"></i> <?= Yii::t('app', 'Filter') ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <button class="dropdown-item btn border-0 rounded-0 sortByDate"><?= Yii::t('app', 'NEWEST') ?></button>
                        </li>
                        <li>
                            <button class="dropdown-item btn border-0 rounded-0 highToLow"><?= Yii::t('app', 'PRICE (HIGH-LOW)') ?></button>
                        </li>
                        <li>
                            <button class="dropdown-item btn border-0 rounded-0 lowToHigh"><?= Yii::t('app', 'PRICE (LOW-HIGH)') ?></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <input type='hidden' id='current_page' class="w-100">
        <div id="result" class="w-100 row m-0 p-0 my-3 px-3">

            <div id="root"></div>

        </div>
        <div class="mt-2 text-center w-100" id="pagination">
            <input type='hidden' id='current_page'>
            <div id='page_navigation' class="text-end"></div>
        </div>
    </div>
</div>
<div id="toastBoard" class="position-fixed bg-success rounded">
    <div id="liveToast" class="toast py-3 px-2 text-light bg-success border-2 fw-bold" role="alert"
         aria-live="assertive" aria-atomic="true">
        <span id="toastNotify"></span>
    </div>
</div>