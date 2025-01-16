<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AssignCategoriesToProducts extends Command
{
    protected $signature = 'assign:categories';

    protected $description = 'Assign categories to products based on category_names';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $batchSize = 100; // Process products in batches to avoid memory issues
        $products = Product::query();

        $products->chunk($batchSize, function ($products) {
            foreach ($products as $product) {
                if (!empty($product->category_names)) {
                    // Handle different types (string or array)
                    $categoryNames = is_array($product->category_names)
                        ? $product->category_names
                        : array_map('trim', explode(',', $product->category_names));

                    foreach ($categoryNames as $categoryName) {
                        $slug = \Str::slug($categoryName); // Create a slug for the category
                        $category = Category::where('slug', $slug)->first();

                        if (!$category) {
                            // Create the category if it doesn't exist
                            try {
                                $category = Category::create([
                                    'title' => $categoryName,
                                    'slug' => $slug,
                                    'description' => "Description for {$categoryName}", // Optional description
                                    'image' => 'no-img.jpg',
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);

                                $this->info("Category '{$categoryName}' created.");
                            } catch (\Exception $e) {
                                $this->error("Error creating category '{$categoryName}': " . $e->getMessage());
                                continue;
                            }
                        }

                        // Assign category to product
                        try {
                            DB::table('category_product') // Replace with your pivot table name
                                ->updateOrInsert(
                                    ['product_id' => $product->id, 'category_id' => $category->id],
                                    ['created_at' => now(), 'updated_at' => now()]
                                );
                        } catch (\Exception $e) {
                            $this->error("Error assigning category '{$categoryName}' to product '{$product->id}': " . $e->getMessage());
                        }
                    }
                }
            }
        });

        $this->info('All categories have been assigned to products successfully.');
    }
}
