<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use File; 

class CategoryController extends Controller
{
    public function index()
    {
    	$searchTerm = request()->get('s'); 
        $categories = Category::orWhere('name', 'LIKE', "%$searchTerm%")->latest()->paginate(5);
        return view('admin/category/index')->with(compact('categories'));
    }

    public function create()
    {
    	return view('admin/category/create');
    }

    public function store(Request $request)
    {
    	// Validate the incoming request
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'meta_description' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    	$fileName = null;

    // Handle file upload for the image
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
        $file->move(storage_path('app/public/uploads/category/'), $fileName);
    }

        Category::create([
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['name']),
                'description' => $validatedData['description'] ?? null,
                'meta_description' => $validatedData['meta_description'] ?? null,
                'image' => $fileName,
                'status' => 'ACTIVE',
        ]);
        return redirect()->route('category.all')->with('success', 'Category Created Successfully');
    }

    public function edit($id)
    {
    	$category = Category::findorFail($id);
        return view('admin/category/edit')->with(compact('category'));
    }

public function update($id, Request $request)
{
    // موجودہ زمرہ تلاش کریں
    $category = Category::findOrFail($id);
    $currentImage = $category->image;

    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'meta_description' => 'nullable|string|max:255',
    ]);

    $filename = null
    ;
    
    // Handle file upload if a new image is provided
    if ($request->hasFile('image')) {
        $file = $request->file('image');  
        $filename = md5($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
        $path = storage_path('app/public/uploads/category' . $filename); // Use public_path for the full path
        $file->move(storage_path('app/public/uploads/category'), $filename); // Move the uploaded file to the desired location

        // Delete the old image file if it exists
        if ($currentImage && file_exists(storage_path('app/public/uploads/category/' . $currentImage))) {
            File::delete(storage_path('app/public/uploads/category/' . $currentImage));
        }
    } else {
        $filename = $currentImage; // Keep the current image if no new image is uploaded
    }

     // Update the category with the new data
    $category->update([
        'name' => $validatedData['name'],
        'slug' => Str::slug($validatedData['name']),
        'description' => $validatedData['description'],
        'meta_description' => $validatedData['meta_description'] ?? null,
        'image' => $filename ? $filename : $currentImage, // Set the new or current image
        'status' => 'ACTIVE', // Adjust status as needed
    ]);

    // اگر نئی تصویر اپلوڈ کی گئی ہے تو پرانی تصویر کو مقامی اسٹوریج سے حذف کریں
    if ($filename) {
        File::delete(storage_path('app/public/uploads/category/') . $currentImage);
    }
    
    // زمرہ لسٹنگ پر ری ڈائریکٹ کریں
    return redirect()->route('category.all')->with('success', 'Category Updated Successfully');
}



    public function destroy($id)
    {
    	$category = Category::findorFail($id);
    	$currentImage = $category->category_img;
        $category->delete();
         if ($currentImage && file_exists(storage_path('app/public/uploads/category/' . $currentImage))) {
        File::delete(storage_path('app/public/uploads/category/' . $currentImage));
         }
        File::delete(storage_path('app/public/uploads/category/') . $currentImage);
        return redirect()->route('category.all')->with('success', 'Category Deleted Successfully!');
    }
    public function status($id)
    {
        sleep(1);
        $category = Category::findorFail($id);
        $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $category->update(['status' => $newStatus]);
        return redirect()->route('category.all')->with('success', 'Category Status Changed Succesfully');
    }

    public function export()
    {
        $categories = Category::get(); // Fetch all reviews from the database, including related products

        // Create a streamed response for CSV export
        $response = new StreamedResponse(function() use ($categories) {
            // Open output stream
            $handle = fopen('php://output', 'w');

            // Add the CSV headers matching what is expected during import
            fputcsv($handle, [
                'name', 'slug', 'description', 'image', 'meta_description', 'meta_keywords', 'status', 'created_at', 'updated_at'
            ]);

            // Add data rows for each review
            foreach ($categories as $category) {
                fputcsv($handle, [
                    $category->name,
                    $category->slug, 
                    $category->description,
                    $category->image,
                    $category->meta_description, 
                    $category->meta_keywords, 
                    $category->status, 
                    $category->created_at,
                    $category->updated_at,
                ]);
            }

            // Close the output stream
            fclose($handle);
        });

        // Set CSV headers and return response
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="categories.csv"');

        return $response;
    }

   public function import(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|mimes:csv|max:2048'
        ]); 

        // Open the CSV file
        $file = $request->file('file');
        $handle = fopen($file, 'r');

        // Skip the header row if it exists
        $header = fgetcsv($handle);

        // Read each row from the CSV
        $category = [];
        while (($row = fgetcsv($handle)) !== false) {
            // Assuming CSV columns: name, slug, price, quantity
            $category[] = [
                'name' => $row[0],
                'slug' => $row[1],
                    'description' => $row[2],
                    'image' => $row[3],
                    'meta_description' => $row[4],
                    'meta_keywords' => $row[5],
                    'status' => $row[6],
                    'created_at' => now(),
                    'updated_at' => now(),
            ];
        }

        // Close the file
        fclose($handle);

        // Insert the data into the products table
        Category::insert($category);

        return back()->with('success', 'CSV data imported successfully!');
    }

   

}
