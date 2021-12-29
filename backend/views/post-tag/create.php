<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PostTag */

$this->title = Yii::t('app', 'Create Post Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-tag-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
