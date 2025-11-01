<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register (Request $r) {
        $validated = $r->validate([
            'login' => 'required|unique:users|min:6',
            'password' => 'required|min:6',
            'fio' => 'required|regex:/^[а-яА-Я\s]+$/u',
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}\-\d{2}\-\d{2}$/', //формате +7(XXX)-XXX-XX-XX),
            'email' => 'email|required|unique:users',
        ]);

        $user = User::create($validated);

        if ($user) {
            return redirect('/login');
        }
    }

    public function login (Request $r) {
        $validated = $r->validate([
            'login' => 'required|min:5|exists:users,login',
            'password' => 'required|min:6',
        ]);

        if(Auth::attempt(['login' => $validated['login'], 'password' => $validated['password']])) {
            return redirect('/');
        }

        return redirect('/login');
    }

    public function logout () {
        Auth::logout();

        return redirect('/');
    }
}
