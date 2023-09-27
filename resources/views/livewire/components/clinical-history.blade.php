@extends('layouts.app-auth')
@section('title', 'Historia Clínica')
<style>
    #btn {
        padding: 7px 16px 8px 10px !important;
    }

    .span-input {
        height: 42px;
    }

    .input-one {
        margin-right: 0px
    }
</style>
@push('scripts')
    <script>
        let valueAllergies = '';
        let valueMedications_supplements = '';
        let valueHistory_surgical = '';
        let allergies = @json($validateHistory ? json_decode($validateHistory->allergies, true) : null);
        let history_surgical = @json($validateHistory ? json_decode($validateHistory->history_surgical, true) : null);
        let medications_supplements = @json($validateHistory ? json_decode($validateHistory->medications_supplements, true) : null);
        ///count
        let countAllergies = (allergies) ? allergies.length : 0;
        let countSurgical = (history_surgical) ? history_surgical.length : 0;
        let countMedicationAdd = (medications_supplements) ? medications_supplements.length : 0;
        let countDiagnosis = 0;
        let countNotPathological = 0;
        let countGynecological = 0;
        let countVitalSigns = 0;
        let countBackFamily = 0;
        ////
        let arrayAllergies = (allergies) ? allergies : [];
        let arrayhistory_surgical = (history_surgical) ? history_surgical : [];
        let arraymedications_supplements = (medications_supplements) ? medications_supplements : [];

        $(document).ready(() => {
            $(".datePickert").datepicker({
                language: 'es'
            });
            $('#form-mecal-histroy').validate({
                ignore: [],
                rules: {
                    weight: {
                        required: true,
                    },
                    height: {
                        required: true,
                    },
                    current_illness: {
                        required: true,
                    },
                    reason: {
                        required: true,
                    },
                    applied_studies: {
                        required: true,
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
                    countDiagnosis: {
                        required: true,
                    },
                    countNotPathological: {
                        required: true,
                    },
                    countVitalSigns: {
                        required: true
                    },
                },
                messages: {
                    weight: {
                        required: "Peso es obligatorio",
                    },
                    height: {
                        required: "Altura es obligatoria",
                    },
                    applied_studies: {
                        required: "Estudios realizados es obligatorio"
                    },
                    countBackFamily: {
                        required: "Debe seleccionar una opción"
                    },
                    countDiagnosis: {
                        required: "Debe seleccionar una opción"
                    },
                    countNotPathological: {
                        required: "Debe seleccionar una opción"
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
                    countVitalSigns: {
                        required: "Debe seleccionar uan opción"
                    }
                }
            });

            $.validator.addMethod("onlyText", function(value, element) {
                let pattern = /^[a-zA-ZñÑáéíóúü0-9\s]+$/g;
                return pattern.test(value);
            }, "No se permiten caracteres especiales");

            $.validator.addMethod("onlyNumber", function(value, element) {
                let pattern = /^\d+\.?\d\s*$/;
                return pattern.test(value);
            }, "Campo solo numero");

            //envio del formulario
            $("#form-mecal-histroy").submit(function(event) {
                event.preventDefault();
                $("#form-mecal-histroy").validate();
                if ($("#form-mecal-histroy").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    //preparar la data para el envio
                    let formData = $('#form-mecal-histroy').serializeArray();
                    let data = {};
                    formData.map((item) => data[item.name] = item.value);
                    data["arrayAllergies"] = JSON.stringify(arrayAllergies);
                    data["arrayhistory_surgical"] = JSON.stringify(arrayhistory_surgical);
                    data["arraymedications_supplements"] = JSON.stringify(arraymedications_supplements);
                    ////end

                    $.ajax({
                        url: '{{ route('ClinicalHistoryCreate') }}',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data": JSON.stringify(data),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-mecal-histroy").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: 'Historia clinica registrada exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                let url = "{{ route('MedicalRecord', ':id') }}";
                                url = url.replace(':id',$('#id_patient').val());
                                window.location.href = url;
                            });
                        },
                        traditional: true,
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    $('#send').show();
                                    $('#spinner').hide();
                                    $("#form-patients").trigger("reset");
                                });
                            });
                        }
                    });
                }
            })
        })

        function handlerBackFamiliy(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                $(`#${e.target.id}`).val(1);
                countBackFamily = countBackFamily + 1;
                $('#countBackFamily').val(countBackFamily);
            } else {
                $(`#${e.target.id}`).val(null);
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
                    <td class="text-center">${$('#type_alergia').val()}</td>
                    <td class="text-center">${$('#detalle_alergia').val()}</td>                 
                    <td class="text-center"><span onclick="deleteAllergie(${countAllergies})"><i class="bi bi-archive"></i></span></td>
                    </tr>`;
                $('#table-alergias').find('tbody').append(row);
                console.log(arrayAllergies);
                arrayAllergies.push({
                    type_alergia: $('#type_alergia').val(),
                    detalle_alergia: $('#detalle_alergia').val()
                });
                countAllergies = countAllergies + 1;
                $('#countAllergies').val(countAllergies);
                // limpiar campos
                $('#type_alergia').val("");
                $('#detalle_alergia').val("");
            }
        }

        function handlerDiagnosis(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                $(`#${e.target.id}`).val(1);
                countDiagnosis = countDiagnosis + 1;
                $('#countDiagnosis').val(countDiagnosis);
            } else {
                $(`#${e.target.id}`).val(null);
                countDiagnosis = countDiagnosis - 1;
                $('#countDiagnosis').val(countDiagnosis);

            }
        }

        function handlerNotPathologica(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                $(`#${e.target.id}`).val(1);
                countNotPathological = countNotPathological + 1;
                $('#countNotPathological').val(countNotPathological);
            } else {
                $(`#${e.target.id}`).val(null);
                countNotPathological = countNotPathological - 1;
                $('#countNotPathological').val(countNotPathological);

            }
        }

        function handlerGynecological(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                $(`#${e.target.id}`).val(1);
                countGynecological = countGynecological + 1;
                $('#countGynecological').val(countGynecological);
            } else {
                $(`#${e.target.id}`).val(null);
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
                    <td class="text-center">${$('#medicine').val()}</td>
                    <td class="text-center">${$('#dose').val()}</td>
                    <td class="text-center">${$('#patologi').val()}</td>
                    <td class="text-center">${$('#viaAdmin').val()}</td>
                    <td class="text-center">${$('#treatmentDuration').val()}</td>
                    <td class="text-center">${$('#dateIniTreatment').val()}</td>
                    <td class="text-center">${$('#dateEndTreatment').val()}</td>
                    <td class="text-center">${$('#NUmberOrder').val()}</td>
                    <td class="text-center"><span onclick="deleteMedication(${countMedicationAdd})" ><i class="bi bi-archive"></i></span></td>                    
                    </tr>`;
                $('#table-medicamento').find('tbody').append(row);

                arraymedications_supplements.push({
                    medicine: $('#medicine').val(),
                    dose: $('#dose').val(),
                    patologi: $('#patologi').val(),
                    viaAdmin: $('#viaAdmin').val(),
                    treatmentDuration: $('#treatmentDuration').val(),
                    dateIniTreatment: $('#dateIniTreatment').val(),
                    dateEndTreatment: $('#dateEndTreatment').val(),
                    NUmberOrder: $('#NUmberOrder').val(),
                });

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

        //agregar cirugia
        function handlerSurgical(e) {
            // validaciones para agragar cirugia
            if ($('#cirugia').val() === "") {
                $("#cirugia_span").text('Campo obligatorio');
            } else if ($('#datecirugia').val() === "") {
                $("#cirugia").text('');
                $("#datecirugia_span").text('Campo obligatorio');
            } else {
                $("#datecirugia_span").text('');
                var row = `
                    <tr id="${countSurgical}">
                    <td class="text-center">${$('#cirugia').val()}</td>
                    <td class="text-center">${$('#datecirugia').val()}</td>                 
                    <td class="text-center"><span onclick="deleteSurgical(${countSurgical})" ><i class="bi bi-archive"></i></span></td>
                    </tr>`;
                $('#table-cirugia').find('tbody').append(row);
                arrayhistory_surgical.push({
                    cirugia: $('#cirugia').val(),
                    datecirugia: $('#datecirugia').val()
                });
                countSurgical = countSurgical + 1;
                $('#countSurgical').val(countSurgical);
                // limpiar campos
                $('#cirugia').val("");
                $('#datecirugia').val("");
            }
        }

        // agregar signos vitales
        function handlerVitalSigns(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                $(`#${e.target.id}`).val(1);
                countVitalSigns = countVitalSigns + 1;
                $('#countVitalSigns').val(countVitalSigns);
            } else {
                $(`#${e.target.id}`).val(null);
                countVitalSigns = countVitalSigns - 1;
                $('#countVitalSigns').val(countVitalSigns);
            }
        }

        //borrar medicamento
        function deleteMedication(count) {
            $('#table-medicamento tr#' + count).remove();
            arraymedications_supplements.splice(count, 1);
            countMedicationAdd = countMedicationAdd - 1;
            $('#countMedicationAdd').val(countMedicationAdd);
        }
        //borrar cirugia
        function deleteSurgical(count) {
            $('#table-cirugia tr#' + count).remove();
            arrayhistory_surgical.splice(count, 1);
            countSurgical = countSurgical - 1;
            $('#countSurgical').val(countSurgical);
        }
        //borrar alergias
        function deleteAllergie(count) {
            $('#table-alergias tr#' + count).remove();
            arrayAllergies.splice(count, 1);
            countAllergies = countAllergies - 1;
            $('#countAllergies').val(countAllergies);
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid" style="padding: 3%">
            <form id="form-mecal-histroy" method="post" action="/">
                {{ csrf_field() }}
                <div class="accordion" id="accordion">
                    {{-- Datos paciente --}}
                    <div class="row mt-3">
                        <input type="hidden" name="id" id="id_patient" value="{{ $Patient->id }}">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingD">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseD" aria-expanded="true" aria-controls="collapseD"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-person"></i></i> Datos personales
                                    </button>
                                </span>
                                <div id="collapseD" class="accordion-collapse collapse show" aria-labelledby="headingD"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row mt-3">
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 offset-3">
                                                    <img src="{{ asset('/imgs/' . $Patient->patient_img) }}" width="150"
                                                        height="150" alt="Imagen del paciente">
                                                </div>
                                                <strong>Nombre:</strong><span>
                                                    {{ $Patient->last_name . ', ' . $Patient->name }}</span>
                                                <br>
                                                <strong>Fecha de Nacimiento:</strong><span>
                                                    {{ date('d-m-Y', strtotime($Patient->birthdate)) }}</span>
                                                <br>
                                                <strong>Edad:</strong><span> {{ $Patient->age }} años</span>
                                                <br>
                                                <strong>{{ $Patient->is_minor === 'true' ? 'Cédula de identidad del representante:' : 'Cédula de identidad:' }}</strong>
                                                <span>
                                                    {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                                <br>
                                                <strong>Genero:</strong> <span> {{ $Patient->genere }}</span>
                                                <br>
                                                <strong>Nº Historial:</strong><span>
                                                    {{ $Patient->get_history != null ? $Patient->get_history->cod_history : '' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- datos pricipales --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-person"></i></i> Datos principales de la historia
                                    </button>
                                </span>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row mt-3">
                                            <input type="hidden" name="history_vital_signs[]" id="history_vital_signs"
                                                value="">
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Peso</label>
                                                        <input autocomplete="off"
                                                            class="mask-input form-control @error('weight') is-invalid @enderror"
                                                            id="weight" name="weight" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->weight : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </diV>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Altura</label>
                                                        <input autocomplete="off"
                                                            class="mask-input-height form-control @error('height') is-invalid @enderror"
                                                            id="height" name="height" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->height : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Motivo
                                                        de la consulta</label>
                                                    <textarea id="reason" name="reason" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->reason : '' !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Enfermedad
                                                        Actual</label>
                                                    <textarea id="current_illness" name="current_illness" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->current_illness : '' !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <h5> <strong>Examen Físico:</strong><small> (Signos vitales)</small></h5>

                                            @php
                                                if ($validateHistory) {
                                                    $data = explode('/', $Patient->get_history->strain);
                                                }
                                            @endphp
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <label for="phone" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Presión
                                                    arterial</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="strain" id="strain"
                                                        class="form-control  mask-input-two input-one" placeholder="Alta"
                                                        aria-label="strain" value="{!! !empty($validateHistory) ? $data[0] : '' !!}">
                                                    <span class="input-group-text span-input">/</span>
                                                    <input type="text" name="strain_two" id="strain_two"
                                                        class="form-control mask-input-two" placeholder="Baja"
                                                        aria-label="strain" value="{!! !empty($validateHistory) ? $data[1] : '' !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Tempetura</label>
                                                        <input autocomplete="off"
                                                            class="mask-only-temperature form-control @error('temperature') is-invalid @enderror"
                                                            id="temperature" name="temperature" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->temperature : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </diV>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Respiraciones</label>
                                                        <input autocomplete="off"
                                                            class="mask-only-breaths form-control @error('breaths') is-invalid @enderror"
                                                            id="breaths" name="breaths" type="text" maxlength="3"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->breaths : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Pulso</label>
                                                        <input autocomplete="off"
                                                            class="mask-only-number form-control @error('pulse') is-invalid @enderror"
                                                            id="pulse" name="pulse" type="text" maxlength="3"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->pulse : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </diV>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Saturación</label>
                                                        <input autocomplete="off"
                                                            class="mask-input-por form-control @error('saturation') is-invalid @enderror"
                                                            id="saturation" name="saturation" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->saturation : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Condición
                                                            general</label>
                                                        <select name="condition" id="condition"
                                                            placeholder="Seleccione"class="form-control"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($get_condition as $item)
                                                                <option value="{{ $item->description }}"
                                                                    {!! !empty($validateHistory) ? ($item->description === $validateHistory->condition ? 'selected' : '') : '' !!}>
                                                                    {{ $item->description }}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                        <span id="condition_span" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Estudios
                                                        realizados</label>
                                                    <textarea id="applied_studies" name="applied_studies" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->applied_studies : '' !!}</textarea>
                                                </div>
                                            </div>
                                            @php
                                                $count_vital_signs = 0;
                                            @endphp
                                            @foreach ($vital_sing as $item)
                                                @php
                                                    if ($validateHistory) {
                                                        $name = $item->name;
                                                        $value = $Patient->get_history->$name;
                                                        if ($value === '1') {
                                                            $count_vital_signs++;
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="floating-label-group">
                                                        <div class="form-check" style="display: flex; ">
                                                            <div style="margin-right: 30px;">
                                                                <input onclick="handlerVitalSigns(event);"
                                                                    class="form-check" name="{{ $item->name }}"
                                                                    type="checkbox" id="{{ $item->name }}"
                                                                    value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                    {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                            </div>
                                                            <div>
                                                                <label style="font-size: 15px;" class="form-check-label"
                                                                    for="flexCheckDefault">
                                                                    {{ $item->text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text">Total Signos vitales
                                                    </span>
                                                    <input type="text" id="countVitalSigns" name="countVitalSigns"
                                                        class="form-control" readonly value="{!! !empty($validateHistory) ? $count_vital_signs : '' !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- antecedentes falimilares --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Antecedentes Personales y Familiares
                                    </button>
                                </span>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            @php
                                                $count_back_bamiliy = 0;
                                            @endphp
                                            @foreach ($family_back as $item)
                                                @php
                                                    if ($validateHistory) {
                                                        $name = $item->name;
                                                        $value = $Patient->get_history->$name;
                                                        if ($value === '1') {
                                                            $count_back_bamiliy++;
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="floating-label-group">
                                                        <div class="form-check" style="display: flex; ">
                                                            <div style="margin-right: 30px;">
                                                                <input onclick="handlerBackFamiliy(event);"
                                                                    class="form-check" name="{{ $item->name }}"
                                                                    type="checkbox" id="{{ $item->name }}"
                                                                    value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                    {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                            </div>
                                                            <div>
                                                                <label style="font-size: 15px;" class="form-check-label"
                                                                    for="flexCheckDefault">
                                                                    {{ $item->text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text" id="">Total
                                                        Antecedentes</span>
                                                    <input type="text" id="countBackFamily" name="countBackFamily"
                                                        class="form-control" readonly value="{!! !empty($validateHistory) ? $count_back_bamiliy : '' !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Antecedentes personales patológicos --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="true"
                                        aria-controls="collapseThree" style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Antecedentes personales patológicos
                                    </button>
                                </span>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            @php
                                                $count_dagnosis = 0;
                                            @endphp
                                            @foreach ($pathology_back as $item)
                                                @php
                                                    if ($validateHistory) {
                                                        $name = $item->name;
                                                        $value = $Patient->get_history->$name;
                                                        if ($value === '1') {
                                                            $count_dagnosis++;
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="floating-label-group">
                                                        <div class="form-check" style="display: flex; ">
                                                            <div style="margin-right: 30px;">
                                                                <input onclick="handlerDiagnosis(event);"
                                                                    class="form-check" name="{{ $item->name }}"
                                                                    type="checkbox" id="{{ $item->name }}"
                                                                    value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                    {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                            </div>
                                                            <div>
                                                                <label style="font-size: 15px;" class="form-check-label"
                                                                    for="flexCheckDefault">
                                                                    {{ $item->text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text">Total patológicos
                                                    </span>
                                                    <input type="text" id="countDiagnosis" name="countDiagnosis"
                                                        class="form-control" readonly value="{!! !empty($validateHistory) ? $count_dagnosis : '' !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- historia Antecedentes personales no patológicos --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Historia no patológica
                                    </button>
                                </span>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            @php
                                                $count_notpathologica = 0;
                                            @endphp
                                            @foreach ($non_pathology_back as $item)
                                                @php
                                                    if ($validateHistory) {
                                                        $name = $item->name;
                                                        $value = $Patient->get_history->$name;
                                                        if ($value === '1') {
                                                            $count_notpathologica++;
                                                        }
                                                    }
                                                @endphp
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                    <div class="floating-label-group">
                                                        <div class="form-check" style="display: flex; ">
                                                            <div style="margin-right: 30px;">
                                                                <input onclick="handlerNotPathologica(event);"
                                                                    class="form-check" name="{{ $item->name }}"
                                                                    type="checkbox" id="{{ $item->name }}"
                                                                    value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                    {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                            </div>
                                                            <div>
                                                                <label style="font-size: 15px;" class="form-check-label"
                                                                    for="flexCheckDefault">
                                                                    {{ $item->text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="input-group flex-nowrap">
                                                    <span class="input-group-text">Total historia no patológica
                                                    </span>
                                                    <input type="text" id="countNotPathological"
                                                        name="countNotPathological" class="form-control" readonly
                                                        value="{!! !empty($validateHistory) ? $count_notpathologica : '' !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- historia ginecológica --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Historial ginecologicos si aplica
                                    </button>
                                </span>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Edad
                                                            de primera menstruación</label>
                                                        <input autocomplete="off"
                                                            class="form-control  mask-only-number @error('edad_primera_menstruation') is-invalid @enderror"
                                                            id="edad_primera_menstruation"
                                                            name="edad_primera_menstruation" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->edad_primera_menstruation : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha
                                                            último periodo</label>
                                                        <input autocomplete="off"
                                                            class="form-control datePickert @error('fecha_ultima_regla') is-invalid @enderror"
                                                            id="fecha_ultima_regla" name="fecha_ultima_regla"
                                                            type="text" readonly value="{!! !empty($validateHistory) ? $Patient->get_history->fecha_ultima_regla : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                            de embarazos</label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('numero_embarazos') is-invalid @enderror"
                                                            id="numero_embarazos" name="numero_embarazos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->numero_embarazos : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                            de partos</label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('numero_partos') is-invalid @enderror"
                                                            id="numero_partos" name="numero_partos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->numero_partos : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                            de cesáreas</label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('cesareas') is-invalid @enderror"
                                                            id="cesareas" name="cesareas" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->cesareas : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                            de abortos</label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('numero_abortos') is-invalid @enderror"
                                                            id="numero_abortos" name="numero_abortos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->numero_abortos : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Utiliza
                                                            algún método anticonceptivo, ¿Cual?</label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('pregunta') is-invalid @enderror"
                                                            id="pregunta" name="pregunta" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->pregunta : '' !!}">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- alergias --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Alergias Conocidas
                                    </button>
                                </span>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row mt-3" style="align-items: flex-end;">
                                            <h5 class="text-center collapseBtn">Añadir Alergias</h5>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Tipo
                                                            de alergia</label>
                                                        <select name="type_alergia" id="type_alergia"
                                                            placeholder="Seleccione"class="form-control"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">Seleccione</option>
                                                            <option value="Medicinas"> Medicinas</option>
                                                            <option value="Alimentos">Alimentos</option>
                                                            <option value="Latex">Latex</option>
                                                            <option value="Otros">Otros</option>
                                                        </select>
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                        <span id="type_alergia_span " class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Detalle</label>
                                                        <input autocomplete="off" class="form-control mask-only-text"
                                                            id="detalle_alergia" name="detalle_alergia" type="text"
                                                            value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="detalle_alergia_span" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <span type="" onclick="handlerAllergies(event)"
                                                    class="btn btn-outline-secondary" id="btn"><i
                                                        class="bi bi-plus-lg"></i>Añadir Alergias</span>
                                            </div>
                                            {{-- Tabla --}}
                                            <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5 table-responsive"
                                                style="margin-top: 20px; width: 100%;">
                                                <hr>
                                                <h5>Lista de alergias</h5>
                                                <hr>
                                                <table class="table table-striped table-bordered" id="table-alergias">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">Tipo de alergias</th>
                                                            <th class="text-center" scope="col">Detalle</th>
                                                            <th class="text-center" scope="col">Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($validateHistory)
                                                            @if ($validateHistory->allergies != 'null')
                                                                @php
                                                                    $dataAllergies = json_decode($validateHistory->allergies, true);
                                                                @endphp
                                                                @foreach ($dataAllergies as $key => $item)
                                                                    <tr id="{{ $key }}">
                                                                        <td class="text-center">
                                                                            {{ $item['type_alergia'] }}</td>
                                                                        <td class="text-center">
                                                                            {{ $item['detalle_alergia'] }} </td>
                                                                        <td class="text-center"><span
                                                                                onclick="deleteAllergie({{ $key }})"><i
                                                                                    class="bi bi-archive"></i></span> </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <tfoot>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                            <div class="input-group flex-nowrap">
                                                                <span class="input-group-text" id="">Total
                                                                    alergias</span>
                                                                <input type="text" id="countAllergies"
                                                                    name="countAllergies" class="form-control" readonly
                                                                    value="{!! !empty($validateHistory) ? ($validateHistory->allergies != 'null' ? count($dataAllergies) : 0) : '' !!}">
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
                    </div>
                    {{-- historia quirúrgica --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingSeven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSeven" aria-expanded="true"
                                        aria-controls="collapseSeven" style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Historia quirúrgica
                                    </button>
                                </span>
                                <div id="collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="headingSeven" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row mt-3" style="align-items: flex-end;">
                                            <h5 class="text-center collapseBtn">Añadir cirugía</h5>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Tipo
                                                            de cirugía</label>
                                                        <input autocomplete="off" class="form-control mask-only-text"
                                                            id="cirugia" name="cirugia" type="text" value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="cirugia_span" class="text-danger"></span>
                                                </diV>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha</label>
                                                        <input autocomplete="off" class="form-control datePickert"
                                                            id="datecirugia" readonly name="datecirugia" type="text"
                                                            value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="datecirugia_span" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <span type="" onclick="handlerSurgical(event)"
                                                    class="btn btn-outline-secondary" id="btn"><i
                                                        class="bi bi-plus-lg"></i>Añadir cirugía</span>
                                            </div>
                                            {{-- tabla --}}
                                            <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5 table-responsive"
                                                style="margin-top: 20px; width: 100%;">
                                                <hr>
                                                <h5>Lista de cirugías</h5>
                                                <hr>
                                                <table class="table table-striped table-bordered" id="table-cirugia">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">Cirugía</th>
                                                            <th class="text-center" scope="col">Fecha</th>
                                                            <th class="text-center" scope="col">Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($validateHistory)
                                                            @if ($validateHistory->history_surgical != 'null')
                                                                @php
                                                                    $history_surgical = json_decode($validateHistory->history_surgical, true);
                                                                @endphp
                                                                @foreach ($history_surgical as $key => $item)
                                                                    <tr id="{{ $key }}">
                                                                        <td class="text-center">{{ $item['cirugia'] }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $item['datecirugia'] }}</td>
                                                                        <td class="text-center"><span
                                                                                onclick="deleteSurgical({{ $key }})"><i
                                                                                    class="bi bi-archive"></i></span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <tfoot>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                            <div class="input-group flex-nowrap">
                                                                <span class="input-group-text">Total cirugía
                                                                </span>
                                                                <input type="text" id="countSurgical"
                                                                    name="countSurgical" class="form-control" readonly
                                                                    value="{!! !empty($validateHistory)
                                                                        ? ($validateHistory->history_surgical != 'null'
                                                                            ? count($history_surgical)
                                                                            : 0)
                                                                        : '' !!}">
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
                    </div>
                    {{-- Medicacion --}}
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingEight">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEight" aria-expanded="true"
                                        aria-controls="collapseEight" style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Medicación
                                    </button>
                                </span>
                                <div id="collapseEight" class="accordion-collapse collapse"
                                    aria-labelledby="headingEight" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row mt-3">
                                            <h5 class="text-center collapseBtn">Añadir Medicamento</h5>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Medicamento</label>
                                                        <input autocomplete="off" class="form-control mask-only-text"
                                                            id="medicine" name="medicine" type="text"
                                                            value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="medicine_span" class="text-danger"></span>
                                                </diV>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Dosis</label>
                                                        <input autocomplete="off" class="form-control mask-only-text"
                                                            id="dose" name="dose" type="text" value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="dose_span" class="text-danger"></span>
                                                </diV>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Patología</label>
                                                        <input autocomplete="off" class="form-control mask-only-text"
                                                            id="patologi" name="patologi" type="text"
                                                            value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="patologi_span" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Vía
                                                            de administración</label>
                                                        <input autocomplete="off" class="form-control mask-only-text"
                                                            id="viaAdmin" name="viaAdmin" type="text"
                                                            value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="viaAdmin_span" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Duración
                                                            del tratamiento</label>
                                                        <input autocomplete="off" class="form-control mask-only-number"
                                                            id="treatmentDuration" name="treatmentDuration"
                                                            type="text" value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="treatmentDuration_span" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha
                                                            inicio</label>
                                                        <input autocomplete="off" class="form-control datePickert"
                                                            id="dateIniTreatment" readonly name="dateIniTreatment"
                                                            type="text" value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="dateIniTreatment_span" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha
                                                            fin</label>
                                                        <input autocomplete="off" class="form-control datePickert"
                                                            id="dateEndTreatment" readonly name="dateEndTreatment"
                                                            type="text" value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="dateEndTreatment_span" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nro.
                                                            Orden</label>
                                                        <input autocomplete="off" class="form-control mask-only-number"
                                                            id="NUmberOrder" name="NUmberOrder" type="text"
                                                            value="">
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                    </div>
                                                    <span id="NUmberOrder_span" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3 offset-md-5">
                                                <span type="" onclick="addMedacition(event)"
                                                    class="btn btn-outline-secondary" id="btn"><i
                                                        class="bi bi-plus-lg"></i>Añadir
                                                    medicamento</span>
                                            </div>
                                        </div>
                                        {{-- tabla --}}
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                                style="margin-top: 20px; width: 100%;">
                                                <hr>
                                                <h5>Lista de medicamentos</h5>
                                                <hr>
                                                <table class="table table-striped table-bordered" id="table-medicamento">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">Medicamento</th>
                                                            <th class="text-center" scope="col">Dosis</th>
                                                            <th class="text-center" scope="col">Patología</th>
                                                            <th class="text-center" scope="col">Via de administración
                                                            </th>
                                                            <th class="text-center" scope="col">Duración de tratamiento
                                                            </th>
                                                            <th class="text-center" scope="col">Fecha inicio</th>
                                                            <th class="text-center" scope="col">Fecha fin</th>
                                                            <th class="text-center" scope="col">Nro. Orden</th>
                                                            <th class="text-center" scope="col">Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($validateHistory)
                                                            @if ($validateHistory->medications_supplements != 'null')
                                                                @php
                                                                    $medications_supplements = json_decode($validateHistory->medications_supplements, true);
                                                                @endphp
                                                                @foreach ($medications_supplements as $key => $item)
                                                                    <tr id="{{ $key }}">
                                                                        <td class="text-center">{{ $item['dose'] }}</td>
                                                                        <td class="text-center"> {{ $item['medicine'] }}
                                                                        </td>
                                                                        <td class="text-center"> {{ $item['patologi'] }}
                                                                        </td>
                                                                        <td class="text-center"> {{ $item['viaAdmin'] }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $item['NUmberOrder'] }}</td>
                                                                        <td class="text-center">
                                                                            {{ $item['dateEndTreatment'] }}</td>
                                                                        <td class="text-center">
                                                                            {{ $item['dateIniTreatment'] }}</td>
                                                                        <td class="text-center">
                                                                            {{ $item['treatmentDuration'] }}</td>
                                                                        <td class="text-center"><span
                                                                                onclick="deleteMedication({{ $key }})"><i
                                                                                    class="bi bi-archive"></i></span> </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <tfoot>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                            <div class="input-group flex-nowrap">
                                                                <span class="input-group-text">Total de medicamentos
                                                                </span>
                                                                <input type="text" id="countMedicationAdd"
                                                                    name="countMedicationAdd" class="form-control"
                                                                    readonly value="{!! !empty($validateHistory)
                                                                        ? ($validateHistory->medications_supplements != 'null'
                                                                            ? count($medications_supplements)
                                                                            : 0)
                                                                        : '' !!}">
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
                    </div>
                </div>
                {{-- botton --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="row justify-content-md-center mt-3">
                            <div id="spinner" style="display: none">
                                <x-load-spinner show="true" />
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-md-end">
                            <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id="send"
                                style="display: flex; justify-content: flex-end;">
                                <input class="btn btnPrimary" value="Guardar" type="submit" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
