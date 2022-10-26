<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'deadline', 'completed', 'company_id', 'employer_id', 'projectType_id',
    ];

    public function employer() {
        return $this->belongsTo(Employer::class);
    }

    public function projectNote() {
        return $this->belongsTo(ProjectNote::class);
    }

    public function projectContact() {
        return $this->belongsTo(ProjectContact::class);
    }

    public function projectType() {
        return $this->belongsTo(ProjectType::class, 'projectType_id');
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function task() {
        return $this->belongsTo(Task::class);
    }
}
