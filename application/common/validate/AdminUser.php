<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 18:38
 */
namespace app\common\validate;

use think\Validate;
class AdminUser extends Validate{
    protected $rule=[
        'username'=>"require|max:20|min:4",
        'password'=>'require|max:18|min:5'
    ];
}