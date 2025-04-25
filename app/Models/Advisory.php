<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advisory extends Model
{
    use HasFactory, SoftDeletes; 
  
    protected $fillable = ['student_id', 'advisor_id', 'topic', 'response'];  
  
    public function student()  
    {  
        return $this->belongsTo(User::class, 'student_id');  
    }  
  
    public function advisor()  
    {  
        return $this->belongsTo(User::class, 'advisor_id');  
    }  
}
