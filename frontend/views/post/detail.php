<?php

/* @var $this yii\web\View */

/* @var $model \common\models\Post */

use frontend\models\Post;
use frontend\models\PostCategory;
use yii\helpers\Url;

$imgUrl = Yii::$app->params['common'] . "/media";
$this->title = $postDetail['title'];
$imgUrl = Yii::$app->params['common'] . "/media";
$this->registerCss('.post-content{text-align: justify}');
$this->registerCss('.post-content img{text-align: center}');
$this->registerCss('.related-post-list{list-style-type: "» "}');
$latestPosts = Post::getLatestPosts();
$postCategory = PostCategory::getAllPostCategory();
$this->registerCssFile(Url::toRoute('css/post.css'));
?>
<div class="posts row mt-4 w-100 px-0 mx-0">
    <div class="col-12 col-lg-8 col-xl-9 px-1 px-md-3 m-0">
        <h3><?= $postDetail['title'] ?></h3>
        <span><?= Yii::t('app', 'Created at ') . date_format(date_create($postDetail['created_at']), 'H:i:s d-m-Y') ?></span>
        <div class="text-center py-2">
            <img src="<?= $imgUrl . '/' . $postDetail['avatar'] ?>" width="80%">
        </div>
        <div class="post-content px-2">
            <?= $postDetail['content'] ?>
        </div>
        <div class="post-tags pb-3">
            <?php foreach (\frontend\models\PostTag::getPostTag(explode(',', $postDetail['tag_id'])) as $tag) : ?>
                <a class="tag"
                   href="<?= Url::toRoute(['post/index', 'post_tag' => \common\components\encrypt\CryptHelper::encryptString($tag['id'])]) ?>">
                    <?= Yii::t('app', $tag['title']) ?></a>
            <?php endforeach; ?>
        </div>
        <div class="same-cate-post pb-3">
            <h4 class="text-uppercase"><?= Yii::t('app', 'Related news') ?></h4>
            <ul class="related-post-list">
                <?php foreach (\frontend\models\Post::getAllRelatedPostByCateID($postDetail['post_category_id']) as $post) : ?>
                    <li class="pb-1"><a class="related-post-link text-decoration-none"
                                        href="<?= Url::toRoute(['post/detail', 'id' => \common\components\encrypt\CryptHelper::encryptString($post['id'])]) ?>">
                            <?= Yii::t('app', $post['title']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-12 col-lg-4 col-xl-3 ps-3 m-0">
        <div class="w-100 mt-3 fs-4"><h2
                    class="latest-news__title text-uppercase"><?= Yii::t('app', 'Post Categories') ?></h2>
        </div>
        <div class="post-category__right-side">
            <?php foreach ($postCategory as $category) : ?>
                <a
                   href="<?= Url::toRoute(['post/index', 'post_category' => \common\components\encrypt\CryptHelper::encryptString($category['id'])]) ?>"><span
                            class="badge border text-dark font-weight-bold p-2 m-1"><?= Yii::t('app', $category['title']) ?></span></a>
            <?php endforeach; ?>
        </div>
        <div class="w-100 mt-5 fs-4"><h2
                    class="latest-news__title text-uppercase"><?= Yii::t('app', 'Latest posts') ?></h2>
        </div>
        <div class="latest-news__right-side mb-3">
            <?php foreach ($latestPosts as $value) : ?>
                <div class="row d-flex align-items-center w-100 px-0 mx-0">
                    <div class="col-3 col-lg-5">
                        <a href="<?= Url::toRoute(['post/detail', 'id' => \common\components\encrypt\CryptHelper::encryptString($value['id'])]) ?>"><img
                                    class="latest-news__image"
                                    src="<?= $imgUrl . '/' . $value['avatar'] ?>"
                                    alt="<?= $value['slug'] ?>"></a>
                    </div>
                    <div class="col-9 col-lg-7">
                        <a href="<?= Url::toRoute(['post/detail', 'id' => \common\components\encrypt\CryptHelper::encryptString($value['id'])]) ?>">
                            <p class="pb-0 mb-0"><?= $value['title'] ?></p></a>
                        <span class="latest-post__date"><?= date_format(date_create($value['created_at']), 'H:i:s d/m/Y') ?></span>
                    </div>
                </div>
                <hr class="latest-post__hr">
            <?php endforeach; ?>
        </div>
    </div>
</div>
