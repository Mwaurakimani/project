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
        return User::where('email',$request['email'])->get()->first();
    }else{
        return response('1', 200)
            ->header('Content-Type', 'text/plain');
    }

});

Route::post('/getArrearsByID', function (Request $request) {
    $id = $request['user_id'];

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

    return($arrears);

});

Route::get('/getSingleArrearsByID', function (Request $request) {
    $id = $request['arrears_id'];

    $arrears = \App\Models\Arrears::where('id',$id)->get();
    return($arrears);
});

Route::post('/listServices', function (Request $request) {
    $id = $request['user_id'];

    $services = \App\Models\Service::all();

    foreach ($services as $key => $value){
        $services_id = $value->id;

        $subscription = \App\Models\Subscription::where('service_id', $services_id)
            ->where('user_id',$id)
            ->where('subscription_end_date',null)
            ->get();

        if(count($subscription) > 0){
            $value['active'] = true;
        }else{
            $value['active'] = false;
        }

        $services[$key] = $value;
    }

    return $services;
});

Route::get('/viewService/{id}', function (Request $request, $id) {
    $services = \App\Models\Service::all();

    foreach ($services as $key => $value){
        $services_id = $value->id;

        $subscription = \App\Models\Subscription::where('service_id', $services_id)
            ->where('user_id',$id)
            ->where('subscription_end_date',null)
            ->get();

        if(count($subscription) > 0){
            $value['active'] = true;
        }else{
            $value['active'] = false;
        }

        $services[$key] = $value;
    }

    return $services;
});

Route::post('/userAccountDetails/home', function (Request $request) {
    $user = User::where('id',$request['user_id'])->first();

    $date  = strtotime($user->created_at);
    $user->date_created = date("d M Y",$date);


    $rent_details = \App\Models\rent::where('user_id',$user->id)->where('end_date',null)->first();
    $house = null;
    $subscriptions = \App\Models\Subscription::where('user_id',$user->id)
        ->where('subscription_end_date',null)->get();

    $subscriptions = $subscriptions->map(function ($item , $index){
        $item->servce = \App\Models\Service::where('id',$item->service_id)->first();

        $item->date_created = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->format('Y-m-d');

        return $item;
    });
    if($rent_details){
        $house = \App\Models\House::where('id',$rent_details->house_id)->first();
    }
    $page_data = [
        'services' => get_all_services(),
        'total_deposit' => get_deposit($user->id),
        'all_arrears' => get_all_arrears($user->id),
        'invites'=>get_all_invites($user->id)
    ];


    return $house;
});

Route::post('/userAccountDetails/split', function (Request $request) {
    $user = User::where('id',$request['user_id'])->first();

    $date  = strtotime($user->created_at);
    $user->date_created = date("d M Y",$date);


    $rent_details = \App\Models\rent::where('user_id',$user->id)->where('end_date',null)->first();
    $house = null;
    $subscriptions = \App\Models\Subscription::where('user_id',$user->id)
        ->where('subscription_end_date',null)->get();

    $subscriptions = $subscriptions->map(function ($item , $index){
        $item->servce = \App\Models\Service::where('id',$item->service_id)->first();

        $item->date_created = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->format('Y-m-d');

        return $item;
    });
    if($rent_details){
        $house = \App\Models\House::where('id',$rent_details->house_id)->first();
    }
    $page_data = [
        'total_deposit' => get_deposit($user->id)['count'][0]->sub_total,
        'all_arrears' => get_all_arrears($user->id)['count'],
    ];


    return $page_data;
});

Route::post('/userAccountDetails/', function (Request $request) {
    $user = User::where('id',$request['user_id'])->first();

    $date  = strtotime($user->created_at);
    $user->date_created = date("d M Y",$date);


    $rent_details = \App\Models\rent::where('user_id',$user->id)->where('end_date',null)->first();
    $house = null;
    $subscriptions = \App\Models\Subscription::where('user_id',$user->id)
        ->where('subscription_end_date',null)->get();

    $subscriptions = $subscriptions->map(function ($item , $index){
        $item->servce = \App\Models\Service::where('id',$item->service_id)->first();

        $item->date_created = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->format('Y-m-d');

        return $item;
    });
    if($rent_details){
        $house = \App\Models\House::where('id',$rent_details->house_id)->first();
    }
    $page_data = [
        'services' => get_all_services(),
        'total_deposit' => get_deposit($user->id),
        'all_arrears' => get_all_arrears($user->id),
        'invites'=>get_all_invites($user->id)
    ];


    return [
        'tenant'=>$user,
        'rent_details' => $rent_details,
        'house' =>$house,
        'subscriptions' => $subscriptions,
        'page_data' => $page_data
    ];
});

Route::post('/addDeposit', function (Request $request) {

    $deposit = new \App\Models\Deposit();

    $deposit->tenant_id = $request['id'];
    $deposit->agent_id = 1;
    $deposit->deposit_mode = $request['depositMode'];
    $deposit->reference_id = $request['referenceId'];
    $deposit->description = $request['description'];
    $deposit->amount = (float) $request['amount'];

    $deposit->save();

    return 1;
});

Route::post('/updateService', function (Request $request) {
    $service = $request['service_id'];
    $status = $request['status'];

    $user = User::where('id',$request['user_id'])->first();

    $rent = \App\Models\Rent::where('user_id',$user->id)->first();

    $house = \App\Models\House::where('id',$rent->house_id)->first();

    $sub = \App\Models\Subscription::where('service_id',$service)
        ->where('user_id',$request['user_id'])
        ->where('subscription_end_date',null)
        ->get();


    if(count($sub) > 0){
        $sub = $sub[0];
    }else{
        $sub = new \App\Models\Subscription();
    }

    if($request['status'] == 'true'){
        $sub->service_id = $service;
        $sub->house_id = $house->id;
        $sub->user_id = $request['user_id'];
        $sub->note = "created service";
        $sub->subscription_start_date = date("Y-m-d");

        $sub->save();
    }else{
        if(isset($sub->id)){
            $sub->subscription_end_date = date("Y-m-d");

            $sub->save();
        }
    }

    return 1;
});

