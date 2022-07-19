<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRDashboardController extends Controller
{
    public function index() {
        $PageData = [
            'title' => 'HR Dashboard',
            'js' => asset(''),
            'dashboardLink' => '/dashboard/hr/'
        ];

        return view('pages.hr.index', $PageData);
    }
}
