<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dateTime('from_date')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dateTime('from_date')->nullable()->change();
        });
    }
};
