@extends('layouts.app-auth')
@section('title', 'Historia Clínica')
@push('scripts')
    <script>
        let back_family = [];
        let allergies = [];
        let history_pathological = [];
        let history_non_pathological = [];
        let history_vital_signs = [];
        let history_surgical = [];
        let history_gynecological = [];
        let medications_supplements = [];
        let countBackFamily = 0;
        let countAllergies = 0;
        let countDiagnosis = 0;
        let countSurgical = 0;
        let countNotPathological = 0;
        let countGynecological = 0;
        let countMedicationSupplements = 0;
        let countMedicationAdd = 0;
        let countVitalSigns = 0;
        $(document).ready(() => {
            $('.mask-input').mask('000,00');
            $(".datePickert").datepicker({
                language: 'es'
            });

            $("#alert").hide();
            $('#form-mecal-histroy').validate({
                rules: {
                    weight: {
                        required: true,
                    },
                    height: {
                        required: true,
                    },
                    current_illness: {
                        required: true
                    },
                    reason: {
                        required: true
                    },
                    strain: {
                        required: true
                    },
                    temperature: {
                        required: true
                    },
                    breaths: {
                        required: true
                    },
                    pulse: {
                        required: true
                    },
                    saturation: {
                        required: true
                    },
                    condition: {
                        required: true
                    },                   
                    countBackFamily: {
                        required: true,
                    },
                    countAllergies: {
                        required: true,
                    },
                    countDiagnosis: {
                        required: true,
                    },
                    countSurgical: {
                        required: true,
                    },
                    countNotPathological: {
                        required: true,
                    },
                    countMedicationAdd: {
                        required: true,
                    },
                    countGynecological: {
                        required: true
                    },
                    countVitalSigns:{
                        required:true                        
                    }
                },
                messages: {
                    weight: {
                        required: "Peso es obligatorio",
                    },
                    height: {
                        required: "Altura es obligatoria",
                    },
                    countBackFamily: {
                        required: "Debe seleccionar uan opción"
                    },
                    countAllergies: {
                        required: "Debe seleccionar uan opción"
                    },
                    countDiagnosis: {
                        required: "Debe seleccionar uan opción"
                    },
                    countSurgical: {
                        required: "Debe seleccionar uan opción"
                    },
                    countNotPathological: {
                        required: "Debe seleccionar uan opción"
                    },
                    countMedicationAdd: {
                        required: "Debe seleccionar uan opción"
                    },
                    countGynecological: {
                        required: "Debe seleccionar uan opción"
                    },
                    current_illness: {
                        required: "Altura es obligatoria",
                    },
                    reason: {
                        required: "Motivo es obligatoria"
                    },
                    strain: {
                        required: "Tesion es obligatoria"
                    },
                    temperature: {
                        required: "Temperatura es obligatoria"
                    },
                    breaths: {
                        required: "Respiraciones es obligatoria"
                    },
                    pulse: {
                        required: "Pulso es obligatoria"
                    },
                    saturation: {
                        required: "Saturacion es obligatoria"
                    },
                    condition: {
                        required: "Condicion es obligatoria"
                    },
                    countVitalSigns:{
                        required: "Debe seleccionar uan opción"
                    }                
                }
            });

            //envio del formulario
            $("#form-mecal-histroy").submit(function(event) {
                event.preventDefault();
                $("#form-mecal-histroy").validate();
                if ($("#form-mecal-histroy").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    var data = $('#form-mecal-histroy').serialize();
                    $.ajax({
                        url: '{{ route('ClinicalHistoryCreate') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#alert").show()
                            $("#alert").text("Registro Exitioso");
                            $("#form-mecal-histroy").trigger("reset");
                            setTimeout(() => {
                                $("#alert").hide();
                            }, 3500);
                        },
                        error: function(error) {
                            $('#send').show();
                            $('#spinner').hide();
                            console.log(error.responseJSON.errors);

                        }
                    });
                }
            })
        })

        function handlerBackFamiliy(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                countBackFamily = countBackFamily + 1;
                back_family.push(e.target.value);
                $('#back_family').val(back_family);
                $('#countBackFamily').val(countBackFamily);
            } else {
                back_family = back_family.filter(elem => elem !== e.target.value);
                $('#back_family').val(back_family);
                countBackFamily = countBackFamily - 1;
                $('#countBackFamily').val(countBackFamily);
            }
        }
        //agregar alergia
        function handlerAllergies(e) {
            // validaciones para agragar cirugia
            if ($('#type_alergia').val() === "") {
                $("#type_alergia_span").text('Campo obligatorio');
            } else if ($('#detalle_alergia').val() === "") {
                $("#cirugia").text('');
                $("#detalle_alergia_span").text('Campo obligatorio');
            } else {
                $("#detalle_alergia_span").text('');
                var row = `
                    <tr id="${countAllergies}">
                    <td>${$('#type_alergia').val()}</td>
                    <td>${$('#detalle_alergia').val()}</td>                 
                    <td class="text-center"><span onclick="deleteAllergie(${countAllergies})" ><i class="bi bi-archive"></i></span></td>
                    </tr>`;
                $('#table-alergias').find('tbody').append(row);
                let alergias =
                    `${$('#type_alergia').val()},${$('#detalle_alergia').val()}`;
                allergies.push(alergias);
                $('#allergies').val(allergies);
                countAllergies = countAllergies + 1;
                $('#countAllergies').val(countAllergies);
                // limpiar campos
                $('#type_alergia').val("");
                $('#detalle_alergia').val("");
            }
        }

        function handlerDiagnosis(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_pathological.push(e.target.value);
                $('#history_pathological').val(history_pathological);
                countDiagnosis = countDiagnosis + 1;
                $('#countDiagnosis').val(countDiagnosis);
            } else {
                history_pathological = history_pathological.filter(elem => elem !== e.target.value);
                $('#history_pathological').val(history_pathological);
                countDiagnosis = countDiagnosis - 1;
                $('#countDiagnosis').val(countDiagnosis);

            }
        }

        function handlerNotPathologica(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_non_pathological.push(e.target.value);
                $('#history_non_pathological').val(history_non_pathological);
                countNotPathological = countNotPathological + 1;
                $('#countNotPathological').val(countNotPathological);
            } else {
                history_non_pathological = history_non_pathological.filter(elem => elem !== e.target.value);
                $('#history_non_pathological').val(history_non_pathological);
                countNotPathological = countNotPathological - 1;
                $('#countNotPathological').val(countNotPathological);

            }
        }

        function handlerGynecological(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_gynecological.push(e.target.value);
                $('#history_gynecological').val(history_gynecological);
                countGynecological = countGynecological + 1;
                $('#countGynecological').val(countGynecological);
            } else {
                history_gynecological = history_gynecological.filter(elem => elem !== e.target.value);
                $('#history_gynecological').val(history_gynecological);
                countGynecological = countGynecological - 1;
                $('#countGynecological').val(countGynecological);
            }
        }
        //agregar medicamento
        function addMedacition(e) {
            // validaciones para agragar medicacion
            if ($('#medicine').val() === "") {
                $("#medicine_span").text('Campo obligatorio');
            } else if ($('#dose').val() === "") {
                $("#medicine_span").text('');
                $("#dose_span").text('Campo obligatorio');
            } else if ($('#patologi').val() === "") {
                $("#dose_span").text('');
                $("#patologi_span").text('Campo obligatorio');
            } else if ($('#viaAdmin').val() === "") {
                $("#patologi_span").text('');
                $("#viaAdmin_span").text('Campo obligatorio');
            } else if ($('#treatmentDuration').val() === "") {
                $("#viaAdmin_span").text('');
                $("#treatmentDuration_span").text('Campo obligatorio');
            } else if ($('#dateIniTreatment').val() === "") {
                $("#treatmentDuration_span").text('');
                $("#dateIniTreatment_span").text('Campo obligatorio');
            } else if ($('#dateEndTreatment').val() === "") {
                $("#dateIniTreatment_span").text('');
                $("#dateEndTreatment_span").text('Campo obligatorio');
            } else if ($('#NUmberOrder').val() === "") {
                $("#dateEndTreatment_span").text('');
                $("#NUmberOrder_span").text('Campo obligatorio');
            } else {
                $("#NUmberOrder_span").text('');
                var row = `
                    <tr id="${countMedicationAdd}">
                    <td>${$('#medicine').val()}</td>
                    <td>${$('#dose').val()}</td>
                    <td>${$('#patologi').val()}</td>
                    <td>${$('#viaAdmin').val()}</td>
                    <td>${$('#treatmentDuration').val()}</td>
                    <td>${$('#dateIniTreatment').val()}</td>
                    <td>${$('#dateEndTreatment').val()}</td>
                    <td>${$('#NUmberOrder').val()}</td>
                    <td class="text-center"><span onclick="deleteMedication(${countMedicationAdd})" ><i class="bi bi-archive"></i></span></td>
                    </tr>`;
                $('#table-medicamento').find('tbody').append(row);
                let medication =
                    `${$('#medicine').val()},${$('#dose').val()},${$('#patologi').val()},${$('#viaAdmin').val()},${$('#treatmentDuration').val()},${$('#dateIniTreatment').val()},${$('#dateEndTreatment').val()},${$('#NUmberOrder').val()}`
                medications_supplements.push(medication);
                $('#medications_supplements').val(medications_supplements);
                countMedicationAdd = countMedicationAdd + 1;
                $('#countMedicationAdd').val(countMedicationAdd);
                // limpiar campos
                $('#medicine').val("")
                $('#dose').val("")
                $('#patologi').val("")
                $('#viaAdmin').val("")
                $('#treatmentDuration').val("")
                $('#dateIniTreatment').val("")
                $('#dateEndTreatment').val("")
                $('#NUmberOrder').val("")
            }
        }
        //borrar medicamento
        function deleteMedication(count) {
            $('#table-medicamento tr#' + count).remove();
            medications_supplements.splice(count, 1);
            $('#medications_supplements').val(medications_supplements);
            countMedicationAdd = countMedicationAdd - 1;
            $('#countMedicationAdd').val(countMedicationAdd);

        }
        //agregar cirugia
        function handlerSurgical(e) {
            // validaciones para agragar cirugia
            if ($('#cirugia').val() === "") {
                $("#cirugia_span").text('Campo obligatorio');
            } else if ($('#dateCirugia').val() === "") {
                $("#cirugia").text('');
                $("#dateCirugia_span").text('Campo obligatorio');
            } else {
                $("#dateCirugia_span").text('');
                var row = `
                    <tr id="${countSurgical}">
                    <td>${$('#cirugia').val()}</td>
                    <td>${$('#dateCirugia').val()}</td>                 
                    <td class="text-center"><span onclick="deleteSurgical(${countSurgical})" ><i class="bi bi-archive"></i></span></td>
                    </tr>`;
                $('#table-cirugia').find('tbody').append(row);
                let cirugia =
                    `${$('#cirugia').val()},${$('#dateCirugia').val()}`;
                history_surgical.push(cirugia);
                $('#history_surgical').val(history_surgical);
                countSurgical = countSurgical + 1;
                $('#countSurgical').val(countSurgical);
                // limpiar campos
                $('#cirugia').val("");
                $('#dateCirugia').val("");
                console.log(history_surgical);
            }
        }
        //borrar cirugia
        function deleteSurgical(count) {
            $('#table-cirugia tr#' + count).remove();
            history_surgical.splice(count, 1);
            $('#history_surgical').val(history_surgical);
            countSurgical = countSurgical - 1;
            $('#countSurgical').val(countSurgical);

        }
        //borrar alergias
        function deleteAllergie(count) {
            $('#table-alergias tr#' + count).remove();
            allergies.splice(count, 1);
            $('#allergies').val(allergies);
            countAllergies = countAllergies - 1;
            $('#countAllergies').val(countAllergies);

        }
        // agregar signos vitales
        function handlerVitalSigns(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_vital_signs.push(e.target.value);
                $('#history_vital_signs').val(history_vital_signs);
                countVitalSigns = countVitalSigns + 1;
                $('#countVitalSigns').val(countVitalSigns);
            } else {
                history_vital_signs = history_vital_signs.filter(elem => elem !== e.target.value);
                $('#history_vital_signs').val(history_vital_signs);
                countVitalSigns = countVitalSigns - 1;
                $('#countVitalSigns').val(countVitalSigns);
            }
        }    
       
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <form id="form-mecal-histroy" method="post" action="/">
                {{ csrf_field() }}
                <div class="row mt-3">
                    <input type="hidden" name="id" value="{{ $Patient->id }}">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Datos personales</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                        <strong>Nombres y Apellidos:</strong><span>
                                            {{ $Patient->name . ',' . $Patient->last_name }}</span>
                                        <br>
                                        <strong>Fecha de Nacimiento:</strong><span> {{ $Patient->birthdate }}</span>
                                        <br>
                                        <strong>Edad:</strong><span> {{ $Patient->age }}</span>
                                        <br>
                                        <strong>Cedula de identidad:</strong> <span> {{ $Patient->ci }}</span>
                                        <br>
                                        <strong>Lugar y fecha de nacimiento :</strong><span> {{ $Patient->address }}</span>
                                        <br>
                                        <strong>Teléfonos personal / otros:</strong><span> {{ $Patient->phone }}</span>
                                        <br>
                                        <strong>Correo electrónico:</strong><span> {{ $Patient->email }}</span>
                                    </div>
                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2 offset-3">
                                        <img src="{{ asset('img/People-Patient-Male-icon.png') }}" width="150"
                                            height="150" alt="Imagen del paciente">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- datos pricipales --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Datos principales de la historia</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <input type="hidden" name="history_vital_signs[]" id="history_vital_signs" value="" >
                                    <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Peso"
                                                    class="mask-input form-control @error('weight') is-invalid @enderror"
                                                    id="weight" name="weight" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Altura"
                                                    class="mask-input form-control @error('height') is-invalid @enderror"
                                                    id="height" name="height" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-3">
                                        <div class="form-group">
                                            <textarea placeholder="Motivo de la consulta" id="reason" name="reason" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-3">
                                        <div class="form-group">
                                            <textarea placeholder="Enfermedad Actual" id="current_illness" name="current_illness" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <h5> <strong>Examen Físico:</strong><small> (Signos vitales)</small></h5>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Tension arterial"
                                                    class="mask-input form-control @error('strain') is-invalid @enderror"
                                                    id="strain" name="strain" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Tempetura"
                                                    class="mask-input form-control @error('temperature') is-invalid @enderror"
                                                    id="temperature" name="temperature" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="respiraciones pp"
                                                    class="mask-input form-control @error('breaths') is-invalid @enderror"
                                                    id="breaths" name="breaths" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="pulso"
                                                    class="mask-input form-control @error('pulse') is-invalid @enderror"
                                                    id="pulse" name="pulse" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="saturación"
                                                    class="mask-input form-control @error('saturation') is-invalid @enderror"
                                                    id="saturation" name="saturation" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-1">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <select name="condition" id="condition"
                                                    placeholder="Seleccione"class="form-control"
                                                    class="form-control combo-textbox-input">
                                                    <option value="">Seleccione Condición general</option>
                                                    <option value="estable">Estable</option>
                                                    <option value="regular">Regular</option>
                                                    <option value="grave">Grave</option>
                                                </select>
                                                <i class="bi bi-three-dots-vertical"></i>
                                                <span id="condition_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-1">
                                        <div class="form-group">
                                            <textarea placeholder="Estudios realizados:" id="applied_studies" name="applied_studies" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-3">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" class="form-check"
                                                        name="Hidratado" type="checkbox" id="Hidratado"
                                                        value="Hidratado">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Hidratado
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" value="Eupenico" class="form-check" name="Eupenico"
                                                        type="checkbox" id="Eupenico">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Eupenico
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" value="Febril" class="form-check" name="Febril"
                                                        type="checkbox" id="Febril">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Febril
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-3">
                                        <div class="floating-label-group">

                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" value="Neurologica" class="form-check"
                                                        name="Neurologica" type="checkbox" id="Neurologica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Esfera Neurologica (orientado en tiempo espacio y persona, fuerza
                                                        muscular etc)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" value="Glasgow" class="form-check"
                                                        name="Glasgow" type="checkbox"
                                                        id="Glasgow">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Glasgow (puntuación de la escala)
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" value="Esfera ORL " class="form-check"
                                                        name="esfera_orl" type="checkbox" id="esfera_orl">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Esfera ORL (oídos, nariz, boca, cuello) </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" class="form-check"
                                                        name="Esfera cardiopulmonar" type="checkbox" id="esfera_cardiopulmonar"
                                                        value="esfera_cardiopulmonar">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Esfera cardiopulmonar (corazón y pulmones)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" value="Esfera abdominal" class="form-check" name="esfera_abdominal"
                                                        type="checkbox" id="esfera_abdominal">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Esfera abdominal (semiología abdominal)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerVitalSigns(event);" value="Extremidades" class="form-check" name="Extremidades"
                                                        type="checkbox" id="Extremidades">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Extremidades (si aplica)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total Signos vitales
                                            </span>
                                            <input type="text" id="countVitalSigns" name="countVitalSigns"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- antecedentes falimilares --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Antecedentes Personales y Familiares</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="back_family[]" id="back_family" value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" class="form-check"
                                                        name="cancer" type="checkbox" id="cancer" value="Cancer">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Cancer
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Diabetes"
                                                        class="form-check" name="diabetes" type="checkbox"
                                                        id="diabetes">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Diabetes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Tension alta"
                                                        class="form-check" name="tension_alta" type="checkbox"
                                                        id="tension_alta">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Tension alta
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Cardiacos"
                                                        class="form-check" name="Cardiacos" type="checkbox"
                                                        id="Cardiacos">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Cardiacos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Psiquiátricas"
                                                        class="form-check" name="psiquiátricas" type="checkbox"
                                                        id="psiquiátricas">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Psiquiátricas
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" class="form-check"
                                                        name="coagulación" type="checkbox" id="coagulación"
                                                        value="Alteraciones en coagulación">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Alteraciones en coagulación</label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Embolia"
                                                        class="form-check" name="embolia" type="checkbox"
                                                        id="embolia">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Trombosis/Embolas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Tranfusiones"
                                                        class="form-check" name="Tranfusiones" type="checkbox"
                                                        id="Tranfusiones">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Tranfusiones sanguineas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="COVID19"
                                                        class="form-check" name="COVID19" type="checkbox"
                                                        id="COVID19">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        COVID19
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="na_back_family"
                                                        class="form-check" name="na_back_family" type="checkbox"
                                                        id="na_back_family">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        No aplica
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="">Total Antecedentes</span>
                                            <input type="text" id="countBackFamily" name="countBackFamily"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Antecedentes personales patológicos --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Antecedentes personales patológicos </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="history_pathological[]" id="history_pathological"
                                        value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" class="form-check"
                                                        name="hepatitis" type="checkbox" id="hepatitis"
                                                        value="Hepatitis">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Hepatitis
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="VIH/SIDA"
                                                        class="form-check" name="VIH" type="checkbox"
                                                        id="VIH">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        VIH/SIDA
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);"
                                                        value="Gastritis/Ulceras                                                    "
                                                        class="form-check" name="gastritis" type="checkbox"
                                                        id="gastritis">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Gastritis/Ulceras
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Neurología"
                                                        class="form-check" name="neurología" type="checkbox"
                                                        id="neurología">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Neurología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Ansiedad/Angustia"
                                                        class="form-check" name="ansiedad" type="checkbox"
                                                        id="ansiedad">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Ansiedad/Angustia
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" class="form-check"
                                                        name="tiroides" type="checkbox" id="tiroides" value="Tiroides">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Tiroides
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Lupus"
                                                        class="form-check" name="lupus" type="checkbox"
                                                        id="lupus">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Lupus
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);"
                                                        value="Enfermedad autoimmune" class="form-check"
                                                        name="autoimmune" type="checkbox" id="autoimmune">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Enfermedad autoimmune
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Diabetes Mellitus"
                                                        class="form-check" name="mellitus" type="checkbox"
                                                        id="mellitus">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Diabetes Mellitus
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);"
                                                        value="Presión arterial alta" class="form-check"
                                                        name="presión_arterial" type="checkbox" id="presión_arterial">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Presión arterial alta
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" class="form-check"
                                                        name="cateter" type="checkbox" id="cateter"
                                                        value="Tiene cateter venoso?">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Tiene cateter venoso?
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Fracturas"
                                                        class="form-check" name="fracturas" type="checkbox"
                                                        id="fracturas">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Fracturas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Trombosis venosa"
                                                        class="form-check" name="trombosis" type="checkbox"
                                                        id="trombosis">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Trombosis venosa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Embolia pulmonar"
                                                        class="form-check" name="embolia_pulmonar" type="checkbox"
                                                        id="embolia_pulmonar">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Embolia pulmonar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Varices en piernas"
                                                        class="form-check" name="varices_piernas" type="checkbox"
                                                        id="varices_piernas">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Varices en piernas
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" class="form-check"
                                                        name="insuficiencia_arterial" type="checkbox"
                                                        id="insuficiencia_arterial" value="Insuficiencia arterial">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Insuficiencia arterial
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Coagulación anormal"
                                                        class="form-check" name="coagulación_anormal" type="checkbox"
                                                        id="coagulación_anormal">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Coagulación anormal
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="Moretones frecuentes"
                                                        class="form-check" name="moretones" type="checkbox"
                                                        id="moretones">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Moretones frecuentes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);"
                                                        value="Sangrado anormal en cirugías previas" class="form-check"
                                                        name="sangrado" type="checkbox" id="sangrado">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Sangrado anormal en cirugías previas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);"
                                                        value="Sangrado anormal en cepillado dental" class="form-check"
                                                        name="sangrado_dental" type="checkbox" id="sangrado_dental">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Sangrado anormal en cepillado dental
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="na_Diagnosis"
                                                        class="form-check" name="na_Diagnosis" type="checkbox"
                                                        id="na_Diagnosis">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        No aplica
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total patológicos
                                            </span>
                                            <input type="text" id="countDiagnosis" name="countDiagnosis"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia Antecedentes personales no patológicos --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Historia no patológica</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="history_non_pathological[]" id="history_non_pathological"
                                        value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);" class="form-check"
                                                        name="tabaco" type="checkbox" id="tabaco" value="Tabaco">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Tabaco
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);" value="Alcohol"
                                                        class="form-check" name="Alcohol" type="checkbox"
                                                        id="Alcohol">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Alcohol
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);" value="Drogas"
                                                        class="form-check" name="Drogas" type="checkbox"
                                                        id="Drogas">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Drogas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);"
                                                        value="vacunas recientes" class="form-check"
                                                        name="vacunas_recientes" type="checkbox" id="vacunas_recientes">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Vacunas recientes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);"
                                                        value="Transfusiones sanguíneas" class="form-check"
                                                        name="transfusiones_sanguíneas" type="checkbox"
                                                        id="transfusiones_sanguíneas">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Transfusiones sanguíneas
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);"
                                                        value="na_NotPathologica" class="form-check"
                                                        name="na_NotPathologica" type="checkbox" id="na_NotPathologica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        No aplica
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total historia no patológica
                                            </span>
                                            <input type="text" id="countNotPathological" name="countNotPathological"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia ginecológica --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Historia ginecologicos si aplica </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="history_gynecological[]" id="history_gynecological"
                                        value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);" class="form-check"
                                                        name="menstruation" type="checkbox" id="menstruation"
                                                        value="menstruation">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Edad de la primera menstruation
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value="Fecha ultima regla" class="form-check"
                                                        name="Fecha_ultima_regla" type="checkbox"
                                                        id="Fecha_ultima_regla">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Fecha ultima regla
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value="Numero de embarazos" class="form-check"
                                                        name="Numero_embarazos" type="checkbox" id="Numero_embarazos">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Numero de embarazos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);" value="Numero de partos"
                                                        class="form-check" name="Numero_partos" type="checkbox"
                                                        id="Numero_partos">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Numero de partos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value="Numero de cesáreas" class="form-check"
                                                        name="Numero_cesáreas" type="checkbox" id="Numero_cesáreas">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        PNumero de cesáreas
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);" class="form-check"
                                                        name="abortos" type="checkbox" id="abortos" value="abortos">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Numero de abortos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value=" En la actualidad utiliza algún anticonceptivo o cualquier otro 
                                                        hormonal(pastillas, parches o inyección) ? + Cual?"
                                                        class="form-check" name="actualidad" type="checkbox"
                                                        id="actualidad">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        En la actualidad utiliza algún anticonceptivo o cualquier otro
                                                        hormonal(pastillas, parches o inyección) ? + Cual? </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total historia ginecológica
                                            </span>
                                            <input type="text" id="countGynecological" name="countGynecological"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- alergias --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Alergias Conocidas</h3>
                            </div>
                            <div class="card-body">
                                <div class="row  mt-3">
                                    <input type="hidden" name="allergies[]" id="allergies" value="">
                                    <h5 class="text-center collapseBtn">Añadir Alergias</h5>
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <select name="type_alergia" id="type_alergia"
                                                    placeholder="Seleccione"class="form-control"
                                                    class="form-control combo-textbox-input">
                                                    <option value="">Seleccione tipo de alergia</option>
                                                    <option value="Medicinas"> Medicinas</option>
                                                    <option value="Alimentos">Alimentos</option>
                                                    <option value="Latex">Latex</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                                <i class="bi bi-three-dots-vertical"></i>
                                                <span id="type_alergia_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Detalle" class="form-control"
                                                    id="detalle_alergia" name="detalle_alergia" type="text"
                                                    value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                            <span id="detalle_alergia_span" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <span type="" onclick="handlerAllergies(event)"
                                            class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir
                                            Alergias</span>
                                    </div>
                                    <div class="col-sm-5 md-5 lg-5 xl-5 xxl-5" style="margin-top: 20px; width: 100%;">
                                        <h2 class="collapseBtn">Lista de cirugias</h6>
                                            <table class="table table-striped table-hover table-bordered"
                                                id="table-alergias">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Tipo de alergias</th>
                                                        <th scope="col">Detalle</th>
                                                        <th scope="col">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <tfoot>
                                                <div class="row mt-3">
                                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                                        <div class="input-group flex-nowrap">
                                                            <span class="input-group-text" id="">Total
                                                                alergias</span>
                                                            <input type="text" id="countAllergies"
                                                                name="countAllergies" class="form-control" readonly
                                                                value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </tfoot>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia quirúrgica --}}
                <div class="row  mt-3">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <h3>Historia quirúrgica</h3>
                        </div>
                        <div class="card-body">
                            <div class="row  mt-3">
                                <input type="hidden" name="history_surgical[]" id="history_surgical" value="">
                                <h5 class="text-center collapseBtn">Añadir Cirugia</h5>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 ">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Cirugia" class="form-control"
                                                id="cirugia" name="cirugia" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="cirugia_span" class="text-danger"></span>
                                    </diV>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Fecha fin"
                                                class="form-control datePickert" id="dateCirugia" readonly
                                                name="dateCirugia" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="dateCirugia_span" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <span type="" onclick="handlerSurgical(event)"
                                        class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir
                                        Cirugia</span>
                                </div>
                                <div class="col-sm-5 md-5 lg-5 xl-5 xxl-5" style="margin-top: 20px; width: 100%;">
                                    <h6 class="collapseBtn">Lista de cirugias</h6>
                                    <table class="table table-striped table-hover table-bordered" id="table-cirugia">
                                        <thead>
                                            <tr>
                                                <th scope="col">Cirugia</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <tfoot>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text">Total Cirugia
                                                    </span>
                                                    <input type="text" id="countSurgical" name="countSurgical"
                                                        class="form-control" readonly value="">
                                                </div>
                                            </div>
                                        </div>
                                    </tfoot>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- Medicacion --}}
                <div class="row  mt-3">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <h3>Medicación</h3>
                        </div>
                        <div class="card-body">
                            <div class="row  mt-3">
                                <input type="hidden" name="medications_supplements[medications_supplements]"
                                    id="medications_supplements" value="">
                                <h5 class="text-center collapseBtn">Añadir Medicamento</h5>

                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3 ">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Medicamento" class="form-control"
                                                id="medicine" name="medicine" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="medicine_span" class="text-danger"></span>
                                    </diV>
                                </div>
                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Dosis" class="form-control"
                                                id="dose" name="dose" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="dose_span" class="text-danger"></span>
                                    </diV>
                                </div>
                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Patologia" class="form-control"
                                                id="patologi" name="patologi" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="patologi_span" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Via de administracion"
                                                class="form-control" id="viaAdmin" name="viaAdmin" type="text"
                                                value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="viaAdmin_span" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Duracion de tratameinto"
                                                class="form-control" id="treatmentDuration" name="treatmentDuration"
                                                type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="treatmentDuration_span" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Fecha inicio"
                                                class="form-control datePickert" id="dateIniTreatment" readonly
                                                name="dateIniTreatment" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="dateIniTreatment_span" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="Fecha fin"
                                                class="form-control datePickert" id="dateEndTreatment" readonly
                                                name="dateEndTreatment" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="dateEndTreatment_span" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                    <div class="form-group">
                                        <div class="Icon-inside">
                                            <input autocomplete="off" placeholder="N-Orden" class="form-control"
                                                id="NUmberOrder" name="NUmberOrder" type="text" value="">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </div>
                                        <span id="NUmberOrder_span" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3 offset-md-5">
                                    <span type="" onclick="addMedacition(event)"
                                        class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir
                                        medicamento</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12" style="margin-top: 20px; width: 100%;">
                                    <h6 class="collapseBtn">Lista de medicamentos</h6>
                                    <table class="table table-striped table-hover table-bordered"
                                        id="table-medicamento">
                                        <thead>
                                            <tr>
                                                <th scope="col">Medicamento</th>
                                                <th scope="col">Dosis</th>
                                                <th scope="col">Patologia</th>
                                                <th scope="col">Via de administracion</th>
                                                <th scope="col">Duracion de tratameinto</th>
                                                <th scope="col">Fecha inicio</th>
                                                <th scope="col">Fecha fin</th>
                                                <th scope="col">N-Orden</th>
                                                <th scope="col">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <tfoot>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text">Total de medicamientos
                                                    </span>
                                                    <input type="text" id="countMedicationAdd"
                                                        name="countMedicationAdd" class="form-control" readonly
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </tfoot>
                                </div>
                            </div>
                            <div class="row justify-content-md-center mt-3">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <input class="btn btnPrimary send " value="Guardar" type="submit" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
