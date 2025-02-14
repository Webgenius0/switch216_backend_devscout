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
        Schema::create('home_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Link to Services
            $table->string('location'); // City/Region
            $table->enum('property_type', ['House', 'Apartment', 'Land', 'Commercial'])->nullable();
            $table->enum('transaction_type', ['For Rent', 'For Sale'])->nullable();
            $table->decimal('price', 15, 2)->nullable(); // Price Range (Decimal for precision)
            $table->integer('bedrooms')->nullable(); // Studio, 1, 2, 3+
            $table->integer('bathrooms')->nullable(); // 1+, 2+, 3+
            $table->boolean('is_furnished')->default(false); // Yes/No (Boolean)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_details');
    }
};
