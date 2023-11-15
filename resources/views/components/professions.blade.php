@php
use App\Http\Controllers\UtilsController;
use App\Models\Profession;
$professions = Profession::all();
@endphp


<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3" id="profesion-div">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Profesión</label>
            <select name="profession" id="profession"
                class="form-control @error('profession') is-invalid @enderror"
                class="form-control combo-textbox-input">
                <option value=''>Seleccione</option>
                @foreach ($professions as $item)
                <option value={{ $item->description }}>{{ $item->description }}
                </option>
                @endforeach
            </select>
            <i class="bi bi-flag st-icon"></i>
        </div>
    </div>
</div>