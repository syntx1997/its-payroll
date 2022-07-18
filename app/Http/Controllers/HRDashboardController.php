<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRDashboardController extends Controller
{
    public function index() {
        $PageData = [
            'title' => 'HR Dashboard',
            'js' => asset('')
        ];

        return view('pages.hr.index', compact('PageData'));
    }
}
