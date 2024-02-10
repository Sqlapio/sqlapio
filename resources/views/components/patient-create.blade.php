<div>
    <div class="row form-patient-register" style="display: none">

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
            <small class="text-warning">Si el paciente es menor de edad debe colocar la cedula y el correo del representante.!</small>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="name_patient" class="form-label"
                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                    <input autocomplete="off" placeholder="" class="form-control mask-text" id="name_patient" name="name_patient"
                        type="text" value="">

                    <i class="bi bi-person-circle" style="top: 30px"></i>
                </div>
            </diV>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="last_name_patient" class="form-label"
                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                    <input autocomplete="off" placeholder="" class="form-control mask-text" id="last_name_patient"
                        name="last_name_patient" type="text" value="">
                    <i class="bi bi-person-circle" style="top: 30px"></i>
                </div>
            </diV>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="ci_patient" class="form-label"
                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Cédula
                        de identidad</label>
                    <input autocomplete="off" placeholder="" type="number" class="form-control" id="ci_patient"
                        name="ci_patient" type="text" value="">
                    <i class="bi bi-person-vcard" style="top: 30px"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
            <div class="form-group">
                <div class="Icon-inside">
                    <label for="email_patient" class="form-label"
                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                        electrónico</label>
                    <input autocomplete="off" placeholder="" class="form-control" id="email_patient" name="email_patient"
                        type="text" value="">
                    <i class="bi bi-envelope-at" style="top: 30px"></i>
                </div>
            </diV>
        </div>
        <input type="hidden" name="is_minor" id="is_minor" value="false">

        <input id="age_patient" name="age_patient" type="hidden" value="">

        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
            <div class="form-group">
                <label for="birthdate_patient" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                    @lang('messages.form.fecha_nacimiento')
                </label>
                <input class="form-control date-bd" id="birthdate_patient" name="birthdate_patient" type="date" value=""
                    style="padding: 0.375rem 5px 0.375rem 0.75rem;" onchange="calculateAge(event,'age_patient');">
            </div>
        </div>
    </div>
</div>
