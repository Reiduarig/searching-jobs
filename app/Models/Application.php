<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'status',
        'cover_letter',
        'cv_path',
        'questions_answers',
        'applied_at',
    ];

    protected $casts = [
        'questions_answers' => 'array',
        'applied_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pendiente',
            'reviewed' => 'Revisado',
            'interviewed' => 'Entrevista',
            'accepted' => 'Aceptado',
            'rejected' => 'Rechazado',
            default => 'Desconocido',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'reviewed' => 'blue',
            'interviewed' => 'purple',
            'accepted' => 'green',
            'rejected' => 'red',
            default => 'gray',
        };
    }
}