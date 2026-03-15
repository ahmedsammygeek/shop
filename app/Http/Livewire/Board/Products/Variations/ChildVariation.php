<?php

namespace App\Http\Livewire\Board\Products\Variations;

use Livewire\Component;

class ChildVariation extends Component
{

    public $variant;
    public $title;
    public $stocks;
    public $color;



    public function deleteVariant() {
        $this->variant->delete();
        $this->emit('variantDeleted');
        // return redirect(request()->header('Referer'))->with('success' , 'تم الحذف بنجاح' ); 
    }

    public function mount()
    {
        $this->title = $this->variant->title;
        $this->stocks = $this->variant->stocks;
        $this->color = $this->variant->color;
    }

    public function updatedColor()
    {
        $this->variant->color = $this->color;
        $this->variant->save();
    }

    public function updatedTitle()
    {
        $this->variant->title = $this->title;
        $this->variant->save();
    }

    public function updatedStocks()
    {
        $this->variant->stocks = $this->stocks;
        $this->variant->save();
    }



    public function render()
    {
        return view('livewire.board.products.variations.child-variation');
    }
}
