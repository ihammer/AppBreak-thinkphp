<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use app\api\controller\v1\AuthBase;
use app\common\lib\Aes;

Class User extends AuthBase {

    /**
     * @return \think\response\Json
     * @name 获取用户的基本信息
     */
    public function read(){
      return show(config('code.success'),'Ok~',Aes::encrypt($this->user));
    }

    public function update(){
        $postData  =  input('param.');
        // validate 进行校验 大家 自行完成
        $data = [];

        if(!empty($postData['image'])) {
            $data['image'] = $postData['image'];
        }
        if(!empty($postData['username'])) {
            $data['username'] = $postData['username'];
        }
        if(!empty($postData['sex'])) {
            $data['sex'] = $postData['sex'];
        }
        if(!empty($postData['signature'])) {
            $data['signature'] = $postData['signature'];
        }
        if(!empty($postData['password'])) {
            // 传输过程当中也是需要加密
            $data['password'] = IAuth::setPassword($postData['password']);
        }
        if(empty($data)) {
            return show(config('code.error'), '数据不合法', [], 404);
        }

        try {
            $id = model('User')->save($data, ['id' => $this->user->id]);
            if($id) {
                return show(config('code.success'), 'OK', [], 202);
            }else {
                return show(config('code.error'), '更新失败', [], 401);
            }
        }catch (\Exception $e) {
            return show(config('code.error'), $e->getMessage(), [], 500);
        }
    }

}