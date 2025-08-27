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
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique()->comment('Auto-generated request number');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('laboratory_id')->constrained()->onDelete('cascade');
            $table->datetime('start_datetime');
            $table->datetime('end_datetime');
            $table->text('purpose');
            $table->string('jsa_document')->nullable()->comment('Job Safety Analysis PDF path');
            $table->enum('status', [
                'draft',
                'submitted',
                'awaiting_lecturer_approval',
                'awaiting_lab_approval',
                'approved',
                'rejected',
                'checked_out',
                'returned',
                'overdue',
                'cancelled'
            ])->default('draft');
            $table->foreignId('lecturer_supervisor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('lecturer_approved_at')->nullable();
            $table->text('lecturer_notes')->nullable();
            $table->foreignId('lab_approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('lab_approved_at')->nullable();
            $table->text('lab_notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->datetime('checked_out_at')->nullable();
            $table->foreignId('checked_out_by')->nullable()->constrained('users')->onDelete('set null');
            $table->datetime('returned_at')->nullable();
            $table->foreignId('returned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->json('checkout_condition_notes')->nullable();
            $table->json('return_condition_notes')->nullable();
            $table->json('checkout_photos')->nullable();
            $table->json('return_photos')->nullable();
            $table->decimal('fine_amount', 10, 2)->default(0);
            $table->text('fine_reason')->nullable();
            $table->timestamps();
            
            $table->index('request_number');
            $table->index('user_id');
            $table->index('status');
            $table->index('laboratory_id');
            $table->index(['status', 'created_at']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
    }
};