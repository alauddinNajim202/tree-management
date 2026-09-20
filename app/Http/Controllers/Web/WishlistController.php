<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function viewWishlist()
    {
        return view('frontend.pages.my-wishlist');
    }

    public function add($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            return redirect()->back()->with('info', 'Product is already in your wishlist!');
        }

        $wishlist[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->discount_price ?? $product->price,
            "image" => $product->thumbnail,
            "slug" => $product->slug
        ];

        session()->put('wishlist', $wishlist);
        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }

    public function remove($id)
    {
        $wishlist = session()->get('wishlist');

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
    }
}
