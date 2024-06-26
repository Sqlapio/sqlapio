@php
    use App\Http\Controllers\UtilsController;
    use App\Models\DoctorCenter;
    $centers = DoctorCenter::where('user_id', Auth::user()->id)
        ->where('status', 1)
        ->get();

@endphp
<div class="{{ $class }}" id="CM">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="center_id" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.centro_salud')</label>
            <select name="center_id" id="center_id" placeholder="@lang('messages.placeholder.seleccione')"
                class="form-control @error('center_id') is-invalid @enderror" class="form-control combo-textbox-input">
                @if (auth()->user()->role == "secretary" && Auth::user()->get_data_corporate_master->type_plane == 7 )
                    @php
                        $centerId = auth()->user()->get_data_corporate_master;
                    @endphp
                    <option value="{{ $centerId->center_id }}">{{ $centerId->get_center->description }}</option>
                @elseif (Auth::user()->role == 'secretary')
                    @php
                        $centerDoctor = auth()->user()->get_data_corporate_master->get_doctors;
                    @endphp

                    @foreach ($centerDoctor as $item)
                        <option value="{{ $item->center_id }}">{{ $item->get_center->description }} </option>
                    @endforeach
                @else
                    @foreach ($centers as $item)
                        <option value={{ $item->get_center->id }}>{{ $item->get_center->description }}</option>
                    @endforeach
                @endif
            </select>
            <i class="bi bi-hospital st-icon"></i>
        </div>
    </div>
</div>
