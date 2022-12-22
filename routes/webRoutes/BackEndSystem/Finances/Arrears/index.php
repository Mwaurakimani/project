<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/Arrears/Create', function () {
    dd("creating Arrears");
})->name('Arrears');

Route::get('/Arrears', function () {
        return Inertia::render('AppPages/Fianance/Arrears/index');
    })->name('Arrears');

