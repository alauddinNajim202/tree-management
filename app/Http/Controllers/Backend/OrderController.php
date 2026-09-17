<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(20);
        return view('backend.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
