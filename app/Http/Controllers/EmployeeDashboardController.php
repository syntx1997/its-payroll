<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function index() {
        $PageData = [
            'title' => 'Employee Dashboard',
            'js' => asset('js/dashboard/employee/index.js'),
            'dashboardLink' => '/dashboard/employee/'
        ];

        return view('pages.employee.index', $PageData);
    }
}
