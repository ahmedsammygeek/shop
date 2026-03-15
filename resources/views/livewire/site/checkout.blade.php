<div class="row">
  <aside class="col-md-6">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('checkout.save') }}" method="POST" >
          @csrf
          <div class="form-row">
            <legend> معلومات التواصل </legend>
            <div class="form-group col-md-12">
              <label> رقم واتس اب لتاكيد الطلب </label>
              <input type="text" class="form-control" name='whats_up' value="" placeholder="0550012412" >
              @error('whats_up')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> 
          </div>
          <hr>
          <div class="form-row">
            <legend> الشحن </legend>
            <div class="form-group col-md-12">
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
            </div> 
            <hr>
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
            <div class="form-group col-md-12">
              <label> العنوان </label>
              <input type="text" class="form-control" name='address' value=""  >
              @error('address')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> 

            <div class="form-group col-md-6">
              <label> المدينه </label>
              <input type="text" class="form-control" name='city' value="" >
              @error('city')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> 
            <div class="form-group col-md-6">
              <label> الرمز البريدى </label>
              <input type="text" class="form-control" name='postal_code' value="" >
              @error('postal_code')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> 

            <div class="form-group col-md-12">
              <label> رقم واتس اب لتاكيد الطلب </label>
              <input type="text" class="form-control" name='whats_up' value="" placeholder="0550012412" >
              @error('whats_up')
              <p class="text-danger" > {{ $message }} </p>
              @enderror
            </div> 
            
          </div>
          <hr>

          <div class="form-row">
            <legend> طرق الشحن </legend>
            <div class="col-md-12">
              <div class="co-ship-box">
                <div class="co-ship-name">الشحن الى السعودية</div>
                <div class="co-ship-price">
                  <span class="sp-old">---سعر---</span>
                  <span class="sp-new">FREE</span>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-row">
            <legend> الدفع </legend>
            <div class="col-md-12">
              <div class="co-option-box">
                <div class="co-option-row">
                  <div class="co-option-content">
                    <div class="co-option-label">الدفع عند الاستلام</div>
                    <div class="co-option-desc">
                      المرجو الضغط على زر اتمام الطلب،بعد الانتهاء ستتواصل معاك في اقرب وقت لتأكيد الطلبية<br>
                      خدمة التوصيل تستغرق من 24 ساعة الى 72 ساعه كحد أعلى
                    </div>
                  </div>
                  <input type="radio" name="pay" checked>
                </div>
              </div>
            </div>
          </div>
          <hr>

          <div class="form-row">
            <button class="btn btn-primary btn-block">اتمام الطلب</button> 
          </div>

        </form>
        <hr>
      </div> 
    </div>  
  </aside> 
  <main class="col-md-6">

    <div class="co-summary">
      <ul class="co-items">
        @foreach ($items as $item)
        <li class="co-item">
          <div class="co-item-thumb">
            <img src="{{ Storage::url('products/'.$item->associatedModel?->image) }}" alt="">
            <span class="co-item-badge">{{ $item->quantity }}</span>
          </div>
          <div class="co-item-info">
            <div class="co-item-name"> {{ $item->name }} </div>
            @foreach ($item->attributes as $key => $value)
            @if ($value)
              <div class="co-item-variant">@lang('site.'.$key) : {{ $value }}</div>
            @endif
            @endforeach
          </div>
          <div class="co-item-price"> {{ $item->price * $item->quantity }}  {{ Session::get('currency') }} </div>
        </li>
        @endforeach
      </ul>

      <div class="co-totals">
        <div class="co-total-row">
          <span style="color:#555;">Subtotal · 257 items</span>
          <span class="t-val">٦٬٧٠٣٫٠٠٠ ر.ع</span>
        </div>
        <div class="co-total-row">
          <span style="color:#555;">الشحن</span>
          <div class="co-shipping-val">
            <span class="t-old">---سعر---</span>
            <span class="t-free">FREE</span>
          </div>
        </div>
        <div class="co-free-note">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          شحن مجاني اذا تم الشراء اك...
        </div>
        <div class="co-grand">
          <span class="co-grand-label">المجموع</span>
          <div class="co-grand-val">
            ٦٬٧٠٣٫٠٠٠
            <span class="co-grand-currency">ر.ع</span>
            <span class="co-grand-currency">OMR</span>
          </div>
        </div>
        <div class="co-discount-row">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
          اجمالى الخصم
          <span style="margin-right:auto;">٤٫٠٠٠ ر.ع</span>
        </div>
      </div>
    </div>
  </main> 
</div>

