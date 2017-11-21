<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 18:55
 */
namespace app\common\model;
class News extends Base {
    /*protected $table="admin_users";*/

    /**
     * @param array $data
     * @return array
     * @name 获取新闻列表 方法1
     * @author wudean
     */
    public function getNews($data=array()){
        $data['status']=['neq',config('code.status_delete')];
        $order=['id'=>'desc'];
        $result=$this->where($data)->order($order)->paginate();
        //echo $this->getLastSql();//打印最后的执行的Sql
        return $result;
    }

    /**
     * @param $condition
     * @param $from
     * @param $size
     * @return false|\PDOStatement|string|\think\Collection
     * @name 获取新闻列表数据 方法2
     * @author wudean
     */
    public function getNewsByCondition($condition,$from,$size){
        //筛选状态
        if(!isset($condition['status'])){
            $condition['status']=['neq',config('code.status_delete')];
        }
        //排序条件
        $order=['id'=>'desc'];
        $result=$this->where($condition)
            ->limit($from,$size)
            ->order($order)
            ->select();
        return $result;
    }

    /**
     * @param $condition
     * @return int|string
     * @name 获取总数量
     * @author wudean
     */
    public function getNewsCountByCondition($condition){
        //筛选状态
        if(!isset($condition['status'])){
            $condition['status']=['neq',config('code.status_delete')];
        }
        return $this->where($condition)->count();
    }

    /**
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     * @name 首页头部推荐接口
     * @author wudean
     */
    public function getIndexHeaderNormalNews($num=4){
        $data = [
            'status' => 1,
            'is_head_figure' => 1,
        ];

        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();
    }

    /**
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     * @name 获取推荐数据
     * @author wudean
     */
    public function getPositionNormalNews($num=20){
        $data = [
            'status' => 1,
        ];

        $order = [
            'is_position' => 'desc',
            'id' => 'desc',
        ];
        return $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();
    }

     public function _getListField(){
         return [
             'id',
             'catid',
             'image',
             'title',
             'read_count',
             'status',
             'is_position',
             'update_time',
             'create_time'
         ];
     }
}