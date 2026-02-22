<tr>
    <td> {{ $i }} </td>
    <td> {{ $country->name }} </td>
    <td> <input type="number" class='form-control' name="price[{{ $country->id }}]" ></td>
    <td>{{ $country->currency }}</td>
    <td> <input type="number" class='form-control' name="price_after_discount[{{ $country->id }}]" ></td>
    <td>{{ $country->currency }} <input type="hidden" name="country[{{ $country->id }}]" value="{{ $country->id }}"> </td>
</tr>