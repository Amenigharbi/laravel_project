<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //la page/vue home.blade.php
    public function home()
    {
        return view('home.home');
    }
    //la page/vue about.blade.php
    public function about()
    {
        return view('home.about');
    }
    //la page dashboard.blade.php
    public function dashboard()
    {
        return view('home.dashboard');
    }
}
