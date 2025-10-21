<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    
    public function create()
    {
        return view('auth.register');
    }

   
    public function store(Request $request)
    {
        $validatedUser = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::min(6)],
            'employer' => ['required', 'string', 'max:255'],
            'logo_url' => ['nullable', 'image', 'max:1024'],
        ]);

        $validatedEmployer = $request->validate([
            'employer' => ['required', 'string', 'max:255'],
            'logo_url' => ['nullable', 'image', File::types(['jpg', 'png', 'jpeg', 'webp'])->max(1024)],
        ]);

        // Create the user...
        $user = User::create($validatedUser);

        //store logo if exists, change FILESYSTEM_DISK in .env to 'public'
        // if ($request->hasFile('logo_url')) {
        //     $path = $request->file('logo_url')->store('logos', 'public');
        //     $validatedEmployer['logo_url'] = $path;
        // }

        // Store the logo and get the path
        $logoPath = $request->logo_url->store('logos');

        // Create the employer associated with the user...
        $user->employer()->create([
            'name' => $validatedEmployer['employer'],
            'logo_url' => $logoPath ?? null,
        ]);

        // Log the user in...
        Auth::login($user);

        return redirect('/')->with('success', 'Cuenta creada correctamente');

    }

   
}
