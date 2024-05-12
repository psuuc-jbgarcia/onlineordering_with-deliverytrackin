<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Our E-Commerce Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #8e44ad !important;
        }
        .navbar-brand {
            color: #ffffff !important;
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            color: #ffffff !important;
        }
        .footer {
            background-color: #333;
            color: #ffffff;
            padding: 40px 0;
        }
        .footer .footer-links a {
            color: #ffffff;
            margin-right: 20px;
        }
        .feature-icon {
            font-size: 3rem;
            color: #3498db;
        }
        .feature-title {
            font-size: 1.5rem;
            color: #3498db;
        }
        .product-category {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .product-category img {
            border-radius: 10px;
        }
        .section-title {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #333;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        .product-card:hover {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .product-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .product-card .card-body {
            padding: 20px;
        }
        .product-card .card-title {
            font-size: 1.2rem;
        }
        .product-card .card-text {
            color: #666;
        }
        .promo-section {
            background-color: #f39c12;
            color: #333;
            padding: 80px 0;
            text-align: center;
        }
        .promo-section h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }
        .promo-section p {
            font-size: 1.2rem;
        }
        .featured-section {
            background-color: #ecf0f1;
            padding: 80px 0;
            text-align: center;
        }
        .featured-section h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #333;
        }
        .featured-section .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .featured-section .card img {
            border-radius: 10px 10px 0 0;
        }
        .featured-section .card-body {
            padding: 20px;
        }
        .featured-section .card-title {
            font-size: 1.5rem;
            color: #333;
        }
        .featured-section .card-text {
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">E-Commerce Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="ml-auto">
                    <a href="{{ route('login') }}" class="btn btn-light mr-2">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-light">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 text-center text-dark">
                <h1 class="display-4">Welcome to Jekkong Online Ordering Website</h1>
                <p class="lead">Discover the latest trends and shop our wide range of products.</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <!-- Clothes Category -->
                    <div class="col-md-4 mb-4">
                        <div class="product-category">
                            <a href="#">
                                <img src="https://www.pinterest.com/pin/765541636666277710/" alt="Clothes" class="img-fluid">
                                <h2 class="text-center mt-3">Clothes</h2>
                            </a>
                        </div>
                    </div>
                    <!-- Computer Accessories Category -->
                    <div class="col-md-4 mb-4">
                        <div class="product-category">
                            <a href="#">
                                <img src="https://via.placeholder.com/400x300" alt="Computer Accessories" class="img-fluid">
                                <h3 class="text-center mt-3">Computer Accessories</h3>
                            </a>
                        </div>
                    </div>
                    <!-- Jewelleries Category -->
                    <div class="col-md-4 mb-4">
                        <div class="product-category">
                            <a href="#">
                                <img src="https://via.placeholder.com/400x300" alt="Jewelleries" class="img-fluid">
                                <h2 class="text-center mt-3">Jewelleries</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5">
      
    </div>

<!-- Latest News Section -->
<div class="container-fluid latest-news">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Latest News</h2>
                <p>Stay updated with our latest news and promotions.</p>
            </div>
        </div>
        <div class="row">
            <!-- News 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">New Arrival: Spring Collection</h5>
                        <p class="card-text">Check out our latest Spring Collection. Get trendy outfits at amazing prices!</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- News 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Summer Sale - Up to 50% Off</h5>
                        <p class="card-text">Enjoy huge discounts on our summer collection. Limited time offer!</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- News 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Get Ready for Fall: New Accessories</h5>
                        <p class="card-text">Explore our latest accessories to complete your fall look.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Featured Section -->
    <div class="container featured-section">
        <h2>Discover New Trends</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Trend 1</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Trend 2</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Trend 3</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="container py-5 bg-light">
        <h2 class="text-center mb-4 section-title">Why Choose Us</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="fas fa-truck feature-icon mb-3"></i>
                <h3 class="feature-title">Fast Delivery</h3>
                <p>Get your orders delivered quickly with our fast shipping service.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fas fa-headphones-alt feature-icon mb-3"></i>
                <h3 class="feature-title">24/7 Customer Support</h3>
                <p>Our dedicated support team is available 24/7 to assist you with any queries.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fas fa-lock feature-icon mb-3"></i>
                <h3 class="feature-title">Secure Checkout</h3>
                <p>Shop with confidence knowing your transactions are secure.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h4 class="mb-4">Follow Us</h4>
                    <div class="footer-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>&copy; 2024 E-Commerce Store. All rights reserved.</p>
                </div>
            </div>0
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
