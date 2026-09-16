<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $homeCategories = \App\Models\Category::parents()->with('children')->where('status', 1)->orderBy('name')->get();
        $products = \App\Models\Product::where('status', 1)->orderBy('name')->get();
        return view('frontend.pages.home', compact('homeCategories', 'products'));
    }

    public function productDetail($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(6)
            ->get();
        $hotDeals = \App\Models\Product::where('is_featured', 1)
            ->where('status', 1)
            ->take(3)
            ->get();
            
        return view('frontend.pages.detail', compact('product', 'relatedProducts', 'hotDeals'));
    }

    public function shoppingCart()
    {
        return view('frontend.pages.shopping-cart');
    }

    public function checkout()
    {
        return view('frontend.pages.checkout');
    }

    public function blog()
    {
        return view('frontend.pages.blog');
    }

    public function blogDetails()
    {
        return view('frontend.pages.blog-details');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function myWishlist()
    {
        return view('frontend.pages.my-wishlist');
    }

    public function productComparison()
    {
        return view('frontend.pages.product-comparison');
    }

    public function signIn()
    {
        return view('frontend.pages.sign-in');
    }

    public function termsConditions()
    {
        return view('frontend.pages.terms-conditions');
    }

    public function trackOrders()
    {
        return view('frontend.pages.track-orders');
    }

    public function notFound()
    {
        return view('frontend.pages.404');
    }
}
