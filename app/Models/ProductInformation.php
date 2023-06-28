<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInformation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'author', 'published', 'language', 'decs', 'year', 'product_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
