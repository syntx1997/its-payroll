<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        $PageData = [
            'title' => 'Login',
            'description' => 'Access your dashboard.',
            'js' => 'js/auth/auth.js'
        ];

        return view('pages.auth.login', $PageData);
    }
}
