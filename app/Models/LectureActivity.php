<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LectureActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecture_id',
        'student_id',
        'notes',
        'date',
    ];

    public function lecture()
    {
        return $this->belongsTo(User::class, 'lecture_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}