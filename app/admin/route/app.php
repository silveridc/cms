<?php
use think\facade\Route;

Route::group('v1/', function () {
    Route::group('form', function () {
        // 提交列表
        Route::get('list', 'FormController/getList');
        // 提交详情
        Route::get('detail/:id', 'FormController/getDetail');
        // 删除提交
        Route::delete('delete/:id', 'FormController/delete');
    });
});
