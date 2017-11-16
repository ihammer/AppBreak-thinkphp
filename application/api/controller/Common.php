<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15 0015
 * Time: 17:16
 * Name: 公共方法
 * Author: wudean
 */
namespace app\api\controller;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use think\Cache;
use think\Controller;
use app\common\lib\Aes;
class Common extends Controller{

    /**
     * headers信息
     * @var string
     */
    public $headers = '';

    /**
     * @name 初始化方法
     * @author wudean
     */
    public function _initialize()
    {
        //获取header
        $headers=request()->header();

        //基础参数校验
        //验证sign是否为空
        /*if(empty($headers['sign'])){
              throw new ApiException('Sign不存在！',400);
        }*/
        //判断客户端
        /*if(!in_array($headers['app_type'],config('app.apptypes'))){
            throw new ApiException('apptype不合法',400);
        }*/
        //验证sign是否正常
        if(!IAuth::checkSignPass($headers)){
            throw new ApiException('授权码sign失败！',400);
        }
        Cache::set($headers['sign'],1,config('app.app_sign_cache_time'));
        $this->headers=$headers;
    }
    public function TestFun(){
         $data=[
            'did'=>'123456789',
            'version'=>1,
             'time'=>time()
         ];
        $str='7DP0LJmfibjZgpmyxsHEQ67BHLfDAOgHdqnvWtmxls4J86wGDsmyIZYkoPk0HuZs';
        //echo IAuth::setSign($data);exit;
        echo Aes::decrypt($str);
    }
}