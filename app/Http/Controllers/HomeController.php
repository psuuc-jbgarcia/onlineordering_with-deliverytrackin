<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Store user email in session
            Session::put('user_email', $user->email);
            Session::put('address', $user->address);
            Session::put('phone', $user->phone);


            // Determine user type and redirect accordingly
            $products = Product::all();
                $prod=Product::all();
                $orders = Order::where('status', '!=', 'Delivered')->get();

                $readyForDeliveryOrders = Order::where('status', 'Accepted')->get();
                $statuses = ['Waiting for Delivery Rider to Accept the order', 'Seller Handed Order to Delivery Rider'];

                // Retrieve and store the orders with the desired statuses
                $AvailableDeliveryOrders = Order::whereIn('status', $statuses)->get();
                    switch ($user->usertype) {
                case 'user':
                    return view('user.dashboard',['products' => $products]);
                    break;
                case 'admin':
                    return view('admin.admin');
                    break;
                case 'rider':
                    return view('deliveryrider.rider',compact('AvailableDeliveryOrders'));
                    case 'seller':
                        return view('seller.seller',compact('prod','orders','readyForDeliveryOrders'));
                    break;
                default:
                    return redirect()->back();
                    break;
            }
        } else {
            return redirect()->route('login'); // Redirect to login if user is not authenticated
        }
    }
 

  
}
