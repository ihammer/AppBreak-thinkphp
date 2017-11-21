<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use think\Controller;

Class News extends Common {

    //栏目展示及搜索接口
    public function index(){
        //获取所有数据
        $data=input('get.');
        //筛选条件
        //状态
        $wheredata['status']=config('code.status_normal');
        //分类
        if(!empty($data['catid'])){
            $wheredata['catid']=input('get.catid', 0, 'intval');
        }
        //标题（模糊）
        if(!empty($datap['title'])){
            $wheredata['catid']=['like', '%'.trim($data['title']).'%'];
        }
        $this->getPageAndSize($data);
        $total = model('News')->getNewsCountByCondition($wheredata);//总数量
        $news = model('News')->getNewsByCondition($wheredata,$this->from,$this->size);//分页数据
        $result = [
            'total' => $total,
            'page_num' => ceil($total / $this->size),
            'list' => $this->getDealNews($news),
        ];
        return show(config('code.success'), 'OK', $result, 200);
    }
    //详情页面
    public function read(){
        $id = input('param.id', 0, 'intval');
        if(empty($id)){
            throw new ApiException('id is not ', 404);
        }
        $news=model('news')->get($id);
        if(empty($new)&&$news->status!=config('code.status_normal')){
            throw new ApiException('不存在词条新闻', 404);
        }
        try{
            model('news')->where(['id'=>$id])->setInc('read_count');
        }catch (\Exception $e){
            throw new ApiException('error' , 404);
        }
        $cats = config('cat.lists');
        $news->catname = $cats[$news->catid];
        return show(config('code.success'), 'OK', $news, 200);
    }

}