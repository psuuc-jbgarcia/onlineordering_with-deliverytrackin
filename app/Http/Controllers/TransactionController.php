<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class TransactionController extends Controller
{
    public function addtocart(Request $request)
    {
        $existingCartItem = Cart::where('name', $request->name)
            ->where('user_email', $request->email)
            ->first();

        if ($existingCartItem) {
            // If the item exists, increment its quantity by 1
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            // If the item doesn't exist, add it to the cart
            $cart = new Cart;
            $cart->prod_id = $request->product_id;
            $cart->name = $request->name;
            $cart->quantity = $request->quantity; // Set quantity to 1
            $cart->price = $request->price;
            $cart->img = $request->img;
            $cart->user_email = $request->email;
            $cart->save();
        }

        return redirect('/home');
    }


    public function fetchCart()
    {
        $userEmail = Session::get("user_email");
        $fetch = Cart::where("user_email", $userEmail)->get();
        return view('user.cart', compact('fetch'));
    }
    public function removeitem($id)
    {
        $remove = Cart::find($id);
        $remove->delete();
        return redirect()->back();
    }
    public function placeOrder(Request $request)
    {
        $selectedItemIDs = explode(',', $request->selected_item_ids); // Convert string to array of item IDs
        $quantities = explode(',', $request->qty); // Convert string to array of quantities
        $selectedItemNames = explode(',', $request->selected_item_names); // Convert string to array of item names

        // Loop through the array of selected item IDs
        foreach ($selectedItemIDs as $key => $id) {
            $quantity = $quantities[$key]; // Get the quantity for the current item
            $itemName = $selectedItemNames[$key]; // Get the name for the current item

            // Find the product
            $product = Product::find($id);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            // Update the stock
            $product->stock -= $quantity;
            $product->save();

            // Log product details
            Log::debug('Product ID: ' . $product->id . ' - Product Name: ' . $product->name . ' - Quantity: ' . $quantity);

            // Create a new order instance
            $insert = new Order();

            // Assign order details
            $insert->user_email = $request->email;
            $insert->tracking_code = $request->tracking_code;
            $insert->qty = $quantity; // Assuming the column name is 'quantity'
            $insert->total_amount = $request->total;
            $insert->status = $request->status;
            $insert->payment_method = $request->payment_method;
            $insert->payment_status = 'Not Paid';
            $insert->shipping_address = $request->address;
            $insert->shippingtype = $request->shipping_method;
            $insert->phone = $request->phone;
            $insert->items = $itemName; // Assign the name of the current item

            // Save the order
            $insert->save();

            // Remove the item from the cart
            $cartItem = Cart::where('prod_id', $id)
                ->where('user_email', $request->email)
                ->first();

            if ($cartItem) {
                $cartItem->delete();
            }
        }

        return redirect()->back()->with('success', 'Your order has been placed successfully.');
    }

    public function buynow(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'status' => 'required|string',
            'total' => 'required|numeric',
            'qty' => 'required|numeric',
            'selected_item_ids' => 'required|string',
            'selected_item_names' => 'required|string',
            'prod_id' => 'required|numeric',
            'tracking_code' => 'required|string',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        // Create a new order
        $order = new Order();
        $order->user_email = $validatedData['email'];
        $order->status = $validatedData['status'];
        $order->total_amount = $validatedData['total'];
        $order->qty = $validatedData['qty'];
        $order->items = $validatedData['selected_item_names'];
        $order->tracking_code = $validatedData['tracking_code'];
        $order->payment_method = $validatedData['payment_method'];
        $order->shippingtype = $validatedData['shipping_method'];
        $order->shipping_address = $validatedData['address'];
        $order->phone = $validatedData['phone'];
        $order->payment_status = 'Not Paid';

        $order->save();

        // Update product stock
        $product = Product::find($validatedData['prod_id']);
        if ($product) {
            $product->stock -= $validatedData['qty'];
            $product->save();
        }

        // Redirect or return response
        return redirect()->back()->withSuccess('Order placed successfully!');
    }

    public function clearCart()
    {
        Cart::truncate();
        return redirect()->back();
    }
    public function order()
    {
        $useremail = Session::get('user_email');
        $order = Order::where('user_email', $useremail)->get();
        return view('user.order', compact('order'));
    }


    // for seller
    public function addProd(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'productPrice' => 'required|numeric',
            'productStock' => 'required|integer',
            'productDescription' => 'required|string',
            'productImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image max size is 2MB
        ]);

        $add = new Product();
        $add->name = $request->productName;
        if ($request->filled('newCategory')) {
            $add->category = $request->newCategory;
        } else {
            $add->category = $request->productCategory;
        }
        $add->description = $request->productDescription;
        $add->price = $request->productPrice;
        $add->stock = $request->productStock;

        // Upload image file
        if ($request->hasFile('productImage')) {
            $image = $request->file('productImage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $add->image = 'images/' . $imageName;
        }

        $add->save();

        return redirect("/home");
    }


    public function gotoadd()
    {
        $categories = Product::select('category')->distinct()->get();
        return view('seller.addprod', compact('categories'));
    }
    public function update(Request $request)
    {   
        $id = $request->input('productID');
    
        // Retrieve the product by ID
        $product = Product::findOrFail($id);
    
        // Update the product attributes
        $product->name = $request->input('productName');
        $product->category = $request->input('productCategory');
        $product->price = $request->input('productPrice');
        $product->stock = $request->input('productStock');
        $product->description = $request->input('productDescription');
    
        // Handle image update if necessary
        if ($request->hasFile('productImage')) {
            $request->validate([
                'productImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image max size is 2MB
            ]);
    
            $image = $request->file('productImage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;
        }
    
        // Save the changes
        $product->save();
    
        return redirect("/home");
    }
    
    public function deleteProd($id)
    {
        $prod = Product::find($id);
        $prod->delete();
        return redirect("/home");
    }
    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = Order::find($id);
        $status->status = $request->status;
        $status->save();
        return redirect("/home");
    }

    //rider
    public function acceptOrder(Request $request)
    {
        $id = $request->input('id');
        $status = Order::find($id);
        $status->status = 'Accepted';
        $status->rider = $request->rider;
        $status->save();
        return redirect("/home");
    }
    public function DeliveryAssign()
    {
        $riderEmail = Session::get('user_email');
        $statuses = ['Accepted', 'Out for Delivery'];
        $assignedOrders = Order::where('rider', $riderEmail)
            ->whereIn('status', $statuses)
            ->get();
        return view('deliveryrider.delivery', compact('assignedOrders'));
    }
    public function updateByrider(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $update = Order::find($id);
        $update->status = $status;
        $update->save();

        // Check if the status is "Delivered", then update payment status
        if ($status === 'Delivered') {
            $update->payment_status = 'Paid';
            $update->save();
        }

        return redirect()->back();
    }
}
