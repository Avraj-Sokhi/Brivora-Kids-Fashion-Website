<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('orders', 'return_requested')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->boolean('return_requested')->default(false)->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('orders', 'return_requested')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('return_requested');
            });
        }
    }
};
