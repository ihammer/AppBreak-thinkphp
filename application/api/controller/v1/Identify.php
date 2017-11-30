<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\Alidayu;
use app\common\lib\SmsApi;

Class Identify extends Common {

    public function send_sms(){
        /*$sms = new SmsApi(config('alidayu.keyId'), config('alidayu.secretKey'));
        $response=$sms->sendSms( '武德安','SMS_113461215', '18514533809');
        if($response){
            $info = $sms->checkSmsIdentify('18514533809');
        }
        halt($info);*/
    }

    /**
     * @return \think\response\Json
     * @name 发送短信服务
     * @author wudean
     */
    public function sendSms(){
        //判断提交方式
        if(!request()->isPost()){
            return show(config('code.error'),'您提交的数据不合法',[],403);
        }
        //校验数据
        $validate=validate('Identify');
        if(!$validate->check(input('param.'))){
            return show(config('code.error'),$validate->getError(),[],403);
        }
        $phone=input('param.phone');
        $sms = new SmsApi(config('alidayu.keyId'), config('alidayu.secretKey'));
        $response=$sms->sendSms( '武德安','SMS_113461215',$phone);
        if($response){
            return show(config('code.success'),'Ok~',[],201);
        }else{
            return show(config('code.error'),'Error!',[],403);
        }
    }

}