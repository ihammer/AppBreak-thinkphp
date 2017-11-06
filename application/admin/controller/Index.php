<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 20:50
 */
namespace app\admin\controller;

class Index extends Base
{
    /**
     * @return mixed
     * @name 后台首页
     * @author wudean
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * @return string
     * @name 欢迎页面
     * @author wudean
     */
    public function welcome(){
        return 'App 强大的后台！';
    }

}
