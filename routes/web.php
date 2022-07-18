<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRDashboardController;

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
});

Route::prefix('/dashboard')->group(function (){

    // HR Officer
    Route::prefix('/hr')->group(function (){
        Route::get('/index', [HRDashboardController::class, 'index']);
    });

});
