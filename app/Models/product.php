<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Product extends Model
{
    use HasFactory;

    // Define which fields can be mass-assigned
    protected $fillable = ['title', 'description', 'price', 'quantity', 'category', 'image'];
}
