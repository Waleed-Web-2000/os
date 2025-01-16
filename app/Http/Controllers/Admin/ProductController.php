<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use File;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
    	$searchTerm = request()->get('s');
        $products = Product::with('category') // Eager load the category relationship
	    ->where('name', 'LIKE', "%$searchTerm%") // Use where instead of orWhere if searching in one column
	    ->latest() // Order by latest
	    ->paginate(30); 
        return view('admin/product/index')->with(compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin/product/create')->with(compact('categories'));
    }

public function store(Request $request) 
{
    // Validate incoming request
    $validatedData = $request->validate([
        'category_id' => 'nullable',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'quantity' => 'required|integer',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_images' => 'nullable|array',
        'tags' => 'nullable|string',
        'meta_description' => 'required|string|max:255',
    ]);

    // Handle file upload for the main image
    $fileName = null;
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = md5($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
        $file->move(storage_path('app/public/uploads/product/'), $fileName); // Use public_path for better practice
    }

    // Handle gallery images (if any)
    $galleryImages = [];
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $image) {
            // Generate a unique name for each gallery image
            $galleryFilename = md5($image->getClientOriginalName()) . time() . "." . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/uploads/product/'), $galleryFilename); // Move the image with a unique name
            $galleryImages[] = $galleryFilename; // Store the filename
        }
    }


    // Process tags and meta keywords
    $tagsArray = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];

    // Create the product
    $product = Product::create([
        'category_id' => $validatedData['category_id'],
        'name' => $validatedData['name'],
        'slug' => Str::slug($validatedData['name']),
        'price' => $validatedData['price'],
        'sale_price' => $validatedData['sale_price'] ?? null,
        'quantity' => $validatedData['quantity'],
        'description' => $validatedData['description'],
        'image' => $fileName,
        'gallery_images' => json_encode($galleryImages),
        'tags' => json_encode($tagsArray),
        'meta_description' => $validatedData['meta_description'],
        'status' => 'ACTIVE',
    ]);

    // Redirect after successful product creation
    return redirect()->route('product.all')->with('success', 'Product Created Successfully!');
}

 
    

    public function edit($id)
    {
    	$product = Product::findorFail($id);
    	$categories = Category::get();
        return view('admin/product/edit')->with(compact('product', 'categories'));
    }

    public function update(Request $request, $id)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'category_id' => 'nullable',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'quantity' => 'required|integer',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_images' => 'nullable|array',
        'tags' => 'nullable|string',
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);
    $currentImage = $product->image;
    $fileName = $currentImage;

     if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
        $file->move(storage_path('app/public/uploads/product/'), $fileName);
        
        // Delete old main image if it exists
        if ($currentImage && file_exists(storage_path('app/public/uploads/product/' . $currentImage))) {
            unlink(storage_path('app/public/uploads/product/' . $currentImage));
        }
    }

   // Handle gallery images
    $galleryImages = [];
    if ($request->hasFile('gallery_images')) {
        // Decode and delete old gallery images if any new ones are uploaded
        $existingGalleryImages = json_decode($product->gallery_images, true) ?? [];
        foreach ($existingGalleryImages as $image) {
            $imagePath = storage_path('app/public/uploads/product/' . basename($image));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Upload and save new gallery images
        foreach ($request->file('gallery_images') as $image) {
            $galleryFilename = md5($image->getClientOriginalName()) . time() . "." . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/uploads/product/'), $galleryFilename);
            $galleryImages[] = $galleryFilename;
        }
        $product->gallery_images = json_encode($galleryImages);
    } else {
        // If no new gallery images are uploaded, retain existing ones
        $galleryImages = json_decode($product->gallery_images, true);
    }

    // Update other fields
    $product->category_id = $validatedData['category_id'];
    $product->name = $validatedData['name'];
    $product->slug = Str::slug($validatedData['name']);
    $product->price = $validatedData['price'];
    $product->sale_price = $validatedData['sale_price'] ?? null; // If sale price is nullable, ensure it's handled properly
    $product->quantity = $validatedData['quantity'];
    $product->image = $fileName;
    $product->gallery_images = json_encode($galleryImages);
    $product->description = $validatedData['description'];
    $product->meta_description = $request->meta_description;
    $product->tags = json_encode(array_map('trim', explode(',', $request->tags ?? ''))); // Process tags into an 
    $product->status = 'ACTIVE';
    $product->save();

    // Redirect after successful product update
    return redirect()->route('product.all')->with('success', 'Product Updated Successfully!');
}


    public function destroy($id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Check if the main image exists and delete it from S3
    if (!empty($product->image)) {
        $mainImagePath = storage_path('app/public/uploads/product/' . $product->image);
        if (File::exists($mainImagePath)) {
            File::delete($mainImagePath);
        }
    }

    // Check if the gallery images exist and delete them from storage
    if (!empty($product->gallery_images)) {
        $galleryImages = json_decode($product->gallery_images);
        foreach ($galleryImages as $image) {
            $galleryImagePath = storage_path('app/public/uploads/product/' . $image);
            if (File::exists($galleryImagePath)) {
                File::delete($galleryImagePath);
            }
        }
    }

    // Delete the product from the database
    $product->delete();

    // Redirect back with a success message
    return redirect()->route('product.all')->with('success', 'Product deleted successfully!');
}

    public function status($id)
    {
        $book = Product::findorFail($id);
        $newStatus = ($book->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $book->update(['status' => $newStatus]);
        return redirect()->route('product.all')->with('success', 'Product Status Changed Succesfully');
    }
    
    public function export()
    {
        $products = Product::get(); // Fetch all reviews from the database, including related products

        // Create a streamed response for CSV export
        $response = new StreamedResponse(function() use ($products) {
            // Open output stream
            $handle = fopen('php://output', 'w');

            // Add the CSV headers matching what is expected during import
            fputcsv($handle, [
               'name', 'slug', 'category_names', 'price', 'sale_price', 'quantity', 'tags', 'image', 'gallery_images', 'description', 'meta_description', 'meta_keywords', 'status', 'created_at', 'updated_at'
            ]);

            // Add data rows for each review
            foreach ($products as $product) {
                fputcsv($handle, [
                    $product->name,
                    $product->slug, 
                    $product->category_names, 
                    $product->price, 
                    $product->sale_price, 
                    $product->quantity, 
                    $product->tags, 
                    $product->image,
                    $product->gallery_images,
                    $product->description,
                    $product->meta_description, 
                    $product->meta_keywords, 
                    $product->status,
                    $product->created_at,
                    $product->updated_at,
                ]);
            }

            // Close the output stream
            fclose($handle);
        });

        // Set CSV headers and return response
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="products.csv"');

        return $response;
    }
public function import(Request $request)
{
    // Validate the file
    $request->validate([
        'file' => 'required|mimes:csv,txt|max:2048'
    ]);

    // Open the CSV file
    $file = $request->file('file');
    $handle = fopen($file, 'r');

    // Skip the header row if it exists
    $header = fgetcsv($handle);

    // Initialize an empty array for gallery images
    $products = [];
    $sale_price = $request->sale_price !== null ? $request->sale_price : null;

    // Read each row from the CSV
    while (($row = fgetcsv($handle)) !== false) {
        // Assuming CSV columns: name, slug, price, quantity, gallery_images...
        
        // Clean up the gallery_images string
        $galleryImagesString = $row[8]; // Assuming column 8 contains the gallery images as a string
        
        // Remove unnecessary escape characters or extra quotes
        $galleryImagesString = str_replace(['\"', '"'], '', $galleryImagesString);  // Remove escaped quotes
        $productImagesArray = explode(',', $galleryImagesString);  // Split by comma
        
        // Now, handle the gallery images correctly
        $galleryImages = json_encode($productImagesArray);  // Convert to JSON array

        // Handle the category (check if exists or create new)
        $categoryNames = explode(',', $row[2]); // Assuming category names are comma-separated
        $categoryIds = [];
        
       foreach ($categoryNames as $categoryName) {
    // Trim any spaces before or after the name
    $categoryName = trim($categoryName);
    
    // Check if the category exists, otherwise create it with a slug
    $category = Category::firstOrCreate(
    ['name' => $categoryName],
    [
        'slug' => Str::slug($categoryName),
        'image' => 'no-img.jpg',
        'status' => 'ACTIVE'
    ]
);


    // Store the category ID
    $categoryIds[] = $category->name;
}


        // Store the product data
        $products[] = [
            'name' => $row[0],
            'slug' => Str::slug($row[0]),
            'category_names' => json_encode($categoryIds),  // Store the category IDs as a JSON array
            'price' => $row[3],
            'sale_price' => $sale_price,
            'quantity' => $row[5],
            'tags' => $row[6],
            'image' => $row[7],
            'gallery_images' => $galleryImages, 
            'description' => $row[9],
            'meta_description' => $row[10],
            'meta_keywords' => $row[11],
            'status' => $row[12],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Close the file
    fclose($handle);

    // Insert the data into the products table
    Product::insert($products);

    return back()->with('success', 'CSV data imported successfully!');
}


}
