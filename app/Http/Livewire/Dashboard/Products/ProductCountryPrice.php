<?php

namespace App\Http\Livewire\Dashboard\Products;

use Livewire\Component;

class ProductCountryPrice extends Component
{
    public $country;
    public $product;
    public $i;

    public function render()
    {
        return view('livewire.dashboard.products.product-country-price');
    }
}
