<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use app\api\controller\Common;
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

}