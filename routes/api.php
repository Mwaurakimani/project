<?php

use App\Models\User;
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

Route::resource('user', \App\Http\Controllers\UsersController::class);

require_once 'ServiceApi/service.php';

Route::get("routepath", function () {

    return array(

        "Title" => "dummy title",
        "Real_Data" => "This is the real data"


    );


});

Route::post('/authenticateUser', function (Request $request) {
    $email = $request['email'];
    $password = $request['password'];

    if(\Illuminate\Support\Facades\Auth::attempt(array(
        'email' => $email,
        'password' => $password
    ))){
        return array(
            'status' => User::where('email',$request['email'])->get()->first()
        );
    }else{
        return response('Hello World', 200)
            ->header('Content-Type', 'text/plain');
    }

});

Route::get('/getarrears/{id}', function (Request $request, $id) {
    $rent = \App\Models\rent::where('user_id',$id)->first();

    $arrears = [];

    if($rent){
        $rentArrears = \App\Models\RentArrear::where('rent_id',$rent->id)->get();

        if($rentArrears){
            $rentArrears->map(function ($item , $key){
                $arrears = \App\Models\Arrears::where('id',$item->id)->first();
                $item['arrear'] = $arrears;

                return $item;
            });
        }

        foreach ($rentArrears as $key => $value){
            array_push($arrears,$value->arrear);
        }
    }

    dd($arrears);

});

Route::get('getArrearsByID/{id}', function (Request $request, $id) {
    $arrears = \App\Models\Arrears::where('id',$id)->get();
    dd($arrears);
});

Route::get('listServices/{id}', function (Request $request, $id) {
    
});
