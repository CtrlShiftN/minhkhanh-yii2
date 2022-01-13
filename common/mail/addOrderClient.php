<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>
<div class="password-reset">
    Kính chào quý khách,<br/>
    <b>MinhKhanh</b> đã nhận được đơn đặt hàng của Quý khách vào <?= date('H:i d-m-Y') ?>.<br/>
    Mã vận đơn của quý khách: <?= array_values($orderModel)[0]['BL_code'] ?>.<br/>
    Đơn hàng của bạn gồm có:<br/><br/>
    <table cellpadding="0" cellspacing="0" width="100%" border="1px solid #C0C0C0">
        <tr>
            <th style="text-align: center">Mã SKU</th>
            <th style="text-align: center;width:120px;height:auto">Ảnh</th>
            <th style="text-align: center">Tên sản phẩm</th>
            <th style="text-align: center">Số lượng</th>
            <th style="text-align: center">Đơn giá</th>
        </tr>
        <?php foreach (array_values($orderModel) as $key => $order): ?>
            <?php if ($key % 2 == 0): ?>
                <tr style="background-color: #dddddd">
            <?php else: ?>
                <tr>
            <?php endif; ?>
            <td style="padding-left: 10px"><?= $order['SKU'] ?></td>
            <td style="padding: 10px;width:120px;">
                <a href="<?= Yii::$app->params['frontend'] . "/shop/product-detail?detail=" . \common\components\encrypt\CryptHelper::encryptString($order['product_id']) ?>">
                    <img src="<?= Yii::$app->params['common'] . '/media/' . $order['product_image'] ?>"
                         alt="<?= \common\models\Product::findOne($order['product_id'])['name'] ?>" style="width: 100%">
                </a></td>
            <td style="padding-left: 10px"><?= \common\models\Product::findOne($order['product_id'])['name'] ?></td>
            <td style="text-align: center"><?= $order['quantity'] ?></td>
            <td style="text-align: center"><?= number_format($order['quantity'] * $order['product_price'], 0, ',', '.') ?>
                đ
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br/>
    <b>*Lưu ý:</b> Chi phí trên chưa bao gồm phí ship, VAT,...
    <p><b>MinhKhanh</b> mong sớm nhận được đơn hàng tiếp theo từ Quý khách,</p>
    <p style="padding-bottom: 15px">Xin chân thành cám ơn!</p>
    <table style="width: 100%">
        <tr>
            <td style="width: 20%">
                <a href="<?= Yii::$app->params['frontend'] ?>">
                    <img src="<?= Yii::$app->params['frontend'] . '/img/logo200.png' ?>"
                         alt="<?= Yii::$app->params['senderName'] ?>" style="width: 100%">
                </a>
            </td>
            <td style="width: 80%">
                <h4><?= Yii::$app->params['senderName'] ?></h4>
                <p>Hotline: <a style="text-decoration: none; color: #0b2e13"
                               href="tel:<?= Yii::$app->params['adminTel'] ?>"><?= Yii::$app->params['adminTel'] ?></a></p>
                <p>Email: <a style="text-decoration: none;color: #0b2e13"
                             href="mailto:<?= Yii::$app->params['supportEmail'] ?>"><?= Yii::$app->params['supportEmail'] ?></a></p>
                <!--                <p>Fanpage: <a style="text-decoration: none" href="https://www.facebook.com">MinhKhanh</a></p>-->
                <p><?= Yii::$app->params['companyAddress'] ?></p>
            </td>
        </tr>
    </table>
</div>
