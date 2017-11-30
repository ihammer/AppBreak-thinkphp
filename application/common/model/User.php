<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 18:55
 */
namespace app\common\model;
class User extends Base {
    /*protected $table="admin_users";*/

    /**
     * @param array $UsersId
     * @return false|\PDOStatement|string|\think\Collection
     * @name 获取用户
     * @author wudean
     */
    public function getUsersUserId($UsersId=[]){
        $data = [
            'id' => ['in', implode(',', $UsersId)],// in
            'status' => 1,
        ];

        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
            ->field(['id', 'username', 'image'])
            ->order($order)
            ->select();
    }
}