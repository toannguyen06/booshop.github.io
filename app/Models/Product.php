<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_code', 'quantity', 'price_sale', 'price', 'promotion_id'];
    
    public function order(){
        return $this->belongsToMany(Order::class, 'order_product', 'order_id', 'product_id')->withPivot('quantity');
    }

    public function subCategory(){
        return $this->belongsToMany(SubCategory::class, 'product_sub_cate', 'product_id', 'sub_category_id');
    }

    public function information() {
        return $this->hasOne(ProductInformation::class, 'product_id');
    }

    public function promotion() {
        return $this->belongsTo(Promotion::class);
    }

    public function image() {
        return $this->hasMany(ImageProduct::class, 'product_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'product_id');
    }
    static function productBy($type){
        if ($type == 'day'){
            return static::select(DB::raw('count(*) as y, DAY(created_at) AS x'))
                        ->whereRaw('MONTH(created_at) = MONTH(NOW())')
                        ->groupByRaw('DAY(created_at)')
                        ->get();
        }
        if ($type == 'month'){
            return static::select(DB::raw('count(*) as y, MONTH(created_at) AS x'))
                        ->whereRaw('YEAR(created_at) = YEAR(NOW())')
                        ->groupByRaw('MONTH(created_at)')
                        ->get();
        }
        if ($type == 'new'){
            return static::select(DB::raw('count(*) as productQuantity'))
                        ->whereRaw('DAY(created_at) = DAY(NOW())')
                        ->groupByRaw('DAY(created_at)')
                        ->get();
        }
        
    }

    public function getPriceFormatAttribute (){
        return number_format($this->price, 0, ",", ".");
    }

    public function getPriceSaleFormatAttribute (){
        return number_format($this->price_sale, 0, ",", ".");
    }

    static function getSellingProducts($limit){
        $sellingProducts =  static::join('order_product', 'products.id', '=', 'order_product.product_id')
                                ->join('orders', 'orders.id', '=', 'order_product.order_id')
                                ->select(DB::raw('products.id ,SUM(order_product.quantity) as sold'))
                                ->where('orders.state', '=', 1)
                                ->groupBy('products.id')
                                ->orderBy('sold', 'desc')->limit($limit)->get();
        $sellingProducts = $sellingProducts->map(function ($product, $i){
            // dd($product);
            return [
                    'product' => static::find($product->id),
                    'sold' => $product->sold
            ];
        });
        return $sellingProducts;
    }

    


}
