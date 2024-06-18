@php
    use App\Models\Contries;
    use App\Models\State;
    use App\Models\Cities;

    $active = false;
    if (Request::path() == 'auth/setting/profile') {
        $active = true;

        $contrie = Contries::where('enable', true)->get();
    } else {

        if(Auth::check()){

            $contrie = Contries::where('id', Auth::user()->contrie)->first();
        }else{
            $active = true;

            $contrie = Contries::where('enable', true)->get();

        }

    }

    $states = State::all();

    $cityContries = Cities::all();

@endphp


@if ($active)
    <div class="{{ $class }}">
        <div class="form-group">
            <div class="Icon-inside">
                <label for="contrie" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_pais')</label>
                <select name="contrie" id="contrie" class="form-control" onchange="handlerState(event)">
                    <option value="">@lang('messages.placeholder.seleccione')</option>
                    @foreach ($contrie as $item)
                        <option value={{ $item->id }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                <i class="bi bi-flag" style="top: 30px"></i>
            </div>
        </div>
    </div>
@endif

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="state_contrie" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_estado')</label>
            <select onchange="handlercity(event)" name="state_contrie" id="state_contrie" class="form-control">
                <option value="">@lang('messages.placeholder.seleccione')</option>
            </select>
            <i class="bi bi-flag" style="top: 30px"></i>
        </div>
    </div>
</div>

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="city_contrie" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_ciudad')</label>
            <select name="city_contrie" id="city_contrie" class="form-control">
                <option value="">@lang('messages.placeholder.seleccione')</option>
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

    let contrie = @json($contrie);

    if (contrie.length === undefined) {

        handlerState(contrie.id, true);
    }

    function handlerState(e, active = false) {

        let value = (!active) ? Number(e.target.value) : Number(e);

        $('#state_contrie').find('option').remove().end();

        $('#city_contrie').find('option').remove().end();

        state_contrier = states.filter((elem) => Number(elem.countries_id) === value);

        state_contrier.map((item) => {

            $('#state_contrie').append(new Option(item.description, item.id));

        });
    }

    function handlercity(e) {

        $('#city_contrie').find('option').remove().end();

        city_contries = cityContries.filter((elem) => Number(elem.state_id) === Number(e.target.value));

        city_contries.map((item) => {

            $('#city_contrie').append(new Option(item.description, item.id));
        });
    }
</script>
