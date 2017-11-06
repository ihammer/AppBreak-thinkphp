<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 20:50
 */
namespace app\admin\controller;

class Admin extends Base
{

    public function Add(){
        if(request()->isPost()){
            //获取提交数据
            $data=input('post.');
            //验证提交数据

            $validate = validate('AdminUser');
            if($validate->check($data)==false) {
                $this->error($validate->getError());
            }
            //处理提交数据
            $data['password']=md5($data['password'].'_#sing_ty');
            $data['status']=1;
            try{
                $id=model("AdminUsers")->add($data);
            }catch(\Exception $exception){
                $this->error($exception->getMessage());
            }
            if($id){
                $this->success('添加成功');
            }else{
                $this->error('请找技术！');
            }
            //返回处理数据
        }else{
            return $this->fetch();
        }
    }

}
