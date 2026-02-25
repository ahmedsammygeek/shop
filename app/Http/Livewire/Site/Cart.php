<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Cart extends Component
{
    use LivewireAlert;
    // protected $listeners = ['cartChanged' => '$refresh' ];

    protected $listeners = ['cartChanged' => '$refresh'];

    public $subtotal;
    public $coupon;

    // public function doSomeThing() {

    //     dd('ggg');
    // }

    public function chackCoupon() {
        
    }
    public function getTotalProperty() {
        // $total = 0;
        // $items = CartModel::where('user_id' , Auth::id() )->get();
        // foreach ($items as $item) {
            
        //     $total += $item->quantity * $item->price;
        // }
        // return $total;

        return 900;
    }



    public function render()
    {
        $user_seesion_id = session()->getId();
        $items =  \Cart::session($user_seesion_id)->getContent();
        // $items = CartModel::where('user_id' , Auth::id() )->get();
        $total = 500;
        // foreach ($items as $item) {
        //     $total += ($item->quantity * $item->price );
        // }

        return view('livewire.site.cart' , compact('items' , 'total'));
    }
}
