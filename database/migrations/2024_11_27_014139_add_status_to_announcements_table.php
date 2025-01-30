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
        Schema::table('announcements', function (Blueprint $table) {
            // Add the 'status' column with a default value of 'pending'
            $table->enum('status', ['pending', 'approved', 'canceled'])->default('pending');
        });
    }

    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Drop the 'status' column
            $table->dropColumn('status');
        });
    }
};
