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
        Schema::table('mood_trackers', function (Blueprint $table) {
            $table->string('mood_emoji')->nullable()->after('mood_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mood_trackers', function (Blueprint $table) {
            $table->dropColumn('mood_emoji');
        });
    }
};
