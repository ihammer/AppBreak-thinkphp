<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use app\api\controller\v1\AuthBase;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;

Class Comment extends AuthBase {

    /**
     * @return \think\response\Json
     * @name 评论 -回复功能开发
     * @author wudean
     */
    public function save(){
        $data=input('post.',[]);
        $data['user_id']=$this->user->id;
        try{
            $comment_id=model('Comment')->add($data);
            if($comment_id){
                model('News')->where(['id'=>$this->user->id])->setInc('comment_count');
                return show(config('code.success'),'Ok~',[],202);
            }else{
                return show(config('code.error'),'评论失败',[],500);
            }
        }catch (\Exception $e){
            return show(config('code.error'),'内部错误',[],500);
        }
    }

    /**
     * @return \think\response\Json
     * @throws ApiException
     * @name 评论列表
     */
    public function read(){
        $newsId=input('param.id',0,'intval');
        if(empty($newsId)){
            throw new ApiException('Id is not ' , 404);
        }

        //获取数量
        $param['news_id']=$newsId;
        $count=model('comment')->getCountByCondition($param);
        $this->getPageAndSize($param);
        $comments=model('Comment')->getListsByCondition($param,$this->from,$this->size);
        if($comments) {
            foreach($comments as $comment) {
                $userIds[] = $comment['user_id'];
                if($comment['to_user_id']) {
                    $userIds[] = $comment['to_user_id'];
                }
            }
            $userIds = array_unique($userIds);
        }
        $userIds=model('User')->getUsersUserId($userIds);
        if(empty($userIds)){
            $userIdNames=[];
        }else{
            foreach ($userIds as $userId){
                $userIdNames[$userId->id] = $userId;
            }
        }
        $resultData=[];
        foreach ($comments as $comment){
            $resultData[]=[
                'id'=>$comment->id,
                'user_id'=>$comment->user_id,
                'to_user_id'=>$comment->to_user_id,
                'content'=>$comment->content,
                'username' => !empty($userIdNames[$comment->user_id]) ? $userIdNames[$comment->user_id]->username : '',
                'tousername' => !empty($userIdNames[$comment->to_user_id]) ? $userIdNames[$comment->to_user_id]->username : '',
                'parent_id'=>$comment->parent_id,
                'create_time'=>$comment->create_time,
                'image'=> !empty($userIdNames[$comment->user_id]) ? $userIdNames[$comment->user_id]->image : '',
            ];
        }
        $result=[
            'total'=>$count,
            'page_num'=>ceil($count/$this->size),
            'list'=>$resultData
        ];
        return show(config('code.success'),'Ok~',$result);
    }

}