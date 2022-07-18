<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginAdmin()
    {
//        dd(bcrypt('123456'));
        return view('login');
    }

    public function postLoginAdmin(Request $request)
    {
        $remember = $request->has('remember_me') ? true : false;
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'isAdmin' => 1
        ],$remember)) {
            $email = Auth::user()->name;

            return view('home', compact('email'));
        } else {
            $message = 'Tên người dùng hoặc mật khẩu không chính xác!!!';
            return view('login', compact('message'));
        }
    }
}
