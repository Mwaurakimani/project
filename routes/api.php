<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/test",function (){
    $user = new \App\Logic\Classes\User();
    $model_user = \App\Models\User::find(1);

    $user_data = [
        'first_name'=>'other_name',
        'last_name'=>'other_name',
        'email'=>'other_name',
        'designation'=>'other_name',
        'department_id'=>'other_name',
        'account_type'=>'other_name'
    ];

    dd($user->update($model_user,$user_data));
});