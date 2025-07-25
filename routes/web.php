<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
//ruta de vistas
Route::get('/home', function () {
    return view('home');
});
Route::get('/play', function () {
    return view('play');
});
Route::get('/demo', function () {
    return view('demo');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/profile', function () {
    return view('profile');
});




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


