<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'thumb_image',
        'images',
        'price',
        'offer_price',
        'quantity',
        'short_description',
        'long_description',
        'sku',
        'status',
        'is_featured',
        'show_at_home',
        'seo_title',
        'seo_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
}
