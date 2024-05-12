<x-app-layout>
    <div class="container mt-4">
        <h2 class="text-center mb-4">My Orders</h2>
        <ul class="nav nav-tabs justify-content-center" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="toShip-tab" data-bs-toggle="tab" data-bs-target="#toShip"
                    type="button" role="tab" aria-controls="toShip" aria-selected="true">To Ship</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="toReceive-tab" data-bs-toggle="tab" data-bs-target="#toReceive"
                    type="button" role="tab" aria-controls="toReceive" aria-selected="false">To Receive</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="toReview-tab" data-bs-toggle="tab" data-bs-target="#toReview"
                    type="button" role="tab" aria-controls="toReview" aria-selected="false">To Review</button>
            </li>
        </ul>
        <div class="tab-content" id="orderTabsContent">
            <div class="tab-pane fade show active" id="toShip" role="tabpanel" aria-labelledby="toShip-tab">
                <div class="accordion" id="toShipAccordion">
                    <!-- Order details for "To Ship" -->
                    <div class="card">
                        <div class="card-header bg-purple">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Order #TRK12345
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#toShipAccordion">
                            <div class="accordion-body">
                                <p>Status: To Ship</p>
                                <p>Total Amount: Php1000</p>
                                <p>Items:</p>
                                <ul>
                                    <li>Item 1</li>
                                    <li>Item 2</li>
                                </ul>
                                <p>Shipping Address: 123 Main St, City</p>
                                <p>Phone: 123-456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="toReceive" role="tabpanel" aria-labelledby="toReceive-tab">
                <div class="accordion" id="toReceiveAccordion">
                    <!-- Order details for "To Receive" -->
                </div>
            </div>
            <div class="tab-pane fade" id="toReview" role="tabpanel" aria-labelledby="toReview-tab">
                <div class="accordion" id="toReviewAccordion">
                    <!-- Order details for "To Review" -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .nav-link {
        margin: 0 15px; /* Adjust spacing between tabs */
        color: #8a2be2; /* Violet color */
        border: none;
    }

    .nav-link.active {
        font-weight: bold;
    }

    .bg-purple {
        background-color: #8a2be2 !important; /* Violet color */
    }

    .accordion-button {
        color: #fff; /* White text for accordion button */
        background-color: #8a2be2; /* Violet background for accordion button */
        border: none;
    }

    .accordion-button:not(.collapsed) {
        background-color: #8a2be2; /* Violet background for accordion button when expanded */
    }

    .accordion-body {
        background-color: #f8f9fa; /* Light gray background for accordion body */
        border: 1px solid #dee2e6; /* Border color for accordion body */
        border-top: none; /* Remove top border */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
