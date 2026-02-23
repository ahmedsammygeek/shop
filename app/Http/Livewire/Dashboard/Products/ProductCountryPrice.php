<?php

namespace App\Http\Livewire\Dashboard\Products;

use Livewire\Component;
use App\Models\ProductCountryPrice as ProductCountryPriceModel;
class ProductCountryPrice extends Component
{
    public $country;
    public $product;
    public $i;
    public $price;
    public $price_after_discount;


    public function mount() {

        if ($this->product != null ) {

            $product_country_price = ProductCountryPriceModel::where('product_id' , $this->product->id )
            ->where('country_id' , $this->country->id )
            ->first();
            if ($product_country_price) {
                $this->price = $product_country_price->price;
                $this->price_after_discount = $product_country_price->price_after_discount;
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.products.product-country-price');
    }
}
