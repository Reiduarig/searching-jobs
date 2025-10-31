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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
            'role' => ['required', 'string', 'in:candidate,employer'],
            'employer' => ['required_if:role,employer', 'nullable', 'string', 'max:255'],
            'logo_url' => ['nullable', 'image', File::types(['jpg', 'png', 'jpeg', 'webp', 'svg'])->max(2048)],
            'terms' => ['required', 'accepted'],
            'newsletter' => ['boolean'],
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role' => $validatedData['role'],
            'newsletter' => $request->boolean('newsletter'),
        ]);

        // Create employer profile only if user is an employer
        if ($user->isEmployer()) {
            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo_url')) {
                $logoPath = $request->file('logo_url')->store('logos', 'public');
            }

            // Create the employer associated with the user
            $user->employer()->create([
                'name' => $validatedData['employer'],
                'logo_url' => $logoPath,
            ]);
        }

        // Log the user in
        Auth::login($user);

        // Redirect with role-specific message and destination
        if ($user->isEmployer()) {
            return redirect()->route('dashboard')->with('success', 'Cuenta de empleador creada correctamente. ¡Ya puedes publicar trabajos!');
        } else {
            return redirect()->route('dashboard')->with('success', 'Cuenta creada correctamente. ¡Explora tu dashboard y empieza a buscar tu trabajo ideal!');
        }
    }

   
}
