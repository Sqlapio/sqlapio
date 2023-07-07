@php
    use App\Models\City;
    $cities = City::all();
@endphp
<div class="Icon-inside">
    <select name="city" id="city" class="form-control">
        <option value="">Seleccione el ciudad</option>
        @foreach ($cities as $item)
            <option value={{ $item->description }}>{{ $item->description }}</option>
        @endforeach
    </select>
    <i class="bi bi-gender-ambiguous"></i>
</div>