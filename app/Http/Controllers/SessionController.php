<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
   
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => ['required', Password::min(6)]
        ]);

        // Intenta autenticar al usuario con las credenciales proporcionadas
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Las credenciales no son correctas'
            ]); 
        }

        // Previene ataques de sesión hijacking, regenerando la sesión
        request()->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Has iniciado sesión correctamente');
    }

   
    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
