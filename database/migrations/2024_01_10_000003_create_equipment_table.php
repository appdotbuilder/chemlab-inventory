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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->comment('Equipment identification code');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('category');
            $table->text('description')->nullable();
            $table->json('technical_specifications')->nullable();
            $table->json('images')->nullable()->comment('Equipment photo URLs');
            $table->json('manuals')->nullable()->comment('Manual document paths');
            $table->json('msds_documents')->nullable()->comment('MSDS document paths');
            $table->enum('risk_level', ['low', 'medium', 'high'])->default('low');
            $table->boolean('requires_supervisor')->default(false)->comment('Requires lecturer approval');
            $table->enum('status', ['available', 'borrowed', 'maintenance', 'damaged', 'retired'])->default('available');
            $table->string('location')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->date('last_calibration')->nullable();
            $table->date('next_calibration')->nullable();
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->text('usage_notes')->nullable();
            $table->json('tags')->nullable()->comment('Equipment tags for filtering');
            $table->string('qr_code')->nullable()->comment('QR code for scanning');
            $table->foreignId('laboratory_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->index('code');
            $table->index('category');
            $table->index('status');
            $table->index('risk_level');
            $table->index('laboratory_id');
            $table->index(['laboratory_id', 'status']);
            $table->index(['category', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};