<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/Agents', function () {
    $users = User::where('account_type', 'LIKE','%AGENT%')->get();

    return Inertia::render('AppPages/Accounts/Agents/index', [
        'users' => $users
    ]);
})->name('Agents');
