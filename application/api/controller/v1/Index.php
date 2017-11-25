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

Class Index extends Common {

    /**
     * @return \think\response\Json
     * @name 首页接口
     * @author wudean
     */
    public function Index(){
        //头图
        $headers=model('News')->getIndexHeaderNormalNews();
        $headers=$this->getDealNews($headers);
        //推荐列表
        $positions=model('News')->getPositionNormalNews();
        $positions=$this->getDealNews($positions);
        $result=[
            'headers'=>$headers,
            'positions'=>$positions,
        ];

        return show(config('code.success'),'ok',$result,200);
    }

    /**
     * @return \think\response\Json
     * @throws ApiException
     * @name 客户端初始化接口
     * 1、检测APP是否需要升级
     * @author wudean
     */
    public function Init(){
        //获取最新版本信息
        $version = model('Version')->getLastNormalVersionByAppType($this->headers('app_type'));
        if(empty($version)){
            throw new ApiException('error' , 404);
        }

        if($version->version > $this->headers['version']){
            $version->is_update = $version->is_force==1 ? 2 : 1 ;
        }else{
            $version -> is_update = 0 ; // 0 不更新 ， 1 需要更新 ， 2 强制更新
        }

        //记录用户数据 用于统计
        $actives = [
            'version'=>$this->headers('version'),
            'app_type'=>$this->headers('app_type'),
            'version_code'=>$this->headers('version_code'),
            'did'=>$this->headers('did')
        ];
        try{
            model('active')->add($actives);
        }catch (\Exception $e){
            // log write
        }
        return show(config('code.success'), 'OK', $version, 200);
    }

}