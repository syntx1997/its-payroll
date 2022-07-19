<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        // Check Email
        $user = User::where('email', $request->email)->first();

        // Check Password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'Invalid credentials!'], 401);
        }

        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            switch (auth()->user()->type) {
                case 'HR':
                    $link = '/dashboard/hr/index';
                    break;
                case 'Employee':
                    $link = '/dashboard/employee/index';
                    break;
                default:
                    $link = '';
                    break;
            }
        }

        return response([
            'message' => 'Logged In!',
            'link' => $link
        ], 201);
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response(['message' => 'You have been logged out!'], 201);
    }
}
