<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()  
    {  
        Schema::create('supervisions', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('advisor_id')->constrained('users')->onDelete('cascade');  
            $table->text('notes')->nullable();  
            $table->timestamps();  
        });  
    }  
  
    public function down()  
    {  
        Schema::dropIfExists('supervisions');  
    }  
};
