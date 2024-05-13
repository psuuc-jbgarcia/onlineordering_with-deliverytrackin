<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom styles -->
    <style>
           .navbar {
            background-color: #8a2be2; /* Violet color */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #ffffff; /* White text */
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #cccccc; /* Light gray on hover */
        }

        .navbar-dark .navbar-toggler {
            border-color: #ffffff; /* White color for toggler */
        }

        .navbar-dark .navbar-toggler-icon {
            background-color: #000000; /* Black color for toggler icon */
        }
        .order-section {
            margin-top: 20px;
        }

        .order-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .order-card h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .order-card p {
            margin-bottom: 10px;
        }

        .deliver-btn {
            margin-top: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Your Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link active" aria-current="page" href="{{ route('DeliveryAssign') }}">Delivery Assignment</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Session::has('user_email'))
                            {{ Session::get('user_email') }}
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
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

<div class="container order-section">
    <h2>Assigned Orders</h2>
    <div class="row">
        @if(count($assignedOrders) > 0)
            @foreach ($assignedOrders as $order)
                <div class="col-md-6">
                    <div class="order-card">
                        <h3>Order Tracking Code: {{ $order->tracking_code }}</h3>
                        <p><strong>Delivery Address:</strong> <a href="#" onclick="openRoute('{{ $order->shipping_address }}')"> {{ $order->shipping_address }}</a></p>
                        <p><strong>Items:</strong> {{ $order->items }}</p>
                        <p><strong>Payment Type:</strong> {{ $order->payment_method }}</p>
                        <p><strong>Contact:</strong> {{ $order->phone }}</p>
                        <form action="{{ route('updateByrider') }}" method="post" >
                            @csrf
                            <input type="hidden" name="id" value="{{ $order->id }}">
                            <div class="form-group">
                                <label for="status">Delivery Status:</label>
                                <select class="form-control" id="status" name="status" onchange="this.form.submit()">
                                    <option value="" @if ($order->status=='Accepted')
                                        selected
                                    @endif>Accepted</option>
                                    <option value="Out for Delivery"  @if ($order->status=='Out for Delivery')
                                        selected
                                    @endif>Out for Delivery</option>
                                    <option value="Delivered"  @if ($order->status=='Delivered')
                                        selected
                                    @endif>Delivered</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="proof">Proof of Delivery:</label>
                            </div>
                        </form>
                        <form action="" enctype="multipart/form-data">
                        <input type="file" class="form-control" id="proof" name="proof">

                        <button type="submit" class="deliver-btn btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    No assigned orders to deliver.
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function openRoute(address) {
        var defaultLocation = "15.98821632442629,120.57362097313083"; // Default location
        window.open("https://www.google.com/maps/dir/" + defaultLocation + "/" + encodeURIComponent(address));
    }
</script>

</body>
</html>
