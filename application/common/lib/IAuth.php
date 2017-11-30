<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 21:43
 */
 namespace app\common\lib;

 use think\Cache;

 class IAuth{
     /**
      * @param $data
      * @return string
      * @name 设置密码
      * @author wudean
      */
    public static function setPassword($data){
        return md5($data.config('app.password_pre_halt'));
    }

     /**
      * @param array $data
      * @return string
      * @name 生词每次请求的sign
      * @author wudean
      */
    public static function setSign($data=array()){

        //1、字段排序
         ksort($data);
        //2、拼接字符串
        $string=http_build_query($data);
        //3、通过ase加密
         $sign=Aes::encrypt($string);
        return $sign;

    }

     /**
      * @param $header
      * @return bool
      * @name 验证Sign
      * @author wudean
      */
    public static function checkSignPass($header){
        $sign=Aes::decrypt($header['sign']);
        if(empty($sign)){
            return false;
        }
        //将字符串解析到变量中
        parse_str($sign,$signArr);
        //验证did
        if(!is_array($signArr)||empty($signArr['did'])||$signArr['did']!=$header['did']){
            return false;
        }
        //判断de_bug是否开启
        if(!config('app_debug')){
            //判断时效
            if((time()-ceil($signArr['time']/1000))>config('app.app_sign_time')){
                return false;
            }
            //唯一性判断
            if(Cache::get($signArr['sign'])){
                return false;
            }
        }
        return true;
    }

     /**
      * @return string
      * @name 获取13位时间戳
      * @author wudean
      */
    public static function get13TimeTamp(){
        list($t1,$t2)=explode(' ',microtime());
        return $t2.ceil($t1 * 1000);
    }

     /**
      * @param string $phone
      * @return string
      * @name 设置登录的唯一性的token
      */
     public static function setAppLoginToken($phone=""){
         $token=md5(uniqid(md5(microtime(true)),true));
         $token=sha1($token.$phone);
         return $token;
     }
 }