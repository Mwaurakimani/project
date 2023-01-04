<?php

use App\Http\Requests\postDeposit;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/Deposits/Create', function (postDeposit $request) {
    dd($request);
})->name('Deposits');


Route::get('/Deposits', function () {
    $deposits = \App\Models\Deposit::all();
    $deposits = $deposits->map(function ($item, $index){
        $item->username = \App\Models\User::find($item->tenant_id)->username;
        $item->date_created = $item->created_at;
        return $item;
    });

    return Inertia::render('AppPages/Fianance/Deposits/index',[
        'deposits'=>$deposits
    ]);
})->name('Deposits');
