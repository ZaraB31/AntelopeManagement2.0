<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'deadline', 'completed', 'project_id', 'user_id',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
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

    public function taskUser() {
        return $this->belongsTo(TaskUser::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
