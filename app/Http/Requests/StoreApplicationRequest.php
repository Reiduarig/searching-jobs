<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && ! Auth::user()->isEmployer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cover_letter' => ['nullable', 'string', 'max:2000'],
            'cv_file' => ['nullable', 'file', File::types(['pdf', 'doc', 'docx'])->max(5120)], // 5MB
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
            'cover_letter.string' => 'La carta de presentación debe ser texto.',
            'cover_letter.max' => 'La carta de presentación no puede exceder los 2000 caracteres.',
            'cv_file.file' => 'El CV debe ser un archivo válido.',
            'cv_file.mimes' => 'El CV debe ser un archivo PDF, DOC o DOCX.',
            'cv_file.max' => 'El CV no puede exceder los 5MB.',
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
            'cover_letter' => 'carta de presentación',
            'cv_file' => 'CV',
        ];
    }
}
