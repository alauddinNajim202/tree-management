<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::where('status', 1);

        // Filter by category if selected
        if ($request->has('category') && $request->category) {
            // Find category and its children if any
            $category = Category::find($request->category);
            if ($category) {
                if ($category->parent_id == null) {
                    $childIds = $category->children()->pluck('id')->toArray();
                    $childIds[] = $category->id;
                    $products = $products->whereIn('category_id', $childIds);
                } else {
                    $products = $products->where('category_id', $request->category);
                }
            }
        }

        // Filter by tag if selected
        if ($request->has('tag') && $request->tag) {
            $products = $products->where('tags', 'like', '%' . $request->tag . '%');
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $products = $products->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $products = $products->where('price', '<=', $request->max_price);
        }

        $products = $products->orderBy('name')->paginate(12);

        $productTags = Product::where('status', 1)->whereNotNull('tags')->pluck('tags')
            ->flatMap(fn($t) => array_map('trim', explode(',', $t)))
            ->unique()->filter()->values();
            
        $parentCategories = Category::whereNull('parent_id')->with('children')->where('status', 1)->orderBy('name')->get();
        $maxPrice = Product::where('status', 1)->max('price') ?? 1000;

        return view('frontend.pages.category', compact('products', 'parentCategories', 'productTags', 'maxPrice'));
    }
}

