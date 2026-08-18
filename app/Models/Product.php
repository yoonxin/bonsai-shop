<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category_id', 'species_id', 'short_description',
        'description', 'is_gift_eligible', 'is_one_of_a_kind', 'status', 'published_at',
    ];

    protected $casts = [
        'is_gift_eligible' => 'boolean',
        'is_one_of_a_kind' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    // Only variants currently purchasable
    public function activeVariants(): HasMany
    {
        return $this->variants()->where('is_active', true)->where('stock_quantity', '>', 0);
    }

    // Scope: Product::active()->get() — published + status active
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active')
                      ->whereNotNull('published_at')
                      ->where('published_at', '<=', now());
    }

    // Cheapest active variant's price — what you show on a product card
    public function getStartingPriceAttribute(): ?int
    {
        return $this->activeVariants()->min('price_cents');
    }
}