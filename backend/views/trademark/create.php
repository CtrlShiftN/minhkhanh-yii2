<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Trademark */

$this->title = Yii::t('app', 'Add New Trademark');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trademarks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trademark-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
