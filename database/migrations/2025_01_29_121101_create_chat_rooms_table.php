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
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade'); // Job holder or sender
            $table->foreignId('contractor_id')->constrained('users')->onDelete('cascade'); // Contractor or receiver
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->foreignId('service_item_id')->nullable()->constrained('service_items')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};
