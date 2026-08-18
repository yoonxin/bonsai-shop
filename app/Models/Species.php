<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Species extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_name', 'botanical_name', 'slug', 'light_requirement',
        'indoor_outdoor', 'watering_frequency', 'hardiness_zone',
        'is_beginner_friendly', 'care_summary',
    ];
    protected $casts = [
        'is_beginner_friendly' => 'boolean',
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}