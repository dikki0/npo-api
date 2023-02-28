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
        Schema::create('stream_events', function (Blueprint $table) {
            $table->string('event_id')->primary();
            $table->string('media_id')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->enum('event_type', ['waypoint', 'streamstart', 'streamstop', 'streamend'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stream_events');
    }
};
