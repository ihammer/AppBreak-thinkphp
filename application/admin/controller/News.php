<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 20:50
 */
namespace app\admin\controller;

class News extends Base
{
    public function add(){
        return $this->fetch();
    }
}
