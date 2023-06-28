<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Http\Controllers\Controller;

class Sub_CategoryController extends Controller
{
    //
    public function index()
    {
        $sub_categories = SubCategory::all();
        return view('backend.sub_category.index', compact('sub_categories'));
    }

    public function show(SubCategory $sub_category)
    {
        return view('backend.sub_category.show', compact('sub_category'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
        SubCategory::create($request->input());
        return redirect('admin/sub_categories');
    }

    public function edit(SubCategory $sub_category)
    {
        $categories = Category::all();
        return view('backend.sub_category.edit', compact('sub_category'), compact('categories'));
    }

    public function update(Request $request, SubCategory $sub_category)
    {
        $sub_category->update($request->input());
        return redirect('admin/sub_categories');
    }

    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();
        return redirect('admin/sub_categories');
    }
}
