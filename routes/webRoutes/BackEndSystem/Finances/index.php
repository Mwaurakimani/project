<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/Finances', function () {
        return Inertia::render('AppPages/Fianance/index');
    })->name('Finances');
