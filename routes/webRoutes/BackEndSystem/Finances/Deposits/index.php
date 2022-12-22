<?php

use App\Http\Requests\postDeposit;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/Deposits/Create', function (postDeposit $request) {
    dd($request);
})->name('Deposits');


Route::get('/Deposits', function () {
        return Inertia::render('AppPages/Fianance/Deposits/index');
    })->name('Deposits');
