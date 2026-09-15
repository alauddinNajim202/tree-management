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
                    $btn = '<div class="table-links">
                                <a href="#">View</a>
                                <div class="bullet"></div>
                                <a href="#">Edit</a>
                                <div class="bullet"></div>
                                <a href="#" class="text-danger">Trash</a>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['thumbnail', 'status', 'action'])
                ->make(true);
        }

        return view('backend.products.index');
    }
}
