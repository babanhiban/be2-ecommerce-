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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // 🔗 Liên kết đến users
            $table->string('tennguoinhan');
            $table->string('sdt')->nullable();
            $table->text('diachi')->nullable();
            $table->decimal('tongtien', 15, 2)->nullable();
            $table->string('trangthai')->default('Chờ xử lý');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
