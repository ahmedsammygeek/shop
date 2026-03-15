{{--    <div class="row">
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
--}}


<div class="co-page">
  <div class="co-wrap">
    <div class="co-form-panel">
      <h2 class="co-sec-title">معلومات التواصل</h2>
      <p class="co-login-hint"><a href="#">تسجيل الدخول</a>(ليس ضروري)</p>

      <div class="co-field">
        <input type="tel" class="co-input" placeholder="الرجاء ادخال رقم الواتساب (ضروري لتاكيد الطلب)">
      </div>
      <label class="co-check-row">
        <span>اريد الاستفادة من العروض القادمة</span>
        <input type="checkbox" checked>
      </label>

      <hr class="co-divider">

      <h2 class="co-sec-title">الشحن</h2>

      <div class="co-country-wrap">
        <span class="co-country-label">الدولة/البلد</span>
        <div class="co-country-select-inner">
          <select class="co-input">
            <option>🇸🇦 المملكة العربية السعودية</option>
            <option>🇪🇬 مصر</option>
            <option>🇦🇪 الإمارات</option>
            <option>🇰🇼 الكويت</option>
          </select>
          <span class="co-country-chevron">&#8964;</span>
        </div>
      </div>

      <div class="co-row">
        <input type="text" class="co-input" placeholder="الاسم الاخير (ليس ضروري)">
        <input type="text" class="co-input" placeholder="الاسم الاول">
      </div>

      <div class="co-addr-wrap">
        <span class="co-addr-icon">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </span>
        <input type="text" class="co-input" placeholder="العنوان">
      </div>

      <div class="co-row">
        <input type="text" class="co-input" placeholder="المدينة">
        <input type="text" class="co-input" placeholder="الرمز البريدى (اختياري)">
      </div>

      <div class="co-wa-wrap">
        <span class="co-wa-icon">?</span>
        <input type="tel" class="co-input" placeholder="الرجاء اعادة ادخال رقم الواتساب (ضروري لتاكيد الطلب)">
      </div>

      <label class="co-check-row">
        <span>احفظ هذه المعلومات للمره القادمة</span>
        <input type="checkbox">
      </label>
      <label class="co-check-row">
        <span>اريد اتلقى رسائل بخصوص العروض</span>
        <input type="checkbox">
      </label>

      <hr class="co-divider">


      <h2 class="co-sec-title">طرق الشحن</h2>
      <div class="co-ship-box">
        <div class="co-ship-name">الشحن الى السعودية</div>
        <div class="co-ship-price">
          <span class="sp-old">---سعر---</span>
          <span class="sp-new">FREE</span>
        </div>
      </div>

      <hr class="co-divider">


      <h2 class="co-sec-title">الدفع</h2>
      <p class="co-payment-sub">كل طرق الدفع امنة</p>
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
      <hr class="co-divider">

      <h2 class="co-sec-title">عنوان الفاتورة (اتركها كما هي)</h2>
      <div class="co-option-box">
        <div class="co-billing-row">
          <label>الشحن لنفس العنوان اعلاه</label>
          <input type="radio" name="bill" checked>
        </div>
        <div class="co-billing-row">
          <label>الشحن لعنوان مختلف</label>
          <input type="radio" name="bill">
        </div>
      </div>
      <button class="co-submit-btn">اكمل الطلب</button>
    </div>
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
              <div class="co-item-variant">@lang('site.'.$key) : {{ $value }}</div>
            @endforeach
          </div>
          <div class="co-item-price">١٬٣٥٢٫٠٠٠ ر.ع</div>
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



  </div>
</div>