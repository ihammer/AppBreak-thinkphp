<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2 0002
 * Time: 18:55
 */
namespace app\common\model;
use think\Db;

class Comment extends Base {

    /**
     * @param array $param
     * @return int|string
     * @name  获取数量
     */
    public function getCountByCondition($param=[]){
         $count=Db::table('app_comment')
             ->alias(['app_comment'=>'co','app_user'=>'us'])
             ->join('app_user','co.user_id=us.id AND co.user_id = '.$param['news_id'])
             ->count();
         return $count;
    }

    /**
     * @param array $param
     * @param int $from
     * @param int $size
     * @return false|\PDOStatement|string|\think\Collection
     * @name 获取数据
     */
    public function getListsByCondition($param=[],$from=0,$size=0){
        return $this->where($param)
            ->field('*')
            ->limit($from,$size)
            ->order(['id'=>'desc'])
            ->select();
    }

}