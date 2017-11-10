<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use think\Controller;

Class Test extends Controller{

    public function index(){
       $id=1;
       if($id!=2){
            throw new ApiException('数据错误！！！',404,5);
       }

    }


    public function update(){
        return input('put');
    }
}