<?php
//后台路由
Route::group(['namespace'=> 'Admin','prefix'=> 'admin','as'=> 'admin.'],function(){
    Route::get('login','LoginController@index')->name('login');
    Route::post('login','LoginController@login')->name('login');



    Route::group(['middleware' => ['checkadmin:id=1&name=aaa']],function(){
        Route::get('edit','IndexController@edit')->name('edit');
        Route::put('edit/{id}','IndexController@update')->name('update');
        Route::get('index','IndexController@index')->name('index');
        Route::get('welcome','IndexController@welcome')->name('welcome');
        Route::get('logout','IndexController@logout')->name('logout');
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
    });
});