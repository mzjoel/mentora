<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    use HasFactory;  
  
    protected $fillable = ['project_id', 'advisor_id', 'notes'];  
    public function project()  
    {  
        return $this->belongsTo(Project::class);  
    }
    public function advisor()  
    {  
        return $this->belongsTo(User::class, 'advisor_id');  
    }    
}
