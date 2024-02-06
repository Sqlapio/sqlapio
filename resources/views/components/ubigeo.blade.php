@php
    use App\Models\State;
    use App\Models\City;
    $states = State::all();
    $cities = City::all();
@endphp

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            @if (Auth::user()->contrie == '81')
            <label for="state" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.provincia')</label>
            @else
            <label for="state" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_estado')</label>
            @endif
            <select name="state" id="state" class="form-control"
                onchange="handlerState(event,{{ $cities }})">
                <option value="">@lang('messages.placeholder.seleccione')</option>
                @foreach ($states as $item)
                    <option value={{ $item->id }}>{{ $item->description }}</option>
                @endforeach
            </select>
            <i class="bi bi-flag st-icon"></i>
        </div>
    </div>
</div>

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="city" class="form-label" style="font-size: 13px; margin-bottom: 7px">@lang('messages.form.selecion_ciudad')</label>
            <select name="city" id="city" class="form-control">
                <option value="">@lang('messages.placeholder.seleccione')</option>
            </select>
            <i class="bi bi-flag st-icon"></i>
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
