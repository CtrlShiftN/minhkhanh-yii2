<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */

$this->title = Yii::t('app', 'Create Document');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'arrType' => $arrType
    ]) ?>

</div>
