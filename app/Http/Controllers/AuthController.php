<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginPage() {
        return view('login');
    }
    public function registerPage() {
        return view('register');
    }
    //role chechup function role is admin or usr check
    public function dashboard() {
        if(Auth::user()->role == 'admin') {
            return redirect()->route('list#page');
        }else{
            return redirect()->route('customer#home');
        }
    }

}
