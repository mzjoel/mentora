<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    use HasFactory;  
  
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
