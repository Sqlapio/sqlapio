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
<div class="{{ $class }} mt-2" id="profesion-div">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="phone" class="form-label"
                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.profesion')</label>
            <select onchange="handleProfesion(event);" name="profession" id="profession"
                class="form-control @error('profession') is-invalid @enderror" class="form-control combo-textbox-input">
                <option value=''>@lang('messages.placeholder.seleccione')</option>
                @foreach ($professions as $item)
                    <option value={{ $item->description }}>{{ $item->description }}
                    </option>
                @endforeach
                <option value='Otros'>@lang('messages.label.otros')</option>
            </select>
            <i class="bi bi-flag st-icon"></i>
        </div>
    </div>
</div>

<div class="{{ $class }}" id="div-otros" style="display: none">
    <div class="form-group">
        <div class="Icon-inside">
            <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                @lang('messages.label.nueva_profesion')
            </label>
            <input autocomplete="off" class="form-control mask-text" id="profession_new" name="profession_new"
                type="text" value="">
            <i data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip"
                data-html="true" title="Refrescar" class="bi bi-arrow-clockwise st-icon" onclick="refresh();"></i>
        </div>
    </diV>
</div>
