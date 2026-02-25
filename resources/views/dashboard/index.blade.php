@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('dashboard.home') }}
@endsection

@section('page_header')
<span class="breadcrumb-item active"> @lang('dashboard.home') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-dark text-white">
			<div class="media">
				<div class="media-body">
					<h3 class="font-weight-semibold mb-0">{{ $orders_count }}</h3>
					<span class="text-uppercase font-size-sm text-muted">عدد الطلبات اليوم</span>
				</div>

				<div class="ml-3 align-self-center">
					<i class="icon-cart4 icon-3x"></i>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-dark text-white">
			<div class="media">
				<div class="media-body">
					<h3 class="font-weight-semibold mb-0">{{ $orders_total_income }} جنيه </h3>
					<span class="text-uppercase font-size-sm text-muted">اجمالى مبيعات طلبات اليوم </span>
				</div>

				<div class="ml-3 align-self-center">
					<i class="icon-cash3 icon-3x"></i>
				</div>
			</div>
		</div>
	</div>
	<hr>



	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-dark text-white">
			<div class="media">
				<div class="media-body">
					<h3 class="font-weight-semibold mb-0">{{ $products_count }} منتج</h3>
					<span class="text-uppercase font-size-sm text-muted">اجمالى عدد المنتجات</span>
				</div>

				<div class="ml-3 align-self-center">
					<i class="icon-ampersand  icon-3x"></i>
				</div>
			</div>
		</div>
	</div>


	<div class="col-sm-6 col-xl-3">
		<div class="card card-body bg-dark text-white">
			<div class="media">
				<div class="media-body">
					<h3 class="font-weight-semibold mb-0">{{ $categories_count }} قسم</h3>
					<span class="text-uppercase font-size-sm text-muted">اجمالى عدد الاقسام</span>
				</div>

				<div class="ml-3 align-self-center">
					<i class="icon-equalizer  icon-3x"></i>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection