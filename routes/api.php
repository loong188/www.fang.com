<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('login',function (){
//    $username=request()->header('username');
//    $password=request()->header('password');
//    $timestamp=request()->header('timestamp');
//    $signate=request()->header('sign');
//    $userData=['username'=>$username,'password'=>$password];
//
//    $bool=auth()->guard('api')->attempt($userData);
//    if(!$bool){
//        throw new \App\Exceptions\LoginException('登录失败',1);
//    }
//    $token=auth()->guard('api')->user()->token;
////    dump($token);exit;
//    //签名算法 username+token+时间+password+md5
//    $sign=$username.$token.$timestamp.$password;
//    $sign =md5($sign);
////    dump($sign);exit;
//    if($sign !== $signate){
//        return ['status'=>2,'msg'=>'登录异常'];
//        throw new \App\Exceptions\LoginException('登录异常',2);
//    }
//    return ['status'=>0,'msg'=>'登陆成功'];
//});
//路由
Route::group(['prefix'=>'v1','namespace'=>'Api','middleware'=>['checkapi']],function(){
    //登录路由
    Route::post('wxlogin','WxloginController@login');
    //授权路由
    Route::post('userinfo','WxloginController@userinfo');
    //图片上传
    Route::post('upfile','RentingController@upfile');
    //删除图片
    Route::get('deletepic','RentingController@deletepic');
    //修改个人信息路由
    Route::put('editrenting','RentingController@editrenting');
    //根据用户ID查询用户信息
    Route::get('renting','RentingController@show');
    //看房通知
    Route::get('notices','NoticeController@index');
    //数据采集
    Route::get('sipder','NoticeController@sipder');
    //记录用户浏览用户
    Route::post('articles/history', 'ArticleController@history');
    //文章详情
    Route::get('articles/{article}', 'ArticleController@show');
    //资讯列表
    Route::get('articles', 'ArticleController@index');
    //房源推荐
    Route::get('fang/recommend', 'FangController@recommend');
    //租房小组
    Route::get('fang/group', 'FangController@group');
    //房源列表
    Route::get('fang/fanglist', 'FangController@fanglist');
    //房源详情
    Route::get('fang/detail', 'FangController@detail');
    //收藏记录
    Route::get('fang/fav', 'FavController@fav');
    //是否收藏
    Route::get('fang/isfav', 'FavController@isfav');
    //收藏列表
    Route::get('fang/list', 'FavController@list');
    //房源属性
    Route::get('fang/attr', 'FangController@attr');
    //房源搜索
    Route::get('fang/search', 'FangController@search');
});
