<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductCategory */

$this->title = Yii::t('app', 'Create Product Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-create">

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types
    ]) ?>

</div>
