@php
    use App\Http\Controllers\UtilsController;
    use App\Models\Profession;
    $professions = Profession::all();
@endphp
<script>
    const handleProfesion = (e) => {

        if (e.target.value === "Otros") {
            $('#profesion-div').hide();
            $('#div-otros').show();
        }
    }

    const refresh = () => {
        $('#profession').val('').change();
        $('#profesion-div').show();
        $('#div-otros').hide();
    }
</script>
<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2" id="profesion-div">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="phone" class="form-label"
                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Profesión</label>
            <select onchange="handleProfesion(event);" name="profession" id="profession"
                class="form-control @error('profession') is-invalid @enderror" class="form-control combo-textbox-input">
                <option value=''>Seleccione</option>
                @foreach ($professions as $item)
                    <option value={{ $item->description }}>{{ $item->description }}
                    </option>
                @endforeach
                <option value='Otros'>Otros</option>
            </select>
            <i class="bi bi-flag st-icon"></i>
        </div>
    </div>
</div>

<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2" id="div-otros" style="display: none">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                Nueva profesión
            </label>
            <input autocomplete="off" class="form-control mask-text" id="profession_new" name="profession_new"
                type="text" value="">
            <i data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip"
                data-html="true" title="Refrescar" class="bi bi-arrow-clockwise st-icon" onclick="refresh();"></i>
        </div>
    </diV>
</div>
