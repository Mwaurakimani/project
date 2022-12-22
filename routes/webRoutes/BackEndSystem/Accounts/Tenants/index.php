<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/Tenants', function () {
    $users = User::where('account_type', 'LIKE','%TENANT%')->get();

    return Inertia::render('AppPages/Accounts/Tenants/index', [
        'users' => $users
    ]);
})->name('Tenants');
