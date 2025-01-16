<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Get products by category slug
    public static function getProductByCat($slug)
    {
        return Category::with('products')->where('slug', $slug)->first();
    }

    // Many-to-many relation between category and products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    } 


}
