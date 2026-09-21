<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| My Web Routes
|--------------------------------------------------------------------------
*/

// My Public Home Route
Route::get('/', function () {
    return view('welcome', ['user' => Session::get('user')]);
});

// My Protected Dashboard Route
Route::get('/dashboard', function () {
    if (!Session::has('user')) {
        return redirect('/auth/login');
    }
    return view('dashboard', ['user' => Session::get('user')]);
});

// My AWS Cognito Auth Routes
Route::get('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/callback', [AuthController::class, 'callback']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
