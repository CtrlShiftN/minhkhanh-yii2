<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Terms */

$this->title = Yii::t('app', 'Add Terms And Services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Terms And Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terms-and-services-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
