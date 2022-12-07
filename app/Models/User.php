<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projectNote() {
        return $this->belongsTo(ProjectNote::class);
    }

    public function taskNote() {
        return $this->belongsTo(TaskNote::class);
    }

    public function taskImage() {
        return $this->belongsTo(TaskImage::class);
    }

    public function taskFile() {
        return $this->belongsTo(TaskFile::class);
    }

    public function userDetail() {
        return $this->belongsTo(UserDetail::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function ScheduleNote() {
        return $this->belongsTo(ScheduleNote::class);
    }

    public function Schedule() {
        return $this->belongsTo(Schedule::class);
    }
}
