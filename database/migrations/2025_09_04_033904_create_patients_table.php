<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();                       // ID único del paciente
            $table->date('date_of_birth');
            $table->foreignId('owner_id')->constrained('owners')->cascadeOnDelete();    
            $table->string('name');
            $table->string('type');          
           
            $table->timestamps();      
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
