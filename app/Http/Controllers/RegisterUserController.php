<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        // Create user
        $user = $this->userService->createUser([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'newsletter' => $validated['newsletter'] ?? false,
        ]);

        // Create employer profile if needed
        if ($user->isEmployer() && isset($validated['employer'])) {
            $this->userService->createEmployerProfile(
                $user,
                $validated['employer'],
                $request->file('logo_url')
            );
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
