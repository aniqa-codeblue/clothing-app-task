<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'quantity', 'size', 'color', 'images'];

    protected $casts = [
        'size' => 'array',
        'color' => 'array',
        'images' => 'array',
    ];
}
