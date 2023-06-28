<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

class PaymentController extends Controller
{
    public function show(){
        $cart = Session::get('myCart');
        $categories = Category::all();
        
        return view('frontend.cart.payment', [
            'cart' => $cart,
            'totalPrice' => $cart->totalPrice(),
            'categories' => $categories
        ]);
    }
}
