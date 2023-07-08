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
                onchange="handlerState(event,{{ $cities }})">
                <option value="">Seleccione el estado</option>
                @foreach ($states as $item)
                    <option value={{ $item->id }}>{{ $item->description }}</option>
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
    let cityFilte = [];
    function handlerState(e,city) {
        $('#city').find('option').remove().end()
        cityFilter = city.filter((elem) => Number(elem.state_id)  === Number(e.target.value));
        cityFilter.map((item) => {
            $('#city').append(new Option(item.description, item.id));
        });
    }
</script>
