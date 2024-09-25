<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile', ['user' => Auth::user()]); // Asegúrate de crear la vista 'profile.blade.php'
    }
}

