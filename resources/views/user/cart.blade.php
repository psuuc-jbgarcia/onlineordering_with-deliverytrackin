<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            body {
                background-color: #f8f9fa; /* Light gray background */
                font-family: Arial, sans-serif;
                color: #333;
                padding-top: 40px; /* Add space at the top */
            }

            .card {
                border: none;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                background-color: #fff; /* White background */
                margin-bottom: 20px;
            }

            .card-body {
                padding: 20px;
            }

            .card-title {
                font-size: 1.2rem;
                font-weight: bold;
                color: #333; /* Dark title color */
                margin-bottom: 10px;
            }

            .card-text {
                color: #666; /* Medium gray text color */
                margin-bottom: 5px;
            }

            .price {
                color: #8a2be2; /* Violet price color */
                font-weight: bold;
            }

            .btn-remove {
                background-color: #dc3545; /* Red remove button */
                border: none;
                color: #fff; /* White button text color */
                margin-top: 10px;
            }

            .btn-remove:hover {
                background-color: #c82333; /* Darker red on hover */
            }

            .btn-checkout {
                background-color: #8a2be2; /* Violet checkout button */
                border: none;
                color: #fff; /* White button text color */
            }

            .btn-checkout:hover {
                background-color: #6c1cb7; /* Darker violet on hover */
            }

            .product-img {
                max-width: 100%;
                max-height: 200px; /* Adjust as needed */
                object-fit: cover;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }

            .cart-item {
                padding: 20px;
            }

            .cart-total {
                font-size: 1.2rem;
                font-weight: bold;
                margin-top: 20px;
            }

            .checkout-details {
                margin-top: 20px;
            }

            .modal-body ul {
                padding-left: 20px;
            }
            .cart-icon {
                color: #fff;
            }

            .icon-purple {
                color: #8a2be2; /* Violet color */
            }

            .empty-cart {
                text-align: center;
                margin-top: 20px;
                font-size: 1.2rem;
                font-weight: bold;
                color: #666;
            }

        </style>
    </head>

    <body>
        <br>
        <br>
        <br>
        <br>
        <div class="container">
            @isset($fetch)
            @if(count($fetch) > 0)
            <div class="row row-cols-1 row-cols-md-3 g-4"> <!-- Changed col classes to make smaller cards -->
                @foreach($fetch as $item)
                <div class="col mb-4">
                    <div class="card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ44MnDnjIkQdn1K0Q-Jbakvk7Ud-w3UZUou3NJjA2t16A79p4cCr3lMrs958wuOpCm_tw&usqp=CAU" class="card-img-top product-img" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">Quantity: {{ $item->quantity }}</p>
                            <p class="card-text price">Total Price: Php{{ number_format($item->price * $item->quantity, 2) }}</p> <!-- Calculated total price -->
                            <div class="form-check">
                                <input class="form-check-input addToCheckout" type="checkbox" value="{{ $item->price * $item->quantity }}" data-id="{{ $item->prod_id }}" name="items[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Add to Checkout
                                </label>
                            </div>
                            <input type="hidden" name="ids" value="{{ $item->id }}">
                            <form action="{{ route('removeitem',$item->id ) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-remove">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <button type="button" class="btn btn-checkout" id="checkoutBtn">Proceed to Checkout</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clearCartModal">Clear Cart</button>
            </div>
            @else
            <p class="empty-cart">Your cart is empty.</p>
            @endif
            @else
            <p class="empty-cart">Your cart is empty.</p>
            @endisset
        </div>

        <!-- Checkout Modal -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-purple text-white">
                        <h5 class="modal-title" id="checkoutModalLabel"><i class="fas fa-shopping-cart me-2 cart-icon"></i> Checkout</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('placeOrder') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('user_email') }}">
                        <input type="hidden" name="status" value="Pending">
                        <!-- Include hidden fields for amount and items -->
                        <input type="hidden" name="total" id="totalAmountInput" value="0"> <!-- Initial value -->
                        <input type="hidden" name="qty" id="qty">

                        <!-- Hidden input for selected item IDs -->
                        <input type="text" name="selected_item_ids" id="selectedItemsIdsInput">
                        <input type="text" name="selected_item_names" id="selectedItemsNamesInput"> <!-- Name input -->

                        <!-- Hidden input for the product ID -->
                        <input type="hidden" id="productIDInput" name="prod_id">

                        <div class="modal-body">
                            <div class="mb-3">
                                <?php
                                $trackingCode = 'TRK' . rand(10000, 99999); 
                                ?>
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
                                        <option value="express">Express Shipping (+ Php100)</option>
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

        <!-- Clear Cart Modal -->
        <div class="modal fade" id="clearCartModal" tabindex="-1" aria-labelledby="clearCartModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clearCartModalLabel">Clear Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to clear your cart?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('clearCart') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Clear Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your order has been placed successfully.',
            });
        </script>
        @endif

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById('checkoutBtn').addEventListener('click', function() {
                const selectedItems = document.querySelectorAll('.addToCheckout:checked');
                const selectedItemsList = document.getElementById('selectedItemsList');
                let totalAmount = 0;
                let selectedItemsIds = [];
                let selectedItemsNames = [];
                let selectedItemsQuantities = []; // Array to store quantities
                selectedItemsList.innerHTML = '';

                selectedItems.forEach(function(item) {
                    const itemName = item.parentNode.parentNode.querySelector('.card-title').innerText;
                    const itemQuantity = parseInt(item.parentNode.parentNode.querySelector('.card-text').innerText.split(' ')[1]); // Get the quantity
                    const itemId = item.getAttribute('data-id');
                    const itemPrice = parseFloat(item.value); // Retrieve the price value from the checkbox
                    const listItem = document.createElement('li');
                    listItem.textContent = itemName + ' - Quantity: ' + itemQuantity + ' - Php' + itemPrice.toFixed(2);
                    selectedItemsList.appendChild(listItem);
                    totalAmount += itemPrice;
                    selectedItemsNames.push(itemName); // Push item name to the array
                    selectedItemsIds.push(itemId); // Push item ID to the array
                    selectedItemsQuantities.push(itemQuantity); // Push item quantity to the array
                });

                document.getElementById('totalAmount').innerText = 'Php' + totalAmount.toFixed(2);
                document.getElementById('totalAmountInput').value = totalAmount.toFixed(2);

                // Set the value of the hidden input fields to the arrays of IDs, names, and quantities
                document.getElementById('selectedItemsIdsInput').value = selectedItemsIds.join(',');
                document.getElementById('selectedItemsNamesInput').value = selectedItemsNames.join(',');
                document.getElementById('qty').value = selectedItemsQuantities.join(','); // Set quantities
                document.getElementById('productIDInput').value = selectedItemsIds.join(',');

                $('#checkoutModal').modal('show');
            });
        </script>

    </body>

    </html>
</x-app-layout>
