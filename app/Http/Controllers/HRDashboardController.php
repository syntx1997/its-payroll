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

    public function employee_deductions() {
        $PageData = [
            'title' => 'Employee Deductions',
            'js' => asset('js/dashboard/hr/employee-deductions.js'),
            'dashboardLink' => '/dashboard/hr/'
        ];

        return view('pages.hr.employee-deductions', $PageData);
    }

    public function rates() {
        $PageData = [
            'title' => 'Employee Rates',
            'js' => asset('js/dashboard/hr/rates.js'),
            'dashboardLink' => '/dashboard/hr/'
        ];

        return view('pages.hr.rates', $PageData);
    }

    public function sales_board() {
        $PageData = [
            'title' => 'Sales Board',
            'js' => asset('js/dashboard/hr/sales-board.js'),
            'dashboardLink' => '/dashboard/hr/'
        ];

        return view('pages.hr.sales-board', $PageData);
    }
}
