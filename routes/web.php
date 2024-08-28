<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
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
Route::post('/user/authenticate',[UserController::class, 'authenticate'])->name('user.authenticate');
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::put('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
Route::post('/user/update-picture', [UserController::class, 'changeProfilePicture'])->name('user.changeProfilePicture');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/jobs/post-jobs',[JobController::class, 'showJobPostForm'])->name('jobs.showJobPostForm');
Route::post('/jobs/create', [JobController::class, 'createJob'])->name('jobs.createJob');
Route::get('/jobs/lists', [JobController::class, 'showJobLists'])->name('jobs.showJobLists');