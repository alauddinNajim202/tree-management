<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::where('status', 1)->get();
        $homeCategories = \App\Models\Category::parents()->with('children')->where('status', 1)->orderBy('name')->get();
        $products = \App\Models\Product::where('status', 1)->orderBy('name')->get();
        $newProducts = \App\Models\Product::where('status', 1)->latest()->take(6)->get();
        $featuredProducts = \App\Models\Product::where('status', 1)->where('is_featured', 1)->take(6)->get();
        $hotDeals = \App\Models\Product::where('status', 1)->where('is_hot_deal', 1)->get();
        $specialOffers = \App\Models\Product::where('status', 1)->where('is_special_offer', 1)->get();
        $productTags = \App\Models\Product::where('status', 1)->whereNotNull('tags')->pluck('tags')
            ->flatMap(fn($t) => array_map('trim', explode(',', $t)))
            ->unique()->filter()->values();
        return view('frontend.pages.home', compact('sliders', 'homeCategories', 'products', 'newProducts', 'featuredProducts', 'hotDeals', 'specialOffers', 'productTags'));
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
        $productTags = \App\Models\Product::where('status', 1)->whereNotNull('tags')->pluck('tags')
            ->flatMap(fn($t) => array_map('trim', explode(',', $t)))
            ->unique()->filter()->values();
        return view('frontend.pages.detail', compact('product', 'relatedProducts', 'hotDeals', 'productTags'));
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


    public function aboutUs()
    {
        $content = \App\Models\Setting::where('key', 'about_us')->value('value');
        return view('frontend.pages.about-us', compact('content'));
    }

    public function termsConditions()
    {
        $content = \App\Models\Setting::where('key', 'terms_conditions')->value('value');
        return view('frontend.pages.terms-conditions', compact('content'));
    }

    public function privacyPolicy()
    {
        $content = \App\Models\Setting::where('key', 'privacy_policy')->value('value');
        return view('frontend.pages.privacy-policy', compact('content'));
    }

    public function trackOrders()
    {
        return view('frontend.pages.track-orders');
    }

    public function dashboard()
    {
        return view('frontend.pages.dashboard');
    }

    public function notFound()
    {
        return view('frontend.pages.404');
    }
}
