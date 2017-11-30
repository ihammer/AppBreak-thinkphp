<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 21:45
 */
return [
    'password_pre_halt'=>'_#sing_ty',//加密盐
    'aeskey'=>'1R0NPqe7ANZk8vVNCxGquOMw3Rqx7jeEENjYYNOVliU=',//aes 密钥 , 服务端和客户端必须保持一致 123456
    'apptypes'=>[
        'ios',
         'android',
    ],
    'app_sign_time'=>10,//sign 失效时间
    'app_sign_cache_time'=>200000000,//sign 缓存失效时间
    'login_time_out_day'=>7//登录失效时间

];