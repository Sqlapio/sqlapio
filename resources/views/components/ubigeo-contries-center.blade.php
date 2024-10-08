@php
    use App\Models\Contries;
    use App\Models\State;
    use App\Models\Cities;

    $active = false;
    if (Request::path() == 'auth/setting/profile') {
        $active = true;

        $contrie_center = Contries::where('enable', true)->get();
    } else {

        if(Auth::check()){

            $contrie_center = Contries::where('id', Auth::user()->contrie)->first();
        }else{
            $active = true;

            $contrie_center = Contries::where('enable', true)->get();

        }

    }

    $states_center = State::all();

    $cityContries_center = Cities::all();

@endphp


@if ($active)
    <div class="{{ $class }}">
        <div class="form-group">
            <div class="Icon-inside">
                <label for="contrie_center" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_pais')</label>
                <select name="contrie_center" id="contrie_center" class="form-control" onchange="handlerStateCenter(event)">
                    <option value="">@lang('messages.placeholder.seleccione')</option>
                    @foreach ($contrie_center as $item)
                        <option value={{ $item->id }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                <i class="bi bi-geo-alt st-icon" ></i>
            </div>
        </div>
    </div>
@endif

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="state_contrie_center" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_estado')</label>
            <select onchange="handlercitycenter(event)" name="state_contrie_center" id="state_contrie_center" class="form-control">
                <option value="">@lang('messages.placeholder.seleccione')</option>
            </select>
            <i class="bi bi-geo-alt st-icon"></i>
        </div>
    </div>
</div>

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="city_contrie_center" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_ciudad')</label>
            <select name="city_contrie_center" id="city_contrie_center" class="form-control">
                <option value="">@lang('messages.placeholder.seleccione')</option>
            </select>
            <i class="bi bi-geo-alt st-icon"></i>
        </div>
    </div>
</div>


<script>
    let state_contrie_center = [];

    let city_contries_center = [];

    let states_center = @json($states_center);

    let cityContries_center = @json($cityContries_center);

    let contrie_center = @json($contrie_center);

    if (contrie_center.length === undefined) {


        handlerStateCenter(contrie_center.id, true);
    }

    function handlerStateCenter(e, active = false) {

        console.log('aquiii')

        let value = (!active) ? Number(e.target.value) : Number(e);

        $('#state_contrie_center').find('option').remove().end();

        $('#city_contrie_center').find('option').remove().end();

        state_contrier_center = states_center.filter((elem) => Number(elem.countries_id) === value);

        state_contrier_center.map((item) => {

            $('#state_contrie_center').append(new Option(item.description, item.id));

        });
    }

    function handlercitycenter(e) {

        $('#city_contrie_center').find('option').remove().end();

        city_contries_center = cityContries.filter((elem) => Number(elem.state_id) === Number(e.target.value));

        console.log(city_contries)

        city_contries_center.map((item) => {

            $('#city_contrie_center').append(new Option(item.description, item.id));
        });
    }
</script>
