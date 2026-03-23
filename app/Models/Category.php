<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель Category.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $status
 * @property int $order
 * @property bool $show_at_home
 * @property int|null $parent_id
 */
class Category extends Model
{
    use HasFactory;

    /**
     * Атрибуты, доступные для массового присвоения.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'slug', 'status', 'order', 'show_at_home', 'parent_id'];

    /**
     * Получить продукты, связанные с категорией.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    /**
     * Получить родительскую категорию.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Получить дочерние категории.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}

