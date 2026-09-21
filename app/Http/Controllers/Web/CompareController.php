<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CompareController extends Controller
{
    public function index()
    {
        $compareIds = session()->get('compare', []);
        
        $compareProducts = collect();
        if (!empty($compareIds)) {
            $compareProducts = Product::whereIn('id', $compareIds)->get();
        }

        return view('frontend.pages.product-comparison', compact('compareProducts'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        
        $compareIds = session()->get('compare', []);

        if (in_array($id, $compareIds)) {
            return redirect()->back()->with('error', 'Product is already in your comparison list.');
        }

        if (count($compareIds) >= 4) {
            return redirect()->back()->with('error', 'You can only compare up to 4 products at a time. Please remove one first.');
        }

        $compareIds[] = $id;
        session()->put('compare', $compareIds);

        return redirect()->back()->with('success', 'Product added to comparison list.');
    }

    public function remove($id)
    {
        $compareIds = session()->get('compare', []);
        
        if (($key = array_search($id, $compareIds)) !== false) {
            unset($compareIds[$key]);
            session()->put('compare', array_values($compareIds));
        }

        return redirect()->back()->with('success', 'Product removed from comparison list.');
    }
}
