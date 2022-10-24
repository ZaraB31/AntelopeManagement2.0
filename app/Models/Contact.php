<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'company_id',
    ];

    public function company() {
        return $this->belongsTo(Comapny::class);
    }

    public function projectContact() {
        return $this->belongsTo(ProjectContact::class);
    }
}
