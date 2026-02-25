@php
$lang = LaravelLocalization::getCurrentLocale();
if ($lang == 'ar') {
    $dir = 'rtl';
} else {
    $dir = 'ltr';
}
@endphp
<!DOCTYPE HTML>
<html lang="{{ $lang }}" dir="{{ $dir }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <livewire:styles />
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> اسم المتجر  </title>

    {{-- <link href="{{ asset('site_assets/images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon"> --}}
    <script src="{{ asset('site_assets/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('site_assets/css/ui.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('site_assets/css/responsive.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('site_assets/css/custom-css.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">


    <script src="{{ asset('site_assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    @if ($lang == 'ar')
    <link href="{{ asset('site_assets/css/bootstrap-rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet"> 
    <style>
        a , p , h1 , h2 , h3 , h4 , h5 , div , span , table , thead , tbody , button ,  th , tr , td {
            font-family: 'Cairo', sans-serif;
            font-weight: bold !important;
        } 
    </style>
    @else
    <link href="{{ Storage::url('site_assets/css/bootstrap3661.css') }}" rel="stylesheet" type="text/css"/>
    @endif

    <style>
        .prevArrow {
            top : 120px;
            display:block;
            z-index: 100;
            position : absolute;
        }
        .nextArrow {
           top : 120px;
           display:block;
           z-index: 100;
           position : absolute;
           left : -8px;
       }
   </style>

   <!-- Font awesome 5 -->
   <link href="{{ asset('site_assets/fonts/fontawesome/css/all.min3661.css') }}" type="text/css" rel="stylesheet">

   <style>


   </style>
   @yield('styles')
   <link href="{{ asset('site_assets/css/ui3661.css') }}" rel="stylesheet" type="text/css"/>
   <link href="{{ asset('site_assets/css/responsive3661.css') }}" rel="stylesheet" type="text/css" />
   <script src="{{ asset('site_assets/js/script3661.js') }}" type="text/javascript"></script>
   <script src="{{ asset('site_assets/js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('site_assets/js/main.js') }}"></script>
   <script src="{{ asset('site_assets/js/all.min.js') }}"></script>
   <script src="{{ asset('site_assets/js/sweetalert2.js') }}"></script>
   <script src="{{ asset('site_assets/js/slick.min.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   @yield('scripts')
   @stack('scripts')
   <livewire:scripts />
   <x-livewire-alert::scripts />
</head>
<body>

    <form class="fixed-select-container" action="{{ route('site.set_country') }}" method="POST" >
        @csrf
        <select class="form-control" name="country_id"  onchange="this.form.submit()" >
            <option value="">🌐 اختر الدولة</option>
            @foreach ($data['countries'] as $one_country)
            <option value="{{ $one_country->id }}"  {{ Session::get('user_country') == $one_country->id ? 'selected="selected"' : '' }} >{{ $one_country->name }}</option>
            @endforeach
        </select>
    </form>

    
    @include('site.layouts.header')

    @yield('page_content')

    @include('site.layouts.footer')
    @include('dashboard.layouts.messages')


</body>
</html>