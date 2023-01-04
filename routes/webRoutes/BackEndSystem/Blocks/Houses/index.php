<?php

use App\Http\Requests\postHouse;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/Houses/Update/{id}', function (\App\Models\House $id) {
    $tenants = $id->tenants()->where('end_date', null)->get();

    return Inertia::render('AppPages/Blocks/Houses/UpdateHouse', [
        'house' => $id,
        'tenant' => count($tenants) > 0 ? $tenants->first() : null
    ]);
})->name('updateHouse');

Route::get('/Houses/Create', function () {
    return Inertia::render('AppPages/Blocks/Houses/CreateHouse');
})->name('createHouse');

Route::get('/Houses', function () {
    $houses = \App\Models\House::with('block')->get();

    $houses = $houses->map(function ($item, $key) {
        $subscription = \App\Models\rent::where('house_id', $item->id)->where('end_date', '=', NULL)->get();
        $item->tenant = null;

        if (count($subscription) > 0) {
            $user = \App\Models\User::where('id', $subscription[0]->user_id)->get();

            if (count($user) > 0) {
                $item->tenant = $user[0];
            }
        }

        return $item;
    });

    return Inertia::render('AppPages/Blocks/Houses/index', [
        'houses' => $houses
    ]);
})->name('Houses');


Route::post('/Houses/Create', function (postHouse $request) {
    $data = (array)json_decode($request->getContent());

    $tenant_id = array_pop($data);

    (new \App\Http\Controllers\HouseController())->store($data);

    if ($tenant_id != null) {
        dd("create rent");
    }

    return \Illuminate\Support\Facades\Redirect::route('Houses');
})->name('postHouse');


Route::post('/Houses/getTenent', function (\Illuminate\Http\Request $request) {
    $key = $request['tenant'];
    return User::where('username', 'LIKE', "%{$key}%")->where('account_type', 'TENANT')->get();
})->name('search_tenant');


Route::put('/Houses/update/{id}', function (postHouse $request, \App\Models\House $id) {

    $data = (array)json_decode($request->getContent());

    $tenant_form = array_pop($data);
    $tenant_id = $tenant_form->id;

    $tenant = User::where('id', $tenant_id)->first();
    $house = $id;
    $date = date('Y-m-d');

    if ($tenant_form->username && $tenant) {
//        check if house is occupied

        if (count($house->tenants()->where('end_date', null)->get()) > 0) {

//            check if the current user is the one occupying it
            if (!count($house->tenants()->where('user_id', $tenant->id)->where('end_date',null)->get()) > 0) {

//              currently occupied by someone else
//              terminate the occupancy of the previous tenant
                $current_occupancy = \App\Models\rent::where('house_id', $house->id)->where('end_date', null)->first();
                $current_occupancy->end_date = $date;
                $current_occupancy->save();

//               set this user as the new occupant
            }
        }
        $house->tenants()->attach($tenant, [
            'start_date' => $date
        ]);
    }else{
//        terminate occupancy
        $current_occupancy = \App\Models\rent::where('house_id', $house->id)->where('end_date', null)->first();

        if($current_occupancy){
            $current_occupancy->end_date = $date;
            $current_occupancy->save();
        }
    }

    (new \App\Http\Controllers\HouseController())->update($data, $id);

    return \Illuminate\Support\Facades\Redirect::route('Houses');
})->
name('putHouse');



