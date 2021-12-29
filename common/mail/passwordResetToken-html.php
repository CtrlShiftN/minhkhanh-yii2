<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p><b>MinhKhanh</b> xin kính chào <?= Html::encode($user->name) ?>,</p>

    <p>Chúng tôi xin gửi đến bạn đường dẫn thay đổi mật khẩu.</p>

    <p>Nhấp vào link dưới đây để thay đổi mật khẩu của bạn:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    <table style="width: 100%" width="100%">
        <tr>
            <td style="width: 20%">
                <a href="<?= Yii::$app->params['frontend'] ?>">
                    <img src="<?= Url::toRoute('img/logo200.png') ?>"
                         alt="<?= Yii::$app->params['senderName'] ?>" style="width: 100%">
                </a>
            </td>
            <td style="width: 80%">
                <h4><?= Yii::$app->params['senderName'] ?></h4>
                <p>Hotline: <a style="text-decoration: none; color: #0b2e13"
                               href="tel:<?= Yii::$app->params['adminTel'] ?>"><?= Yii::$app->params['adminTel'] ?></a></p>
                <p>Email: <a style="text-decoration: none;color: #0b2e13"
                             href="mailto:<?= Yii::$app->params['supportEmail'] ?>"><?= Yii::$app->params['supportEmail'] ?></a></p>
                <p>Fanpage: <a style="text-decoration: none" href="https://www.facebook.com">MinhKhanh</a></p>
                <p><?= Yii::$app->params['companyAddress'] ?></p>
            </td>
        </tr>
    </table>
</div>
