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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->comment('Lab identification code');
            $table->text('description')->nullable();
            $table->string('location');
            $table->integer('capacity')->comment('Maximum number of people');
            $table->json('operating_hours')->comment('Operating schedule per day');
            $table->json('blackout_dates')->nullable()->comment('Unavailable dates');
            $table->string('contact_person')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->json('image_gallery')->nullable()->comment('Photo gallery URLs');
            $table->json('sop_documents')->nullable()->comment('SOP PDF document paths');
            $table->text('rules')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->timestamps();
            
            $table->index('code');
            $table->index('status');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};