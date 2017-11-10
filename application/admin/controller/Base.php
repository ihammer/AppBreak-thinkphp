<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6 0006
 * Time: 18:12
 */
namespace app\admin\controller;

use think\Controller;

class Base extends Controller{

    /**
     * page
     * @var string
     */
    public $page = '';

    /**
     * 每页显示多少条
     * @var string
     */
    public $size = '';
    /**
     * 查询条件的起始值
     * @var int
     */
    public $from = 0;

    /**
     * 定义model
     * @var string
     */
    public $model = '';

    /**
     * @name 初始化
     * @author wudean
     */
    public function _initialize()
    {
        $islogin=$this->IsLogin();
        if(!$islogin){
            return $this->redirect('login/index');
        }
    }

    /**
     * @return bool
     * @name 判断是否登录
     * @author wudean
     */
    public function IsLogin(){
        //获取用户信息
        $user=session(config('admin.session_user'),'',config('admin.session_user_scope'));
        if($user && $user->id){
            return true;
        }
        return false;
    }

    /**
     * @param $data
     * @name 获取分页内容
     * @author wudean
     */
    public function getPageAndSize($data){
        $this->page=!empty($data['page'])?$data['page']:1;
        $this->size=!empty($data['size'])?$data['page']:config('paginate.list_rows');
        $this->from=($this->page-1)*$this->size;
    }

    /**
     * @param int $id
     * @name 统一的删除操作
     */
    public function delete($id=0){
        if(!intval($id)){
            return $this->result('',0,'ID不合法');
        }
        //获取model名称
        $model=$this->model?$this->model:request()->controller();
        try{
            $res=model($model)->save(['status'=>-1],['id'=>$id]);
        }catch (\Exception $exception){
            return $this->result('',0,$exception->getMessage());
        }
        if($res){
            return $this->result(['jump_url'=>$_SERVER['HTTP_REFERER']],1,'Ok!');
        }
        return $this->redirect('',0,'删除失败！');
    }
    /**
     * 通用化修改状态
     */
    public function status() {
        $data  = input('param.');
        // tp5  validate 机制 校验  小伙伴自行完成 id status

        // 通过id 去库中查询下记录是否存在
        //model('News')->get($data['id']);

        $model = $this->model ? $this->model : request()->controller();

        try {
            $res = model($model)->save(['status' => $data['status']], ['id' => $data['id']]);
        }catch(\Exception $e) {
            return $this->result('', 0, $e->getMessage());
        }

        if($res) {
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'OK');
        }
        return $this->result('', 0, '修改失败');
    }

}