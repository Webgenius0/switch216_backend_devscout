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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Contractor
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->onDelete('restrict');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('pending'); // 'pending', 'approved', 'rejected'
            $table->string('cover_image')->nullable();
            $table->json('gallery_images')->nullable(); // Array of images
            $table->string('video_url')->nullable(); // Service video
            $table->decimal('price', 10, 2)->nullable(); // Base price
            $table->enum('type', ['event', 'single', 'sell', 'rent'])->nullable();
            $table->enum('verify', ['pending', 'approved','rejected'])->default('pending');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
