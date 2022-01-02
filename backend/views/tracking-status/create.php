<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrackingStatus */

$this->title = Yii::t('app', 'Add New Status');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracking-status-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
