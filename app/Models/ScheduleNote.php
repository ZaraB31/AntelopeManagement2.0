<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'schedule_id', 'note',
    ];

    public function Schedule() {
        return $this->belongsTo(Schedule::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }
}
