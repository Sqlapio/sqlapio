<style>
    @media screen and (max-width: 768px) {
        .mt-mb {
            margin-top: 0.25rem !important;
        }
    }
</style>

<div>
    <div class="row mt-2" style='align-items: flex-end;'>
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-4">
            <div class="form-group">
                @if (Auth::user()->contrie == '81')
                    <label for="search_person" class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: -23px">@lang('messages.form.CIE')</label>
                @else
                    <label for="search_person" class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: -23px"> @lang('messages.form.cedula_identidad') </label>
                @endif
                <input type="text" class="form-control mask-only-number {{ Auth::user()->contrie == '81' ? 'mask-id-dom' : '' }}" id="search_person" name="search_person"  placeholder="@lang('messages.placeholder.buscar_paciente')" value="">
            </div>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1 mt-3 mt-mb">
            <button style="margin-top: 12px;" onclick="searchPerson()" class="btn btnSecond">@lang('messages.botton.buscar')</button>
        </div>
    </div>
</div>
