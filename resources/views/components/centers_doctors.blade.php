@php

    use App\Models\State;
    use App\Models\Center;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;

    $user_state_id = Auth::user()->state;
    $state = State::where('id', $user_state_id)->first();
    $centers = Center::where('state', $state->description)->get();
    
@endphp

<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.seleccionar_centro')</label>
            <select name="center_id" id="center_id" placeholder="Seleccione"
                class="form-control @error('center_id') is-invalid @enderror" class="form-control combo-textbox-input">
                <option value=''>@lang('messages.placeholder.seleccione')...</option>
                @foreach ($centers as $item)
                    <option value={{ $item->id }}>{{ $item->description }}
                    </option>
                @endforeach
            </select>
            <i class="bi bi-hospital st-icon"></i>
        </div>
    </div>
</div>
