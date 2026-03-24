<div class="widget-header">
    <a href="{{ route('cart') }}" class="widget-view cart-icon-wrapper">
        <div class="icon-area">
            <i class="fa fa-shopping-cart"></i>
        </div>
        <small class="text"> @lang('site.cart') </small>
        <span class="cart-count"> {{ $items_count }} </span>
    </a>
</div>