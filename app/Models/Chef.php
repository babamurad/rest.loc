<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'title',
        'twitter',
        'instagram',
        'linkedin',
        'telegram',
        'pinterest',
        'tiktok',
        'snapchat',
        'whatsapp',
        'email',
        'phone',
        'facebook',
        'imo',
        'show_at_home',
        'status',
    ];

    // Геттер для поля name
    public function getNameAttribute($value)
    {
        //return ucfirst($value); // Преобразует первую букву в заглавную
        return ucwords(strtolower($value)); // Делает каждое слово заглавным
    }
}
