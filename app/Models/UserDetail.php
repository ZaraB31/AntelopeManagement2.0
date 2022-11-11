<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'userType_id', 'employer_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function userType() {
        return $this->belongsTo(UserType::class, 'userType_id');
    }

    public function employer() {
        return $this->belongsTo(Employer::class, 'employer_id');
    }
}
