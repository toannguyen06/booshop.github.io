<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class OrderController extends Controller
{
    public function index(){
        $categories = Category::all();
        $orders = Auth::user()->order;
        // $orders = Order::all();
        return view('frontend.order.index', compact('orders', 'categories'));
    }


    public function create(){

        $order = Order::create([
            'price' => Session::get('myCart')->totalPrice(),
            'state' => 0,
            'user_id' => Auth::user()->id
        ]);
        foreach (Session::get('myCart')->products as $key => $value){
            $order->product()->attach((int) $key, ['quantity' => $value['quantity']]);
            Product::find($key)->decrement('quantity', $value['quantity']);
        }
        Session::forget('myCart');
        return 1;
    }

    public function show($id){
        // $categories = Category::all();
        $order = Order::find($id);
        $products = [];
        foreach ($order->product as $product){
            array_push($products, [
                'name' => $product->information->name,
                'img' => $product->image[0]->path,
                'quantity' => $product->pivot->quantity,
                'price' => $product->price,
                'code' => $product->product_code,
            ]);
        }
        return json_encode([
            'order' => ['id' => $order->id, 'date' => date_format($order->created_at, "d/m/Y"), 'price' => $order->price],
            'products' => $products, 
            'user' => ['name' => $order->user->information->fullname, 'email' => $order->user->email]
        ]);
    }
}
