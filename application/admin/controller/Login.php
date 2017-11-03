<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 20:50
 */
namespace app\admin\controller;

use app\common\lib\IAuth;
use think\Controller;
class Login extends Controller
{
    /**
     * @return mixed
     * @name  页面
     * @author wudean
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * @name 后台登录
     * @author wudean
     */
    public function check(){
        if(request()->isPost()){
            //接收数据
            $data=input("post.");
            //验证验证码是否正确
            if(!captcha_check($data['code'])){
                $this->error("验证码错误!!!");
            }
            //验证数据
            $validate=validate("AdminUser");
            if($validate->check($data)==false){
                $this->error($validate->getError());
            }
            //获取用户信息
            try{
                $user=model("AdminUsers")->get(['username'=>$data['username']]);
            }catch (\Exception $exception){
                $this->error($exception->getMessage());
            }
            //判断用户是否存在
            if(!$user||$user->status!=config('code.status_normal')){
                $this->error('该用户不存在!!!');
            }
            //进行密码检验
            if(IAuth::setPassword($data['password'])!=$user['password']){
                $this->error('密码不正确！！！');
            }
            //处理数据
            $updata['last_login_time']=time();
            $updata['last_login_ip']=request()->ip();
            //更新数据
            try{
                model('AdminUsers')->save($updata,['id' => $user['id']]);
            }catch (\Exception $exception){
                $this->error($exception->getMessage());
            }

            //设置session
            session(config('admin.session_user'),$user,config('admin.session_user_scope'));
            $this->success('登录成功！！！','index/index');

        }else{
            $this->error("请求不合法！！！");
        }
    }

}
