<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'user_id', 'state'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function getStateCharAttribute (){
        if ($this->attributes['state'] == 0){
            return 'Chưa duyệt';
        }
        if ($this->attributes['state'] == 1){
            return 'Đã duyệt';
        }
        if ($this->attributes['state'] == 2){
            return 'Hủy bỏ';
        }
       
    }

    static function orderBy($type){
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
            return static::select(DB::raw('count(*) as orderQuantity'))
                        ->whereRaw('DAY(created_at) = DAY(NOW())')
                        ->groupByRaw('DAY(created_at)')
                        ->get();
        }
    }

    static function salesBy($type){
        if ($type == 'day'){
            return static::select(DB::raw('sum(price) as y, DAY(created_at) AS x'))
                        ->whereRaw('MONTH(created_at) = MONTH(NOW())')
                        ->groupByRaw('DAY(created_at)')
                        ->get();
        }
        if ($type == 'month'){
            return static::select(DB::raw('sum(price) as y, MONTH(created_at) AS x'))
                        ->whereRaw('YEAR(created_at) = YEAR(NOW())')
                        ->groupByRaw('MONTH(created_at)')
                        ->get();
        }
        if ($type == 'new'){
            return static::select(DB::raw('sum(price) as salesQuantity'))
                        ->whereRaw('DAY(created_at) = DAY(NOW())')
                        ->groupByRaw('DAY(created_at)')
                        ->get();
        }
    }
}
