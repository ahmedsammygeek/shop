@extends('site.layouts.master')

@section('page_content')
<section class="section-content padding-y">
    <div class="container">
        <header class="mb-3">
            <div class="form-inline">
                <strong class="mr-md-auto"> {{ $category->name }}  </strong>
                <select class="mr-2 form-control">
                    <option> الترتيب حسب </option>
                    <option>الاكثير مبيعا</option>
                    <option>الاكثير تقييما</option>
                    <option>الاحدث</option>
                    <option>الاقدم</option>
                    <option>الاقل سعرا</option>
                    <option>الاعلى سعرا</option>
                </select>
            </div>
        </header>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-6 col-lg-2">
                <x-product-card :product="$product" />
            </div> 
            @endforeach
        </div>
  </div>
</section>






@endsection