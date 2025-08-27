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
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_id')->nullable()->after('email')->comment('Student/Staff ID number');
            $table->enum('role', ['admin', 'head_of_lab', 'lab_assistant', 'lecturer', 'student'])->default('student')->after('password');
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending')->after('role');
            $table->string('phone')->nullable()->after('status');
            $table->string('department')->nullable()->after('phone');
            $table->string('faculty')->default('Faculty of Engineering')->after('department');
            $table->text('address')->nullable()->after('faculty');
            $table->json('assigned_labs')->nullable()->after('address')->comment('Lab IDs for lab assistants/head of labs');
            $table->string('supervisor_lecturer_id')->nullable()->after('assigned_labs')->comment('Default supervisor for students');
            $table->timestamp('approved_at')->nullable()->after('email_verified_at');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
            $table->text('rejection_reason')->nullable()->after('approved_by');
            
            // Email uniqueness is already handled by the original migration
            $table->index('role');
            $table->index('status');
            $table->index('student_id');
            $table->index(['role', 'status']);
            
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropIndex(['role', 'status']);
            $table->dropIndex(['student_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['role']);
            // Email uniqueness remains with original migration
            
            $table->dropColumn([
                'student_id',
                'role',
                'status',
                'phone',
                'department',
                'faculty',
                'address',
                'assigned_labs',
                'supervisor_lecturer_id',
                'approved_at',
                'approved_by',
                'rejection_reason'
            ]);
        });
    }
};