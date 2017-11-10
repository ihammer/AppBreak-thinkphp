<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/31 0031
 * Time: 20:50
 */
namespace app\admin\controller;

class News extends Base
{
    /**
     * @return mixed
     * @name 新闻列表页面
     * @author wudean
     */
    public function index(){
        //获取数据
        $data = input('param.');
        $query=http_build_query($data);
        $whereData=[];
        //转换查询条件
        if(
            !empty($data['start_time'])&&
            !empty($data['end_time'])&&
            $data['end_time']>$data['start_time']
        ){
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        //分类
        if(!empty($data['catid'])) {
            $whereData['catid'] = intval($data['catid']);
        }
        //标题
        if(!empty($data['title'])) {
            $whereData['title'] = ['like', '%'.$data['title'].'%'];
        }
        //方法1
        //$news=model('News')->getNews();
        //方法2
        //获取分页和展示数量
        $this->getPageAndSize($data);
        //获取表里面的数据
        $news=model('News')->getNewsByCondition($whereData,$this->from,$this->size);
        //统计数量
        $total=model('News')->getNewsCountByCondition($whereData);
        //总页数
        $pageTotal=ceil($total/$this->size);
        return $this->fetch('',[
            'cats' => config('cat.lists'),//分类列表
            'news'=>$news,//新闻列表
            'pageTotal'=>$pageTotal,//分页数量
            'curr' => $this->page,//当前页面
            'start_time'=>!empty($data['start_time'])?$data['start_time']:"",//筛选开始时间
            'end_time'=>!empty($data['end_time'])?$data['end_time']:"",//筛选结束时间
            'title'=>!empty($data['title'])?$data['title']:"",//标题
            'catid'=>!empty($data['catid'])?$data['catid']:"",//分类id
            'query'=>$query//筛选值

        ]);
    }
    /**
     * @return mixed | void
     * @name  新闻添加
     * @author wudean
     */
    public function add(){
        if(request()->isPost()){
            //收集数据
            $data=input('post.');
            //验证数据

            //存储数据
            try{
                $id=model('News')->add($data);
            }catch (\Exception $exception){
                return $this->result('',0,'新增失败！');
            }
            if($id){
                return $this->result(['jump_url' => url('news/index')],1,'ok');
            }else{
                return $this->result('',0,'新增失败！');
            }

        }else{
            return $this->fetch('',['cats'=>config('cat.lists')]);
        }
    }
}
