<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Add indexes to cart table for faster lookups
        Schema::table('cart', function (Blueprint $table) {
            if (!$this->indexExists('cart', 'cart_user_id_index')) {
                $table->index('user_id');
            }
            if (!$this->indexExists('cart', 'cart_product_id_index')) {
                $table->index('product_id');
            }
        });

        // Add indexes to orders table
        Schema::table('orders', function (Blueprint $table) {
            if (!$this->indexExists('orders', 'orders_user_id_index')) {
                $table->index('user_id');
            }
            if (!$this->indexExists('orders', 'orders_status_index')) {
                $table->index('status');
            }
        });

        // Add indexes to order_items table
        Schema::table('order_items', function (Blueprint $table) {
            if (!$this->indexExists('order_items', 'order_items_order_id_index')) {
                $table->index('order_id');
            }
            if (!$this->indexExists('order_items', 'order_items_product_id_index')) {
                $table->index('product_id');
            }
        });

        // Add indexes to cart_items table (if it exists separately)
        if (Schema::hasTable('cart_items')) {
            Schema::table('cart_items', function (Blueprint $table) {
                if (!$this->indexExists('cart_items', 'cart_items_user_id_index')) {
                    $table->index('user_id');
                }
                if (!$this->indexExists('cart_items', 'cart_items_product_id_index')) {
                    $table->index('product_id');
                }
            });
        }

        // Add indexes to products for filtering and search
        Schema::table('products', function (Blueprint $table) {
            if (!$this->indexExists('products', 'products_category_id_index')) {
                $table->index('category_id');
            }
            // Only add age_group_id index if column exists
            if (Schema::hasColumn('products', 'age_group_id') && !$this->indexExists('products', 'products_age_group_id_index')) {
                $table->index('age_group_id');
            }
        });

        // Add indexes to addresses
        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                if (!$this->indexExists('addresses', 'addresses_user_id_index')) {
                    $table->index('user_id');
                }
            });
        }
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $indexes = DB::select("SHOW INDEXES FROM $table WHERE Key_name = ?", [$indexName]);
        return count($indexes) > 0;
    }

    public function down(): void
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['product_id']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['order_id']);
            $table->dropIndex(['product_id']);
        });

        if (Schema::hasTable('cart_items')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $table->dropIndex(['user_id']);
                $table->dropIndex(['product_id']);
            });
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category_id']);
            $table->dropIndex(['age_group_id']);
            $table->dropIndex(['is_active']);
        });

        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->dropIndex(['user_id']);
            });
        }
    }
};
