<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'low_stock_threshold',
        'status',
        'category_id',
        'gender_id',
        'image_url',
        'size_chart_url',
    ];

    /**
     * Cast attributes.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'low_stock_threshold' => 'integer',
    ];

    /**
     * Category relationship.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Gender relationship.
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Sizes relationship (many-to-many).
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class)->withTimestamps();
    }

    /**
     * Images relationship.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Cart items relationship.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Order items relationship.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Reviews relationship.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Accessor for formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return '£' . number_format((float) $this->price, 2);
    }

    /**
     * Scope a query to only active products.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to products with low stock.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $threshold
     */
    public function scopeLowStock($query, int $threshold = 5)
    {
        return $query->where('stock_quantity', '<=', $threshold);
    }
}
