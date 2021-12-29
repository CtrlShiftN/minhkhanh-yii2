<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Social */

$this->title = Yii::t('app', 'Create Social');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
