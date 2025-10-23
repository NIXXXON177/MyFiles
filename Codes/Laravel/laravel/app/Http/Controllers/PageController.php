<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Главная страница
    public function welcome()
    {
        return view('welcome');
    }

    // Личный кабинет
    public function dashboard()
    {
        return view('dashboard', [
            'user' => auth()->user()
        ]);
    }

    // О компании
    public function about()
    {
        return view('about');
    }

    // Услуги
    public function services()
    {
        return view('services');
    }

    // Контакты
    public function contact()
    {
        return view('contact');
    }
}
