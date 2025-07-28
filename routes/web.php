<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\UserController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;

// Rutas públicas accesibles para todos
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Autenticación (solo para invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Cerrar sesión (solo para autenticados)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
->middleware('auth');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    

    Route::get('/play', [GameController::class, 'play'])->name('play');
    Route::get('/demo', [GameController::class, 'demo'])->name('demo');

    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/scores', [GameController::class, 'index'])->name('scores.index');
        Route::get('/scores/global', [GameController::class, 'global'])->name('scores.global');
});






























// //ruta de vistas
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/play', function () {
//     return view('play');
// });
// Route::get('/demo', function () {
//     return view('demo');
// });
// Route::get('/login', function () {
//     return view('login');
// });
// Route::get('/profile', function () {
//     return view('profile');
// });

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);


