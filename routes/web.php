<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

//    user routes
    Route::get('/dashboard/users', [\App\Http\Controllers\UsersController::class, 'listUsers'])->name('ListUsers');
    Route::get('/fetch/users/{id}', [\App\Http\Controllers\UsersController::class, 'getUsers'])->name('apiGetUser');
    Route::post('/put/user/{id}', [\App\Http\Controllers\UsersController::class, 'updateUsers'])->name('apiUpdateUser');
    Route::post('/post/user/', [\App\Http\Controllers\UsersController::class, 'createUser'])->name('apiCreateUser');

    Route::get('/dashboard/incidents', function () {
        return Inertia::render('AppPages/Incidents/index');
    })->name('listIncidents');

    Route::get('/dashboard/departments', function () {
        return Inertia::render('AppPages/Department/index');
    })->name('departments');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


});

//Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//    ->name('logout');
