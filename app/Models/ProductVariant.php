<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{

    use HasFactory;

    protected $fillable = [
        'product_id', 'sku', 'size_label', 'age_years', 'pot_type',
        'price_cents', 'stock_quantity', 'shipping_weight_lbs',
        'shipping_profile', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'shipping_weight_lbs' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Convenience accessor: $variant->price → "$89.00"
    public function getPriceAttribute(): string
    {
        return '$' . number_format($this->price_cents / 100, 2);
    }

    public function inStock(): bool
    {
        return $this->is_active && $this->stock_quantity > 0;
    }
}