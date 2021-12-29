<?php

use kartik\depdrop\DepDrop;
use kartik\form\ActiveField;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm */
$arrLogisticMethod = [Yii::t('app', 'Home delivery'), Yii::t('app', 'Get at the store')];
?>

<div class="order-form container p-3">
    <h3 class="text-uppercase pb-4"><?= Yii::t('app', 'Add New Order') ?></h3>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-12 col-md-3">
            <?= $form->field($model, 'user_id', ['hintType' => ActiveField::HINT_SPECIAL])->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map($users, 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose a customer')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(Yii::t('app', 'Customer'))->hint('Tài khoản của khách hàng đã có sẵn trên hệ thống, hoặc, một nhân viên nào đó của shop có thể đặt hàng giúp người thân, bạn bè, đối tác,...'); ?>
        </div>
        <div class="col-12 col-md-3">
            <?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', 'Họ và tên')]) ?>
        </div>
        <div class="col-12 col-md-6">
            <?= $form->field($model, 'tel')->textInput(['placeholder' => Yii::t('app', '0397 742 xxx')]) ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('app', 'deobelly@gmail.com')]) ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map($products, 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose a product')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'placeholder' => Yii::t('app', 'Enter a number, ex: 300')]) ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'logistic_method')->dropDownList($arrLogisticMethod, ['prompt' => Yii::t('app', 'Choose logistic method')]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'province_id')->dropDownList($provinces, ['id' => 'province-id', 'prompt' => Yii::t('app', '- Choose province/city -')]) ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'district-id'],
                'pluginOptions' => [
                    'depends' => ['province-id'],
                    'placeholder' => Yii::t('app', '- Choose district -'),
                    'url' => Url::to(['/order/get-district'])
                ]
            ]); ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'village_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'village-id'],
                'pluginOptions' => [
                    'depends' => ['district-id'],
                    'placeholder' => Yii::t('app', '- Choose village/ward -'),
                    'url' => Url::to(['/order/get-village'])
                ]
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'specific_address')->textInput(['placeholder' => Yii::t('app', 'No 19, 29 alley, 460 lane, XXX street')]) ?>

    <?= $form->field($model, 'notes')->widget(\yii\redactor\widgets\Redactor::class) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Add New Order'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
