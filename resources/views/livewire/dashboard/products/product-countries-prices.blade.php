<div class="col-md-12 text-center">
    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th> # </th>
                <th> الدوله </th>
                <th> سعر المنتج </th>
                <th> العمله </th>
                <th>  السعر فى حاله وجود خصم </th>
                <th> العمله </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $country)
            @livewire('dashboard.products.product-country-price' , ['product' => null , 'country' => $country , 'i' => $loop->index + 1 ] )
            @endforeach

        </tbody>
    </table>
</div>
