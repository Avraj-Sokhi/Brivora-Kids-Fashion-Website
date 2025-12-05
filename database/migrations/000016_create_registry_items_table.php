<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registry_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registry_id')->constrained('gift_registries')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity_requested');
            $table->integer('quantity_purchased')->default(0);
            $table->enum('priority', ['high', 'medium', 'low'])->default('medium');
            $table->timestamps();

            $table->index('registry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registry_items');
    }
};
