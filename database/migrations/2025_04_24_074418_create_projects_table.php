<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()  
    {  
        Schema::create('projects', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  
            $table->string('title');  
            $table->text('description')->nullable();  
            $table->string('status')->default('pending');  
            $table->softDeletes();
            $table->timestamps();  
        });  
    }  
  
    public function down()  
    {  
        Schema::dropIfExists('projects');  
    }  
};
