<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class TrackOrderController extends Controller
{
    public function index()
    {
        $myOrders = collect();
        if (Auth::check()) {
            $myOrders = Order::where('email', Auth::user()->email)->orderBy('created_at', 'desc')->get();
        }
        return view('frontend.pages.track-orders', compact('myOrders'));
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'email' => 'required|email'
        ]);

        $orderId = str_replace('ORD-', '', $request->order_id);
        $orderId = ltrim($orderId, '0');

        $order = Order::where('id', $orderId)->where('email', $request->email)->with('items')->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found. Please check your Order ID and Email.');
        }

        return view('frontend.pages.track-orders-result', compact('order'));
    }
}
