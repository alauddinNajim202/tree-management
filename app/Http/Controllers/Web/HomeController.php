<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.home');
    }

    public function detail()
    {
        return view('frontend.pages.detail');
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
