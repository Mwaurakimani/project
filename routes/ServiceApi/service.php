<?php

use Illuminate\Support\Facades\Route;

Route::get('receives/service',function(){
    return "Connection established...";
});

Route::get('generateArrears',function(){
    (new \App\Http\Controllers\SystemController())->generate_arrears();
});

//this is it
