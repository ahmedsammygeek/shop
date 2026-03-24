 @php
 $lang = LaravelLocalization::getCurrentLocale() ;
 @endphp


 <header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-md-12">
                    <a href="{{ url('/') }}" class="brand-wrap">
                        <img style='max-height: 57px; !important' class="logo" src="{{ asset('shop-logo.svg') }}">
                    </a> 
                </div>
                <div class="col-xl-6 col-lg-5 col-md-6">
                    <form action="{{ route('search') }}" class="search-header">
                        <div class="input-group w-100">
                            <select class="custom-select border-right search-input"  name="category_name">
                                <option value="all"> جميع التصنيفات </option>
                                @foreach ($data['categories'] as $category)
                                <option value="{{ $category->id }}">  {{ $category->name }}  </option>
                                @endforeach
                            </select>
                            <input type="text" name='search' class="form-control search-input" placeholder="ابحث الان عن المنتجات داخل الموقع" >

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i> 
                                </button>
                            </div>
                        </div>
                    </form> 
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="widgets-wrap float-md-right">
                        @livewire('site.header-cart')
                 </div>
             </div>
         </div>
     </div>
 </section> 



 <nav class="navbar navbar-main navbar-expand-lg border-bottom">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('site.index') }}" > الرئيسيه </a> 
                </li>
                @foreach ($data['categories'] as $category)
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('category.products' , $category ) }}"> {{ $category->name }} </a>
                </li>
                @endforeach
               
            </ul>
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('complains') }}"> الشكاوى  و الاقتراحات </a>
                </li>
                @if ($lang == 'ar' )
                {{-- <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL('en') }}"> English </a> --}}
                @else
                <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL('ar') }}"> اللغه العربيه </a>
                @endif
            </ul>
        </div> <!-- collapse .// -->
    </div> <!-- container .// -->
</nav>

</header> <!-- section-header.// -->


<style>
    .cart-icon-wrapper {
  position: relative;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  text-decoration: none;
  color: inherit;
}

.cart-count {
  position: absolute;
  top: -2px;
  left: 0px; 
  background-color: #e74c3c;
  color: #fff;
  font-size: 11px;
  font-weight: bold;
  min-width: 20px;
  height: 20px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 3px;
}
</style>