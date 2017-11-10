<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * @param $obj
 * @return string
 * @name 分页
 */
function pagination($obj){
    if(!$obj){
        return '';
    }
    $params = request()->param();
    return '<div class="imooc-app">'.$obj->appends($params)->render().'</div>';
}
/**
 * @param $catId
 * @return string
 * @name 获取分类名称
 */
function getCatName($catId){
    if(!$catId){
        return '';
    }
    $cats = config('cat.lists');
    return !empty($cats[$catId])?$cats[$catId]:'';
}

/**
 * @param $str
 * @return string
 * @name 推荐状态
 */
function isYesNo($str){
    return $str ? '<span style="color:green"> 是</span>' : '<span > 否</span>';
}

/**
 * @param $id
 * @param $status
 * @return string
 * @name 商品状态
 */
function status($id, $status) {
    $controller = request()->controller();

    $sta = $status == 1 ? 0 : 1;
    $url = url($controller.'/status', ['id' => $id, 'status' => $sta]);

    if($status == 1) {
        $str = "<a href='javascript:;' title='修改状态' status_url='".$url."' onclick='app_status(this)'><span class='label label-success radius'>正常</span></a>";
    }elseif($status == 0) {
        $str = "<a href='javascript:;' title='修改状态' status_url='".$url."' onclick='app_status(this)'><span class='label label-danger radius'>待审</span></a>";
    }

    return $str;
}

/**
 * @param $status 业务状态码
 * @param $message 信息提示
 * @param array $data 数据
 * @param int $httpCode http 状态吗
 * @return \think\response\Json
 * @name 通用化数据API接口输出
 * @author wudean
 */
function show($status ,$message , $data=[], $httpCode=200){
    $data=[
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    ];
    return json($data,$httpCode);
}
