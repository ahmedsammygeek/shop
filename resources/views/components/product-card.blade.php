<div class="item-box">
    <div class="item-img">
        <div id="carouselExampleIndicators{{ $product->id }}" class="carousel slide"data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($product->images as $product_image)
                <li data-target="#carouselExampleIndicators{{ $product->id }}" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="{{ route('site.products.show' , $product ) }}">
                        <img class="" style='height: 225px !important;' src="{{ Storage::url('products/'.$product->image) }}" alt="{{ $product->name }}">
                    </a>
                </div>
                @foreach ($product->images as $product_image)
                <div class="carousel-item">
                    <a href="{{ route('site.products.show' , $product ) }}">
                        <img class="" style='height: 225px !important;' src="{{ Storage::url('products/'.$product_image->image) }}" alt="{{ $product->name }}">
                    </a>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    <div class="item-text">
        <h6 class='text-center' > {{ $product->name }} </h6>
        <h6 class='text-center' style='color:#053534 !important' >{{ $product->price }} {{ Session::get('currency') }} </h6>
        <a href='{{ route('site.products.show' , $product ) }}' class='btn btn-primary btn-block' > شاهد تفاصيل المنتج  </a>

    </div>
</div>