<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('address_id')->constrained('addresses')->onDelete('restrict');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->enum('status', ['processing', 'shipped', 'delivered', 'cancelled', 'returned'])->default('processing');
            $table->string('payment_method', 50)->nullable();
            $table->timestamp('order_date')->useCurrent();
            $table->timestamp('shipped_date')->nullable();
            $table->timestamp('delivered_date')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
            $table->index('order_number');
            $table->index('order_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
