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
        Schema::create('verification_codes_from_admin', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('code', 6);
            $table->enum('type', ['admin', 'staff']); // Chỉ cho admin tạo tài khoản
            $table->unsignedBigInteger('role_id'); // Lưu role_id để assign sau khi verify
            $table->string('created_by_admin_id')->nullable(); // ID của admin tạo
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index(['email', 'code', 'type']);
            $table->index(['role_id']);
            $table->index(['created_by_admin_id']);

            // Foreign key constraints
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_codes_from_admin');
    }
};
