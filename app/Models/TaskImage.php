<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id', 'user_id', 'image_id',
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function upload() {
        return $this->belongsTo(Upload::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
