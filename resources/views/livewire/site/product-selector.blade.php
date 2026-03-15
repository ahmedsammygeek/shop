<div>
    <div class="mb-3"> 
        @if ($this->hasDiscount())
        <var class=" h4"> سعر المنتج : {{ $productPriceAfterDiscount }} جنيه  </var> 
        <span class="text-muted old-price"> <del>{{ $product->price }}</del> {{ Session::get('currency') }} </span> 
        @else
        <var class=" h4"> سعر المنتج : {{ $productPrice }} {{ Session::get('currency') }}   </var> 
        @endif
    </div> 
    <dl class="row">
       {{ $product->mini_description }}
    </dl>
    <hr>





    <div class="form  mt-4">
        @if ($initialVariation)
        @livewire('site.product-dropdown' ,  ['variations' => $initialVariation ] )
        @endif
        <br>
        <label> الكميه </label>
        <div class="form-group col-md flex-grow-0">
            <div class="input-group mb-3 input-spinner">
                <div class="input-group-prepend">
                    <button class="btn btn-light" wire:click='increasQuantity()' type="button" id="button-plus"> + </button>
                </div>
                <input type="text" class="form-control" value="{{ $quantity }}">
                <div class="input-group-append">
                    <button class="btn btn-light" wire:click='dcreasQuantity()' type="button" id="button-minus"> &minus; </button>
                </div>
            </div>
        </div> 
        <div class="form-group col-md">

            {{-- @if ($finalVariant || !$hasVariant ) --}}
            <a wire:click='add_to_cart()' href='#' class="btn btn-primary"> 
                <i class="fas fa-shopping-cart"></i> <span class="text"> اضف الى السله </span> 
            </a>
            {{-- @endif       --}}
        </div> 
    </div> 
</div>