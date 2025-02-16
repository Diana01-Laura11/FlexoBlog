<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        // Obtener todos los artículos
        return view('contacts.index');
    }
}
