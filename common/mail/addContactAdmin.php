<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="password-reset">
    Kính chào quý khách,<br/>

    <p>Bạn có một liên hệ mới! Hãy kiểm tra ngay.</p>

    <p>Đường dẫn tới quản lý liên hệ <a href="<?= Yii::$app->params['backend'] . '/contact/' ?>">tại đây</a></p>

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
