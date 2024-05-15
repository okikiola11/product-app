<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'FirstName',
        'LastName',
        'phone',
    ];

    public function courses() {
        return $this->belongsToMany(Course::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'student_id');
    }
}
