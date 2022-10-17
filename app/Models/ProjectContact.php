<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'contact_id',
    ];
}
