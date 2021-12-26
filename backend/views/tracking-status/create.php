<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderTracking */

$this->title = Yii::t('app', 'Create Order Tracking');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Trackings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-tracking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
