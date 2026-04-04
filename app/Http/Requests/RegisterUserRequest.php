<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
            'role' => ['required', 'string', 'in:candidate,employer'],
            'employer' => ['required_if:role,employer', 'nullable', 'string', 'max:255'],
            'logo_url' => ['nullable', 'image', File::types(['jpg', 'png', 'jpeg', 'webp', 'svg'])->max(2048)],
            'terms' => ['required', 'accepted'],
            'newsletter' => ['boolean'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Debe ser un email válido.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'role.required' => 'Debes seleccionar un tipo de cuenta.',
            'role.in' => 'El tipo de cuenta debe ser candidato o empleador.',
            'employer.required_if' => 'El nombre de la empresa es obligatorio para empleadores.',
            'employer.max' => 'El nombre de la empresa no puede exceder los 255 caracteres.',
            'logo_url.image' => 'El logo debe ser una imagen válida.',
            'logo_url.mimes' => 'El logo debe ser JPG, PNG, JPEG, WEBP o SVG.',
            'logo_url.max' => 'El logo no puede exceder los 2MB.',
            'terms.required' => 'Debes aceptar los términos y condiciones.',
            'terms.accepted' => 'Debes aceptar los términos y condiciones.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'role' => 'tipo de cuenta',
            'employer' => 'nombre de empresa',
            'logo_url' => 'logo',
            'terms' => 'términos y condiciones',
            'newsletter' => 'boletín',
        ];
    }
}
