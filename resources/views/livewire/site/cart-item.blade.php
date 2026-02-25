<tr>
  <td>
    <figure class="itemside">
      <div class="aside">
        <a href="{{ $product?->url() }}">
          <img src="{{ Storage::url('products/'.$product?->image) }}" class="img-sm">
        </a>
      </div>
      <figcaption class="info">

        <a href="{{ $product?->url() }}" class="title text-dark">{{ $product->name }}</a>
        @foreach ($attributes as $key =>  $value)
        <p class="text-muted small">  
          @lang('site.'.$key): {{ $value }}
          <br>
        </p>
        @endforeach
      </figcaption>
    </figure>
  </td>
  <td>
    {{ $productPrice }} <span class="text-muted"> {{ Session::get('currency') }} </span>
  </td>

  <td> 
    <select class="form-control" wire:model='quantity'>
      @for ($i = 1; $i < 20 ; $i++)
      <option  value='{{ $i }}' {{ $quantity == $i ? 'selected="selected"' : '' }} >{{ $i }}</option>
      @endfor
    </select> 
  </td>

  <td> 
    <div class="price-wrap"> 
     {{ $this->total_product_price }}
   </div> 
 </td>
 <td class="text-right"> 
  <a href="#" wire:click='removeItem({{ $item_id }})' class="btn btn-danger"> <i class="fa fa-trash"></i> حذف </a>
</td>
</tr>