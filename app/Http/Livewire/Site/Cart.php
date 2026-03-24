<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Cart extends Component
{
    use LivewireAlert;
    protected $listeners = ['cartChanged' => '$refresh'];
    public $subtotal;
    public $coupon;

    public function chackCoupon() {
        
    }

    public function getTotalProperty() {
        $user_seesion_id = session()->getId();
        $items =  \Cart::session($user_seesion_id)->getContent();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }



    public function render()
    {
        $user_seesion_id = session()->getId();
        $items = \Cart::session($user_seesion_id)->getContent();
        $total = $this->getTotalProperty();
        return view('livewire.site.cart' , compact('items' , 'total'));
    }
}
