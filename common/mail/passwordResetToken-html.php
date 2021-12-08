<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$siteContact = \common\models\SiteContact::find()->where(['status' => \common\components\SystemConstant::STATUS_ACTIVE])->asArray()->one();
?>
<div class="password-reset">
    <p>De-Obelly xin kính chào <?= Html::encode($user->name) ?>,</p>

    <p>Chúng tôi xin gửi đến bạn đường dẫn thay đổi mật khẩu.</p>

    <p>Nhấp vào link dưới đây để thay đổi mật khẩu của bạn:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

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
