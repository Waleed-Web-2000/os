<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row mt-4 text-center">
            <!-- Total Products Card -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                <div class="card text-black bg-primary">
                    <div class="card-header d-flex align-items-center justify-content-center">
                        <i class="fas fa-box mr-2"></i> Total Products
                    </div>
                    <div class="card-body">
                        <h5 class="card-title display-4 font-weight-bold">{{ $productsCount }}</h5>
                        <p class="card-text">Number of products available.</p>
                    </div>
                </div>
            </div>

            <!-- Total Categories Card -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-5">
                <div class="card text-black bg-success">
                    <div class="card-header d-flex align-items-center justify-content-center" >
                        <i class="fas fa-tags mr-2"></i> Total Categories
                    </div>
                    <div class="card-body">
                        <h5 class="card-title display-4 font-weight-bold">{{ $categoriesCount }}</h5>
                        <p class="card-text">Number of categories available.</p>
                    </div>
                </div>
            </div>

            <!-- Total Blogs Card -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3 text-black">
                <div class="card text-black bg-warning" >
                    <div class="card-header d-flex align-items-center justify-content-center">
                        <i class="fas fa-blog mr-2"></i> Total Blogs
                    </div>
                    <div class="card-body">
                        <h5 class="card-title display-4 font-weight-bold">{{ $blogsCount }}</h5>
                        <p class="card-text">Number of blogs published.</p>
                    </div>
                </div>
            </div>

            <!-- Total Buy Now Orders Card -->
            

            <!-- Total Add to Cart Orders Card -->
            
        </div>
            </div>
        </div>
    </div>
</x-app-layout>
