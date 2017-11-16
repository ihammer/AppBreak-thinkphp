<?php
namespace app\common\lib;

/**
 * aes 加密 解密类库
 * @by singwa
 * Class Aes
 * @package app\common\lib
 */
class Aes {

    static $key="";
    /**
     * Aes constructor.
     * @name 秘钥
     * @author wudean
     */
    public function __construct() {
        self::$key=config('app.aeskey');
    }




    /**
     * [encrypt aes加密]
     * @param    [type]                   $input [要加密的数据]
     * @param    [type]                   $key   [加密key]
     * @return   [type]                   [加密后的数据]
     */
    public static function encrypt($input)
    {
        $data = openssl_encrypt($input, 'AES-128-ECB', self::$key, OPENSSL_RAW_DATA);
        $data = base64_encode($data);
        return $data;
    }
    /**
     * [decrypt aes解密]
     * @param    [type]                   $sStr [要解密的数据]
     * @param    [type]                   $sKey [加密key]
     * @return   [type]                         [解密后的数据]
     */
    public static function decrypt($sStr)
    {
        $decrypted = openssl_decrypt(base64_decode($sStr), 'AES-128-ECB', self::$key, OPENSSL_RAW_DATA);
        return $decrypted;
    }

}