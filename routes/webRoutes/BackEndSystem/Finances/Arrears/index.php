<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/Arrears/Create', function () {
    dd("creating Arrears");
})->name('Arrears');

Route::get('/Arrears', function () {
    $arrears = \App\Models\Arrears::all();

    $arrears->transform(function ($item,$index){
        $item['date_created'] = Carbon::parse($item->created_at)->diffForHumans();
        $item->type = (new \App\Http\Controllers\ArrearsController())->get_table_ref($item->id);
        $item->username = $item->type["Tenant"]->username;

        return $item;
    });


    return Inertia::render('AppPages/Fianance/Arrears/index', [
        'arrears' => $arrears
    ]);
})->name('Arrears');

