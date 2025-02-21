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
        Schema::create('restaurant_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Links to Services table
            $table->string('cuisine_type'); // Cuisine type (e.g., Italian, Chinese, Fast Food)
            $table->boolean('is_delivery_available')->default(false); // Delivery availability
            $table->decimal('average_cost', 10, 2)->nullable(); // Average cost per person
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_services');
    }
};
