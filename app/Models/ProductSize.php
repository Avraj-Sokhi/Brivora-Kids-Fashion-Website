<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
        'product_id',
        'size',
        'stock_quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'size_id');
    }

    public function reduceStock($qty)
    {
        // Prevent negative stock
        $newStock = $this->stock_quantity - $qty;

        $this->stock_quantity = max(0, $newStock);
        $this->save();
    }

    public function isLowStock()
    {
        // Adjustable threshold
        return $this->stock_quantity <= 5;
    }

    public function isOutOfStock()
    {
        return $this->stock_quantity <= 0;
    }

    public function restock($qty)
    {
        $this->stock_quantity += $qty;
        $this->save();
    }
}
