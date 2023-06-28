<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function add (Request $request) {

        // Session::forget('myCart');
        $product = Product::find($request->input('product_id'));
        $cart = Session::has('myCart') ? Session::get('myCart') : null;
        $newCart = new Cart($cart);
        $newCart->addCart($product, (int) $request->input('quantity'));
        // dd($newCart);
        Session::put('myCart', $newCart);
        // dd(Session::get('myCart'));
        return "Thành công";
    }

    public function getCart(){
        $myCart = [];
        if (Session::has('myCart')){
            foreach (Session::get('myCart')->products as $key => $value){
                $myCart[] = $value;
            }
            // dd($myCart);
            return json_encode([
                'cart' => $myCart,
                'totalPrice' => Session::get('myCart')->totalPrice()
            ]);
        } else {
            return json_encode([
                'cart' => [],
                'totalPrice' => 0
            ]);
        }
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $cart = Session::get('myCart');
        $cart->deleteItemCart($id);
        Session::put('myCart', $cart);
        return "thành công";
    }

    public function showCart (){
        $categories = Category::all();
        $cart = Session::get('myCart');
        return view('frontend.cart.index', compact('categories'));
    }

    public function update(Request $request){
        // dd($request->input('id'));
        // dd($request->input('quantity'));
        $cart = Session::get('myCart');
        $cart->updateCartQuantity((int) $request->input('id'), (int) $request->input('quantity'));
        return "OK";
    }
}
