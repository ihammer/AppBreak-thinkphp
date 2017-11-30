<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use app\common\lib\Alidayu;
use app\common\lib\IAuth;
use think\Cache;
use think\Controller;
use app\common\lib\SmsApi;

Class Test extends Controller {

    public function send_sms(){
        /*$sms = new SmsApi(config('alidayu.keyId'), config('alidayu.secretKey'));
        $response=$sms->sendSms( '武德安','SMS_113461215', '18514533809');
        if($response){
            $info = $sms->checkSmsIdentify('18514533809');
        }*/
        halt('Wudean');
    }
    public function test(){
        $data=[
            'time_out'=>strtotime("+".config('app.login_time_out_day')." days")
        ];
        $token=IAuth::setAppLoginToken();
        dump($token);
    }

}