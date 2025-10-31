<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'newsletter',
        'role',
        'notification_preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'newsletter' => 'boolean',
            'notification_preferences' => 'array',
        ];
    }

    public function employer(): HasOne
    {
        return $this->hasOne(Employer::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function savedJobs(): HasMany
    {
        return $this->hasMany(SavedJob::class);
    }

    public function hasAppliedTo(Job $job): bool
    {
        return $this->applications()->where('job_id', $job->id)->exists();
    }

    public function hasSaved(Job $job): bool
    {
        return $this->savedJobs()->where('job_id', $job->id)->exists();
    }

    public function isEmployer(): bool
    {
        return $this->role === 'employer';
    }

    public function isCandidate(): bool
    {
        return $this->role === 'candidate';
    }

    public function getNotificationPreferences(): array
    {
        return $this->notification_preferences ?? [
            'new_applications' => true,
            'status_changes' => true,
            'job_recommendations' => true,
            'marketing' => false,
        ];
    }

    public function shouldReceiveNotification(string $type): bool
    {
        $preferences = $this->getNotificationPreferences();
        return $preferences[$type] ?? false;
    }

    public function updateNotificationPreferences(array $preferences): void
    {
        $this->update(['notification_preferences' => $preferences]);
    }
}
