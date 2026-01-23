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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable();
            $table->string('role')->default('USER'); // UserRole::USER
            $table->boolean('is_active')->default(true);
            $table->string('avatar')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('aadhar_card_front')->nullable();
            $table->string('aadhar_card_back')->nullable();
            $table->enum('apply_status', ['PENDING', 'VERIFIED', 'REJECTED','SUBMITTED'])->nullable();
            $table->text('rejection_reason')->nullable();

            $table->boolean('is_verified')->default(false);
            $table->timestamp('last_login_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'role', 'is_active', 'avatar_url', 'aadhar_card', 'aadhar_card_front', 'aadhar_card_back', 'is_verified', 'apply_status', 'rejection_reason', 'last_login_at']);
        });
    }
};
