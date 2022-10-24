<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'userType',
    ];

    public function userDetail() {
        return $this->belongsTo(UserDetail::class);
    }
}
