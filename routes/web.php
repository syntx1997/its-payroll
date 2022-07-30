<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeductionCategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\EmployeeSettingController;
use App\Http\Controllers\HRSettingController;

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
    switch (auth()->user()->type) {
        case 'HR':
            return redirect('/dashboard/hr/index');
            break;
        case 'Employee':
            return redirect('/dashboard/employee/index');
            break;
        default:
            break;
    }
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::middleware('auth')->prefix('/dashboard')->group(function (){

    // HR Officer
    Route::prefix('/hr')->group(function (){
        Route::get('/index', [HRDashboardController::class, 'index']);
        Route::get('/employees', [HRDashboardController::class, 'employees']);
        Route::get('/deduction-categories', [HRDashboardController::class, 'deduction_categories']);
        Route::get('/employee-deductions', [HRDashboardController::class, 'employee_deductions']);
        Route::get('/rates', [HRDashboardController::class, 'rates']);
        Route::get('/sales-board', [HRDashboardController::class, 'sales_board']);
        Route::get('/attendance', [HRDashboardController::class, 'attendance']);
        Route::get('/payslips', [HRDashboardController::class, 'payslips']);
        Route::get('/settings', [HRDashboardController::class, 'settings']);
    });

    // Employee
    Route::prefix('/employee')->group(function (){
        Route::get('/index', [EmployeeDashboardController::class, 'index']);
        Route::get('/payslips', [EmployeeDashboardController::class, 'payslips']);
        Route::get('/settings', [EmployeeDashboardController::class, 'settings']);
    });

});

// APIs
Route::prefix('/func')->group(function (){

    // Authentication
    Route::prefix('/auth')->group(function (){
        Route::post('/login', [UserController::class, 'login']);
        Route::get('/logout', [UserController::class, 'logout']);
    });

    // Deduction Category
    Route::prefix('/deduction-category')->group(function (){
        Route::post('/add', [DeductionCategoryController::class, 'add']);
        Route::get('/get-all', [DeductionCategoryController::class, 'get_all']);
        Route::put('/edit', [DeductionCategoryController::class, 'edit']);
        Route::delete('/delete', [DeductionCategoryController::class, 'delete']);
    });

    // Employee
    Route::prefix('/employee')->group(function (){
        Route::post('/add', [EmployeeController::class, 'add']);
        Route::get('/get-all', [EmployeeController::class, 'get_all']);
        Route::post('/edit', [EmployeeController::class, 'edit']);
        Route::post('/get', [EmployeeController::class, 'get_employee']);
    });

    // Employee Deduction
    Route::prefix('/employee-deduction')->group(function (){
        Route::post('/set', [DeductionController::class, 'set']);
        Route::get('/get-all-employees', [DeductionController::class, 'get_all_employees']);
    });

    // Employee Rates
    Route::prefix('/employee-rate')->group(function (){
        Route::post('/set', [RateController::class, 'set']);
        Route::get('/get-all-employees', [RateController::class, 'get_all_employees']);
    });

    // Sales Board
    Route::prefix('sales-board')->group(function (){
        Route::post('add', [SaleController::class, 'add']);
        Route::get('get-all', [SaleController::class, 'get_all']);
    });

    // Attendance
    Route::prefix('/attendance')->group(function (){
        Route::post('/punch', [AttendanceController::class, 'punch']);
        Route::get('/get-all', [AttendanceController::class, 'get_all']);
        Route::get('/get-all-employees', [AttendanceController::class, 'get_all_employees']);
    });

    // Payslip
    Route::prefix('/payslip')->group(function (){
        Route::post('/compute', [PayslipController::class, 'compute']);
        Route::post('/create', [PayslipController::class, 'create']);
        Route::get('/get-all', [PayslipController::class, 'get_all']);
        Route::get('/get-employee-slip', [PayslipController::class, 'get_employee_slip']);
    });

    // Settings
    Route::prefix('/settings')->group(function (){

        // Employee Settings
        Route::prefix('/employee')->group(function (){
            Route::post('/update-password', [EmployeeSettingController::class, 'update_password']);
            Route::post('/update-info', [EmployeeSettingController::class, 'update_info']);
        });

        // HR Settings
        Route::prefix('/hr')->group(function (){
            Route::post('/update-password', [HRSettingController::class, 'update_password']);
            Route::post('/update-info', [HRSettingController::class, 'update_info']);
        });

    });

});
