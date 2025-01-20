<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'title', 'review', 'rating', 'status', 'show_at_home', 'sort_order'];
}
