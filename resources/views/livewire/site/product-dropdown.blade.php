<div>

    <div class="modal" tabindex="-1" id="exampleModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">دليل المقاسات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-thumbnail" src="{{ Storage::url('products/'.$variations->first()?->product?->image) }}" alt="">
                </div>
            </div>
        </div>
    </div>


    <div class="variation-block">
        <div class="variation-label">
            @lang('site.'.$variations->first()?->type)
            @if ($show_sizes_ruler)
            <a class="size-guide-link" data-toggle="modal" data-target="#exampleModal" >دليل المقاسات</a>
            @endif
        </div>
        <ul class="size-options variation-options">
            @foreach ($variations as $variation)
            <li class="{{ $variation->stockCount() <= 0 ? 'oos' : '' }}">
                <input
                type="radio"
                wire:model='selectedVariation'
                name="variation_{{ $variations->first()?->type }}"
                id="variation_{{ $variation->id }}"
                value="{{ $variation->id }}"
                {{ !$variation->stockCount() ? 'disabled="disabled"' : '' }}
                />
                <label for="variation_{{ $variation->id }}">{{ $variation->title }}</label>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- Nested child variations (e.g. color after size) --}}
    @if ($this->selectedVariationModel?->children->count())
    @livewire('site.product-dropdown', ['variations' => $this->selectedVariationModel->children , 'show_sizes_ruler' => false ,  ], key(\Str::uuid()->toString()))
    @endif
</div>