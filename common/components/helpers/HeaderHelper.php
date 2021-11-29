<?php


namespace common\components\helpers;

use Yii;

class HeaderHelper
{
    /**
     * Allow only these origins to access the controller
     */
    public static function getHeaderAccessControlAllowOrigin()
    {
        // uncomment this to allow all
//        header("Access-Control-Allow-Origin: *");
//        header("Access-Control-Allow-Header: *");

        $httpOrigin = isset($_SERVER['HTTP_HOST']) ? 'https://' . $_SERVER['HTTP_HOST'] : null;
        if (in_array($httpOrigin, [
                Yii::$app->params['backend'], // Admin
                Yii::$app->params['frontend'], // Client
                Yii::$app->params['common'], // System
            ]
        )) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Header: *');
        }
    }
}