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
                // errorPlacement: function(error, element) {
                //     $("#collapseTwo").collapse('show');
                //     return false;
                // }
            });


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
                }else{
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
            autoTextarea('observations_ginecologica');
            autoTextarea('observations_allergies');
            autoTextarea('observations_quirurgicas');
            autoTextarea('observations_medication');
        })

        const handlerBackFamiliy = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "no_aplica") {

                    $('#checkbok-input input[type="checkbox"]').prop('checked', false);

                    $('#checkbok-input input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countBackFamily = 0;

                } else {

                    $('#no_aplica').prop('checked', false);

                    $('#no_aplica').val(null);

                    $(`#${e.target.id}`).val(1);

                    $(`#${e.target.id}`).prop('checked', true);

                    countBackFamily = countBackFamily + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countBackFamily = (countBackFamily==0)? '' : countBackFamily - 1;

            }

            $('#countBackFamily').val(countBackFamily);

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
                            url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
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

        const handlerDiagnosis = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "no_aplic_pathology") {

                    $('#checkbok-input-diagnosis input[type="checkbox"]').prop('checked', false);

                    $('#checkbok-input-diagnosis input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countDiagnosis = 0;

                } else {

                    $('#no_aplic_pathology').prop('checked', false);

                    $('#no_aplic_pathology').val(null);


                    $(`#${e.target.id}`).val(1);

                    countDiagnosis = countDiagnosis + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countDiagnosis = (countDiagnosis==0)? '' : countDiagnosis - 1;
            }

            $('#countDiagnosis').val(countDiagnosis);

        }

        const handlerNotPathologica = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                //cambiar atributo input checkbook cunaod niega
                if (e.target.id == "no_aplica_no_pathology") {

                    $('#div_no_aplica_no_pathology input[type="checkbox"]').prop('checked', false);

                    $('#div_no_aplica_no_pathology input[type="checkbox"]').val(null);

                    $(`#${e.target.id}`).prop('checked', true);

                    $(`#${e.target.id}`).val(1);

                    countNotPathological = 0;

                } else {

                    $('#no_aplica_no_pathology').prop('checked', false);

                    $('#no_aplica_no_pathology').val(null);


                    $(`#${e.target.id}`).val(1);

                    countNotPathological = countNotPathological + 1;
                }

            } else {

                $(`#${e.target.id}`).val(null);

                countNotPathological = (countNotPathological==0)? '' : countNotPathological - 1;
            }

            $('#countNotPathological').val(countNotPathological);

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
                    btn: btn,
                    id: countMedicationAdd
                });

                new DataTable(
                    '#table-medicamento', {
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
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
                            // {
                            //     data: 'viaAdmin',
                            //     title: 'Via de administración',
                            //     className: "text-center td-pad",
                            // },
                            {
                                data: 'treatmentDuration',
                                title: '@lang('messages.tabla.duracion')',
                                className: "text-center td-pad",
                            },
                            // {
                            //     data: 'dateIniTreatment',
                            //     title: 'Fecha inicio',
                            //     className: "text-center td-pad w-10",
                            // },
                            // {
                            //     data: 'dateEndTreatment',
                            //     title: 'Fecha fin',
                            //     className: "text-center td-pad w-10",
                            // },
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
                $('#form-medication').hide();
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
                            url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
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
                                    <i class="bi bi-clipboard2-pulse"></i> @lang('messages.acordion.antecedentes_per')
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">

                                    {{-- antecedentes personales --}}

                                    <div class="row" id="checkbok-input">
                                        <div style="display: flex">
                                            <span class="text-warning mt-2" id='APF'
                                                style="font-size: 15px;margin-right: 10px;"></span>
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
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                        @lang('messages.acordion.antecedentes_per_pa')</h6>
                                    <hr style="margin-bottom: 0;">
                                    {{-- Antecedentes Personales Patológicos --}}

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
                                    <hr style="margin-bottom: 0;">
                                    <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px"> @lang('messages.acordion.antecedentes_per_no_pa')</h6>
                                    <hr style="margin-bottom: 0;">
                                    {{-- Antecedentes Personales No Patológicos --}}

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
                                            {{-- <a>{{$Patient->get_history->observations_not_pathological}}</a> --}}
                                        </div>
                                    </div>
                                    {{-- end --}}

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
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="edad_primera_menstruation" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.edad_mestruacion')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control  mask-only-number @error('edad_primera_menstruation') is-invalid @enderror"
                                                            id="edad_primera_menstruation"
                                                            name="edad_primera_menstruation" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->edad_primera_menstruation : '' !!}">
                                                        <i class="bi bi-calendar-event st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="fecha_ultima_regla" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.fecha_periodo')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control datePickert @error('fecha_ultima_regla') is-invalid @enderror"
                                                            id="fecha_ultima_regla" name="fecha_ultima_regla"
                                                            type="text" readonly value="{!! !empty($validateHistory) ? $Patient->get_history->fecha_ultima_regla : '' !!}">
                                                        <i class="bi bi-calendar2-week st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="numero_embarazos" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_embarazos')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('numero_embarazos') is-invalid @enderror"
                                                            id="numero_embarazos" name="numero_embarazos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->numero_embarazos : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="numero_partos" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_partos')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('numero_partos') is-invalid @enderror"
                                                            id="numero_partos" name="numero_partos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->numero_partos : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="cesareas" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_cesareas')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('cesareas') is-invalid @enderror"
                                                            id="cesareas" name="cesareas" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->cesareas : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="numero_abortos" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.nro_abortos')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-number @error('numero_abortos') is-invalid @enderror"
                                                            id="numero_abortos" name="numero_abortos" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->numero_abortos : '' !!}">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="pregunta" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                            @lang('messages.form.anticonceptivo')
                                                        </label>
                                                        <input autocomplete="off"
                                                            class="form-control mask-only-text @error('pregunta') is-invalid @enderror"
                                                            id="pregunta" name="pregunta" type="text"
                                                            value="{!! !empty($validateHistory) ? $Patient->get_history->pregunta : '' !!}">
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
                                                        <option value="@lang('messages.select.Medicinas')">@lang('messages.select.Medicinas')</option>
                                                        <option value="@lang('messages.select.Alimentos')">@lang('messages.select.Alimentos')</option>
                                                        <option value="@lang('messages.select.Latex')">@lang('messages.select.Latex')</option>
                                                        <option value="@lang('messages.select.Otros')">@lang('messages.select.Otros')</option>
                                                    </select>
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                    <span id="type_alergia_span " class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3 mt-2">
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
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-cr">
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
                                                    <input autocomplete="off" class="form-control datePickert"
                                                        id="datecirugia" readonly name="datecirugia" type="text"
                                                        value="">
                                                    <i class="bi bi-calendar2-week st-icon"></i>
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
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha') </th>
                                                        <th class="text-center w-5" scope="col" data-orderable="false">@lang('messages.tabla.eliminar')</th>
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
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
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
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="viaAdmin_span" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                        @lang('messages.form.via_administracion')
                                                    </label>
                                                    <input autocomplete="off" class="form-control mask-only-text"
                                                        id="viaAdmin" name="viaAdmin" type="text" value="">
                                                    <i class="bi bi-file-medical st-icon"></i>
                                                </div>
                                                <span id="viaAdmin_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 mt-2">
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
                                                        <option value="@lang('messages.select.7_dia')">@lang('messages.select.7_dia')</option>
                                                        <option value="@lang('messages.select.1_semana')">@lang('messages.select.1_semana')</option>
                                                        <option value="@lang('messages.select.2_semana')">@lang('messages.select.2_semana')</option>
                                                        <option value="@lang('messages.select.3_semana')">@lang('messages.select.3_semana')</option>
                                                        <option value="@lang('messages.select.4_semana')">@lang('messages.select.4_semana')</option>
                                                        <option value="@lang('messages.select.1_mes')">@lang('messages.select.1_mes')</option>
                                                        <option value="@lang('messages.select.2_mes')">@lang('messages.select.2_mes')</option>
                                                        <option value="@lang('messages.select.3_mes')">@lang('messages.select.3_mes')</option>
                                                        <option value="@lang('messages.select.1_anio')">@lang('messages.select.1_anio')</option>

                                                    </select>
                                                    <i class="bi bi-calendar-range st-icon"></i>
                                                    <span id="treatmentDuration_span" class="text-danger"></span>
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
                                                        {{-- <th class="text-center" scope="col">@lang('messages.tabla.via_administracion')</th> --}}
                                                        <th class="text-center" scope="col">@lang('messages.tabla.duracion')</th>
                                                        {{-- <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_ini')</th> --}}
                                                        {{-- <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_fin')</th> --}}
                                                        <th class="text-center w-5" data-orderable="false" scope="col">@lang('messages.tabla.eliminar')</th>
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
                                                                    <td class="text-center text-capitalize">
                                                                        {{ $item['medicine'] }}</td>
                                                                    <td class="text-center"> {{ $item['dose'] }} </td>
                                                                    <td class="text-center"> {{ $item['patologi'] }} </td>
                                                                    {{-- <td class="text-center"> {{ $item['viaAdmin'] }} </td> --}}
                                                                    <td class="text-center"> {{ $item['treatmentDuration'] }}</td>
                                                                    {{-- <td class="text-center"> {{ $item['dateIniTreatment'] }}</td> --}}
                                                                    {{-- <td class="text-center"> {{ $item['dateEndTreatment'] }}</td> --}}
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
                                            <label for="observations_medication" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
                                            <textarea id="observations_medication" rows="{!! !empty($Patient->get_history->observations_medication) ? '8' : '1' !!}" style="{!! !empty($validateHistory) ? 'height: auto' : '' !!}" name="observations_medication" class="form-control">{!! !empty($validateHistory) ? $Patient->get_history->observations_medication : '' !!}</textarea>
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
