<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name', 'unit', 'lecturer', 'description'
    ];

    public function student() {
        return $this->belongsToMany(Student::class);
    }
}
