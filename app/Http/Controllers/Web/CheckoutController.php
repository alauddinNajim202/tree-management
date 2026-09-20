<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if(count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('frontend.pages.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
        ]);

        $cart = Session::get('cart', []);
        
        if(count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $product = \App\Models\Product::find($item['id']);
            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->route('shopping-cart')->with('error', 'Sorry, ' . $item['name'] . ' does not have enough stock available.');
            }
            $total += $item['price'] * $item['quantity'];
        }

        // Create Order
        $order = new Order();
        $order->user_id = Auth::id(); // Will be null for guests if we don't enforce auth
        $order->order_number = 'ORD-' . strtoupper(uniqid());
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->shipping_address = $request->address;
        $order->city = $request->city;
        $order->zip_code = $request->zip_code;
        $order->total_amount = $total;
        $order->payment_method = 'cod';
        $order->payment_status = 'pending';
        $order->order_status = 'pending';
        $order->save();

        // Create Order Items and Deduct Stock
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ]);

            // Deduct stock
            $product = \App\Models\Product::find($item['id']);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        // Clear Cart
        Session::forget('cart');

        return redirect()->route('dashboard')->with('success', 'Your order has been placed successfully! Order Number: ' . $order->order_number);
    }
}
