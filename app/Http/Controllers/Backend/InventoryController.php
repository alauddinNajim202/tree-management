<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
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
                ->editColumn('stock', function($row){
                    // HTML for the stock input field and save button
                    return '
                        <div class="input-group" style="width: 150px;">
                            <input type="number" class="form-control stock-input" id="stock-'.$row->id.'" value="'.$row->stock.'" min="0">
                            <div class="input-group-append">
                                <button class="btn btn-primary save-stock-btn" type="button" data-id="'.$row->id.'">
                                    <i class="fas fa-save"></i>
                                </button>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['thumbnail', 'stock'])
                ->make(true);
        }

        return view('backend.inventory.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::find($request->id);
        if ($product) {
            $product->update([
                'stock' => $request->stock
            ]);
            return response()->json(['success' => true, 'message' => 'Stock updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found!'], 404);
    }
}
