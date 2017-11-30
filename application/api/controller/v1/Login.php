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
use app\common\lib\IAuth;
use app\common\lib\SmsApi;
use app\common\model\User;

Class Login extends Common {

    /**
     * @return \think\response\Json
     * @name 手机验证码或者密码登录
     * @author wudean
     */
    public function save(){
        //判断登录方式
        if(!request()->isPost()){
            return show(config('code.error'),'您提交的数据不合法！',[],403);
        }
        $input=input('param.');
        if(empty($input['phone'])){
            return show(config('code.error'),'手机号不合法！',[],403);
        }
        if(empty($input['code'])&&empty($input['password'])){
            return show(config('code.error'),'手机验证码或者密码不合法！',[],403);
        }
        //校验验证
        if(!empty($input['code'])){
            $sms = new SmsApi(config('alidayu.keyId'), config('alidayu.secretKey'));
            $code=$sms->checkSmsIdentify($input['phone']);
            if($code!=$input['code']){
                return show(config('code.error'),'手机验证码不合法！',[],403);
            }
        }
        //记录token和登录时间
        $token=IAuth::setAppLoginToken($input['phone']);
        $data=[
            'token'=>$token,
            'time_out'=>strtotime("+".config('app.login_time_out_day')." days")
        ];
        //检查这个手机号是否存在
        $user=User::get(['phone'=>$input['phone']]);
        if($user&&$user->status==1){
            if(!empty($input['password'])){
                //用户名密码可以加密传输过来
                if(IAuth::setPassword($input['password'])!=$user->password){
                    return show(config('code.error'),'密码错误！',[],403);
                }
            }
            $id = model('User')->save($data,['phone'=>$input['phone']]);
        }else{
            if(!empty($input['code'])){
                //第一登录需要注册数据
                $data['username']='iunan_'.$input['phone'];
                $data['phone']=$input['phone'];
                $data['status']=1;
                $id=model('User')->add($data);
            }else{
                return show(config('code.error'),'用户不存在！',[],403);
            }
        }
        if($id){
            $result=[
                'token'=>Aes::encrypt($token."||".$id)
            ];
            return show(config('code.success'),'Ok~',$result,200);
        }else{
            return show(config('code.error'),'登录失败',[],403);
        }
    }

}