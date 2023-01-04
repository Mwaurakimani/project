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
    if (\Illuminate\Support\Facades\Auth::user()){
        return Inertia::render('AppPages/Dashboard/index');
    }else{
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    include_once 'webRoutes/BackEndSystem/index.php';
    include_once 'Mobile/index.php';

//    Route::get('/dashboard/users', [\App\Http\Controllers\UsersController::class, 'listUsers'])->name('ListUsers');
//    Route::get('/fetch/users/{id}', [\App\Http\Controllers\UsersController::class, 'getUsers'])->name('apiGetUser');
//    Route::post('/put/user/{id}', [\App\Http\Controllers\UsersController::class, 'updateUsers'])->name('apiUpdateUser');
//    Route::post('/post/user/', [\App\Http\Controllers\UsersController::class, 'createUser'])->name('apiCreateUser');
});
