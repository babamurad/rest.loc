<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status', 'order', 'show_at_home', 'parent_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
