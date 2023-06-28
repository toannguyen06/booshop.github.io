<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'sale', 'date_expired'];

    public function product() {
        return $this->hasMany(Product::class, 'promotion_id');
    }
}
