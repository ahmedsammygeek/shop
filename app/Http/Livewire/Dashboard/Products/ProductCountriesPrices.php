<?php

namespace App\Http\Livewire\Dashboard\Products;

use Livewire\Component;
use App\Models\Country;
class ProductCountriesPrices extends Component
{

    public $product;

    public function render()
    {
        $countries = Country::get();
        return view('livewire.dashboard.products.product-countries-prices' , compact('countries'));
    }
}
