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
Route::get('api/:ver/news','api/:ver.news/index');
Route::get('api/:ver/news_read','api/:ver.news/read');
//文章详情页面接口