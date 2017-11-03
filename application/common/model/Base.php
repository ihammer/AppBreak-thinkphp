<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 18:58
 */
namespace app\common\model;
use think\Model;

class Base extends Model {

    protected  $autoWriteTimestamp = true;

    /**
     * 新增
     * @param $data
     * @return mixed
     */
    public function add($data) {
        if(!is_array($data)) {
            exception('传递数据不合法');
        }
        $this->allowField(true)->save($data);

        return $this->id;
    }

}