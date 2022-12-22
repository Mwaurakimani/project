<?php

use App\Http\Requests\postPayment;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/Payments/Create', function (postPayment $request) {
    dd($request);
})->name('Payments');

Route::get('/Payments', function () {
        return Inertia::render('AppPages/Fianance/Payment/index');
    })->name('Payments');
