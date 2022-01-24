<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */

$this->title = Yii::t('app', 'Update Document');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="document-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'arrType' => $arrType
    ]) ?>

</div>
