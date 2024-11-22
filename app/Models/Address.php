<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'user_id',
        'icon',
        'delivery_area_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
