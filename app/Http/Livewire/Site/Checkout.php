<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\{Governorate , Country , City };
use Auth;
class Checkout extends Component
{

    public $governorate_id;
    public $city_id;
    public $country_id;

    public function getCountriesProperty()
    {
        return Country::all();
    }

    public function getGovernoratesProperty()
    {
        return Governorate::all();
    }

    public function getCitiesProperty()
    {
        return City::where('governorate_id' , $this->governorate_id )->get();
    }


    public function getShippingPriceProperty()
    {
        if ($this->city_id) {
            return City::find($this->city_id)?->shipping_cost ? City::find($this->city_id)?->shipping_cost : Governorate::find($this->governorate_id)?->shipping_cost;
        }

        if ($this->governorate_id) {
            return Governorate::find($this->governorate_id)?->shipping_cost;
        }
        return 0;
    }

    public function getSubTotalProperty()
    {
        $user_seesion_id = session()->getId();
        $items =  \Cart::session($user_seesion_id)->getContent();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;

    }


    public function getTotalProperty()
    {
        return $this->sub_total + $this->shipping_price;
    }



    public function render()
    {
        $user_seesion_id = session()->getId();
        $items = \Cart::session($user_seesion_id)->getContent();
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->quantity * $item->product?->price );
        }
        return view('livewire.site.checkout' , compact('total' , 'items'  ) );
    }
}
