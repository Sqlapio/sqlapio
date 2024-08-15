@extends('layouts.app-auth')
@section('title', 'Historia Clínica')
<style>
    #btn {
        padding: 8px 16px !important;
    }

    .span-input {
        height: 42px;
    }

    .input-one {
        margin-right: 0px
    }

    .img-medical {
        border-radius: 20px;
        border: 3px solid #47525e;
        object-fit: cover;
    }

    .data-medical {
        font-size: 13px
    }

    @media only screen and (max-width: 390px) {
        .data-medical {
            width: 185px !important;
            font-size: 13px;
        }

        .mt-cr {
            padding-top: 1rem;
        }

        .btn {
            width: 100% !important;
        }
    }

    @media (min-width: 391px) and (max-width: 576px) {

        .btn {
            width: 100% !important;
        }

        .mt-cr {
            padding-top: 1rem;
        }

        .data-medical {
            width: 222px !important;
            font-size: 13px;
        }


    }

    textarea {
        padding-top: 10px;
        padding-bottom: 10px;
        width: 100%;
        display: block;
        height: 36px;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
    }
</style>
@php
    $lang = session()->get('locale');
    if ($lang == 'en') {
        $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/en-EN.json';
    } else{
        $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json';
    }
@endphp
@push('scripts')
    <script>
        let valueAllergies = '';
        let valueMedications_supplements = '';
        let valueHistory_surgical = '';
        let allergies = @json($validateHistory ? json_decode($validateHistory->allergies, true) : []);
        let history_surgical = @json($validateHistory ? json_decode($validateHistory->history_surgical, true) : []);
        let medications_supplements = @json($validateHistory ? json_decode($validateHistory->medications_supplements, true) : []);
        ///count
        let countAllergies = (allergies) ? allergies.length : 0;
        let countSurgical = (history_surgical) ? history_surgical.length : 0;
        let countMedicationAdd = (medications_supplements) ? medications_supplements.length : 0;
        let countDiagnosis = 0;
        let countNotPathological = 0;
        let countGynecological = 0;
        let countBackFamily = 0;
        let countAllergySymptoms = 0;
        let count_medical_devices = 0;
        ////
        let arrayAllergies = (allergies) ? allergies : [];
        let arrayhistory_surgical = (history_surgical) ? history_surgical : [];
        let arraymedications_supplements = (medications_supplements) ? medications_supplements : [];

        var url = @json($url);

        let history = @json($validateHistory)

        $(document).ready(() => {

            $(".datePickert").datepicker({
                language: 'es',
            });
            $('#form-mecal-histroy').validate({
                ignore: [],
                rules: {
                    countBackFamily: {
                        required: true,
                    },
                    countDiagnosis: {
                        required: true,
                    },
                    countNotPathological: {
                        required: true,
                    }
                },
                messages: {

                    countBackFamily: {
                        required: "@lang('messages.alert.selec_antp')"
                    },
                    countDiagnosis: {
                        required: "@lang('messages.alert.selec_antpp')"
                    },
                    countNotPathological: {
                        required: "@lang('messages.alert.selec_antpnp')"
                    }
                },
            });

            if(history) {
                $('#ACTSEX_activo').val(history.ACTSEX_activo).change();
                $('#IMC19_dosis').val(history.IMC19_dosis).change();
                $('#IMC19_marca').val(history.IMC19_marca).change();
            }


            $.validator.addMethod("onlyText", function(value, element) {
                let pattern = /^[a-zA-ZñÑáéíóúü0-9\s]+$/g;
                return pattern.test(value);
            }, "@lang('messages.alert.no_caracteres')");

            $.validator.addMethod("onlyNumber", function(value, element) {
                let pattern = /^\d+\.?\d\s*$/;
                return pattern.test(value);
            }, "@lang('messages.alert.campo_numerico')");

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
                                title: '@lang('messages.alert.historia_registrada')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {
                                let url = "{{ route('MedicalRecord', ':id') }}";
                                url = url.replace(':id', $('#id_patient').val());
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
                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                }).then((result) => {
                                    $('#send').show();
                                    $('#spinner').hide();
                                    $("#form-patients").trigger("reset");
                                });
                            });
                        }
                    });
                } else {
                    $("#collapseTwo").collapse('show');
                }
            })


            const autoTextarea = (id) => {
                document.getElementById(id).addEventListener('keyup', function() {
                    this.style.overflow = 'hidden';
                    this.style.height = 0;
                    this.style.height = this.scrollHeight + 'px';
                }, false);
            }

            autoTextarea('observations_back_family');
            autoTextarea('observations_diagnosis');
            autoTextarea('observations_not_pathological');
            autoTextarea('observations_mental_healths');
            autoTextarea('observations_medical_devices');
            autoTextarea('observations_ginecologica');
            autoTextarea('observations_allergies');
            autoTextarea('observations_quirurgicas');
            autoTextarea('observations_medication');
            autoTextarea('observations_inmunizations');
        })

        // Antecedentes Familiares //
        const handlerBackFamiliy = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "FB_NA") {

                    $('#checkbok-input input[type="checkbox"]').prop('checked', false);

                    $('#checkbok-input input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countBackFamily = 0;

                } else {

                    $('#FB_NA').prop('checked', false);

                    $('#FB_NA').val(null);

                    $(`#${e.target.id}`).val(1);

                    $(`#${e.target.id}`).prop('checked', true);

                    countBackFamily = countBackFamily + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countBackFamily = (countBackFamily == 0) ? '' : countBackFamily - 1;

            }

            $('#countBackFamily').val(countBackFamily);

            if(e.target.id == 'FB_C' && $(`#${'FB_C'}`).is(':checked') == true) {
                $('#FB_C_input').show();

            } else if($(`#${'FB_C'}`).is(':checked') == false) {

                $('#FB_C_input').hide();
                $('#FB_C_input').val('');
            }


        }

        // Antecedentes Personales Patológicos //
        const handlerDiagnosis = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "PB_NA") {

                    $('#checkbok-input-diagnosis input[type="checkbox"]').prop('checked', false);

                    $('#checkbok-input-diagnosis input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countDiagnosis = 0;

                } else {

                    $('#PB_NA').prop('checked', false);

                    $('#PB_NA').val(null);


                    $(`#${e.target.id}`).val(1);

                    countDiagnosis = countDiagnosis + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countDiagnosis = (countDiagnosis == 0) ? '' : countDiagnosis - 1;
            }

            $('#countDiagnosis').val(countDiagnosis);

        }

        // Antecedentes Personales No Patológicos //
        const handlerNotPathologica = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "NPB_NA") {

                    $('#div_no_aplica_no_pathology input[type="checkbox"]').prop('checked', false);

                    $('#div_no_aplica_no_pathology input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countNotPathological = 0;

                } else {

                    $('#NPB_NA').prop('checked', false);

                    $('#NPB_NA').val(null);


                    $(`#${e.target.id}`).val(1);

                    countNotPathological = countNotPathological + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countNotPathological = (countNotPathological == 0) ? '' : countNotPathological - 1;
            }

            $('#countNotPathological').val(countNotPathological);

        }

        // Salud mental //
        const handlerMentalHealths = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                console.log(e.target.id)

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "EM_NA") {

                    $('#div_mental_healths input[type="checkbox"]').prop('checked', false);

                    $('#div_mental_healths input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countMentalHealths = 0;

                } else {

                    $('#EM_NA').prop('checked', false);

                    $('#EM_NA').val(null);


                    $(`#${e.target.id}`).val(1);

                    countMentalHealths = countMentalHealths + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countMentalHealths = (countMentalHealths == 0) ? '' : countMentalHealths - 1;
            }

            $('#countMentalHealths').val(countMentalHealths);

        }

        // inmunizaciones //
        const handlerInmunizations = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {


                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "IM_NA") {

                    $('#div_inmunizations input[type="checkbox"]').prop('checked', false);

                    $('#div_inmunizations input[type="checkbox"]').val(null);

                    $('#IMC19_dosis').val('');
                    $('#IMC19_fecha_ultima_dosis').val('');
                    $('#IMC19_marca').val('');

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countInmunizations = 0;

                } else {

                    $('#IM_NA').prop('checked', false);

                    $('#IM_NA').val(null);


                    $(`#${e.target.id}`).val(1);

                    countInmunizations = countInmunizations + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countInmunizations = (countInmunizations == 0) ? '' : countInmunizations - 1;
            }

            $('#countInmunizations').val(countInmunizations);


            if(e.target.id == 'IM_O' && $(`#${'IM_O'}`).is(':checked') == true) {
                $('#IM_V_input').show();

            } else if($(`#${'IM_O'}`).is(':checked') == false) {
                $('#IM_V_input').hide();
                $('#IM_V_input').val('');
            }

        }

        // dispositivos medicos //
        const handlerMedicalDevices = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                console.log(e.target.id)

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "MD_NA") {

                    $('#div_medical_devices input[type="checkbox"]').prop('checked', false);

                    $('#div_medical_devices input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    count_medical_devices = 0;

                } else {

                    $('#MD_NA').prop('checked', false);

                    $('#MD_NA').val(null);


                    $(`#${e.target.id}`).val(1);

                    count_medical_devices = count_medical_devices + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                count_medical_devices = (count_medical_devices == 0) ? '' : count_medical_devices - 1;
            }

            $('#count_medical_devices').val(count_medical_devices);

        }

        //agregar alergia
        function handlerAllergies(e) {
            // validaciones para agragar cirugia
            if ($('#type_alergia').val() === "") {
                $("#type_alergia_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#detalle_alergia').val() === "") {
                $("#cirugia").text('');
                $("#detalle_alergia_span").text('@lang('messages.alert.campo_obligatorio')');
            } else {
                $("#detalle_alergia_span").text('');

                let btn = `<span onclick="deleteAllergie(${countAllergies})" ><i class="bi bi-trash-fill"></i></span>`;

                arrayAllergies.push({
                    type_alergia: $('#type_alergia').val(),
                    detalle_alergia: $('#detalle_alergia').val(),
                    btn: btn,
                    id: countAllergies
                });


                new DataTable(
                    '#table-alergias', {
                        language: {
                            url: url,
                        },
                        bDestroy: true,
                        data: arrayAllergies,
                        "searching": false,
                        "bLengthChange": false,
                        columns: [{
                                data: 'type_alergia',
                                title: '@lang('messages.tabla.tipo_alergias')',
                                className: "text-center td-pad w-17",
                            },
                            {
                                data: 'detalle_alergia',
                                title: '@lang('messages.tabla.detalle')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'btn',
                                title: '@lang('messages.tabla.eliminar')',
                                className: "text-center td-pad w-5",
                            }
                        ],
                        fnCreatedRow: function(rowEl, data) {
                            $(rowEl).attr('id', data.id);
                        }
                    });

                countAllergies = countAllergies + 1;
                $('#countAllergies').val(countAllergies);
                // limpiar campos
                $('#type_alergia').val("");
                $('#detalle_alergia').val("");
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

        function addForm(e) {
            $("#form-medication").toggle();
        }

        //agregar medicamento
        function addMedacition(e) {
            // validaciones para agragar medicacion
            if ($('#medicine').val() === "") {
                $("#medicine_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#dose').val() === "") {
                $("#medicine_span").text('');
                $("#dose_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#patologi').val() === "") {
                $("#dose_span").text('');
                $("#patologi_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#viaAdmin').val() === "") {
                $("#patologi_span").text('');
                $("#viaAdmin_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#treatmentDuration').val() === "") {
                $("#viaAdmin_span").text('');
                $("#treatmentDuration_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#dateIniTreatment').val() === "") {
                $("#treatmentDuration_span").text('');
                $("#dateIniTreatment_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#dateEndTreatment').val() === "") {
                $("#dateIniTreatment_span").text('');
                $("#dateEndTreatment_span").text('@lang('messages.alert.campo_obligatorio')');
            } else {

                let btn =
                    `<span onclick="deleteMedication(${countMedicationAdd})" ><i class="bi bi-trash-fill"></i></span>`;

                arraymedications_supplements.push({
                    medicine: $('#medicine').val(),
                    dose: $('#dose').val(),
                    patologi: $('#patologi').val(),
                    viaAdmin: $('#viaAdmin').val(),
                    treatmentDuration: $('#treatmentDuration').val(),
                    dateIniTreatment: $('#dateIniTreatment').val(),
                    dateEndTreatment: $('#dateEndTreatment').val(),

                    frequency: $('#frequency').val(),
                    side_effects: $('#side_effects').val(),
                    effectiveness: $('#effectiveness').val(),
                    btn: btn,
                    id: countMedicationAdd
                });

                new DataTable(
                    '#table-medicamento', {
                        language: {
                            url: url,
                        },
                        bDestroy: true,
                        data: arraymedications_supplements,
                        "searching": false,
                        "bLengthChange": false,
                        columns: [{
                                data: 'medicine',
                                title: '@lang('messages.tabla.medicamento')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'dose',
                                title: '@lang('messages.tabla.dosis')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'patologi',
                                title: '@lang('messages.tabla.patologia')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'frequency',
                                title: '@lang('messages.tabla.frecuencia')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'effectiveness',
                                title: '@lang('messages.tabla.efectividad')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'treatmentDuration',
                                title: '@lang('messages.tabla.duracion')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'viaAdmin',
                                title: '@lang('messages.tabla.via')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'side_effects',
                                title: '@lang('messages.tabla.efect_secund')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'btn',
                                title: '@lang('messages.tabla.eliminar')',
                                className: "text-center td-pad w-5",
                            }
                        ],
                        fnCreatedRow: function(rowEl, data) {
                            $(rowEl).attr('id', data.id);
                        }
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
                $('#form-medication').hide()

                $('#frequency').val("")
                $('#side_effects').val("")
                $('#effectiveness').val("")
            }
        }

        //agregar cirugia
        function handlerSurgical(e) {
            // validaciones para agragar cirugia
            if ($('#cirugia').val() === "") {
                $("#cirugia_span").text('@lang('messages.alert.campo_obligatorio')');
            } else if ($('#datecirugia').val() === "") {
                $("#cirugia").text('');
                $("#datecirugia_span").text('@lang('messages.alert.campo_obligatorio')');
            } else {
                $("#datecirugia_span").text('');

                let btn = `<span onclick="deleteSurgical(${countSurgical})" ><i class="bi bi-trash-fill"></i></span>`;

                arrayhistory_surgical.push({
                    cirugia: $('#cirugia').val(),
                    datecirugia: $('#datecirugia').val(),
                    btn: btn,
                    id: countSurgical
                });

                new DataTable(
                    '#table-cirugia', {
                        language: {
                            url: url,
                        },
                        bDestroy: true,
                        data: arrayhistory_surgical,
                        "searching": false,
                        "bLengthChange": false,
                        columns: [{
                                data: 'cirugia',
                                title: '@lang('messages.tabla.cirugia')',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'datecirugia',
                                title: '@lang('messages.tabla.fecha')',
                                className: "text-center td-pad w-10",
                            },
                            {
                                data: 'btn',
                                title: '@lang('messages.tabla.eliminar')',
                                className: "text-center td-pad w-5",
                            }
                        ],
                        fnCreatedRow: function(rowEl, data) {
                            $(rowEl).attr('id', data.id);
                        }
                    });



                countSurgical = countSurgical + 1;
                $('#countSurgical').val(countSurgical);
                // limpiar campos
                $('#cirugia').val("");
                $('#datecirugia').val("");
            }
        }

        //borrar medicamento
        function deleteMedication(count) {
            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.accion')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')',
                showCancelButton: true,
                cancelButtonText: '@lang('messages.botton.cancelar')'
            }).then((result) => {
                if (result.isConfirmed) {

                    $('#table-medicamento tr#' + count).remove();
                    arraymedications_supplements.splice(count, 1);
                    countMedicationAdd = countMedicationAdd - 1;
                    $('#countMedicationAdd').val(countMedicationAdd);
                }
            });

        }

        //borrar cirugia
        function deleteSurgical(count) {
            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.accion')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')',
                showCancelButton: true,
                cancelButtonText: '@lang('messages.botton.cancelar')'
            }).then((result) => {
                if (result.isConfirmed) {

                    $('#table-cirugia tr#' + count).remove();
                    arrayhistory_surgical.splice(count, 1);
                    countSurgical = countSurgical - 1;
                    $('#countSurgical').val(countSurgical);
                }
            });

        }

        //borrar alergias
        function deleteAllergie(count) {

            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.accion')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')',
                showCancelButton: true,
                cancelButtonText: '@lang('messages.botton.cancelar')'
            }).then((result) => {
                if (result.isConfirmed) {

                    $('#table-alergias tr#' + count).remove();
                    arrayAllergies.splice(count, 1);
                    countAllergies = countAllergies - 1;
                    $('#countAllergies').val(countAllergies);
                }

            });
        }

        function handlerValidate(e, input) {

            switch (input) {
                case 'age':
                    if (Number(e.target.value.replace(',', '')) > 30000) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    }
                    break;
                case 'height':

                    let value = e.target.value.replace(',', '');
                    value = value.replace('CM', '');
                    if (Number(value) > 25000) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    }
                    break;
                case 'strain':
                    if (Number(e.target.value) < 50) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    } else if (Number(e.target.value) > 250) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();

                    }
                    break;
                case 'strain_two':
                    if (Number(e.target.value) < 30) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    } else if (Number(e.target.value) > 150) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();

                    }
                    break;
                case 'temperature':
                    let temperature = e.target.value.replace(',', '');
                    temperature = temperature.replace('°', '');
                    if (Number(temperature) < 34) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    } else if (Number(temperature) > 4200) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    } else if (temperature.length == 2) {
                        if (Number(temperature) > 42) {
                            $(`#${e.target.id}`).val('');
                            $(`#${e.target.id}`).focus();
                        }
                    }
                    break;

                case 'breaths':
                    if (Number(e.target.value.replace('/Min', '')) < 12) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    } else if (Number(e.target.value.replace('/Min', '')) > 30) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    }
                    break;

                case 'pulse':
                    if (Number(e.target.value) < 40) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    } else if (Number(e.target.value) > 200) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    }
                    break;

                case 'saturation':
                    if (Number(e.target.value.replace('%', '')) < 70) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    } else if (Number(e.target.value.replace('%', '')) > 100) {
                        $(`#${e.target.id}`).val('');
                        $(`#${e.target.id}`).focus();
                    }
                    break;

                default:
                    break;
            }
        }

    </script>
