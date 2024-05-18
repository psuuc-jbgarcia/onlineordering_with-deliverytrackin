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
        html{scroll-behavior: smooth;}
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
                        <a class="nav-link" href="#shop">Shop</a>
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
                                <img src="https://i.pinimg.com/236x/b0/9d/ce/b09dce1fbeeec696d0c581cf4cff3163.jpg" alt="Clothes" class="img-fluid">
                                <h4 class="text-center mt-3">Clothes</h4>
                            </a>
                        </div>
                    </div>
                    <!-- Computer Accessories Category -->
                    <div class="col-md-4 mb-4">
                        <div class="product-category">
                            <a href="#">
                                <img src="https://i.pinimg.com/736x/3b/e5/d2/3be5d2c91c64dc240bef81e339c40d8f.jpg" alt="Computer Accessories" class="img-fluid">
                                <h4 class="text-center mt-3">Computer Accessories</h4>
                            </a>
                        </div>
                    </div>
                    <!-- Jewelleries Category -->
                    <div class="col-md-4 mb-4">
                        <div class="product-category">
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQCrRGG62rMOj42fnKM1xWE-uOu1BpkFQwTWhecRGtBw&s" alt="Jewelleries" class="img-fluid">
                                <h4 class="text-center mt-3">Jewelleries</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5">
      
    </div>
<!-- Online Shopping Section -->
<div class="container-fluid online-shopping" id="shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Online Shopping</h2>
                <p>Discover our latest arrivals and promotions for online shopping.</p>
            </div>
        </div>
        <div class="row">
            <!-- Product 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSQvIKs9AAC2dT0UQzPYuXdtjBdS1os4_FsJQXz3B3ol8kpbQty37IzUviBERbxemvLE8w9SvwbwwL0kQTeiMo9tOR4jqWIilYO1dq4AzU&usqp=CAE" class="card-img-top" alt="Trendy Dresses">
                    <div class="card-body" style="height: 250px;">
                        <h5 class="card-title">New Arrivals: Trendy Dresses</h5>
                        <p class="card-text">Explore our latest collection of trendy dresses. Perfect for any occasion!</p>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFFI_LrokfBBee6mlnZN-spyDvZbBzDt3TP0RHba2cfA&s" class="card-img-top" alt="Footwear">
                    <div class="card-body" style="height: 250px;">
                        <h5 class="card-title">Exclusive Offer: Footwear</h5>
                        <p class="card-text">Get exclusive discounts on our latest footwear collection. Limited time offer!</p>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://images.saymedia-content.com/.image/t_share/MjAyNjY5Nzk4NzMwMTE0MDYw/elevate-your-look-the-ultimate-guide-to-chic-fashion-accessories.png" class="card-img-top" alt="Accessories">
                    <div class="card-body" style="height: 250px;">
                        <h5 class="card-title">Accessorize Your Look</h5>
                        <p class="card-text">Discover our latest accessories to complement your style.</p>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



\
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
                    <p>&copy; 2024 E-Commerce Store. Jekkong All rights reserved.</p>
                </div>
            </div>0
        </div>
    </footer>
    <script>
window.embeddedChatbotConfig = {
chatbotId: "DaRKCON9cGg_5Bjyy8ZMA",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="DaRKCON9cGg_5Bjyy8ZMA"
domain="www.chatbase.co"
defer>
</script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
