@php
    use App\Http\Controllers\UtilsController;
    use App\Models\DoctorCenter;
    $centers = DoctorCenter::where('user_id', Auth::user()->id)
        ->where('status', 1)
        ->get();
@endphp
<div class="{{ $class }}">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Seleccione el Centro</label>
            <select  name="center_id" id="center_id" placeholder="Seleccione"
                class="form-control @error('center_id') is-invalid @enderror" class="form-control combo-textbox-input">
                <option value=''>Seleccione</option>
                @foreach ($centers as $item)
                    <option value={{ $item->get_center->id }}>{{ $item->get_center->description }}
                    </option>
                @endforeach
            </select>
            <i class="bi bi-hospital st-icon"></i>
        </div>
    </div>
</div>
