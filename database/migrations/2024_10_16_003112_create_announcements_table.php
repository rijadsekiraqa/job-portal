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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null'); // Prevent deletion of related data
            $table->string('job_title');  

            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null'); // Prevent deletion of related data
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null'); // Prevent deletion of related data

            $table->enum('work_schedule', ['Full Time', 'Part Time']); 
            $table->date('from_date');  
            $table->date('to_date');  
            $table->text('job_description')->nullable(); 
            $table->json('requirements')->nullable();  
            $table->json('qualifications')->nullable(); 
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
