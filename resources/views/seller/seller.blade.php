<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Product Management</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #8e44ad !important;
            position: fixed;
            width: 100%;
            z-index: 2000;
            /* Higher z-index */
        }

        .navbar-brand {
            color: #ffffff !important;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .table th,
        .table td {
            border-top: 0;
            vertical-align: middle;
        }

        .table th {
            font-weight: bold;
            color: #ffffff;
            background-color: #7f4eff;
            border-bottom: 2px solid #5a3ec8;
            font-size: 0.9rem;
        }

        .table td {
            color: #495057;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: #e9ecef;
        }

        .table tbody tr:hover {
            background-color: #c8cbcf;
        }

        .btn-action {
            margin-left: 5px;
        }

        .edit-btn {
            background-color: #a869ff;
            border-color: #a869ff;
        }

        .edit-btn:hover {
            background-color: #8957e5;
            border-color: #8957e5;
        }

        .delete-btn {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }

        .delete-btn:hover {
            background-color: #ff4f4f;
            border-color: #ff4f4f;
        }

        .sidebar {
            background-color: #343a40;
            color: #ffffff;
            height: 100vh;
            margin-top: 50px;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
            width: 220px;
        }

        .nav-link {
            color: #ffffff !important;
        }

        .nav-link.active {
            font-weight: bold;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        /* Add top margin to modal */
        .modal {
            margin-top: 15px;
        }

        .modal-dialog {
            max-width: 80%;
            /* Set modal width */
            transition: all 0.3s;
            /* Add transition */
        }

        .navbar-brand {
            margin: 0 auto;
            text-align: center;
        }

        .s {
            margin-top: 100px;
            /* Adjust the value as needed */
        }
    
    </style>
</head>

<body>



<nav class="navbar navbar-expand-lg navbar-dark align-items-center" style="height: 80px;">
    <div class="container">
        <!-- Your Logo -->
        <a class="navbar-brand" href="#">
            <img src="icon.png" alt="Your Logo" style="max-height: 100px;">
        </a>
      
      

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
        
              <!-- Title -->
        <div class="mx-auto text-center">
            <p class="navbar-brand mb-0">Jekkong Online Ordering Website</p>
        </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Session::has('user_email'))
                            {{ Session::get('user_email') }}
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <x-dropdown-link :href="route('profile.edit')" style="text-decoration: none; color:black">
                            {{ __('Profile') }}
                        </x-dropdown-link>                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
                <br>
                <br>
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#manage-products">Manage Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#manage-orders">Orders</a>
                        </li>
                        <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#ready-for-delivery">Accept by Delivery Rider</a>
</li>

                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-10 main-content">
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="manage-products">
                        <br>
                        <br>
                  
                        <div class="form-group">
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date:</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                        <br>
                        <div class="mb-3" id="addProductBtnWrapper">
                            <a href="{{ route('gotoadd') }}" class="btn btn-primary">Add Product</a>
                        </div>
<br><br>
                        <table class="table table-striped" id="productTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Order Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prod as $prod )
                                <tr>
                                    <td>{{ $prod->id }}</td>
                                    <td>{{ $prod->name }}</td>
                                    <td>{{ $prod->category }}</td>
                                    <td>{{ $prod->price }}</td>
                                    <td>{{ $prod->stock }}</td>
                                    <td>{{ $prod->description }}</td>

                                    <td><img src="./{{ $prod->image }}" alt="{{ $prod->image }}" style="max-width: 100px; height: 100px;"></td>
                                    <td>{{ $prod->created_at }}</td>

                                    <td>
                                        <button class="btn btn-sm btn-action edit-btn" data-id="{{ $prod->id }}" data-name="{{ $prod->name }}" data-category="{{ $prod->category }}" data-price="{{ $prod->price }}" data-stock="{{ $prod->stock }}" data-description="{{ $prod->description }}" data-image="{{ $prod->image }}">Edit</button>
                                        <button type="button" class="btn btn-sm btn-action delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $prod->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="manage-orders">
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="startDateO">Start Date:</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="endDateO">End Date:</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                        <br>
                        <table class="table table-striped" id="orderTable">

                            <thead>
                                <tr>
                                <th>Tracking Code</th>

                                    <th>User Email</th>
                                    <th>Items</th>
                                    <th>Total Amount</th>
                                    <th>Quantity</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Shipping Address</th>
                                    <th>Shipping Type</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>                        
                                                <td>{{ $order->tracking_code }}</td>

                                    <td>{{ $order->user_email }}</td>
                                    <td>{{ $order->items }}</td>
                                    <td>{{ $order->total_amount }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->shipping_address }}</td>
                                    <td>{{ $order->shippingtype }}</td> <!-- Corrected this line -->

                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <form action="{{ route('updateStatus') }} " method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <select name="status" id="" onchange="this.form.submit()">
                                            <option value="Pending" @if ($order->status == 'Pending') selected @endif>Pending</option>
                            <option value="Seller Packing Your Order" @if ($order->status == 'Seller Packing Your Order') selected @endif>Seller Packing Your Order</option>
                            <option value="Waiting for Delivery Rider to Accept the order" @if ($order->status == 'Waiting for Delivery Rider to Accept the order') selected @endif>Waiting for Delivery Rider to Accept the order</option>
                            <option value="Accepted" @if ($order->status == 'Accepted') selected @endif>Accepted</option>
                            <option value="Accepted" @if ($order->status == 'Out for Delivery') selected @endif>Out for Delivery</option>


                            <option value="Seller Handed Order to Delivery Rider" @if ($order->status == 'Seller Handed Order to Delivery Rider') selected @endif>Seller Handed Order to Delivery Rider</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="ready-for-delivery">
    <br>
    <br>
    <div class="form-group">
        <label for="startDateRD">Start Date:</label>
        <input type="date" id="startDateRD" class="form-control">
    </div>
    <div class="form-group">
        <label for="endDateRD">End Date:</label>
        <input type="date" id="endDateRD" class="form-control">
    </div>
    <br>
    <table class="table table-striped" id="readyForDeliveryTable">
        <thead>
            <tr>
                <th>User Email</th>
                <th>Items</th>
                <th>Total Amount</th>
                <th>Quantity</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Shipping Address</th>
                <th>Shipping Type</th>
                <th>Phone</th>
                <th>Delivery Rider</th>

                <th>Created At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($readyForDeliveryOrders as $order)
            <tr>
                <td>{{ $order->user_email }}</td>
                <td>{{ $order->items }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->qty }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->shippingtype }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->rider }}</td>

                <td>{{ $order->created_at }}</td>
                <td>
                    <form action="{{ route('updateStatus') }} " method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <select name="status" onchange="this.form.submit()">
                            <option value="Pending" @if ($order->status == 'Pending') selected @endif>Pending</option>
                            <option value="Seller Packing Your Order" @if ($order->status == 'Seller Packing Your Order') selected @endif>Seller Packing Your Order</option>
                            <option value="Waiting for Delivery Rider to Accept the order" @if ($order->status == 'Waiting for Delivery Rider to Accept the order') selected @endif>Waiting for Delivery Rider to Accept the order</option>
                            <option value="Accepted" @if ($order->status == 'Accepted') selected @endif>Accepted</option>
                            <option value="Accepted" @if ($order->status == 'Out for Delivery') selected @endif>Out for Delivery</option>


                            <option value="Seller Handed Order to Delivery Rider" @if ($order->status == 'Seller Handed Order to Delivery Rider') selected @endif>Seller Handed Order to Delivery Rider</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


                </div>
            </main>
        </div>
    </div>


    <div class="modal" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <br>
                    <br>
                    <br>
                    <br>
                    <br>
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                 
                    <!-- Edit Product Form -->
                    <form id="editProductFormModal" action="{{ route('update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="productID" name="productID">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName">
                        </div>
                        <div class="form-group">
                            <label for="productCategory">Category</label>
                            <input type="text" class="form-control" id="productCategory" name="productCategory">
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice">
                        </div>
                        <div class="form-group">
                            <label for="productStock">Stock</label>
                            <input type="number" class="form-control" id="productStock" name="productStock">
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Description</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="productImage">Image</label>
                            <input type="file" class="form-control-file" id="productImage" name="productImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog s" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('deleteProd',$prod->id,) }}" class="btn btn-sm btn-action delete-btn">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7ie1ITaiL3FJ9hVjv1vcR3eK/5t1kl5kG6D" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-ES6vtBRF8aMTH6ek2F3yHFRKe4OQW1IVe0FEtWlbcd4XkPl1NodX7MZj6Ff3w8H8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-JO3GQK7W2LSCSgqXMZZjdDBCF0NJZWFlTm83UyyD7zJ6P3yLv6F8jS0B+9P+0yL4" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
