<fieldset class="mb-3">
	<div>
		<button class='btn btn-success add_new_row '> إضافه جديد  </button>
	</div>

	<div class="main_rows">

		<div class="row main_row" data-row_number='0' >

			<div class="col-md-4">
				<div class="form-group">
					<label class="col-form-label"> النوع </label>
					<select name="types[]" class='select form-control' id="">
						<option value="one_size"> بدون </option>
						<option value="size"> مقاس </option>
					</select>
					@error('types.*')
					<p class='text-danger' >  {{ $message }} </p>
					@enderror
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label class="col-form-label"> الاسم </label>
					<input type="text" class="form-control @error('name.*') is-invalid @enderror" name="name[]" value="{{ old('name.*') }}" >
					@error('name.*')
					<p  class='text-danger' >  {{ $message }} </p>
					@enderror
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="col-form-label"> خصائص </label> <br>
					<button title='الغاء' class="btn btn-outline-danger delete_main_row  border-2 ml-2"><i class="icon-trash"></i></button>
					<button title='إضافه لون'  class="add_color	 btn btn-outline-success border-2 ml-2"><i class="icon-plus3"></i> اضف لون </button>
				</div>										
			</div>

			<div class="child-row col-md-12"  >
				<ul class='' >
					
				</ul>
			</div>

		</div>


		
	</div>
	
</fieldset>

@section('scripts')

<script>
	$(function() {


		$(document).on('click', 'button.delete_main_row', function(event) {
			event.preventDefault();
			var rows_count = $(document).find('div.main_row').length;
			if (rows_count > 1 ) {
				$(this).parent().parent().parent().remove();
			} else {
				alert('يجب اضافه متغير واحد على الاقل');
			}
		});

		$(document).on('click', 'button.delete_color_row', function(event) {
			event.preventDefault();
			$(this).parent().parent().parent().remove();
		});




		$('button.add_new_row').on('click',  function(event) {
			event.preventDefault();	
			rows_count = $(document).find('div.main_row').length;
			console.log(rows_count);
			$.ajax({
				url: '{{ route('dashboard.get_new_varition_main_row') }}',
				type: 'POST',
				dataType: 'html',
				data: {_token: "{{ csrf_token() }}" , 'rows_count':rows_count  },
			})
			.done(function(data) {
				$(document).find('div.main_rows').find('div.main_row').last().after(data);
			})
		});


		$(document).on('click',  'button.add_color'  ,  function(event) {
			event.preventDefault();	

			main_row_number = $(this).parent().parent().parent().attr('data-row_number');
			var the_main_row = $('div.main_row[data-row_number='+main_row_number+']');

			var child_rows_count_of_the_main_row = $('div.main_row[data-row_number='+main_row_number+']').find('div.child-row ul li').length;

			// console.log(child_rows_count_of_the_main_row);
			$.ajax({
				url: '{{ route('dashboard.get_new_varition_color_row') }}',
				type: 'POST',
				dataType: 'html',
				data: {_token: "{{ csrf_token() }}"  , main_row_number : main_row_number },
			})
			.done(function(data) {
				if (child_rows_count_of_the_main_row > 0 ) {
					$(document).find('div.main_row[data-row_number='+main_row_number+']').find('div.child-row ul li').last().after(data);
				} else {
					$(document).find('div.main_row[data-row_number='+main_row_number+']').find('div.child-row ul').addClass('border-info list-group '); 
					$(document).find('div.main_row[data-row_number='+main_row_number+']').find('div.child-row ul').append(data);
				}
			})
		});

	});
</script>

@endsection