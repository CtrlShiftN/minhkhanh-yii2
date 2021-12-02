<?php

namespace common\components\encrypt;

class CryptHelper
{
    protected static $encryptKey = '#minhkhanh2021';
    protected static $encryptMethod = 'aes-256-cbc';
    protected static $iv = 'minhkhanhcam2021';

    /**
     * CryptHelper constructor.
     */
    public function __construct()
    {
        $this->transactionId = $this->createTransactionId();
    }

    /**
     * @return int
     */
    private function createTransactionId()
    {
        // A string of 12 numbers
        return mt_rand(pow(10, 15), pow(10, 16) - 1);
    }

    /**
     * @param $string
     * @return string
     */
    public static function encryptString($string)
    {
        $encryptStr = (openssl_encrypt($string, self::$encryptMethod, self::$encryptKey, 0, self::$iv));
        return base64_encode($encryptStr);
    }

    /**
     * @param $string
     * @return false|string
     */
    public static function decryptString($string)
    {

        $string = base64_decode($string);
        return openssl_decrypt(($string), self::$encryptMethod, self::$encryptKey, 0, self::$iv);
    }

    /**
     * @param $array
     * @return array
     */
    public static function decryptAllElementInArray($array)
    {
        $decryptedArray = [];
        foreach ($array as $key => $value) {
            $decryptedArray[$key] = self::decryptString($value);
        }
        return $decryptedArray;
    }
}