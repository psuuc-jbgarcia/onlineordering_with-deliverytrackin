<x-app-layout>
    <div class="container mt-4">
        <h2 class="text-center mb-4">My Orders</h2>
        <ul class="nav nav-tabs justify-content-center" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold bg-primary text-white" id="toShip-tab" data-bs-toggle="tab" data-bs-target="#toShip"
                    type="button" role="tab" aria-controls="toShip" aria-selected="true">To Ship</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold bg-success text-white" id="toReceive-tab" data-bs-toggle="tab" data-bs-target="#toReceive"
                    type="button" role="tab" aria-controls="toReceive" aria-selected="false">To Receive</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold bg-warning text-dark" id="toReview-tab" data-bs-toggle="tab" data-bs-target="#toReview"
                    type="button" role="tab" aria-controls="toReview" aria-selected="false">Delivered</button>
            </li>
        </ul>
        <div class="tab-content" id="orderTabsContent">
            <div class="tab-pane fade show active" id="toShip" role="tabpanel" aria-labelledby="toShip-tab">
                <div class="accordion" id="toShipAccordion">
                    <!-- Order details for "To Ship" -->
                    @if ($order)
                        @php $hasToShip = false; @endphp
                        @foreach ($order as $ord)
                            @if ($ord->status == 'Pending' || $ord->status == 'Seller Packing Your Order' || $ord->status == 'Waiting for Delivery Rider to Accept the order'||$ord->status== 'Seller Handed Order to Delivery Rider'||$ord->status== 'Accepted')
                                @php $hasToShip = true; @endphp
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h2 class="accordion-header" id="headingToShip{{ $ord->id }}">
                                            <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseToShip{{ $ord->id }}" aria-expanded="false"
                                                aria-controls="collapseToShip{{ $ord->id }}">
<b>                                                Order#{{ $ord->tracking_code }}
</b>                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseToShip{{ $ord->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingToShip{{ $ord->id }}" data-bs-parent="#toShipAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Status:</strong>{{$ord->status }}</p>
                                                    <p><strong>Total Amount:</strong> {{ $ord->total_amount }}</p>
                                                    <p><strong>Items:</strong>  {{ $ord->items }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Shipping Address:</strong>  {{ $ord->shipping_address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if (!$hasToShip)
                            <div class="alert alert-info" role="alert">
                                <strong>No orders to ship.</strong>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning" role="alert">
                            <strong>No data available.</strong>
                        </div>
                    @endif
                </div>
            </div>
         
            <div class="tab-pane fade" id="toReceive" role="tabpanel" aria-labelledby="toReceive-tab">
                <div class="accordion" id="toReceiveAccordion">
                    <!-- Order details for "To Receive" -->
                    @if ($order)
                        @php $hasToReceive = false; @endphp
                        @foreach ($order as $ord)
                            @if ($ord->status == 'Out for Delivery')
                                @php $hasToReceive = true; @endphp
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h2 class="accordion-header" id="headingToReceive{{ $ord->id }}">
                                            <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseToReceive{{ $ord->id }}" aria-expanded="false"
                                                aria-controls="collapseToReceive{{ $ord->id }}">
<b>                                                Order#{{ $ord->tracking_code }}
</b>                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseToReceive{{ $ord->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingToReceive{{ $ord->id }}" data-bs-parent="#toReceiveAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Status:</strong> {{$ord->status }}</p>
                                                    <p><strong>Total Amount:</strong> {{ $ord->total_amount }}</p>
                                                    <p><strong>Items:</strong> {{ $ord->items }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Shipping Address:</strong> {{ $ord->shipping_address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if (!$hasToReceive)
                            <div class="alert alert-info" role="alert">
                                <strong>No orders out for delivery.</strong>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning" role="alert">
                            <strong>No data available.</strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="tab-pane fade" id="toReview" role="tabpanel" aria-labelledby="toReview-tab">
    <div class="accordion" id="toReviewAccordion">
        <!-- Order details for "To Review" -->
        @if ($order)
            @php $hasToReview = false; @endphp
            @foreach ($order as $ord)
                @if ($ord->status == 'Delivered')
                    @php $hasToReview = true; @endphp
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h2 class="accordion-header" id="headingToReview{{ $ord->id }}">
                                <button class="accordion-button text-dark" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseToReview{{ $ord->id }}" aria-expanded="false"
                                    aria-controls="collapseToReview{{ $ord->id }}">
                                    <b>Order#{{ $ord->tracking_code }}</b>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseToReview{{ $ord->id }}" class="accordion-collapse collapse"
                            aria-labelledby="headingToReview{{ $ord->id }}" data-bs-parent="#toReviewAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Status:</strong> {{$ord->status }}</p>
                                        <p><strong>Total Amount:</strong> {{ $ord->total_amount }}</p>
                                        <p><strong>Items:</strong> {{ $ord->items }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Shipping Address:</strong> {{ $ord->shipping_address }}</p>
                                        <!-- Proof of delivery image -->
                                        <div class="proof-of-delivery">
                                            <p><strong>Proof of Delivery:</strong></p>
                                            <img src="{{ $ord->proof_img }}" alt="Proof of Delivery" class="img-fluid max-height-img" style="  max-height: 300px; /* Set your desired max height here */
            object-fit: cover; /* This will ensure the image covers the area while maintaining aspect ratio */">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @if (!$hasToReview)
                <div class="alert alert-info" role="alert">
                    <strong>No orders Delivered.</strong>
                </div>
            @endif
        @else
            <div class="alert alert-warning" role="alert">
                <strong>No data available.</strong>
            </div>
        @endif
    </div>
</div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Close all accordions initially
        $(".accordion-collapse").collapse('hide');
    </script>
</x-app-layout>
