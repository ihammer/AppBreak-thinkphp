<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6 0006
 * Time: 18:12
 */
namespace app\admin\controller;

use think\Controller;

class Base extends Controller{

    /**
     * @name 初始化
     * @author wudean
     */
    public function _initialize()
    {
        $islogin=$this->IsLogin();
        if(!$islogin){
            return $this->redirect('login/index');
        }
    }

    /**
     * @return bool
     * @name 判断是否登录
     * @author wudean
     */
    public function IsLogin(){
        //获取用户信息
        $user=session(config('admin.session_user'),'',config('admin.session_user_scope'));
        if($user && $user->id){
            return true;
        }
        return false;
    }
}