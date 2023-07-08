@php
    use App\Models\State;
    use App\Models\City;
    $states = State::all();
    $cities = City::all();
@endphp

<div class="{{ $class }}">
    <div class="floating-label-group">
        <div class="Icon-inside">
            <select name="state" id="state" class="form-control"
                onchange="handlerState(event,{{ $states }}, {{ $cities }})">
                <option value="">Seleccione el estado</option>
                @foreach ($states as $item)
                    <option value={{ $item->description }}>{{ $item->description }}</option>
                @endforeach
            </select>
            <i class="bi bi-gender-ambiguous"></i>
        </div>
    </div>
</div>

<div class="{{ $class }}">
    <div class="floating-label-group">
        <div class="Icon-inside">
            <select name="city" id="city" class="form-control">
                <option value="">Seleccione el ciudad</option>
            </select>
            <i class="bi bi-gender-ambiguous"></i>
        </div>
    </div>
</div>


<script>
    let cityFilte = []

    function handlerState(e, state, city) {
        $('#city').find('option').remove().end()
        cityFilter = city.filter((elem) => elem.state === e.target.value.toUpperCase());
        cityFilter.map((item) => {
            $('#city').append(new Option(item.description, item.description));
        });
    }
</script>
