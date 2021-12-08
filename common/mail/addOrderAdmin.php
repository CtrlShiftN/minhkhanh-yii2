<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
$siteContact = \common\models\SiteContact::find()->where(['status' => \common\components\SystemConstant::STATUS_ACTIVE])->asArray()->one();
?>
<div class="password-reset">
    Kính chào quý khách,<br/>
    Một đơn hàng mới vừa được tạo bởi người dùng: <b><?= Yii::$app->user->identity->username ?></b><br/>
    Mã vận đơn: <?= array_values($orderModel)[0]['BL_code'] ?>.<br/>
    Đơn hàng bao gồm:<br/><br/>
    <table cellpadding="0" cellspacing="0" width="100%" border="1px solid #C0C0C0">
        <tr>
            <th style="text-align: center">Mã SKU</th>
            <th style="text-align: center;width:120px;height:auto">Ảnh</th>
            <th style="text-align: center">Tên sản phẩm</th>
            <th style="text-align: center">Màu sắc</th>
            <th style="text-align: center">Kích cỡ</th>
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
            <td style="text-align: center"><?= \common\models\Color::findOne($order['color_id'])['name'] ?></td>
            <td style="text-align: center"><?= \common\models\Size::findOne($order['size_id'])['name'] ?></td>
            <td style="text-align: center"><?= $order['quantity'] ?></td>
            <td style="text-align: center"><?= $order['quantity'] * $order['product_price'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br/>
    Kiểm tra ngay: <a href="<?= Yii::$app->params['backend'] . "/order/" ?>">Go to Order manager.</a><br/>
    <p style="padding-bottom: 15px">Xin chân thành cám ơn!</p>
    <table style="width: 100%" width="100%">
        <tr>
            <td style="width: 20%">
                <a href="<?= Yii::$app->params['frontend'] ?>">
                    <img src="<?= Yii::$app->params['common'] . '/media/' . $siteContact['logo_link'] ?>"
                         alt="<?= Yii::$app->params['senderName'] ?>" style="width: 100%">
                </a>
            </td>
            <td style="width: 80%">
                <h4><?= Yii::$app->params['senderName'] ?></h4>
                <p>Hotline: <a style="text-decoration: none; color: #0b2e13"
                               href="tel:<?= $siteContact['tel'] ?>"><?= $siteContact['tel'] ?></a></p>
                <p>Email: <a style="text-decoration: none;color: #0b2e13"
                             href="mailto:<?= $siteContact['email'] ?>"><?= $siteContact['email'] ?></a></p>
                <p>Fanpage: <a style="text-decoration: none" href="https://www.facebook.com/deobellyvietnam">De Obelly</a></p>
                <p><?= $siteContact['company_address'] ?></p>
            </td>
        </tr>
    </table>
</div>
