<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 18:55
 */
namespace app\common\model;
class Version extends Base {
    /*protected $table="admin_users";*/

    /**
     * @param $app_type
     * @name 获取最新的一个版本
     * @return  object
     * @author wudean
     */
    public function getLastNormalVersionByAppType($app_type){
        $where = [
            'status' => 1 ,
            'app_type' => $app_type
        ];
        $order = [ 'id' => 'desc' ];
        $result=$this->where($where)
            ->order($order)
            ->limit(1)
            ->find();
        return $result;
    }

}