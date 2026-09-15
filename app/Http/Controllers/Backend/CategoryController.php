<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($row){
                    if ($row->image) {
                        return '<img alt="image" src="'.asset($row->image).'" class="rounded" width="35">';
                    }
                    return 'N/A';
                })
                ->editColumn('status', function($row){
                    return $row->status ? '<div class="badge badge-primary">Published</div>' : '<div class="badge badge-danger">Draft</div>';
                })
                ->addColumn('action', function($row){
                    $editUrl = route('admin.categories.edit', $row->id);
                    $deleteUrl = route('admin.categories.destroy', $row->id);
                    $btn = '<div class="table-links">
                                <a href="'.$editUrl.'">Edit</a>
                                <div class="bullet"></div>
                                <a href="'.$deleteUrl.'" class="text-danger" onclick="event.preventDefault(); document.getElementById(\'delete-category-'.$row->id.'\').submit();">Trash</a>
                                <form id="delete-category-'.$row->id.'" action="'.$deleteUrl.'" method="POST" class="d-none">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                </form>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('backend.categories.index');
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'image']);
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status') ? $request->status : 1;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $data['image'] = 'uploads/categories/' . $imageName;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'image', '_method']);
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status') ? $request->status : 1;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $data['image'] = 'uploads/categories/' . $imageName;
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
