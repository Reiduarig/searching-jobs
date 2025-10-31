<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'salary_min',
        'salary_max',
        'salary_period',
        'location',
        'schedule',
        'experience_level',
        'education',
        'benefits',
        'url',
        'featured',
        'urgent',
        'duration'
    ];

    protected $casts = [
        'benefits' => 'array',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'featured' => 'boolean',
        'urgent' => 'boolean',
    ];

    public function tag(string $name): void
    {
        $tag = Tag::firstOrCreate(['name' => $name]);
        $this->tags()->attach($tag);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function savedBy(): HasMany
    {
        return $this->hasMany(SavedJob::class);
    }

    public function getApplicationsCountAttribute(): int
    {
        return $this->applications()->count();
    }

    public function getSavedCountAttribute(): int
    {
        return $this->savedBy()->count();
    }
}
