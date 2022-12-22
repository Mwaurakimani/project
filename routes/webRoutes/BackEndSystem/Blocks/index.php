<?php

use App\Http\Requests\postBlock;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/Blocks/Create', function () {
    return Inertia::render('AppPages/Blocks/CreateBlock');
})->name('CreateBlocks');


Route::post('/Blocks/Create', function (postBlock $request) {
    $data = (array)json_decode($request->getContent());

    (new \App\Http\Controllers\BlockController())->store($data);

    return \Illuminate\Support\Facades\Redirect::route('Blocks');
})->name('postBlock');


Route::get('/Blocks', function () {
    $blocks = \App\Models\Block::all();


    $blocks = $blocks->map(function ($items, $keys) {
        $items->totalhouses = count($items->houses);
        $items->occupied = 0;
        return $items;
    });

    return Inertia::render('AppPages/Blocks/index',[
        'blocks' => $blocks
    ]);
})->name('Blocks');


