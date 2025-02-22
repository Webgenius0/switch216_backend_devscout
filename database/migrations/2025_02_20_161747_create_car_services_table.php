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
        Schema::create('car_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Link to Services
            $table->enum('car_type', [
                'Sedan',
                'SUV',
                'Coupe',
                'Convertible',
                'Pickup Truck',
                'Van',
                'Motorcycle',
                'Electric',
                'Other'
            ])->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->year('year')->nullable();
            $table->enum('fuel_type', ['Gasoline', 'Diesel', 'Hybrid', 'Electric', 'Other'])->nullable();
            $table->enum('transmission', ['Manual', 'Automatic'])->nullable();
            $table->string('kilometers_driven')->nullable();
            $table->string('location')->nullable(); // City/Region
            $table->decimal('price', 15, 2)->nullable();
            $table->enum('transaction_type', ['sell', 'rent'])->nullable(); // Sell or Rent
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_services');
    }
};
