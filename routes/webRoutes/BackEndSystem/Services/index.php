<?php

use App\Http\Requests\postService;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/Services/Create', function () {
    return Inertia::render('AppPages/Services/CreateService');
})->name('CreateServices');



Route::get('/Services/Update/{id}', function (\Illuminate\Http\Request $request,\App\Models\Service $id) {
    return Inertia::render('AppPages/Services/UpdateService',[
        'service' => $id
    ]);
})->name('UpdateService');

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

Route::put('/Services/Update/{id}', function (postService $request,\App\Models\Service $id) {
    $service = $id;

    $service->name = $request['name'];
    $service->description = $request['description'];
    $service->price = $request['price'];

    $service->save();

    return redirect()->route('Services');

})->name('putService');





