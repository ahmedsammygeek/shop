<?php

namespace App\Http\Livewire\Board\Products\Variations;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Variation;
class ParentVariation extends Component
{
    use LivewireAlert;
    public $variant;
    public $type;
    public $title;
    public $stocks;

    protected $listeners = ['variantAdded' => '$refresh' , 'variantDeleted' => '$refresh' ];

    public function deleteVariant() {
        $this->variant->children()->delete();
        $this->variant->delete();
        $this->emit('variantDeleted');
    }

    public function mount() {
        $this->type = $this->variant->type;
        $this->title = $this->variant->title;
        $this->stocks = $this->variant->stocks;
    }

    public function updatedType()
    {
        $this->variant->type = $this->type;
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
        $children = Variation::where('parent_id' , $this->variant->id )->get();
        return view('livewire.board.products.variations.parent-variation' , compact('children'));
    }
}
