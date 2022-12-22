<?php

use App\Http\Requests\storeUser;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/Accounts', function () {
    $users = User::all();

    return Inertia::render('AppPages/Accounts/index',[
        'users' => $users
    ]);
})->name('Accounts');


Route::get('/Accounts/Create', function () {
    return Inertia::render('AppPages/Accounts/CreateUser');
})->name('createUser');

Route::post('/Accounts/Create', function (storeUser $request) {
    $data = (Array) json_decode($request->getContent());
    $data['password'] = bcrypt('password');

    (new App\Http\Controllers\UsersController)->store($data);

    return \Illuminate\Support\Facades\Redirect::route('Accounts');
})->name('postUser');
