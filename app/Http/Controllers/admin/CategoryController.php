<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('backend.category.show', compact('category'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required'
        ]);
        Category::create($request->input());
        return redirect('admin/categories');
    }

    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {   
        $request->validate([
            'name' => 'required'
        ]);
        $category->update($request->input());
        return redirect('admin/categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('admin/categories');
    }
}

