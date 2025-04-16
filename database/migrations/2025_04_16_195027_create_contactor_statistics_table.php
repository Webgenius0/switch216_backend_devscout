<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contactor_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->index();
            $table->string('rank')->nullable();
            $table->float('average_rating')->default(0);
            $table->integer('review_count')->default(0);
            $table->integer('complete_booking_count')->default(0);
            $table->integer('pending_booking_count')->default(0);

            // Last 60 days
            $table->integer('last_60_days_complete_booking_count')->default(0);
            $table->float('last_60_days_average_rating')->default(0);
            $table->float('last_60_days_response_rate')->default(0);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactor_statistics');
    }
};
