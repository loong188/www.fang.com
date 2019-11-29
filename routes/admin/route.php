<?php
//后台路由
//

Route::group(['namespace'=> 'Admin','prefix'=> 'admin','as'=> 'admin.'],function(){
    Route::get('login','LoginController@index')->name('login');
    Route::post('login','LoginController@login')->name('login');
    Route::get('esinitindex','EsController@initIndex')->name('initIndex');


    Route::group(['middleware' => ['checkadmin:id=1&name=aaa']],function(){

        Route::put('edit/{id}','IndexController@update')->name('update');
        Route::get('index','IndexController@index')->name('index');
        Route::get('welcome','IndexController@welcome')->name('welcome');
        Route::get('logout','IndexController@logout')->name('logout');
        Route::post('base/upfile','BaseController@upfile')->name('base.upfile');

        Route::get('edit','IndexController@edit')->name('edit');
        Route::get('user/index','AdminController@index')->name('user.index');
        Route::get('user/create','AdminController@create')->name('user.create');
        Route::post('user/create','AdminController@store')->name('user.store');
        Route::get('user/edit/{id}','AdminController@edit')->name('user.edit');
        Route::put('user/edit/{id}','AdminController@update')->name('user.update');
        Route::delete('user/destroy/{id}','AdminController@destroy')->name('user.destroy');
        Route::delete('user/delall}','AdminController@delall')->name('user.delall');
        Route::get('user/restore}','AdminController@restore')->name('user.restore');
        Route::resource('role','RoleController');
        Route::resource('node','NodeController');
        Route::post('article/upfile','ArticleController@upfile')->name('article.upfile');
        Route::get('article/delfile','ArticleController@delfile')->name('article.delfile');
        Route::resource('article','ArticleController');
        Route::resource('fangattr','FangAttrController');
        Route::get('fangowner/export','FangOwnerController@export')->name('fangowner.export');
        Route::resource('fangowner','FangOwnerController');
        Route::get('fang/city','FangController@getCity')->name('fang.city');
        Route::resource('fang','FangController');
        //预约管理
        Route::resource('notice','NoticeController');
        //租客列表
//        Route::get('renting/index','RentingController');
        Route::resource('renting','RentingController');
        Route::resource('apiuser','ApiuserController');

    });
});