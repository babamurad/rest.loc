<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'subtitle', 'offer', 'image', 'button_link', 'sort_order', 'status'];

    public function scopeStatus($query)
    {
        return $query->where('status', true);
    }
}
