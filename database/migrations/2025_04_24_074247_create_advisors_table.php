<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()  
    {  
        Schema::create('advisories', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');  
            $table->foreignId('advisor_id')->constrained('users')->onDelete('cascade'); 
            $table->text('topic');   
            $table->text('response')->default("pending");
            $table->softDeletes();  
            $table->timestamps();  
        });  
    }  
  
    public function down()  
    {  
        Schema::dropIfExists('advisors');  
    }  
};
