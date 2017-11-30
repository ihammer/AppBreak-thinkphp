<?php
use think\Route;

/**
 * @name 接口
 * @author wudean
 */
Route::get('test/fun','api/Test/TestFun');
Route::get('test','api/test/index');
Route::put('test/:id', 'api/test/update');// 修改
Route::delete('test/:id','api/test/delete');


Route::get('api/:ver/cat','api/:ver.cat/read');//栏目分类接口
Route::get('api/:ver/index','api/:ver.index/index');//首页接口
Route::get('api/:ver/init', 'api/:ver.index/init');//初始化
Route::get('api/:ver/news','api/:ver.news/index');
Route::get('api/:ver/news_read','api/:ver.news/read');//文章详情页面接口

/**发送短信相关**/
Route::post('api/:ver/send_sms','api/:ver.Identify/sendSms');

/**登录（手机验证码登录或者密码登录）**/
Route::post('api/:ver/login','api/:ver.login/save');
/**用户相关**/
Route::get('api/:ver/user_read','api/:ver.user/read');
Route::post('api/:ver/user_update','api/:ver.user/update');
/**图片上传**/
Route::post('api/:ver/image','api/:ver.image/save');
/**点赞相关**/
Route::post('api/:ver/upvote','api/:ver.upvote/save');
Route::post('api/:ver/upvote_delete','api/:ver.upvote/delete');
Route::get('api/:ver/upvote/:id','api/:ver.upvote/rend');
/**评论相关**/
Route::post('api/:ver/comment','api/:ver.comment/save');
Route::get('api/:ver/comment/:id','api/:ver.comment/read');
/**
 * @name 测试模块
 * @author wudean
 */
Route::get('api/:ver/test','api/:ver.Test/test');