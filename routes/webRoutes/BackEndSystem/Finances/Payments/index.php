<?php

use App\Http\Requests\postPayment;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/Payments/Create', function (postPayment $request) {
    dd($request);
})->name('Payments');

Route::get('/Payments', function () {

    $payments = \App\Models\Payment::all();

    $payments = $payments->map(function ($item){
        $date  = strtotime($item->created_at);
        $item->date_created = date("d M Y",$date);


        return $item;
    });

    return Inertia::render('AppPages/Fianance/Payment/index', [
        'payments' => $payments
    ]);
})->name('Payments');