@endpush
@section('content')
    {{-- <div> --}}
    <div class="container-fluid" style="padding: 0 3% 3%">

        <form id="form-mecal-histroy" method="post" action="/">
            {{ csrf_field() }}
            <div class="accordion" id="accordion">
                {{-- Datos paciente --}}
                <div class="row mt-2">
                    <input type="hidden" name="id" id="id_patient" value="{{ $Patient->id }}">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingD">
                                <button class="accordion-button bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseD" aria-expanded="true" aria-controls="collapseD"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person"></i></i>@lang('messages.label.datos_paciente')
                                </button>
                            </span>
                            <div id="collapseD" class="accordion-collapse collapse show" aria-labelledby="headingD"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row mt-2">
                                        <div class="d-flex" style="align-items: center;">
                                            <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2"
                                                style="width: 162px;">
                                                <img src=" {{ $Patient->patient_img ? asset('/imgs/' . $Patient->patient_img) : ($Patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                    width="125" height="125" alt="Imagen del paciente"
                                                    class="img-medical">
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical">
                                                <strong>@lang('messages.ficha_paciente.nombre'):</strong>
                                                <span class="text-capitalize"> {{ $Patient->last_name . ', ' . $Patient->name }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.fecha_nacimiento'):</strong>
                                                <span> {{ date('d-m-Y', strtotime($Patient->birthdate)) }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.edad'):</strong>
                                                <span> {{ $Patient->age }} @lang('messages.ficha_paciente.años')</span>
                                                <br>
                                                @if (Auth::user()->contrie == '81')
                                                    <strong>@lang('messages.form.CIE') {{ $Patient->is_minor === 'true' ? '(Rep)' : '' }}:</strong>
                                                @else
                                                    <strong>@lang('messages.ficha_paciente.ci') {{ $Patient->is_minor === 'true' ? '(Rep)' : '' }}:</strong>
                                                @endif
                                                <span> {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.genero'):</strong>
                                                <span class="text-capitalize"> {{ $Patient->genere }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.nro_historias'):</strong>
                                                <span> {{ $Patient->get_history != null ? $Patient->get_history->cod_history : '' }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- antecedentes falimilares --}}
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-clipboard2-pulse"></i> @lang('messages.acordion.antecedentes_med')
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">

                                    {{-- antecedentes personales --}}
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">@lang('messages.acordion.antecedentes_per')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="row" id="checkbok-input">
                                        <div style="display: flex">
                                            <span class="text-warning mt-2" id='APF' style="font-size: 15px;margin-right: 10px;"></span>
                                        </div>
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
                                                            <input onclick="handlerBackFamiliy(event);" class="form-check"
                                                                name="{{ $item->name }}" type="checkbox"
                                                                id="{{ $item->name }}" value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                        </div>
                                                        <div style="display: flex; align-items: center;">
                                                            <label style="font-size: 14px;" class="form-check-label"
                                                                for="flexCheckDefault">
                                                                {{ $item->text }}
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-2" id="FB_C_input" style="{!! !empty($validateHistory->FB_C) ? '' : 'display: none' !!}">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="FB_C_input" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.label.tipo_cancer')
                                                        </label>
                                                        <input autocomplete="off" class="form-control mask-only-text"
                                                            id="FB_C_input" name="FB_C_input" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->FB_C_input : '' !!}">
                                                        <i class="bi bi-file-medical st-icon"></i>
                                                    </div>
                                                    <span id="FB_C_input" class="text-danger"></span>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="hidden" id="countBackFamily" name="countBackFamily"
                                                    class="form-control" readonly value="{!! !empty($validateHistory) ? $count_back_bamiliy : '' !!}">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                            <div class="form-group">
                                                <label for="observations_back_family" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_back_family" rows="{!! !empty($Patient->get_history->observations_back_family) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}"
                                                    name="observations_back_family" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_back_family : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end --}}

                                    {{-- Antecedentes Personales Patológicos --}}
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                        @lang('messages.acordion.antecedentes_per_pa')</h6>
                                    <hr style="margin-bottom: 0;">

                                    <div class="row" id="checkbok-input-diagnosis">
                                        <div style="display: flex">
                                            <span class="text-warning mt-2" id="APP"
                                                style="font-size: 15px;margin-right: 10px;"></span>
                                        </div>
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
                                                            <input onclick="handlerDiagnosis(event);" class="form-check"
                                                                name="{{ $item->name }}" type="checkbox"
                                                                id="{{ $item->name }}" value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                        </div>
                                                        <div>
                                                            <label style="font-size: 14px;" class="form-check-label"
                                                                for="flexCheckDefault">
                                                                {{ $item->text }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="hidden" id="countDiagnosis" name="countDiagnosis"
                                                    class="form-control" readonly value="{!! !empty($validateHistory) ? $count_dagnosis : '' !!}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                            <div class="form-group">
                                                <label for="observations_diagnosis" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_diagnosis" rows="{!! !empty($Patient->get_history->observations_diagnosis) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}"
                                                    name="observations_diagnosis" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_diagnosis : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end --}}

                                    {{-- Antecedentes Personales No Patológicos --}}
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px"> @lang('messages.acordion.antecedentes_per_no_pa')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="row" id="div_no_aplica_no_pathology">
                                        <div style="display: flex">
                                            <span class="text-warning mt-2" id="ANP"
                                                style="font-size: 15px;margin-right: 10px;"></span>
                                        </div>
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
                                                            <label style="font-size: 14px;" class="form-check-label"
                                                                for="flexCheckDefault">
                                                                {{ $item->text }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="hidden" id="countNotPathological"
                                                    name="countNotPathological" class="form-control" readonly
                                                    value="{!! !empty($validateHistory) ? $count_notpathologica : '' !!}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                            <div class="form-group">
                                                <label for="observations_not_pathological" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_not_pathological" rows="{!! !empty($Patient->get_history->observations_not_pathological) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}" name="observations_not_pathological" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_not_pathological : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end --}}

                                    {{-- Salud Mental --}}
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px"> @lang('messages.acordion.antecedentes_salud')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="row" id="div_mental_healths">
                                        <div style="display: flex">
                                            <span class="text-warning mt-2" id="ANP"
                                                style="font-size: 15px;margin-right: 10px;"></span>
                                        </div>
                                        @php
                                            $count_mental_healths = 0;
                                        @endphp
                                        @foreach ($mental_healths as $item)
                                            @php
                                                if ($validateHistory) {
                                                    $name = $item->name;
                                                    $value = $Patient->get_history->$name;
                                                    if ($value === '1') {
                                                        $count_mental_healths++;
                                                    }
                                                }
                                            @endphp
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="floating-label-group">
                                                    <div class="form-check" style="display: flex; ">
                                                        <div style="margin-right: 30px;">
                                                            <input onclick="handlerMentalHealths(event);"
                                                                class="form-check" name="{{ $item->name }}"
                                                                type="checkbox" id="{{ $item->name }}"
                                                                value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                        </div>
                                                        <div>
                                                            <label style="font-size: 14px;" class="form-check-label"
                                                                for="flexCheckDefault">
                                                                {{ $item->text }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="hidden" id="countMentalHealths"
                                                    name="countMentalHealths" class="form-control" readonly
                                                    value="{!! !empty($validateHistory) ? $count_mental_healths : '' !!}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                            <div class="form-group">
                                                <label for="observations_mental_healths" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_mental_healths" rows="{!! !empty($Patient->get_history->observations_mental_healths) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}" name="observations_mental_healths" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_mental_healths : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- end --}}

                                    {{-- inmunizaciones --}}
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px"> @lang('messages.acordion.inmunizaciones')</h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="row" id="div_inmunizations">
                                        <div style="display: flex">
                                            <span class="text-warning mt-2" id="ANP"
                                                style="font-size: 15px;margin-right: 10px;"></span>
                                        </div>
                                        @php
                                            $count_inmunizations = 0;
                                        @endphp
                                        @foreach ($inmunizations as $item)
                                            @php
                                                if ($validateHistory) {
                                                    $name = $item->name;
                                                    $value = $Patient->get_history->$name;
                                                    if ($value === '1') {
                                                        $count_inmunizations++;
                                                    }
                                                }
                                            @endphp
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="floating-label-group">
                                                    <div class="form-check" style="display: flex; ">
                                                        <div style="margin-right: 30px;">
                                                            <input onclick="handlerInmunizations(event);"
                                                                class="form-check" name="{{ $item->name }}"
                                                                type="checkbox" id="{{ $item->name }}"
                                                                value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                        </div>
                                                        <div>
                                                            <label style="font-size: 14px;" class="form-check-label"
                                                                for="flexCheckDefault">
                                                                {{ $item->text }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-2" id="IM_V_input" style="{!! !empty($validateHistory->IM_O) ? '' : 'display: none' !!}">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="IM_V_input" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.label.otros')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="IM_V_input" name="IM_V_input" type="text"
                                                        value="{!! !empty($validateHistory) ? $Patient->get_history->IM_V_input : '' !!}">
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                </div>
                                                <span id="IM_V_input" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <hr class="mt-3" style="margin-bottom: 0;">
                                        <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                            @lang('messages.form.IMC19_covid')</h6>
                                        <hr style="margin-bottom: 0;">
                                        <div class="row">
                                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-3">
                                                <div class="floating-label-group" style="margin-top: 30px;">
                                                    <div class="form-check" style="display: flex; ">
                                                        <div style="margin-right: 30px;">
                                                            <input class="form-check" name="IMC19_covid" type="checkbox"
                                                                id="IMC19_covid" value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                {{ $validateHistory ? ( $validateHistory->IMC19_covid === '1' ? 'checked' : '') : '' }}>
                                                        </div>
                                                        <div>
                                                            <label style="font-size: 14px;" class="form-check-label"
                                                                for="flexCheckDefault">
                                                                @lang('messages.form.IMC19_covid')
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="IMC19_dosis" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px"> @lang('messages.form.IMC19_dosis') </label>
                                                        <select name="IMC19_dosis" id="IMC19_dosis"
                                                            placeholder="Seleccione"class="form-control"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">@lang('messages.label.seleccione')</option>
                                                            <option value="1 Dosis">1 Dosis</option>
                                                            <option value="2 Dosis">2 Dosis</option>
                                                            <option value="3 Dosis">3 Dosis</option>
                                                            <option value="4 Dosis">4 Dosis</option>
                                                        </select>
                                                        <i class="bi bi-capsule st-icon"></i>

                                                        {{-- <input autocomplete="off"
                                                            class="form-control mask-only-text @error('IMC19_dosis') is-invalid @enderror"
                                                            id="IMC19_dosis" name="IMC19_dosis" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->IMC19_dosis : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="IMC19_fecha_ultima_dosis" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.IMC19_fecha_ultima_dosis')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control @error('IMC19_fecha_ultima_dosis') is-invalid @enderror"
                                                            id="IMC19_fecha_ultima_dosis" name="IMC19_fecha_ultima_dosis"
                                                            type="date" value="{!! !empty($validateHistory) ? $Patient->get_history->IMC19_fecha_ultima_dosis : '' !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="IMC19_marca" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px"> @lang('messages.form.IMC19_marca') </label>
                                                        <select name="IMC19_marca" id="IMC19_marca"
                                                            placeholder="@lang('messages.label.seleccione')" class="form-control"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">@lang('messages.label.seleccione')</option>
                                                            @foreach ($covid_vacunas as $item)
                                                                <option value={{ $item->description }}>{{ $item->description }} </option>
                                                            @endforeach
                                                        </select>


                                                        {{-- <input autocomplete="off"
                                                            class="form-control mask-only-text @error('IMC19_marca') is-invalid @enderror"
                                                            id="IMC19_marca" name="IMC19_marca" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->IMC19_marca : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="hidden" id="countInmunizations"
                                                    name="countInmunizations" class="form-control" readonly
                                                    value="{!! !empty($validateHistory) ? $count_inmunizations : '' !!}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                            <div class="form-group">
                                                <label for="observations_inmunization" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_inmunization" rows="{!! !empty($Patient->get_history->observations_inmunization) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}"
                                                    name="observations_inmunization" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_inmunization : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- end --}}

                                    {{-- Dispositivos medicos --}}
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px"> @lang('messages.acordion.dispositivos_medicos') </h6>
                                    <hr style="margin-bottom: 0;">
                                    <div class="row" id="div_medical_devices">
                                        <div style="display: flex">
                                            <span class="text-warning mt-2" id="ANP" style="font-size: 15px;margin-right: 10px;"></span>
                                        </div>
                                        @php
                                            $count_medical_devices = 0;
                                        @endphp
                                        @foreach ($medical_devices as $item)
                                            @php
                                                if ($validateHistory) {
                                                    $name = $item->name;
                                                    $value = $Patient->get_history->$name;
                                                    if ($value === '1') {
                                                        $count_medical_devices++;
                                                    }
                                                }
                                            @endphp
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="floating-label-group">
                                                    <div class="form-check" style="display: flex; ">
                                                        <div style="margin-right: 30px;">
                                                            <input onclick="handlerMedicalDevices(event);"
                                                                class="form-check" name="{{ $item->name }}"
                                                                type="checkbox" id="{{ $item->name }}"
                                                                value="{!! !empty($validateHistory) ? 1 : null !!}"
                                                                {{ $validateHistory ? ($value != null ? 'checked' : '') : '' }}>
                                                        </div>
                                                        <div>
                                                            <label style="font-size: 14px;" class="form-check-label"
                                                                for="flexCheckDefault">
                                                                {{ $item->description }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="input-group flex-nowrap">
                                                <input type="hidden" id="countmedical_devices"
                                                    name="countmedical_devices" class="form-control" readonly
                                                    value="{!! !empty($validateHistory) ? $count_medical_devices : '' !!}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                            <div class="form-group">
                                                <label for="observations_medical_devices" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_medical_devices" rows="{!! !empty($Patient->get_history->observations_medical_devices) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}" name="observations_medical_devices" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_medical_devices : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia ginecológica --}}
                @if ($Patient->genere == 'femenino')
                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingFive">
                                    <button class="accordion-button collapsed bg-5" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true"
                                        aria-controls="collapseFive"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-clipboard2-pulse"></i> @lang('messages.acordion.antecedentes_gine')
                                    </button>
                                </span>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <hr class="mt-3" style="margin-bottom: 0;">
                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                @lang('messages.subtitulos.ginecologicos')</h6>
                                            <hr style="margin-bottom: 0;">
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="GINE_menarquia" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.edad_mestruacion')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control  mask-only-number @error('GINE_menarquia') is-invalid @enderror"
                                                            id="GINE_menarquia" name="GINE_menarquia" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->GINE_menarquia : '' !!}">
                                                        <i class="bi bi-calendar-event st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="GINE_fecha_ultimo_pe" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.fecha_periodo')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control @error('GINE_fecha_ultimo_pe') is-invalid @enderror"
                                                            id="GINE_fecha_ultimo_pe" name="GINE_fecha_ultimo_pe"
                                                            type="date" value="{!! !empty($validateHistory) ? $Patient->get_history->GINE_fecha_ultimo_pe : '' !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="GINE_duracion" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.ciclo_menstrual')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('GINE_duracion') is-invalid @enderror"
                                                            id="GINE_duracion" name="GINE_duracion" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->GINE_duracion : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="GINE_infecciones" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.infecciones')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('GINE_infecciones') is-invalid @enderror"
                                                            id="GINE_infecciones" name="GINE_infecciones" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->GINE_infecciones : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="GINE_ex_gine_previos" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.exam_previos')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('GINE_ex_gine_previos') is-invalid @enderror"
                                                            id="GINE_ex_gine_previos" name="GINE_ex_gine_previos"
                                                            type="text" value="{!! !empty($validateHistory) ? $Patient->get_history->GINE_ex_gine_previos : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="GINE_metodo_anti" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.anticonceptivo')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('GINE_metodo_anti') is-invalid @enderror"
                                                            id="GINE_metodo_anti" name="GINE_metodo_anti" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->GINE_metodo_anti : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-3" style="margin-bottom: 0;">
                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                @lang('messages.subtitulos.obstetricos')</h6>
                                            <hr style="margin-bottom: 0;">
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="OBSTE_gravides" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_embarazos')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('OBSTE_gravides') is-invalid @enderror"
                                                            id="OBSTE_gravides" name="OBSTE_gravides" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->OBSTE_gravides : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="OBSTE_partos" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_partos')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('OBSTE_partos') is-invalid @enderror"
                                                            id="OBSTE_partos" name="OBSTE_partos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->OBSTE_partos : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="OBSTE_cesareas" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_cesareas')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('OBSTE_cesareas') is-invalid @enderror"
                                                            id="OBSTE_cesareas" name="OBSTE_cesareas" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->OBSTE_cesareas : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="OBSTE_abortos" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_abortos')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('OBSTE_abortos') is-invalid @enderror"
                                                            id="OBSTE_abortos" name="OBSTE_abortos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->OBSTE_abortos : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-3" style="margin-bottom: 0;">
                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                @lang('messages.subtitulos.menopausia')</h6>
                                            <hr style="margin-bottom: 0;">
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="MENOSPA_fecha_ini" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.MENOSPA_fecha_ini')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control @error('MENOSPA_fecha_ini') is-invalid @enderror"
                                                            id="MENOSPA_fecha_ini" name="MENOSPA_fecha_ini"
                                                            type="date" value="{!! !empty($validateHistory) ? $Patient->get_history->MENOSPA_fecha_ini : '' !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="MENOSPA_sintomas" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.MENOSPA_sintomas')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('MENOSPA_sintomas') is-invalid @enderror"
                                                            id="MENOSPA_sintomas" name="MENOSPA_sintomas" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->MENOSPA_sintomas : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="MENOSPA_tratamiento" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.MENOSPA_tratamiento')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('MENOSPA_tratamiento') is-invalid @enderror"
                                                            id="MENOSPA_tratamiento" name="MENOSPA_tratamiento"
                                                            type="text" value="{!! !empty($validateHistory) ? $Patient->get_history->MENOSPA_tratamiento : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-3" style="margin-bottom: 0;">
                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                @lang('messages.subtitulos.act_sexual')</h6>
                                            <hr style="margin-bottom: 0;">
                                            <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="ACTSEX_activo" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.ACTSEX_activo')
                                                        </label>
                                                        <select name="ACTSEX_activo" id="ACTSEX_activo"
                                                            placeholder="Seleccione"class="form-control"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">@lang('messages.label.seleccione')</option>
                                                            <option value="1">@lang('messages.label.activo')</option>
                                                            <option value="0">@lang('messages.label.inactivo')</option>
                                                        </select>
                                                        <i class="bi bi-file-medical st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="ACTSEX_enfermedades_ts" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.ACTSEX_enfermedades_ts')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('ACTSEX_enfermedades_ts') is-invalid @enderror"
                                                            id="ACTSEX_enfermedades_ts" name="ACTSEX_enfermedades_ts"
                                                            type="text" value="{!! !empty($validateHistory) ? $Patient->get_history->ACTSEX_enfermedades_ts : '' !!}">
                                                        <i class="bi bi-capsule st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                                <div class="form-group">
                                                    <label for="observations_ginecologica" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                    <textarea id="observations_ginecologica" rows="{!! !empty($Patient->get_history->observations_ginecologica) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}"
                                                        name="observations_ginecologica" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_ginecologica : '' !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- alergias --}}
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 ">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingSix">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-clipboard2-pulse"></i> @lang('messages.acordion.antecedentes_alerg')
                                </button>
                            </span>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row mt-2" style="align-items: flex-end;">
                                        <h6 class="collapseBtn" style="margin-bottom: 10px;">@lang('messages.label.añadir_alergia')</h6>
                                        <hr style="margin-bottom: 0">
                                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="tipo_alergia" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.tipo_alergia')
                                                    </label>
                                                    <select name="type_alergia" id="type_alergia"
                                                        placeholder="Seleccione"class="form-control"
                                                        class="form-control combo-textbox-input">
                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                        @foreach ($allergies as $item)
                                                        <option value={{ $item->description }}>{{ $item->description }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                    <span id="type_alergia_span " class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-7 col-xl-7 col-xxl-7 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="detalle_alergia" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.detalle')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="detalle_alergia" name="detalle_alergia" type="text"
                                                        value="">
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                </div>
                                                <span id="detalle_alergia_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-2 col-xl-2 col-xxl-2 mt-cr">
                                            <span type="" onclick="handlerAllergies(event)" class="btn btnSecond"
                                                id="btn">@lang('messages.botton.añadir_alergia')</span>
                                        </div>
                                        {{-- Tabla --}}
                                        <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5 table-responsive"
                                            style="margin-top: 20px; width: 100%;">
                                            <table class="table table-striped table-bordered" id="table-alergias">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-17" scope="col">@lang('messages.tabla.tipo_alergias')</th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.detalle')</th>
                                                        <th class="text-center w-5" scope="col" data-orderable="false">@lang('messages.tabla.eliminar')</th>
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
                                                                    <td class="text-center"> {{ $item['type_alergia'] }} </td>
                                                                    <td class="text-center"> {{ $item['detalle_alergia'] }} </td>
                                                                    <td class="text-center w-5"><span
                                                                            onclick="deleteAllergie({{ $key }})"><img
                                                                                width="30" height="auto"
                                                                                src="{{ asset('/img/icons/delete-icon.png') }}"
                                                                                alt="avatar"></span> </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </tbody>
                                            </table>
                                            <tfoot>
                                                <div class="row mt-2" style="display: none">
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

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1">
                                            <div class="form-group">
                                                <label for="observations_allergies" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_allergies" rows="{!! !empty($Patient->get_history->observations_allergies) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}"
                                                    name="observations_allergies" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_allergies : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia quirúrgica --}}
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingSeven">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-clipboard2-pulse"></i> @lang('messages.acordion.antecedentes_qx')
                                </button>
                            </span>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row mt-2" style="align-items: flex-end;">
                                        <h6 class="collapseBtn" style="margin-bottom: 10px;">@lang('messages.botton.añadir_cirugia')</h6>
                                        <hr style="margin-bottom: 0;">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="tipo_cirugia" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.tipo_cirugia')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="cirugia" name="cirugia" type="text" value="">
                                                    <i class="bi bi-file-earmark-medical st-icon"></i>
                                                </div>
                                                <span id="cirugia_span" class="text-danger"></span>
                                            </diV>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="datecirugia" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.fecha')
                                                    </label>
                                                    <input autocomplete="off" class="form-control" id="datecirugia"
                                                        name="datecirugia" type="text" value="">
                                                    {{-- <i class="bi bi-calendar2-week st-icon"></i> --}}
                                                </div>
                                                <span id="datecirugia_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-cr">
                                            <span type="" onclick="handlerSurgical(event)" class="btn btnSecond"
                                                id="btn">
                                                @lang('messages.botton.añadir_cirugia')
                                            </span>
                                        </div>
                                        {{-- tabla --}}
                                        <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5 table-responsive"
                                            style="margin-top: 20px; width: 100%;">
                                            <table class="table table-striped table-bordered" id="table-cirugia">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.cirugia')</th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha')
                                                        </th>
                                                        <th class="text-center w-5" scope="col"
                                                            data-orderable="false">@lang('messages.tabla.eliminar')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($validateHistory)
                                                        @if ($validateHistory->history_surgical != 'null')
                                                            @php

                                                                $history_surgical = json_decode($validateHistory->history_surgical, true);
                                                                if($history_surgical == null)
                                                                {
                                                                    $history_surgical = [];
                                                                }

                                                            @endphp
                                                            @foreach ($history_surgical as $key => $item)
                                                                <tr id="{{ $key }}">
                                                                    <td class="text-center">{{ $item['cirugia'] }} </td>
                                                                    <td class="text-center"> {{ $item['datecirugia'] }}
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            onclick="deleteSurgical({{ $key }})"><img
                                                                                width="30" height="auto"
                                                                                src="{{ asset('/img/icons/delete-icon.png') }}"
                                                                                alt="avatar"></span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </tbody>
                                            </table>
                                            <tfoot>
                                                <div class="row mt-2" style="display: none">
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                        <div class="input-group flex-nowrap">
                                                            <span class="input-group-text">Total cirugía
                                                            </span>
                                                            <input type="text" id="countSurgical" name="countSurgical"
                                                                class="form-control" readonly
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
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                            <div class="form-group">
                                                <label for="observations_quirurgicas" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                                <textarea id="observations_quirurgicas" rows="{!! !empty($Patient->get_history->observations_quirurgicas) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}"
                                                    name="observations_quirurgicas" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_quirurgicas : '' !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Medicacion --}}
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingEight">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-capsule"></i> @lang('messages.acordion.medicamentos')
                                </button>
                            </span>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div id="form-medication" class="row mt-2"
                                        style="align-items: flex-end; display: none">
                                        <h6 class="collapseBtn" style="margin-bottom: 10px">@lang('messages.label.añadir_medicamentos')</h6>
                                        <hr style="margin-bottom: 0;">
                                        {{-- medicamento --}}
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="medicine_span" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.medicamento')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="medicine" name="medicine" type="text" value="">
                                                    <i class="bi bi-capsule st-icon"></i>
                                                </div>
                                                <span id="medicine_span" class="text-danger"></span>
                                            </diV>
                                        </div>
                                        {{-- dosis --}}
                                        <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="dosis" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.dosis')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="dose" name="dose" type="text" value="">
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                </div>
                                                <span id="dose_span" class="text-danger"></span>
                                            </diV>
                                        </div>
                                        {{-- frecuencia --}}
                                        <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="frequency" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.frecuencia')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="frequency" name="frequency" type="text" value="">
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                </div>
                                                <span id="frequency_span" class="text-danger"></span>
                                            </diV>
                                        </div>
                                        {{-- patologia --}}
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="patologi_span" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.patologia')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="patologi" name="patologi" type="text" value="">
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                </div>
                                                <span id="patologi_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                        {{-- via administracion --}}
                                        <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="viaAdmin" class="form-label" style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.via')</label>
                                                    <select name="viaAdmin" id="viaAdmin" placeholder="@lang('messages.label.seleccione')" class="form-control" class="form-control combo-textbox-input">
                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                        @foreach ($medicines_vias as $item)
                                                            <option value={{ $item->description }}>{{ $item->description }} </option>
                                                        @endforeach
                                                    </select>
                                                    <i class="bi bi-capsule st-icon"></i>
                                                </div>
                                                <span id="viaAdmin_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                        {{-- Duracion --}}
                                        <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="treatmentDuration" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.duracion')
                                                    </label>
                                                    <select name="treatmentDuration" id="treatmentDuration"
                                                        placeholder="Seleccione"class="form-control"
                                                        class="form-control combo-textbox-input">
                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                        <option value="@lang('messages.select.1_dia')">@lang('messages.select.1_dia')</option>
                                                        <option value="@lang('messages.select.2_dia')">@lang('messages.select.2_dia')</option>
                                                        <option value="@lang('messages.select.3_dia')">@lang('messages.select.3_dia')</option>
                                                        <option value="@lang('messages.select.4_dia')">@lang('messages.select.4_dia')</option>
                                                        <option value="@lang('messages.select.5_dia')">@lang('messages.select.5_dia')</option>
                                                        <option value="@lang('messages.select.6_dia')">@lang('messages.select.6_dia')</option>
                                                        <option value="@lang('messages.select.1_semana')">@lang('messages.select.1_semana')</option>
                                                        <option value="@lang('messages.select.2_semana')">@lang('messages.select.2_semana')</option>
                                                        <option value="@lang('messages.select.3_semana')">@lang('messages.select.3_semana')</option>
                                                        <option value="@lang('messages.select.4_semana')">@lang('messages.select.4_semana')</option>
                                                        <option value="@lang('messages.select.2_mes')">@lang('messages.select.2_mes')</option>
                                                        <option value="@lang('messages.select.3_mes')">@lang('messages.select.3_mes')</option>
                                                        <option value="@lang('messages.select.1_anio')">@lang('messages.select.1_anio')</option>
                                                        <option value="@lang('messages.select.permanentes')">@lang('messages.select.permanentes')</option>

                                                    </select>
                                                    <i class="bi bi-calendar-range st-icon"></i>
                                                    <span id="treatmentDuration_span" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- efectos secundarios --}}
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="side_effects" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.efectos_secundarios')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="side_effects" name="side_effects" type="text" value="">
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                </div>
                                                <span id="side_effects_span" class="text-danger"></span>
                                            </diV>
                                        </div>
                                        {{-- efectividad --}}
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="effectiveness" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.efectividad')
                                                    </label>
                                                    <select name="effectiveness" id="effectiveness"
                                                        placeholder="Seleccione"class="form-control"
                                                        class="form-control combo-textbox-input">
                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                        <option value="baja">@lang('messages.select.baja')</option>
                                                        <option value="media">@lang('messages.select.media')</option>
                                                        <option value="alta">@lang('messages.select.alta')</option>

                                                    </select>
                                                    <i class="bi bi-calendar-range st-icon"></i>
                                                    <span id="effectiveness" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                            <span type="" onclick="addMedacition(event)" class="btn btnSave"
                                                id="btn">@lang('messages.botton.guardar_medicamentos')</span>
                                        </div>
                                    </div>
                                    {{-- tabla --}}
                                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                        <span type="" onclick="addForm(event)" class="btn btnSecond"
                                            id="btn">@lang('messages.botton.añadir_medicamentos')</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                            style="margin-top: 20px; width: 100%;">
                                            <table class="table table-striped table-bordered" id="table-medicamento">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.medicamento')</th>
                                                        <th class="text-center" data-orderable="false" scope="col"> @lang('messages.tabla.dosis')</th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.patologia')</th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.frecuencia')</th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.efectividad')</th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.duracion')</th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.via')</th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.efect_secund')</th>
                                                        <th class="text-center w-5" data-orderable="false" scope="col">@lang('messages.tabla.eliminar')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($validateHistory)
                                                        @if ($validateHistory->medications_supplements != 'null')
                                                            @php
                                                                $medications_supplements = json_decode($validateHistory->medications_supplements, true);
                                                                if($medications_supplements == null)
                                                                {
                                                                    $medications_supplements = [];
                                                                }
                                                                // dd($medications_supplements);
                                                            @endphp
                                                            @foreach ($medications_supplements as $key => $item)
                                                                <tr id="{{ $key }}">
                                                                    <td class="text-center text-capitalize">
                                                                        {{ $item['medicine'] }}</td>
                                                                    <td class="text-center"> {{ $item['dose'] }} </td>
                                                                    <td class="text-center"> {{ $item['patologi'] }} </td>
                                                                    <td class="text-center"> {{ $item['frequency'] }} </td>
                                                                    <td class="text-center"> {{ $item['effectiveness'] }} </td>
                                                                    <td class="text-center">
                                                                        {{ $item['treatmentDuration'] }}</td>
                                                                    <td class="text-center"> {{ $item['viaAdmin'] }}</td>
                                                                    <td class="text-center"> {{ $item['side_effects'] }}</td>
                                                                    <td class="text-center"><span
                                                                            onclick="deleteMedication({{ $key }})"><img
                                                                                width="30" height="auto"
                                                                                src="{{ asset('/img/icons/delete-icon.png') }}"
                                                                                alt="avatar"></span> </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </tbody>
                                            </table>
                                            <tfoot>
                                                <div class="row mt-2" style="display: none">
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                        <div class="input-group flex-nowrap">
                                                            <span class="input-group-text">Total de medicamentos
                                                            </span>
                                                            <input type="text" id="countMedicationAdd"
                                                                name="countMedicationAdd" class="form-control" readonly
                                                                value="{!! !empty($validateHistory)
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

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                        <div class="form-group">
                                            <label for="observations_medication" class="form-label"
                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                            <textarea id="observations_medication" rows="{!! !empty($Patient->get_history->observations_medication) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}"
                                                name="observations_medication" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_medication : '' !!}</textarea>
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
                    <div class="row justify-content-md-center mt-2">
                        <div id="spinner" style="display: none">
                            <x-load-spinner show="true" />
                        </div>
                    </div>
                    <div class="row mt-2 justify-content-md-end">
                        <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd" id="send"
                            style="display: flex; justify-content: flex-end;">
                            <input class="btn btnSave" value="@lang('messages.botton.guardar')" type="submit" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- </div> --}}
@endsection
