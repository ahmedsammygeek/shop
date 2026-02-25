<li class='row ml-2' >


    <div class="col-md-4">
        <div class="form-group">
            <label class="col-form-label"> الاسم </label>
            <input type="text" class="form-control @error('color_names.*') is-invalid @enderror" name="color_names[{{ $main_row_number }}][]" value="{{ old('color_names.*') }}" >
            @error('color_names.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>




    <div class="col-md-4">
        <div class="form-group">
            <label class="col-form-label"> الباركود </label>
            <input type="color" class="form-control @error('colors.*') is-invalid @enderror" name="colors[{{ $main_row_number }}][]" value="{{ old('colors.*') }}" >
            @error('colors.*')
            <p  class='text-danger' >  {{ $message }} </p>
            @enderror
        </div>
    </div>



    <div class="col-md-4">
        <div class="form-group">
            <label class="col-form-label"> خصائص </label> <br>
            <button title='الغاء' class="btn btn-outline-danger delete_color_row  border-2 ml-2"><i class="icon-trash"></i></button>
        </div>                                      
    </div>
</li>