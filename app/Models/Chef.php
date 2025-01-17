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
}
