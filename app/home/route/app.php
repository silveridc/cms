<?php
use think\facade\Route;

Route::group('v1/',function (){
    Route::get('form/data','ApiController/getFormData');
    Route::post('form/submit','ApiController/submitData');
});