<?php

use App\Http\Requests\postService;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/Services/Create', function () {
    return Inertia::render('AppPages/Services/CreateService');
})->name('CreateServices');


Route::post('/Services/Create', function (postService $request) {
    $data = (array)json_decode($request->getContent());

    (new App\Http\Controllers\ServiceAreaController())->store($data);

    dd("done");

    return \Illuminate\Support\Facades\Redirect::route('Accounts');
})->name('postService');


Route::get('/Services', function () {
    $services = \App\Models\Service::all();

    return Inertia::render('AppPages/Services/index',[
        'services' => $services
    ]);
})->name('Services');


