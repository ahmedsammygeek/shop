<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class CartItem extends Component
{   
    use LivewireAlert;

    public $item;
    public $productPrice;
    public $quantity;
    public $product;
    public $attributes;
    public $item_id;


    public function mount()
    {
        $this->product = $this->item->associatedModel;
        $this->productPrice = $this->item->price;
        $this->quantity = $this->item->quantity;
        $this->attributes = $this->item->attributes;
        $this->item_id = $this->item->id;
    }



    public function updatedQuantity()
    {
        // $new_quantity = $this->quantity;
        // $user_seesion_id = session()->getId();
        // $cart = \Cart::session($user_seesion_id);
        // $cartItem = $cart->get($this->item['id']);
        // if ($cartItem) {
        //     $cart->update($this->item['id'], [
        //         'quantity' => $new_quantity , 
        //     ]);
        // } 
        $this->emitTo('site.cart' , 'cartChanged');
    }

    public function removeItem($item_id) {
        $user_seesion_id = session()->getId();
        \Cart::session($user_seesion_id)->remove($item_id);
        $this->alert( 'success' ,  'تم حذف المنتج من السله بنجاح');
        $this->emitTo( 'site.cart' ,  'cartChanged');
    }


    public function getTotalProductPriceProperty()
    {
        return $this->quantity * $this->productPrice;
    }

    public function render()
    {
        return view('livewire.site.cart-item');
    }
}
