<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('category')->select('products.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('thumbnail', function($row){
                    $img = $row->thumbnail ? asset($row->thumbnail) : asset('backend/assets/img/products/product-1-50.png');
                    return '<img alt="image" src="'.$img.'" class="rounded" width="35">';
                })
                ->addColumn('category_name', function($row){
                    return $row->category ? $row->category->name : 'N/A';
                })
                ->editColumn('status', function($row){
                    return $row->status ? '<div class="badge badge-primary">Published</div>' : '<div class="badge badge-danger">Draft</div>';
                })
                ->addColumn('action', function($row){
                    $editUrl = route('admin.products.edit', $row->id);
                    $deleteUrl = route('admin.products.destroy', $row->id);
                    $btn = '<div class="table-links">
                                <a href="#">View</a>
                                <div class="bullet"></div>
                                <a href="'.$editUrl.'">Edit</a>
                                <div class="bullet"></div>
                                <a href="'.$deleteUrl.'" class="text-danger" onclick="event.preventDefault(); document.getElementById(\'delete-form-'.$row->id.'\').submit();">Trash</a>
                                <form id="delete-form-'.$row->id.'" action="'.$deleteUrl.'" method="POST" class="d-none">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                </form>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['thumbnail', 'status', 'action'])
                ->make(true);
        }

        return view('backend.products.index');
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('backend.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'thumbnail']);
        $data['slug'] = \Illuminate\Support\Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $data['is_special_offer'] = $request->has('is_special_offer') ? 1 : 0;
        $data['deal_end_date'] = $request->deal_end_date ?: null;

        if ($request->hasFile('thumbnail')) {
            $path = storage_path('app/public/uploads/products');
            if (!\Illuminate\Support\Facades\File::exists($path)) {
                \Illuminate\Support\Facades\File::makeDirectory($path, 0775, true);
            }
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move($path, $imageName);
            $data['thumbnail'] = 'storage/uploads/products/' . $imageName;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = \App\Models\Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'thumbnail', '_method']);
        $data['slug'] = \Illuminate\Support\Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $data['is_special_offer'] = $request->has('is_special_offer') ? 1 : 0;
        $data['deal_end_date'] = $request->deal_end_date ?: null;

        if ($request->hasFile('thumbnail')) {
            $path = storage_path('app/public/uploads/products');
            if (!\Illuminate\Support\Facades\File::exists($path)) {
                \Illuminate\Support\Facades\File::makeDirectory($path, 0775, true);
            }
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move($path, $imageName);
            $data['thumbnail'] = 'storage/uploads/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
