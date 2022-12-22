<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

Route::get('/Admins', function () {

    $users = User::where('account_type','like','%ADMIN%')->get();

    return Inertia::render('AppPages/Accounts/Admin/index',[
        'users' => $users
    ]);
})->name('Admins');
