<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">
    <div class="container px-3 pt-3">
        <h3 class="text-uppercase"><?= Yii::t('app', 'Add New Post') ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'postTag' => $postTag,
        'postCate' => $postCate
    ]) ?>

</div>
