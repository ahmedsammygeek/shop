   <div class="row">
    <main class="col-md-6">
      <div class="card">
        <table class="table table-borderless table-shopping-cart">
          <thead class="text-muted">
            <tr class="small text-uppercase">
              <th scope="col">المنتج</th>
              <th scope="col" width="150"> سعر المنتج </th>
              <th scope="col" width="150"> العدد </th>
              <th scope="col" width="150"> المبلغ النهائى </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
            <tr>
              <td>
                <figure class="itemside">
                  <div class="aside">
                    <a href="{{ $item->associatedModel?->url() }}"> <img src="{{ Storage::url('products/'.$item->associatedModel?->image) }}" class="img-sm"> </a>
                  </div>
                  <figcaption class="info">
                    <a href="{{ $item->associatedModel?->url() }}" class="title text-dark">{{ $item->name }}</a>
                    @foreach ($item->attributes as $key => $value )
                    <p class="text-muted small">  
                      @lang('site.'.$key) : {{ $value }}
                      <br>
                    </p>
                    @endforeach
                  </figcaption>
                </figure>
              </td>
              <td>
                {{ $item->price }} <span class="text-muted"> {{ Session::get('currency') }} </span>
              </td>
              <td> 
                <div class="price-wrap"> 
                  {{ $item->quantity }} <span class="text-muted"></span>
                </div> 
              </td>
              <td> 
               {{ $item->quantity * $item->price }} <span class="text-muted"> {{ Session::get('currency') }} </span>
             </td>

           </tr>
           @endforeach
         </tbody>
       </table>
     </div> 
   </main> 
   <aside class="col-md-6">

    <div class="card">
      <div class="card-body">
        
        <form action="{{ route('checkout.save') }}" method="POST" >
          @csrf
          <div class="col-md-12">
           <div class="form-row">


              <div class="form-group col-md-6">
                <label> الاسم الاول </label>
                <input type="text" class="form-control" name='first_name' value="" placeholder="محمد" >
                @error('first_name')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
              </div> 



              <div class="form-group col-md-6">
                <label> الاسم الاخير </label>
                <input type="text" class="form-control" name='last_name' value="" placeholder="الجسمى" >
                @error('last_name')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
              </div> 
 



              <div class="form-group col-md-6">
                <label> رقم الجوال </label>
                <input type="text" class="form-control" name='phone' value="" placeholder="0550012412" >
                @error('phone')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
              </div> 

       
              <div class="form-group col-md-6">
                <label> رقم واتس اب لتاكيد الطلب </label>
                <input type="text" class="form-control" name='whats_up' value="" placeholder="0550012412" >
                @error('whats_up')
                <p class="text-danger" > {{ $message }} </p>
                @enderror
              </div> 
   


            <div class="form-group col-md-6">
              <label> الدوله </label>
              <select id="inputState" wire:model='country_id' name="country_id" class="form-control">
                <option value=""></option>
                @foreach ($this->countries as $country)
                <option value="{{ $country->id }}"> {{ $country->name }} </option>
                @endforeach
              </select>
              @error('governorate_id')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->

            <div class="form-group col-md-6">
              <label> المحافظه </label>
              <select id="inputState" wire:model='governorate_id' name="governorate_id" class="form-control">
                <option value=""></option>
                @foreach ($this->governorates as $governorate)
                <option value="{{ $governorate->id }}"> {{ $governorate->name }} </option>
                @endforeach
              </select>
              @error('governorate_id')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->

            <div class="form-group col-md-6">
              <label> المدينه </label>
              <input type="text" class="form-control" name="city" value=" ">
              @error('city')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->



  
            <div class=" form-group col-md-6">
              <label> العنوان بالتفصيل </label>
              <input type="text" class="form-control" name="address" value=" ">
              @error('address')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> <!-- form-group end.// -->




          

          <button class="btn btn-primary btn-block">اتمام الطلب</button> 
          <br>
        </div>
      </form>
      <hr>
      <dl class="dlist-align">
          <dt style="width:143px !important;"> المجموع الفرعى </dt>
          <dd class="text-right">{{ $this->sub_total }}  <span class="text-muted">  {{ Session::get('currency') }} </span> </dd>
        </dl>
        <dl class="dlist-align">
          <dt style="width:143px !important;">سعر الشحن:</dt>
          <dd class="text-right">
            @if (!$this->shipping_price)
            <span class="text-muted"> لم يتم حسابه بعد </span>
            @else
            {{ $this->shipping_price }}  <span class="text-muted">  {{ Session::get('currency') }} </span>
            @endif
          </dd>
        </dl>
        <dl class="dlist-align">
          <dt style="width:143px !important;">المبلغ الكلى :</dt>
          <dd class="text-right  h5"><strong>{{ $this->total }} </strong> <span class="text-muted">  {{ Session::get('currency') }} </span> </dd>
        </dl>
        


    </div> <!-- card-body.// -->
  </div>  <!-- card .// -->
</aside> <!-- col.// -->
</div>
