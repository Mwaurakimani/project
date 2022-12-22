<?php

use App\Http\Requests\postHouse;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/Houses/Create', function () {
    return Inertia::render('AppPages/Blocks/Houses/CreateHouse');
})->name('createHouse');



Route::get('/Houses/Update/{id}', function (\Illuminate\Http\Request $request) {
    dd($request);
})->name('updateHouse');


Route::post('/Houses/Create', function (postHouse $request) {
    $data = (array)json_decode($request->getContent());

    $tenant_id = array_pop($data);

    (new \App\Http\Controllers\HouseController())->store($data);

    if ($tenant_id != null) {
        dd("create rent");
    }

    return \Illuminate\Support\Facades\Redirect::route('Houses');
})->name('postHouse');


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
