<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'slug',
    'category_id',
    'price',
    'description',
    'image',
    'rarity',
    'quality',
    'stattrak',
];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // На всякий випадок — якщо забудемо заповнити slug
    protected static function booted()
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
