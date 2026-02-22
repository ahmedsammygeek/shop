<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCountryPrice extends Model
{
    use HasFactory;



    public function country() {
        return $this->belongsTo(Country::class , 'country_id');
    }

    public function product() {
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class , 'user_id');
    }
}
