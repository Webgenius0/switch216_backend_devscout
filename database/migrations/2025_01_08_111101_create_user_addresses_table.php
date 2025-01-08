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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('address_line1')->nullable(); // Primary address line
            $table->string('address_line2')->nullable(); 
            $table->string('building')->nullable(); 
            $table->string('apartment')->nullable(); 
            $table->string('floor')->nullable(); 
            $table->string('location')->nullable(); // here map like google
            $table->text('description')->nullable();
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude with precision
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude with precision
            $table->enum('address_type', ['home', 'work', 'other'])->nullable();
            $table->boolean('is_current')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
