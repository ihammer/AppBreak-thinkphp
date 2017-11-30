<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;
use app\common\model\User;

/**
 * Class AuthBase
 * @package app\api\controller\v1
 * @name 登录权限基础库
 */
Class AuthBase extends Common {
    /**
     * @name 用户的基本信息
     */
    public $user=[];

    /**
     * @throws ApiException
     * @name 初始化项目
     */
   public function _initialize()
   {
        parent::_initialize();
        if(empty($this->isLogin())){
            throw new ApiException('您还没有登录',400);
        }
   }

    /**
     * @return bool
     * @name 检测用户是否登录
     * @author wudean
     */
   public function isLogin(){
        if(empty($this->headers['access-user-token'])){

            return false;
        }
        //解密Aes加密token
        $accessUserToken=Aes::decrypt($this->headers['access-user-token']);
        if(empty($accessUserToken)){
            return false;
        }
        //匹配
        if(!preg_match('/||/',$accessUserToken)){
            return false;
        }
        //切分数组
        list($token,$id)=explode("||",$accessUserToken);
        $user=User::get(['token'=>$token]);
        if(!$user && $user->status !=1){
            return false;
        }
        //判断是否过期
       if($user->time_out<time()){
            return false;
       }
       $this->user=$user;
       return true;

   }
}