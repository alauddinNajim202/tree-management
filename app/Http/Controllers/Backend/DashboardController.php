<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Order Statistics (This Month)
        $ordersThisMonth = Order::whereMonth('created_at', $currentMonth)
                                ->whereYear('created_at', $currentYear);
        
        $totalOrdersCount = $ordersThisMonth->count();
        // Calculate total sales for orders that are not cancelled this month
        $totalSales = Order::whereMonth('created_at', $currentMonth)
                           ->whereYear('created_at', $currentYear)
                           ->where('order_status', '!=', 'cancelled')
                           ->sum('total_amount'); 

        $pendingOrders = (clone $ordersThisMonth)->where('order_status', 'pending')->count();
        $processingOrders = (clone $ordersThisMonth)->where('order_status', 'processing')->count();
        $shippedOrders = (clone $ordersThisMonth)->where('order_status', 'shipped')->count();
        $completedOrders = (clone $ordersThisMonth)->where('order_status', 'delivered')->count();

        // Top 5 Best Selling Products (All time)
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->with('product') // assuming OrderItem belongsTo Product
            ->get();

        // Out of Stock Products
        $outOfStockProducts = Product::where('stock', '<=', 0)->limit(10)->get();

        // Recent Orders/Invoices
        $recentOrders = Order::orderBy('created_at', 'desc')->limit(5)->get();

        // Prepare 7-day sales chart data
        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $dailySales = Order::whereDate('created_at', $date)
                               ->where('order_status', '!=', 'cancelled')
                               ->sum('total_amount');
            $chartData[] = $dailySales;
        }

        return view('backend.dashboard', compact(
            'totalOrdersCount', 'totalSales',
            'pendingOrders', 'processingOrders', 'shippedOrders', 'completedOrders',
            'topProducts', 'outOfStockProducts', 'recentOrders',
            'chartLabels', 'chartData'
        ));
    }
}
