<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Http\Controllers\Controller;
use App\Models\ProductInformation;
use App\Models\Promotion;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function home()
    {
        $categories = Category::all();
        return view('frontend.product.home', compact('categories'));
    }
    public function index()
    {
        $products = Product::all();
        return view('backend.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('backend.product.show', compact('product'));
    }

    public function create()
    {
        $promotions = Promotion::all();
        $categories = Category::all();
        return view('backend.product.create', compact('promotions'), compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'product_code' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'name' => 'required',
            'sub_category_id' => 'required',
            'path' => 'required',
        ]);
        $files = $request->file('path');
        $product = Product::create($request->input());

        ProductInformation::create(['product_id' => $product->id]);
        $product->information->update($request->input());

        foreach ($request->input('sub_category_id') as $cateId){
            $product->subCategory()->attach($cateId);
        }

        foreach ($files as $file){
            $file->storeAs('', $file->getClientOriginalName(), 'products');
            ImageProduct::create([
                'path' => $file->getClientOriginalName(),
                'product_id' => $product->id
            ]);
        }

        return redirect('admin/products');
    }

    public function edit(Product $product)
    {
        $promotions = Promotion::all();
        $categories = Category::all();
        $subCateIds = [];
        foreach ($product->subCategory as $subCategory){
            array_push($subCateIds, $subCategory->id);
        }

        return view('backend.product.edit', compact('product', 'promotions', 'categories', 'subCateIds'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'product_code' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'name' => 'required',
            'sub_category_id' => 'required',
            // 'path' => 'required',
        ]);
        $product->update($request->input());
        $product->information->update($request->input());
        $product->subCategory()->sync($request->input('sub_category_id'));

        if ($request->file('path')) {
            foreach ($product->image as $img){
                if (Storage::disk('products')->exists($img->path)) {
                    Storage::disk('products')->delete($img->path);
                }
                $img->delete();
            }
            $files = $request->file('path');
            foreach ($files as $file){
                $file->storeAs('', $file->getClientOriginalName(), 'products');
                ImageProduct::create([
                    'path' => $file->getClientOriginalName(),
                    'product_id' => $product->id
                ]);
            }
        }


        return redirect('admin/products');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('admin/products');
    }
}
