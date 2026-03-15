@extends('site.layouts.master')

@section('page_content')
<section class="section-content padding-y">
  <div class="container">
    @livewire('site.checkout')
  </div> 
</section>
@endsection




@push('styles')
<link rel="stylesheet" href="{{ asset('site_assets/css/checkout.css') }}">
@endpush