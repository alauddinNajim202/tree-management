<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() { 
        return view('admin.category'); 
    }

    public function show($id) { 
        return view('admin.category'); 
    }

    public function edit($id) { 
        return view('admin.category'); 
    }

    public function update(Request $request, $id) { 
        return view('admin.category'); 
    }

    public function destroy($id) { 
        return view('admin.category'); 
    }
}
