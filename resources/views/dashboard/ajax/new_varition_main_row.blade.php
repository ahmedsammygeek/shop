<div class="row main_row" data-row_number='{{ $rows_count }}' >

    <div class="col-md-4">
        <div class="form-group">
            <label class="col-form-label"> النوع </label>
            <select name="types[]" class='select form-control' id="">
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
            <button title='إضافه لون'  class="add_color  btn btn-outline-success border-2 ml-2"><i class="icon-plus3"></i> اضف لون </button>
        </div>                                      
    </div>

    <div class="child-row col-md-12"  >
        <ul class='' >

        </ul>
    </div>

</div>