<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);  // Length set for longer product names
            $table->string('slug', 255);  // Increased slug length
            $table->UnsignedInteger('category_id')->nullable();  // Updated to handle large IDs
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('quantity');
            $table->string('tags', 500)->nullable();  
            $table->string('image', 255);  
            $table->json('gallery_images')->nullable();  
            $table->text('description')->nullable();  
            $table->text('meta_description')->nullable(); 
            $table->string('status', 20)->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
