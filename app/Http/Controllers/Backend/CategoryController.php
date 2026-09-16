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
            $data = Category::with('parent')->select('categories.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($row){
                    if($row->image) {
                        return '<img src="'.asset($row->image).'" width="50" class="img-thumbnail" />';
                    }
                    return 'N/A';
                })
                ->addColumn('parent_name', function($row){
                    return $row->parent ? '<span class="badge badge-light">'.$row->parent->name.'</span>' : '<span class="text-muted">— Root</span>';
                })
                ->editColumn('status', function($row){
                    return $row->status ? '<div class="badge badge-primary">Published</div>' : '<div class="badge badge-danger">Draft</div>';
                })
                ->addColumn('action', function($row){
                    $editUrl = route('admin.categories.edit', $row->id);
                    $deleteUrl = route('admin.categories.destroy', $row->id);
                    $btn = '<div class="d-flex justify-content-center">
                                <a href="'.$editUrl.'" class="btn btn-sm btn-primary mr-1"><i class="fas fa-edit"></i> Edit</a>
                                <form action="'.$deleteUrl.'" method="POST" class="delete-form" style="display:inline;">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['image', 'parent_name', 'status', 'action'])
                ->make(true);
        }

        return view('backend.categories.index');
    }

    public function create()
    {
        $parentCategories = Category::parents()->where('status', 1)->orderBy('name')->get();
        return view('backend.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'image']);
        $data['slug']      = Str::slug($request->name);
        $data['status']    = $request->has('status') ? $request->status : 1;
        $data['parent_id'] = $request->parent_id ?: null;

        if ($request->hasFile('image')) {
            $path = public_path('uploads/categories');
            if (!\Illuminate\Support\Facades\File::exists($path)) {
                \Illuminate\Support\Facades\File::makeDirectory($path, 0775, true);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            $data['image'] = 'uploads/categories/' . $imageName;
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        // Exclude current category and its children from parent options
        $parentCategories = Category::parents()
            ->where('id', '!=', $category->id)
            ->where('status', 1)
            ->orderBy('name')
            ->get();
        return view('backend.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'image', '_method']);
        $data['slug']      = Str::slug($request->name);
        $data['status']    = $request->has('status') ? $request->status : 1;
        $data['parent_id'] = $request->parent_id ?: null;

        if ($request->hasFile('image')) {
            $path = public_path('uploads/categories');
            if (!\Illuminate\Support\Facades\File::exists($path)) {
                \Illuminate\Support\Facades\File::makeDirectory($path, 0775, true);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
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
