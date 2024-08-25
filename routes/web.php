<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index'])->name('home'); // route the homeController class with it's method
Route::get('/user/registration',[UserController::class, 'showRegistrationForm'])->name('user.showRegistrationForm');
Route::post('/user/save-user',[UserController::class, 'processRegistration'])->name('user.processRegistration');
Route::get('/user/login',[UserController::class, 'showLoginForm'])->name('user.showLoginForm');