$(document).ready(function() {
    $('.nav-link').click(function() {
        $(this).tab('show');
    });
});


</script>
    <script>
        $(document).ready(function() {
            // DataTable initialization
            var table = $('#productTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],
                "columnDefs": [{
                    "targets": 7, // Index of the 'created_At' column
                    "type": "date",
                    "render": function(data) {
                        return moment(data).format('YYYY-MM-DD');
                    }
                }],
                "order": [
                    [7, 'desc']
                ],
                "language": {
                    "paginate": {
                        "next": "&raquo;",
                        "previous": "&laquo;"
                    },
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)"
                }
            });

            // Date range filtering
            $('#startDate, #endDate').change(function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var min = new Date(startDate);
                        var max = new Date(endDate);
                        var targetDate = new Date(data[7]);

                        if ((isNaN(min) && isNaN(max)) ||
                            (isNaN(min) && targetDate <= max) ||
                            (min <= targetDate && isNaN(max)) ||
                            (min <= targetDate && targetDate <= max)) {
                            return true;
                        }
                        return false;
                    }
                );

                table.draw();
            });
        });
        $(document).ready(function() {
    // DataTable initialization
    var orderTable = $('#orderTable').DataTable({
        dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],
        "columnDefs": [{
            "targets": 10, // Index of the 'created_At' column
            "type": "date",
            "render": function(data) {
                return moment(data).format('YYYY-MM-DD');
            }
        }],
        "order": [
            [10, 'desc']
        ],
        "language": {
            "paginate": {
                "next": "&raquo;",
                "previous": "&laquo;"
            },
            "search": "Search:",
            "zeroRecords": "No matching records found",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)"
        }
    });

    // Custom filtering function for date range
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var startDate = $('#startDateO').val();
            var endDate = $('#endDateO').val();
            var min = startDate ? new Date(startDate) : null;
            var max = endDate ? new Date(endDate) : null;
            var date = new Date(data[10]); // Index of the 'created_At' column

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    // Event listener to the two range filtering inputs to redraw on input
    $('#startDateO, #endDateO').change(function() {
        orderTable.draw();
    });
});
        // Show Add Product Modal
        $('#addProductBtn').click(function() {
            $('#addProductModal').modal('show');
        });

        // Populate Edit Product Modal
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var category = $(this).data('category');
            var price = $(this).data('price');
            var stock = $(this).data('stock');
            var description = $(this).data('description');
            var image = $(this).data('image');

            $('#editProductModal #productID').val(id);
            $('#editProductModal #productName').val(name);
            $('#editProductModal #productCategory').val(category);
            $('#editProductModal #productPrice').val(price);
            $('#editProductModal #productStock').val(stock);
            $('#editProductModal #productDescription').val(description);
            $('#editProductModal #productImagePreview').attr('src', '/images/' + image);

            $('#editProductModal').modal('show');
        });
    </script>
<script>
    $(document).ready(function() {
        // DataTable initialization
        var table = $('#readyForDeliveryTable').DataTable({
            dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],
            "columnDefs": [{
                "targets": 10, // Index of the 'created_At' column
                "type": "date",
                "render": function(data) {
                    return moment(data).format('YYYY-MM-DD');
                }
            }],
            "order": [
                [9, 'desc']
            ],
            "language": {
                "paginate": {
                    "next": "&raquo;",
                    "previous": "&laquo;"
                },
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)"
            }
        });

        // Date range filtering
        $('#startDateRD, #endDateRD').change(function() {
            var startDate = $('#startDateRD').val();
            var endDate = $('#endDateRD').val();

            table.draw();
        });

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = new Date($('#startDateRD').val());
                var max = new Date($('#endDateRD').val());
                var date = new Date(data[9]);

                if (
                    (isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && date <= max) ||
                    (min <= date && isNaN(max)) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }

                return false;
            }
        );
    });
</script>

</body>

</html>