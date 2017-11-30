<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 18:38
 */
namespace app\common\validate;

use think\Validate;
class Identify extends Validate{
    protected $rule = [
        'phone' => 'require|number|length:11',
    ];
}