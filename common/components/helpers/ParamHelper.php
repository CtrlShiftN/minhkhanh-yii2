<?php

namespace common\components\helpers;

use Yii;

class ParamHelper
{
    /**
     * Get a param value from any request
     * @param $paramName
     * @return array|mixed|null
     */
    public static function getParamValue($paramName)
    {
        $paramValue = Yii::$app->request->post($paramName);
        // if param exists in POST, return
        if (isset($paramValue)) {
            return $paramValue;
        } else {
            $paramValue = Yii::$app->request->get($paramName);
            // param exists in GET, return
            if (isset($paramValue)) {
                return $paramValue;
            }
        }
        // param not exist in both POST and GET, return null
        return null;
    }
}