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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event')->comment('Action performed');
            $table->string('auditable_type')->comment('Model type');
            $table->unsignedBigInteger('auditable_id')->comment('Model ID');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->json('old_values')->nullable()->comment('Previous data');
            $table->json('new_values')->nullable()->comment('Updated data');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            $table->index(['auditable_type', 'auditable_id']);
            $table->index('user_id');
            $table->index('event');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};