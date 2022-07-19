<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->prefix('/dashboard')->group(function (){

    // HR Officer
    Route::prefix('/hr')->group(function (){
        Route::get('/index', [HRDashboardController::class, 'index']);
    });

});

// APIs
Route::prefix('/func')->group(function (){

    // authentication
    Route::prefix('/auth')->group(function (){
        Route::post('/login', [UserController::class, 'login']);
    });

});
