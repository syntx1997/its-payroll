<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRDashboardController extends Controller
{
    public function index() {
        $PageData = [
            'title' => 'HR Dashboard',
            'js' => asset('js/dashboard/hr/index.js'),
            'dashboardLink' => '/dashboard/hr/'
        ];

        return view('pages.hr.index', $PageData);
    }

    public function employees() {
        $PageData = [
            'title' => 'All Employees',
            'js' => asset('js/dashboard/hr/employees.js'),
            'dashboardLink' => '/dashboard/hr/'
        ];

        return view('pages.hr.employees', $PageData);
    }

    public function deduction_categories() {
        $PageData = [
            'title' => 'Deduction Categories',
            'js' => asset('js/dashboard/hr/deduction-categories.js'),
            'dashboardLink' => '/dashboard/hr/'
        ];

        return view('pages.hr.deduction-categories', $PageData);
    }
}
