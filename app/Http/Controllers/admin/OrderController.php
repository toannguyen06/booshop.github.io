<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class OrderController extends Controller
{
    public function index(){
        $categories = Category::all();
        $orders = Order::all();
        return view('backend.order.index', compact('orders', 'categories'));
    }
    public function create()
    {
        $orders = Order::all();
        return view('backend.order.create', compact('ordes'));
    }

    public function store(Request $request)
    {

        Order::create($request->input());
        return redirect('orders');
    }
    public function show($id){
        $order = Order::find($id);
        return view('backend.order.show', compact('order'));
    }

    public function update($id, Request $request){
        $order = Order::find($id);
        if ($request->input('browse')){
            $order->update(['state' => 1]);
            Auth::user()->update(['point' => 1234]);
        } else {
            foreach($order->product as $product){
                $product->increment('quantity', $product->pivot->quantity);
            }
            $order->update(['state' => 2]);
        }
        return redirect('admin/orders');
    }

    public function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return redirect('admin/orders');
    }
}
