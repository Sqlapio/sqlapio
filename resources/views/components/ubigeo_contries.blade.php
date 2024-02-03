@php
    use App\Models\Contries;
    use App\Models\StatesContries;
    use App\Models\CityContries;

    $contrie = Contries::where('enable',true)->get();
    $states = StatesContries::all();
    $cityContries = CityContries::all();

@endphp

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="contrie" class="form-label" style="font-size: 13px; margin-bottom: 7px">Seleccione el pais</label>
            <select name="contrie" id="contrie" class="form-control"
                onchange="handlerState(event)">
                <option value="">Seleccione</option>
                @foreach ($contrie as $item)
                    <option value={{ $item->id }}>{{ $item->name }}</option>
                @endforeach
            </select>
            <i class="bi bi-flag" style="top: 30px"></i>
        </div>
    </div>
</div>

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="state_contrie" class="form-label" style="font-size: 13px; margin-bottom: 7px">Seleccione el estado</label>
            <select onchange="handlercity(event)"  name="state_contrie" id="state_contrie" class="form-control">
                <option value="">Seleccione</option>
            </select>
            <i class="bi bi-flag" style="top: 30px"></i>
        </div>
    </div>
</div>

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="city_contrie" class="form-label" style="font-size: 13px; margin-bottom: 7px">Seleccione la ciudad</label>
            <select name="city_contrie" id="city_contrie" class="form-control">
                <option value="">Seleccione</option>
            </select>
            <i class="bi bi-flag" style="top: 30px"></i>
        </div>
    </div>
</div>


<script>
    let state_contrie = [];

    let city_contries = [];

    let states = @json($states);

    let cityContries = @json($cityContries);

    function handlerState(e) {
        $('#state_contrie').find('option').remove().end();
        $('#city_contrie').find('option').remove().end();
        state_contrier = states.filter((elem) => Number(elem.contrie_id)  === Number(e.target.value));
        state_contrier.map((item) => {
            $('#state_contrie').append(new Option(item.name, item.id));
        });
    }

    function handlercity(e) {
        $('#city_contrie').find('option').remove().end()
        city_contries = cityContries.filter((elem) => Number(elem.state_id)  === Number(e.target.value));
        city_contries.map((item) => {
            $('#city_contrie').append(new Option(item.name, item.id));
        });
    }
</script>
