<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class HeaderCart extends Component
{
    protected $listeners = ['cartChanged' => '$refresh'];
    
    public function render()
    {
        $user_seesion_id = session()->getId();
        $items =  \Cart::session($user_seesion_id)->getContent();
        $items_count = $items->count();
        return view('livewire.site.header-cart' , compact('items_count'));
    }
}
