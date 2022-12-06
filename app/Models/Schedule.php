<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'start', 'finish', 'employer_id',
    ];

    public function ScheduleUser() {
        return $this->belongsTo(ScheduleUser::class);
    }

    public function ScheduleNote() {
        return $this->belongsTo(ScheduleNote::class);
    }

    public function Employer() {
        return $this->belongsTo(Employer::class);
    }
}
