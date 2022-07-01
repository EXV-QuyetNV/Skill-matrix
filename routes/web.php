<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillUserController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('skill-user', SkillUserController::class)->only('store');
    Route::get('skill-user.show-level-history', [SkillUserController::class, 'showLevelHistory'])->name('show-level-history');
});


Auth::routes();

Route::get('/redirect/{social}', [SocialAuthController::class, 'redirect'])->name('redirect');
Route::get('{social}/callback', [SocialAuthController::class, 'callback']);
