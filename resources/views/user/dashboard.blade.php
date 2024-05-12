<x-app-layout>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'figtree', sans-serif;
            color: #333;
            min-height: 80vh; /* Set minimum height to 80% of viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 40px; /* Add space at the top */
        }

        .container {
            max-width: 1200px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.);
            background-color: #fff; /* White background */
            transition: transform 0.3s; /* Smooth transition on hover */
        }

        .card:hover {
            transform: translateY(-10px); /* Move up on hover */
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333; /* Dark text color */
            margin-bottom: 10px;
        }

        .card-text {
            color: #666; /* Medium gray text color */
            margin-bottom: 15px;
        }

        .price {
            color: #8a2be2; /* Violet price color */
            font-weight: bold;
            margin-bottom: 15px;
        }

        .btn-add-to-cart,
        .btn-buy-now {
            background-color: #8a2be2; /* Violet button background */
            border: none;
            color: #fff; /* White button text color */
            transition: background-color 0.3s; /* Smooth transition on hover */
            width: 100%;
        }

        .btn-add-to-cart:hover,
        .btn-buy-now:hover {
            background-color: #6c1cb7; /* Darker violet on hover */
        }
        
        .category-link {
            text-decoration: none;
            color: #000;
            padding: 8px 15px;
            border-radius: 5px;
            margin-right: 10px;
            background-color: #ddd;
            transition: background-color 0.3s;
            min-width: 120px; /* Set minimum width for the tabs */
        }

        .category-link.active {
            background-color: #8a2be2;
            color: #fff;
        }

        .category-link:hover {
            background-color: #ccc;
        }

        .category-products {
            display: none;
        }

        .category-products.active {
            display: block;
        }
    </style>
</head>

<body>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="d-flex justify-content-start">
                    @foreach($products->pluck('category')->unique() as $category)
                    <a class="category-link{{ $loop->first ? ' active' : '' }}" id="{{ $category }}-link" href="javascript:void(0);" onclick="showCategory('{{ $category }}')">{{ $category }}</a>
                    @endforeach
                </div>
            </div>
            @foreach($products->pluck('category')->unique() as $category)
            <div class="col-md-12 mb-4 category-products{{ $loop->first ? ' active' : '' }}" id="{{ $category }}-products">
                <div class="row">
                    @foreach($products->where('category', $category) as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                        <img src="./{{ $product->image }}" class="card-img-top" alt="Product Image" style="max-height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">Price: Php{{ $product->price }}</p>
                                <p class="card-text">Stock: {{ $product->stock }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($product->stock > 0)
                                    <form action="{{ route('addtocart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="email" value="{{ session('user_email') }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="img" value="{{ $product->image }}">
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width: 70px;">
                                            <input type="submit" class="btn btn-add-to-cart ms-2" value="Add to Cart">
                                        </div>
                                    </form>
                                    <div class="text-end mt-3">
                                        <a href="" class="btn btn-buy-now">Buy Now</a>
                                    </div>
                                    @else
                                    <p class="text-danger">Out of Stock</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        function showCategory(category) {
            var categories = document.querySelectorAll('.category-products');
            var links = document.querySelectorAll('.category-link');
            categories.forEach(function(category) {
                category.classList.remove('active');
            });
            links.forEach(function(link) {
                link.classList.remove('active');
            });
            document.getElementById(category + '-products').classList.add('active');
            document.getElementById(category + '-link').classList.add('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

</x-app-layout>
