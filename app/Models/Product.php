<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Many-to-many relation between product and categories
   public function category()
    {
        return $this->belongsTo(Category::class);
    }




    // Get product by slug and load categories and reviews
    public static function getProductBySlug($slug)
    {
        return Product::with(['categories', 'reviews'])->where('slug', $slug)->first();
    }

    // Reviews relation
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    // Cart relation
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    // Casts for specific fields
    protected $casts = [
        'tags' => 'array',
        'images' => 'array',
        'category_names' => 'array',
    ];

    protected static function booted()
{
    static::saved(function ($product) {
        if (!empty($product->category_names)) {
            Log::info('Categories to be attached:', $product->category_names);

            // Detach existing categories
            $product->categories()->detach();

            // Attach new categories
            foreach ($product->category_names as $categorySlug) {
                $normalizedSlug = Str::slug($categorySlug);
                $category = Category::where('slug', $normalizedSlug)->first();
                if ($category) {
                    $product->categories()->attach($category->id);
                    Log::info('Category attached:', [$category->name]);
                } else {
                    Log::warning('Category not found:', [$categorySlug]);
                }
            }
        }
    });
}

}
