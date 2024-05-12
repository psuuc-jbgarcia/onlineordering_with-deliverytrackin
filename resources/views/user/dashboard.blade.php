<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

        <style>
            body {
                background-color: #f8f9fa; /* Light gray background */
                font-family: 'figtree', sans-serif;
                color: #333;
                padding-top: 40px; /* Add space at the top */
            }

            .container {
                max-width: 1200px;
            }

            .card {
                border: none;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
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
            
            @media (max-width: 768px) {
                .card-img-top {
                    max-height: 200px;
                }
            }

            .product-image {
                max-height: 200px;
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
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($products->where('category', $category) as $product)
                        <div class="col">
                            <div class="card h-100">
                                <img src="./{{ $product->image }}" class="card-img-top product-image" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text">Price: Php{{ $product->price }}</p>
                                    <p class="card-text">Stock: {{ $product->stock }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if($product->stock > 0)
                                        <form action="{{ route('addtocart') }}" method="post" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            
                                            <input type="hidden" name="email" value="{{ session('user_email') }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="img" value="{{ $product->image }}">
                                            <div class="input-group">
                                            <input type="number" id="quantityInput{{ $product->id }}" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control quantity-input" style="width: 70px;">
                                                <button type="submit" class="btn btn-add-to-cart ms-2">Add to Cart</button>
                                            </div>
                                        </form>
                                        <div class="text-end mt-3">
                                        <button type="submit" class="btn btn-buy-now" onclick="buyNow('{{ $product->name }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ $product->id }}')">Buy Now</button>
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

        <!-- Checkout Modal -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-purple text-white">
                        <h5 class="modal-title" id="checkoutModalLabel"><i class="fas fa-shopping-cart me-2 cart-icon"></i> Checkout</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('buynow') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('user_email') }}">
                        <input type="hidden" name="status" value="Pending">
                        <input type="hidden" name="total" id="totalAmountInput" value="0"> <!-- Initial value -->
                        <input type="hidden" name="qty" id="qty">
                        <input type="hidden" name="selected_item_ids" id="selectedItemsIdsInput">
                        <input type="hidden" name="selected_item_names" id="selectedItemsNamesInput">
                        <input type="hidden" id="productIDInput" name="prod_id">
                        <div class="modal-body">
                        <?php
                                $trackingCode = 'TRK' . rand(10000, 99999); 
                                ?>
                            <div class="mb-3">
                                <label for="trackingCode">Tracking Code:</label>
                                <input type="text" class="form-control" id="trackingCode" name="tracking_code" value="{{ $trackingCode }}" readonly>
                            </div>
                            <h5 class="mb-3">Selected Items:</h5>
                            <ul id="selectedItemsList" class="list-group mb-3"></ul>
                            <p class="cart-total">Total Amount: <span id="totalAmount">Php0.00</span></p>
                            <div class="checkout-details">
                                <div class="mb-3">
                                    <label for="paymentMethod" class="form-label"><i class="fas fa-credit-card me-2 icon-purple"></i> Payment Method:</label>
                                    <select class="form-select" id="paymentMethod" name="payment_method">
                                        <option value="Cash on Delivery">Cash on Delivery</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="shippingMethod" class="form-label"><i class="fas fa-truck me-2 icon-purple"></i> Shipping Method:</label>
                                    <select class="form-select" id="shippingMethod" name="shipping_method">
                                        <option value="standard">Standard Shipping (Free)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label"><i class="fas fa-map-marker-alt me-2 icon-purple"></i> Shipping Address:</label>
                                    <textarea class="form-control" id="address" name="address" rows="3">{{ session('address') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label"><i class="fas fa-phone me-2 icon-purple"></i> Phone Number:</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ session('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1 icon-purple"></i> Close</button>
                            <button type="submit" class="btn btn-primary" id="placeOrderBtn"><i class="fas fa-check me-1 icon-purple"></i> Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function showCategory(category) {
                var categories = document.querySelectorAll('.category-products');
                var links = document.querySelectorAll('.category-link');
                categories.forEach(function (category) {
                    category.classList.remove('active');
                });
                links.forEach(function (link) {
                    link.classList.remove('active');
                });
                document.getElementById(category + '-products').classList.add('active');
                document.getElementById(category + '-link').classList.add('active');
            }
            function buyNow(productName, productPrice, productStock, productId) {
                var quantity = $('#quantityInput' + productId).val();
                var totalAmount = parseFloat(productPrice) * parseFloat(quantity); // Calculate total amount
                $('#checkoutModal').modal('show');
                $('#selectedItemsList').html('');
                $('#selectedItemsList').append('<li>' + productName + ' - Quantity: ' + quantity + ' - Php' + totalAmount.toFixed(2) + '</li>');
                $('#totalAmount').text('Php' + totalAmount.toFixed(2));
                $('#totalAmountInput').val(totalAmount.toFixed(2));
                $('#qty').val(quantity);
                $('#selectedItemsIdsInput').val(productId);
                $('#selectedItemsNamesInput').val(productName);
                $('#productIDInput').val(productId);
            }

            if(session('success'))
            $(document).ready(function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your order has been placed successfully.',
                });
            });
           
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
</x-app-layout>
