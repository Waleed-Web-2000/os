<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\Review;
use App\Models\Logo;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use DB;
use Hash; 
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
 
class MainController extends Controller
{
    public function index() { 
    	$banner = Product::where('status', 'ACTIVE')->latest()->limit(2)->get();
    	$product = Product::first();
    	$categories = Category::where('status', 'ACTIVE')->limit(4)->get();
    	$products = Product::where('status', 'ACTIVE')->latest()->limit(12)->get();  
        return view('/index', compact('products', 'categories', 'banner', 'product'));
    }
    public function shop() { 
      	$products = Product::where('status', 'ACTIVE')->latest()->paginate(20);
        return view('/shop', compact('products'));
    }
    public function about() { 
    	$abouts = Setting::first();  
        return view('/about', compact('abouts'));
    }
    public function contact() {   
    	$contacts = Setting::first();
        return view('/contact', compact('contacts'));
    }
    public function cart() {   
        return view('/cart');
    }
    
    public function product_detail($slug) {   
    	$product = Product::where('slug', $slug)->with(['category', 'reviews'])
	    ->firstOrFail();
	    $rel_product = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)
        ->limit(8)->get();
        $pros = Product::limit(8)->get();
        return view('/product', compact('product', 'rel_product', 'pros'));
    }
    public function category_detail($slug) {   
    	$category = category::where('slug', $slug)->first();
    	$products = Product::where('category_id', $category->id)->where('status', 'ACTIVE')->paginate(10);
        return view('/categories', compact('products', 'category'));
    }
}
