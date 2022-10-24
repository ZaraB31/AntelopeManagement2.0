<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'file', 'description',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function taskImage() {
        return $this->belongsTo(TaskImage::class);
    }

    public function taskFile() {
        return $this->belongsTo(TaskFile::class);
    }
}
