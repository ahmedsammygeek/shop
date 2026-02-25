<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\{Variation , Product , ProductCountryPrice };

use Auth;
use Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ProductSelector extends Component
{
    use LivewireAlert;
    public $product;
    public $initialVariation;
    public $finalVariant;
    public $productPrice;
    public $productPriceAfterDiscount;
    public $hasVariant = false;
    public $quantity = 1;
    protected $listeners = ['finalVariantChoosed'];
    public function mount()
    {
        $country_id = Session::get('user_country');
        $product_country_price = ProductCountryPrice::where('product_id' , $this->product->id )
        ->where('country_id' , $country_id)
        ->first();


        if (!$product_country_price) {
            return redirect(route('site.index'));
        } 

        $this->productPrice = $product_country_price->price;
        $this->productPriceAfterDiscount = $product_country_price->price_after_discount;



        $this->initialVariation = $this->product->variations->where('type' , '!=' , 'one_size' )
        ->sortBy('order')
        ->groupBy('type')
        ->first();
        if ($this->initialVariation) {
            $this->hasVariant = true;
        } else {
            $this->hasVariant = false;
            $one_size_variation = $this->product->variations->first();
            $this->finalVariantChoosed($one_size_variation->id);
        }
    }


    public function increasQuantity()
    {
        $this->quantity++;
    }

    public function dcreasQuantity()
    {
        if ($this->quantity == 1 ) {
            return;
        }
        $this->quantity--;
    }


    public function getProductPrice()
    {
        if ($this->hasDiscount()) {
            return $this->productPriceAfterDiscount;
        }
        return $this->productPrice;
    }


    public function hasDiscount()
    {
        if ($this->productPriceAfterDiscount) {
            return true;
        }

        return false;
    }

    public function add_to_cart()
    {
        $user_seesion_id = session()->getId();

        if ($this->finalVariant->type  == 'size') {
            $size = $this->finalVariant->title;
            $color = null;
        } else if ($this->finalVariant->type  == 'color') {
            $color_variation =  $this->finalVariant;
            $size_variaton = Variation::where('id' , $this->finalVariant->parent_id )->first();
            $size = $size_variaton->title;
            $color = $color_variation->title;
        } else {
            $size = null;
            $color = null;
        }

        $cart = \Cart::session($user_seesion_id);

        $cartItem = $cart->get($this->finalVariant->id);

        if ($cartItem) {
            $cart->update($this->finalVariant->id, [
                'quantity' => +1
            ]);
        } else {
            \Cart::session($user_seesion_id)->add(array(
                'id' => $this->finalVariant->id ,
                'name' => $this->finalVariant->product?->name,
                'price' => $this->getProductPrice(),
                'quantity' => 1,
                'attributes' => [
                    'size' => $size , 
                    'color' => $color, 
                ],
                'associatedModel' => $this->product
            ));
        }
        $this->alert( 'success' ,  'تم إضافه المنتج '.$this->finalVariant?->product->name.' الى السله بنجاح' );
    }

    public function finalVariantChoosed($variateId)
    {
        if (!$variateId) {
            $this->finalVariant = null;
            $this->productPrice = $this->product->price ;
            return;
        }
        $this->finalVariant = Variation::find($variateId);
    }

    public function render()
    {
        return view('livewire.site.product-selector');
    }
}
