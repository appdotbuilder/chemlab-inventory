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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Notification type/category');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('data')->comment('Notification content and metadata');
            $table->timestamp('read_at')->nullable();
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->string('action_url')->nullable()->comment('Related page URL');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('type');
            $table->index('read_at');
            $table->index(['user_id', 'read_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};