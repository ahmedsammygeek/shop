@extends('dashboard.layouts.master')

@section('page_title')
{{ trans('products.add_new_product') }}
@endsection

@section('page_header')
<a href="{{ route('dashboard.products.index') }}" class="breadcrumb-item"><i class="icon-ampersand  mr-2"></i> @lang('products.products')</a>
<span class="breadcrumb-item active"> @lang('products.add_new_product') </span>
@endsection

@section('page_content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			
			<div class="card-header bg-primary text-white header-elements-sm-inline" >
				<h5 class="card-title"> @lang('products.add_new_product') </h5>
				<div class="header-elements">
					<div class="d-flex justify-content-between">
						<div class="list-icons ml-3">
							<a class="list-icons-item" data-action="collapse"></a>
							<a class="list-icons-item" data-action="reload"></a>
							<a class="list-icons-item" data-action="remove"></a>
						</div>
					</div>
				</div>
			</div>
			<form action="{{ route('dashboard.products.store') }}" method='POST' enctype="multipart/form-data" > 
				@csrf
				<div class="card-body">

					<div class="tab-content">
						<div class="tab-pane fade show active" id="solid-justified-tab1">
							<fieldset class="mb-3">
								<legend> بيانات المنتج الاساسيه </legend>
								<div class="form-group row">
									<div class="col-md-6">
										<div  class='mb-2' >
											<label class="col-form-label"> اسم المنتج بالعربيه </label>
											<input type="text" class="form-control @error('name.ar') is-invalid @enderror" name="name[ar]" value="{{ old('name.ar') }}" >
											@error('name.ar')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div  class='mb-2' >
											<label class="col-form-label"> اسم المنتج بالانجليزيه </label>
											<input type="text" class="form-control @error('name.en') is-invalid @enderror" name="name[en]" value="{{ old('name.en') }}" >
											@error('name.en')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>

									<div class="col-md-4">
										<div  class='mb-2' >
											<label class="col-form-label"> @lang('products.category') </label>
											<select name="category_id" id="select1" class="form-control ">

												@foreach ($categories as $category)
												<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
											@error('category_id')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>


									<div class="col-md-4">
										<div  class='mb-2' >
											<label class="col-form-label"> @lang('products.image') </label>
											<input type="file" name="image" class="form-control @error('image') is-invalid @enderror " >
											@error('image')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>
									<div class="col-md-4">
										<div  class='mb-2' >
											<label class="col-form-label"> @lang('products.images') </label>
											<input type="file" name="images[]" multiple='multiple' class="form-control @error('images') is-invalid @enderror " >
											@error('images')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div  class='mb-2' >
											<label class="col-form-label">وصف بسيط للمنتج بالعربيه</label>
											<textarea name="mini_description[ar]"  class="form-control" rows="3" > {{ old('mini_description.ar') }} </textarea>
											@error('mini_description.ar')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>

									<div class="col-md-6">
										<div  class='mb-2' >
											<label class="col-form-label">وصف بسيط للمنتج بالانجليزيه </label>
											<textarea name="mini_description[en]"  class="form-control" rows="3" > {{ old('mini_description.en') }} </textarea>
											@error('mini_description.en')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>

									<div class="col-md-12">
										<div  class='mb-2' >
											<label class="col-form-label"> وصف تفصيلى للمنتج بالعربيه </label>
											<textarea name="description[ar]"  class="editor form-control" rows="3" > {{ old('description.ar') }} </textarea>
											@error('description.ar')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>

									<div class="col-md-12">
										<div  class='mb-2' >
											<label class="col-form-label"> وصف تفصيلى للمنتج بالانجليزيه </label>
											<textarea name="description[en]"  class="editor form-control" rows="3" > {{ old('description.en') }} </textarea>
											@error('description.en')
											<p  class='text-danger' >  {{ $message }} </p>
											@enderror
										</div>
									</div>



								</div>			
							</fieldset>

							<fieldset>
								<legend> اسعار المنتج </legend>
								<div class="row">
									@livewire('dashboard.products.product-countries-prices')
								</div>
							</fieldset>
							<fieldset>
								<legend> المقاسات & الالوان </legend>
								
									@include('dashboard.variations.create')
							
							</fieldset>
						</div>
					</div>
				</div>

				<div class="card-footer bg-white ">
					<a href="{{ route('dashboard.products.index') }}" class="btn btn-outline-primary w-100 w-sm-auto"> @lang('dashboard.cancel') </a>
					<button type="submit" name='add' class="btn btn-primary mr-2 mt-sm-0 w-100 w-sm-auto" style="float: left;"> @lang('dashboard.add') </button>
					{{-- <button type="submit" name='add_variations' class="btn btn-primary mr-2 mt-sm-0 w-100 w-sm-auto" style="float: left;"> حفظ و إضافه متغيرات </button> --}}
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script src="{{ Storage::url('dashboard_assets/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/ic4s7prz04qh4jzykmzgizzo1lize2ckglkcjr9ci9sgkbuc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	$(function() {

		tinymce.init({
			selector: 'textarea.editor',
			plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
			toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
		});


	});
</script>

@endsection