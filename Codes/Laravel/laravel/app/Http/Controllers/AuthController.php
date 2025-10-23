<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Показать форму регистрации
    public function showRegisterForm()
    {
        return view('welcome'); // Используем welcome.blade.php для регистрации
    }

    // Обработка регистрации
    public function register(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'fio' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Создание пользователя
        $user = User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'fio' => $request->fio,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        // Автоматический вход после регистрации
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Регистрация прошла успешно!');
    }

    // Показать форму входа
    public function showLoginForm()
    {
        return view('login');
    }

    // Обработка входа
    public function login(Request $request)
    {
        // Валидация данных
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Попытка аутентификации
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Добро пожаловать!');
        }

        return back()->withErrors([
            'login' => 'Неверные учетные данные.',
        ])->onlyInput('login');
    }

    // Выход
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Вы успешно вышли из системы.');
    }
}
