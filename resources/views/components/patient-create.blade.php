<div>
    <div class="row form-patient-register" style="display: none">

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
            <small class="text-warning">NOTA: Si el paciente es menor de edad debe colocar el correo del representante.!</small>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 mt-3">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="name_patient" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre')</label>
                    <input autocomplete="off" placeholder="" class="form-control mask-text" id="name_patient" name="name_patient" type="text" value="">
                    <i class="bi bi-person-circle st-icon"></i>
                </div>
            </diV>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 mt-3">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="last_name_patient" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.apellido')</label>
                    <input autocomplete="off" placeholder="" class="form-control mask-text" id="last_name_patient" name="last_name_patient" type="text" value="">
                    <i class="bi bi-person-circle st-icon"></i>
                </div>
            </diV>
        </div>
        <input type="hidden" name="is_minor" id="is_minor" value="false">

        <input id="age_patient" name="age_patient" type="hidden" value="">

        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mt-3">
            <div class="form-group">
                <label for="birthdate_patient" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                    @lang('messages.form.fecha_nacimiento')
                </label>
                <input class="form-control date-bd" id="birthdate_patient" name="birthdate_patient" type="date" value=""
                    style="padding: 0.375rem 5px 0.375rem 0.75rem;" onchange="calculateAge(event,'age_patient');">
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 mt-3">
            {{-- <x-phone_component :phone="null"/> --}}
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.telefono')</label>
                    <input autocomplete="off" placeholder="" class="form-control phone" id="phone" name="phone" type="text" value="">
                    <i class="bi bi-telephone-forward st-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="email_patient" class="form-label"
                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label>
                    <input autocomplete="off" placeholder="" class="form-control" id="email_patient" name="email_patient" type="text" value="">
                    <i class="bi bi-envelope-at st-icon"></i>
                </div>
            </diV>
        </div>

    </div>
</div>
