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
        Schema::create('loan_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->text('notes')->nullable();
            $table->enum('condition_at_checkout', ['excellent', 'good', 'fair', 'poor'])->nullable();
            $table->enum('condition_at_return', ['excellent', 'good', 'fair', 'poor'])->nullable();
            $table->text('damage_notes')->nullable();
            $table->timestamps();
            
            $table->index('loan_request_id');
            $table->index('equipment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_request_items');
    }
};