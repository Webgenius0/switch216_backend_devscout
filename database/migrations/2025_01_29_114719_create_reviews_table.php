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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Link to Service
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Link to User
            $table->tinyInteger('rating')->unsigned()->default(0); // Rating (1-5 scale)
            $table->text('review')->nullable(); // Review content
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
