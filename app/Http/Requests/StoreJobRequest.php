<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->employer !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0', 'gte:salary_min'],
            'salary_period' => ['required', 'string', Rule::in(['hour', 'day', 'week', 'month', 'year'])],
            'location' => ['required', 'string', 'max:255'],
            'schedule' => ['required', 'string', Rule::in(['full-time', 'part-time', 'contract', 'internship'])],
            'experience_level' => ['nullable', 'string', Rule::in(['entry', 'mid', 'senior', 'lead'])],
            'education' => ['nullable', 'string', Rule::in(['none', 'high_school', 'bachelor', 'master', 'phd'])],
            'benefits' => ['nullable', 'array'],
            'url' => ['required', 'active_url'],
            'featured' => ['boolean'],
            'urgent' => ['boolean'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'tags' => ['nullable', 'string'],
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
            'title.required' => 'El título del trabajo es obligatorio.',
            'title.max' => 'El título no puede exceder los 255 caracteres.',
            'salary_min.numeric' => 'El salario mínimo debe ser un número.',
            'salary_min.min' => 'El salario mínimo no puede ser negativo.',
            'salary_max.numeric' => 'El salario máximo debe ser un número.',
            'salary_max.gte' => 'El salario máximo debe ser mayor o igual al salario mínimo.',
            'salary_period.required' => 'El período de salario es obligatorio.',
            'salary_period.in' => 'El período de salario debe ser: por hora, día, semana, mes o año.',
            'location.required' => 'La ubicación es obligatoria.',
            'location.max' => 'La ubicación no puede exceder los 255 caracteres.',
            'schedule.required' => 'El tipo de empleo es obligatorio.',
            'schedule.in' => 'El tipo de empleo debe ser: tiempo completo, medio tiempo, contrato o práctica.',
            'experience_level.in' => 'El nivel de experiencia debe ser: principiante, intermedio, senior o líder.',
            'education.in' => 'El nivel educativo debe ser: ninguno, secundaria, licenciatura, maestría o doctorado.',
            'url.required' => 'La URL de aplicación es obligatoria.',
            'url.active_url' => 'La URL debe ser una dirección web válida.',
            'duration.integer' => 'La duración debe ser un número entero.',
            'duration.min' => 'La duración debe ser al menos 1.',
        ];
    }
}
