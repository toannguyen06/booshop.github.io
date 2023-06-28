<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index(){
        $productByMonth = Product::productBy('month');
        $productByDay = Product::productBy('day');
        $productNew = Product::productBy('new');
        $userByMonth = User::userBy('month');
        $userByDay = User::userBy('day');
        $userNew = User::userBy('new');
        $orderByMonth = Order::orderBy('month');
        $orderByDay = Order::orderBy('day');
        $orderNew = Order::orderBy('new');
        $salesByMonth = Order::salesBy('month');
        $salesByDay = Order::salesBy('day');
        $salesNew = Order::salesBy('new');
        
        $sellingProducts = Product::getSellingProducts(5);
        // dd($sellingProducts);
        return view('backend.index', [
            'productByMonth' => $productByMonth,
            'productByDay' => $productByDay,
            'productNew' => $productNew,
            'userByMonth' => $userByMonth,
            'userByDay' => $userByDay,
            'userNew' => $userNew,
            'orderByMonth' => $orderByMonth,
            'orderByDay' => $orderByDay,
            'orderNew' => $orderNew,
            'salesByMonth' => $salesByMonth,
            'salesByDay' => $salesByDay,
            'salesNew' => $salesNew,
            'sellingProducts' => $sellingProducts,
        ]);
    }
}
