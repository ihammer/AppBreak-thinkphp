<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 17:52
 */
namespace app\api\controller\v1;
use think\Controller;

Class Cat extends Controller {

    /**
     * @return \think\response\Json
     * @name 栏目
     * @author wudean
     */
    public function read(){
        $cats=config('cat.lists');
        $result[]=[
          'cat_id'=>0,
           'cat_name'=>'首页'
        ];
        foreach ($cats as $cat_id => $cat_name){
            $result[]=[
              'catid'=>$cat_id,
              'catname'=>$cat_name
            ];
        }
        return show(config('code.success'),'ok!',$result,200);
    }

}