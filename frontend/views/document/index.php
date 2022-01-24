<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Document');
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCss('
.btn-type-docs {
    border: 2px solid #d00f0f;
    padding: 5px 7px;
    margin: 2px;
    color: #d00f0f;
    border-radius: 5px;
    background-color: #fff;
    transition: 0.3s;
}

.btn-type-docs:hover {
    border-radius: 5px;
    background-color: #d00f0f;
    color: #fff;
}

.items-download img {
    object-fit: contain;
}

.file-name {
    font-size: 18px !important;
    line-height: 1.45rem;
    font-weight: 500;
    display: block;
    display: -webkit-box;
    margin: 0 !important;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    height: 47px !important;
}

.file-img {
    height: 18vh;
}
#document-wrap {
    min-height: 70vh;
}
');
?>
<div class="container w-100 m-0 p-0" id="document-wrap">
    <div class="row px-0 pb-3 mb-3 align-items-center justify-content-center border-bottom border-danger m-0">
        <div class="text-center">
            <span class="fw-bold fs-6">Thể loại:</span>
            <a href="<?= \yii\helpers\Url::toRoute('document/') ?>" class="btn p-2 btn-type-docs">Tất cả</a>
            <?php foreach ($arrType as $key => $value): ?>
                <a href="<?= \yii\helpers\Url::toRoute('document/index?type=' . \common\components\encrypt\CryptHelper::encryptString($key)) ?>"
                   class="btn p-2 btn-type-docs"><?= Yii::t('app', $value) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row p-0 m-0">
        <?php foreach ($document as $value): ?>
            <div class="col-6 col-md-4 col-xl-4 col-xxl-3 mb-2 px-2 h-100 d-inline">
                <a href="<?= \yii\helpers\Url::toRoute($value['link']) ?>" download
                   class="text-decoration-none text-dark w-100">
                    <div class="card w-100 items-download h-100">
                        <img src="<?= $imgUrl . '/' . $value['image'] ?>" class="w-100 file-img">
                        <div class="card-body">
                            <p class="mb-2 file-name"><?= $value['title'] ?></p>
                            <span><?= $value['updated_at'] ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
