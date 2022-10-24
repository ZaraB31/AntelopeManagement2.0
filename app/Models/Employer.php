<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer',
    ];

    public function userDetail() {
        return $this->belongsTo(UserDetail::class);
    }
    
    public function project() {
        return $this->belongsTo(Project::class);
    }
}
