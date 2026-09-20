<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('frontend.pages.shopping-cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        $cart = Session::get('cart', []);
        
        // If product already in cart, increment quantity
        if(isset($cart[$id])) {
            if ($cart[$id]['quantity'] + 1 > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more. Only ' . $product->stock . ' available in stock.');
            }
            $cart[$id]['quantity']++;
        } else {
            // Add new product to cart
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->thumbnail,
                'slug' => $product->slug,
            ];
        }
        
        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);

        if(isset($cart[$request->id])) {
            $product = Product::find($request->id);
            if ($product && $request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Cannot update quantity. Only ' . $product->stock . ' available in stock.');
            }
            $cart[$request->id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    public function clearCart()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
