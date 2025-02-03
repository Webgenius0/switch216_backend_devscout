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
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Link to Service
            $table->string('name'); // Item name
            $table->text('description')->nullable(); // Item description
            $table->string('cover_image')->nullable();
            $table->json('gallery_images')->nullable(); // Array of images
            $table->string('video_url')->nullable(); // Service video
            $table->decimal('price', 10, 2)->nullable(); // Item price
            $table->boolean('is_emergency')->default(false);
            $table->enum('type', ['event', 'single', 'sell', 'rent'])->nullable();
            $table->enum('verify', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status', ['active', 'inactive'])->default('active'); // Item status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_items');
    }
};
