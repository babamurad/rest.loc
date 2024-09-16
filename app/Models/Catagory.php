<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status', 'order', 'show_at_home', 'parent_id'];
}
