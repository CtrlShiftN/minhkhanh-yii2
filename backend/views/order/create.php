<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = Yii::t('app', 'Add New Order');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'products' => $products,
        'provinces' => $provinces
    ]) ?>

</div>
