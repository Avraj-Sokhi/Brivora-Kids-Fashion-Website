<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            // Only add gender_id index if column exists
            if (Schema::hasColumn('products', 'gender_id') && !$this->indexExists('products', 'products_gender_id_index')) {
                $table->index('gender_id');
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
        if (!Schema::hasTable($table)) {
            return false;
        }

        try {
            $indexes = Schema::getConnection()->getSchemaBuilder()->getIndexes($table);

            foreach ($indexes as $index) {
                $name = is_array($index)
                    ? ($index['name'] ?? $index['index_name'] ?? null)
                    : ($index->name ?? null);

                if ($name === $indexName) {
                    return true;
                }
            }
        } catch (\Throwable $e) {
            return false;
        }

        return false;
    }

    private function dropIndexIfExists(Blueprint $table, string $tableName, string $indexName): void
    {
        if ($this->indexExists($tableName, $indexName)) {
            $table->dropIndex($indexName);
        }
    }

    public function down(): void
    {
        Schema::table('cart', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'cart', 'cart_user_id_index');
            $this->dropIndexIfExists($table, 'cart', 'cart_product_id_index');
        });

        Schema::table('orders', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'orders', 'orders_user_id_index');
            $this->dropIndexIfExists($table, 'orders', 'orders_status_index');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'order_items', 'order_items_order_id_index');
            $this->dropIndexIfExists($table, 'order_items', 'order_items_product_id_index');
        });

        if (Schema::hasTable('cart_items')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $this->dropIndexIfExists($table, 'cart_items', 'cart_items_user_id_index');
                $this->dropIndexIfExists($table, 'cart_items', 'cart_items_product_id_index');
            });
        }

        Schema::table('products', function (Blueprint $table) {
            $this->dropIndexIfExists($table, 'products', 'products_category_id_index');
            $this->dropIndexIfExists($table, 'products', 'products_gender_id_index');
        });

        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                $this->dropIndexIfExists($table, 'addresses', 'addresses_user_id_index');
            });
        }
    }
};
