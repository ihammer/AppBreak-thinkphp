<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller;


Class Test extends Common {

    public function index(){
       /*$id=1;
       if($id!=2){
            throw new ApiException('数据错误！！！',404,5);
       }*/
        $this->TestFun();
       halt('哎呦到这里了吧！');

    }



    public function update(){
        return input('put');
    }
}