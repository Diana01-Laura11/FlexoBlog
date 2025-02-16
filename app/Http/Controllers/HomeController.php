<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }


    public function index()
    {
        $user = Auth::user(); // Obtén al usuario logueado
        $role = $user->role;  // Obtén el rol asociado al usuario
    
        // Pasamos la variable $role a la vista
        return view('welcomeValidate', ['role' => $role]);
    }
}
