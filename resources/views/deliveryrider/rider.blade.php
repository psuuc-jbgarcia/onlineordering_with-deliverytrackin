<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <!-- Custom styles -->
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

        .signature-pad {
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
        }

        .order-section {
            margin-top: 20px;
        }

        .order-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
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

        .order-card .accept-btn {
            margin-top: 10px;
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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Delivery Assignment</a>
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
    <h2>Available Orders</h2>
    <div class="row">
        @if(count($AvailableDeliveryOrders) > 0)
            @foreach ($AvailableDeliveryOrders as $avail)
                <div class="col-md-6">
                    <div class="order-card">
                        <h3>Order Tracking Code: {{ $avail->tracking_code }}</h3>
                        <p><strong>Delivery Address:</strong> {{ $avail->shipping_address }}</p>
                        <p><strong>Items:</strong> {{ $avail->items }}</p>
                        <p><strong>Payment Type:</strong> {{ $avail->payment_method }}</p>
                        <p><strong>Contact:</strong> {{ $avail->phone }}</p>
                        <form action="{{ route('acceptOrder') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $avail->id }}" name="id">
                            <input type="hidden" value="{{ Session::get('user_email') }}" name="rider">
                            <button type="submit" class="accept-btn btn btn-success">Accept Order</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    No available orders at the moment.
                </div>
            </div>
        @endif
    </div>
</div>


<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Include Signature Pad library -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>


</body>
</html>
