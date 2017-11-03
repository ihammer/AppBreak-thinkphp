<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 21:43
 */
 namespace app\common\lib;

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
 }