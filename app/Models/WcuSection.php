<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WcuSection extends Model
{
    use HasFactory;
    protected $fillable = ['icon', 'title', 'description', 'status', 'order'];

    public function scopeStatus($query)
    {
        return $query->where('status', true);
    }
}
