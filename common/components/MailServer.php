<?php

namespace common\components;

use Yii;

class MailServer
{
    /**
     * @param $title
     * @param $htmlContent
     * @param null $orderModel
     * @return bool
     */
    public static function sendMailOrderInformAdmin($title, $orderModel = null)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'addOrderAdmin'],
                ['orderModel' => $orderModel]
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject($title)
            ->send();
    }

    public static function sendMailContactAdmin($title)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'addContactAdmin']
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject($title)
            ->send();
    }

    /**
     * @param $title
     * @param $htmlContent
     * @param $receiver
     * @param null $orderModel
     * @return bool
     */
    public static function sendMailOrderInformCustomer($title, $receiver, $orderModel = null)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'addOrderClient'],
                ['orderModel' => $orderModel]
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
            ->setTo($receiver)
            ->setSubject($title)
            ->send();
    }
}