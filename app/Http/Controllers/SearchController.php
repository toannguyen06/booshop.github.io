<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductInformation;
use App\Models\Category;
class SearchController extends Controller
{
    public function search (Request $request){
        $categories = Category::all();
        $productInformations = ProductInformation::where('name', 'like', '%'.$request->input('search').'%')->get();
        $products = [];
        foreach ($productInformations as $productInformation){
            $products[] = $productInformation->product;
        }
        return view('frontend.search.index', [
            'products' => $products,
            'categories' => $categories,
            'search' => $request->input('search'),
        ]);
    }
}
