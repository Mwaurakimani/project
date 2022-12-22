<?php

use App\Http\Requests\postEvent;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/Events/Create', function () {
    return Inertia::render('AppPages/Events/CreateEvent');
})->name('Events');

Route::post('/Events/Create', function ( postEvent $request ) {
    dd($request);
})->name('Events');


Route::get('/Events', function () {
        return Inertia::render('AppPages/Events/index');
    })->name('Events');

