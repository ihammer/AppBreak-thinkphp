<?php
namespace app\api\controller\v1;
use app\api\controller\v1\AuthBase;
use app\common\lib\Aes;

Class Upvote extends AuthBase {

    /**
     * @return \think\response\Json
     * @name 点赞
     * @author wudean
     */
    public function save(){
        //接受数据
        $new_id=input('post.id',0,'intval');
        //检测数据
        if(empty($new_id)){
            return show(config('code.error'),'id不存在',[],404);
        }
        $newinfo=model('News')->get(['id'=>$new_id]);
        if(empty($newinfo)){
            return show(config('code.error'),'数据不存在',[],404);
        }
        $data=[
            'news_id'=>$new_id,
            'user_id'=>$this->user->id,
        ];
        //检测库里是否有点赞信息
        $userNews=model('UserNews')->get($data);
        if($userNews){
            return show(config('code.error'),'已经被点赞过了，不能重复点赞了！',[],401);
        }
        try{
            $userNewId=model('UserNews')->add($data);
            if($userNewId){
                model('News')->where(['id'=>$new_id])->setInc('upvote_count');
                return show(config('code.success'),'Ok~',[]);
            }else{
                return show(config('code.error'),'内部错误，点赞失败！',[],500);
            }
        }catch (\Exception $e){
             return show(config('code.error'),'内部错误，点赞失败！',[],500);
        }

    }

    /**
     * @return \think\response\Json
     * @name 取消点赞
     * @author wudean
     */
    public function delete(){
        //接受数据
        $id=input('post.id',0,'intval');
        //检测数据
        if(empty($id)){
            return show(config('code.error'),'id不存在',[],404);
        }
        $info=model('News')->get(['id'=>$id]);
        if(empty($info)){
            return show(config('code.error'),'数据不存在',[],404);
        }
        $data=[
            'news_id'=>$id,
            'user_id'=>$this->user->id,
        ];
        //检测库里是否有点赞信息
        $userNews=model('UserNews')->get($data);
        if(empty($userNews)){
            return show(config('code.error'),'您还没有点赞，不能取消。',[],401);
        }
        try{
            $userNewsiId=model('UserNews')->where($data)->delete();
            if($userNewsiId){
                model('News')->where(['id'=>$id])->setDec('upvote_count');
                return show(config('code.success'),'取消成功！',[]);
            }else{
                return show(config('code.success'),'取消失败！',[],500);
            }
        }catch (\Exception $exception){
             return show(config('code.error'),'内部错误，取消点赞失败！',[],500);
        }
    }

    /**
     * @return \think\response\Json
     * @name wudean
     */
    public function read(){
        //接受数据
        $new_id=input('post.id',0,'intval');
        //检测数据
        if(empty($new_id)){
            return show(config('code.error'),'id不存在',[],404);
        }
        $newinfo=model('News')->get(['id'=>$new_id]);
        if(empty($newinfo)){
            return show(config('code.error'),'数据不存在',[],404);
        }
        $data=[
            'news_id'=>$new_id,
            'user_id'=>$this->user->id,
        ];
        $userNews=model('UserNews')->get($data);
        if($userNews){
            return show(config('code.success'),'Ok~',['isUpvote'=>1],200);
        }else{
            return show(config('code.success'),'Ok~',['isUpvote'=>0],200);
        }
    }
}