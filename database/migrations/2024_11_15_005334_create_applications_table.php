<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('announcement_id'); // Foreign key for the job (announcement)
        $table->string('name');
        $table->string('lastname');
        $table->string('city');
        $table->string('email');
        $table->string('phone');
        $table->string('resume')->nullable(); 
        $table->timestamps();

        // Foreign key constraint
        $table->foreign('announcement_id')->references('id')->on('announcements')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
