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
        Schema::table('notifications', function (Blueprint $table) {
            // Drop the existing primary key if there's one already (useful if it's an integer-based primary key)
            $table->dropPrimary();

            // Change 'id' column to use UUID if it's not already
            $table->uuid('id')->primary()->change(); // Make 'id' a UUID field if it's not already

            // Add missing columns for the default Laravel notifications table
            $table->string('type'); // The class name of the notification
            $table->json('data'); // The notification data (JSON)
            $table->morphs('notifiable'); // Adds notifiable_id and notifiable_type
            $table->timestamp('read_at')->nullable(); // To store when the notification was read
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Drop the columns if you want to rollback the migration
            $table->dropColumn(['type', 'data', 'notifiable_id', 'notifiable_type', 'read_at']);
            $table->dropPrimary('id'); // Drop the UUID primary key if needed
        });
    }
};
