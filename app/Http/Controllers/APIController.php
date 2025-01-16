<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Browser;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\BuyOrder;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;






class APIController extends Controller
{

	// HOME PAGE // 

	public function HomeBannerProduct()
    {
        $result = Banner::limit(3)->get();
    	return $result;
    }

    public function HomeProduct()
    {
        $result = Product::with('categories', 'reviews')->get();
    	return $result;
    }

    public function HomeBlog()
    {
    	$result = Blog::limit(2)->get();
    	return $result;
    }

    public function Setting()
    {
    	$result = Setting::get();
    	return $result;
    } 

    public function Categories()
    {
        $result = Category::get();
        return $result;
    }


    // END HOME PAGE //

public function Checkout(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'items' => 'required|array',  // Ensure that 'items' is an array
        'items.*.product_id' => 'required|exists:products,id', // Ensure that product_id exists in the products table
        'items.*.quantity' => 'required|integer|min:1', // Ensure each item has a quantity greater than 0
        'items.*.price' => 'required|numeric|min:0', // Ensure that price is provided for each item
        'name' => 'required|string',
        'address' => 'required|string',
        'phone' => 'required|string',
        'city' => 'required|string',
        'note' => 'nullable|string',
        'total_amount' => 'required|numeric|min:0', // Total amount sent from the frontend
    ]);

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Create a new order record in the database
        $order = Order::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'note' => $validated['note'],
            'total_amount' => $validated['total_amount'],  // The total amount sent from the frontend
        ]);

        // Loop through each item and save it to the order_items table
        foreach ($validated['items'] as $item) {
            // Calculate total item price: quantity * price
            $item_total_price = $item['quantity'] * $item['price'];

            // Create an order item
            OrderItem::create([
                'order_id' => $order->id,  // Reference to the order
                'product_id' => $item['product_id'],  // Product ID from the request
                'quantity' => $item['quantity'],  // Quantity from the request
                'price' => $item['price'],  // Price from the request (item price)
                'total_price' => $item_total_price,  // Calculate total price for each item
            ]);
        }

        // Commit the transaction
        DB::commit();

        // Respond with success
        return response()->json(['message' => 'Order placed successfully', 'order' => $order]);

    } catch (\Exception $e) {
        // Rollback the transaction in case of error
        DB::rollBack();

        // Log the error
        \Log::error('Order creation failed: ' . $e->getMessage());

        return response()->json(['error' => 'Order failed', 'message' => $e->getMessage()], 500);
    }
}
 
public function buyNow(Request $request)
{
    // Validate request
    $validator = Validator::make($request->all(), [
        'product_id' => 'required|exists:products,id',
        'product_price' => 'required|numeric',
        'total_price' => 'required|numeric',
        'name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'address' => 'required|string|max:500',
        'qty' => 'required|integer|min:1',
        'phone' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
    }

    // Fetch the product details
    $product = Product::find($request->product_id);

    if (!$product) {
        return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
    }

    if ($product->quantity < $request->qty) {
        return response()->json(['status' => 'error', 'message' => 'Insufficient stock available'], 400);
    }

    // Create an order
    $order = BuyOrder::create([
        'product_id' => $product->id,
        'name' => $request->name,
        'city' => $request->city,
        'address' => $request->address,
        'phone' => $request->phone,
        'note' => $request->note,
        'quantity' => $request->qty,
        'price' => $request->product_price, // Corrected the variable
        'total_price' => $request->total_price,
    ]);

    // Reduce the product quantity
    $product->decrement('quantity', $request->qty);

    // Return success response
    return response()->json(['status' => 'success', 'message' => 'Order placed successfully', 'order' => $order], 200);
}

public function ReviewSubmit(Request $request)
{
    // Validate request
    $validator = Validator::make($request->all(), [
        'product_id' => 'required|exists:products,id', // Ensuring product exists
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'review' => 'required|string|max:1000',
        'rating' => 'required|integer|min:1|max:5',  // Rating should be between 1 and 5
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
    }

    // Fetch the product details
    $product = Product::find($request->product_id);

    if (!$product) {
        return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
    }

    // Create a review
    $review = Review::create([
        'product_id' => $product->id,
        'name' => $request->name,
        'email' => $request->email,
        'review' => $request->review,
        'rating' => $request->rating,  // Store the rating
    ]);

    // Return success response
    return response()->json(['status' => 'success', 'message' => 'Review submitted successfully', 'data' => $review], 200);
}
    
    // SHOP PAGE //

    public function ShopProduct()
    {
    	$result = Product::all();
    	return $result;
    }

    // END SHOP PAGE //
    
    // PRODUCT DETAIL PAGE //

 public function SingleProduct($productSlug)
{
    // Get product by ID and load category and reviews
    $result = Product::with('categories', 'reviews') 
        ->where('slug', $productSlug)
        ->get();
    return $result;
}



    // END PRODUCT DETAIL PAGE //

    // USEFUL POLICIES PAGE //
    // END USEFUL POLICIES PAGE //

    // CATEGORY PAGE // 

   public function CategoryPage($categorySlug)
{
    // Find the category by slug
    $category = Category::where('slug', $categorySlug)->first();

    if (!$category) {
        // If the category doesn't exist, return an error response
        return response()->json(['error' => 'Category not found'], 404);
    }

    // Fetch products that belong to the category
    $result = Product::whereHas('categories', function ($query) use ($category) {
        $query->where('categories.id', $category->id); // Explicitly reference 'categories.id'
    })->with(['categories', 'reviews'])->get();

    return response()->json($result); // Return the products as a JSON response
}





    // END CATEGORY PAGE //

    // BLOG DETAIL PAGE //

    public function BlogPage($blogID)
    {
    	$id = $blogID;
    	$result = Blog::where('slug', $id)->get();
    	return $result;
    }
     public function BlogReviews()
    {
    	$result = Review::get();
    	return $result;
    }

    // END BLOG DETAIL PAGE //
}
