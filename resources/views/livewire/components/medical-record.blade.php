<!DOCTYPE html>

@extends('layouts.app-auth')
@section('title', 'Detalle Médico')

<style>
    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
    }

    .modal.show .modal-dialog .InformeMedicomodal {
        width: 100% !important;
    }

    ul {
        list-style-type: none;
    }

    pre {
        white-space: pre-wrap;
        white-space: -moz-pre-wrap;
        white-space: -pre-wrap;
        white-space: -o-pre-wrap;
        word-wrap: break-word;
        text-align: justify;
    }

    .div-ia {
        padding: 3%;
    }

    .p-ia {
        text-align: justify !important;
    }

    .check-cm {
        padding: 1px 10px !important;
        border-radius: 20px !important;
        font-size: 11px !important;
    }

    .btn-outline-other {
        --bs-btn-color: #d19e5b !important;
        --bs-btn-border-color: #d19e5b !important;
        --bs-btn-hover-bg: #d19e5b !important;
        --bs-btn-hover-border-color: #d19e5b !important;
        --bs-btn-active-bg: #d19e5b !important;
        --bs-btn-active-border-color: #d19e5b !important;
        --bs-btn-disabled-color: #d19e5b !important;
        --bs-btn-disabled-border-color: #d19e5b !important;
        --bs-btn-active-color: #fff !important;
    }

    .btn-outline-primary {
        --bs-btn-color: #02bdbb !important;
        --bs-btn-border-color: #02bdbb !important;
        --bs-btn-hover-bg: #02bdbb !important;
        --bs-btn-hover-border-color: #02bdbb !important;
        --bs-btn-active-bg: #02bdbb !important;
        --bs-btn-active-border-color: #02bdbb !important;
        --bs-btn-disabled-color: #02bdbb !important;
        --bs-btn-disabled-border-color: #02bdbb !important;
    }

    .btn-outline-success:checked+.btn,
    :not(.btn-outline-success)+.btn:active,
    .btn:first-child:active,
    .btn.active,
    .btn.show {
        color: var(--bs-btn-active-color);
        background-color: #45959400;
        border-color: #45959400;
    }

    .btn-outline-success {
        --bs-btn-color: #4eb6b4 !important;
        --bs-btn-border-color: #4eb6b4 !important;
        --bs-btn-hover-bg: #4eb6b4 !important;
        --bs-btn-hover-border-color: #4eb6b4 !important;
        --bs-btn-active-bg: #4eb6b4 !important;
        --bs-btn-active-border-color: #4eb6b4 !important;
        --bs-btn-disabled-color: #4eb6b4 !important;
        --bs-btn-disabled-border-color: #4eb6b4 !important;
    }

    .img-medical {
        border-radius: 20px;
        border: 3px solid #47525e;
        object-fit: cover;
    }

    .img-medical-modal {
        border-radius: 50%;
        border: 3px solid #47525e;
        object-fit: cover;
    }

    .btn-idanger {
        cursor: pointer;
        display: inline-block;
        text-align: center;
        white-space: nowrap;
        background: #ff7b0d;
        color: #fff;
        font-size: 22px;
        font-weight: 400;
        letter-spacing: -.01em;
        padding: 5px;
        margin-right: 9px;
    }

    .btn-idanger:hover,
    .btnSecond:active {
        background: #ff7b0d;
        color: #fff;
    }

    .card-study::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }

    .card-study::-webkit-scrollbar-thumb:active {
        background-color: #999999;
    }

    .card-study::-webkit-scrollbar-thumb:hover {
        background: #b3b3b3;
        box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
    }

    /* Estilos track de scroll */
    .card-study::-webkit-scrollbar-track {
        background: #e1e1e1;
        border-radius: 4px;
    }

    .card-study::-webkit-scrollbar-track:hover,
    .card-study::-webkit-scrollbar-track:active {
        background: #d4d4d4;
    }

    .data-medical {
        font-size: 13px;
    }

    .pr-5 {
        padding: 0 5px 0 0;
    }

    .pl-5 {
        padding: 0 0 0 5px;
    }

    .w-4 {
        width: 4% !important;
    }

    .w-7 {
        width: 7% !important;
    }

    .w-8 {
        width: 8% !important;
    }

    .w-35 {
        width: 35% !important;
    }

    .w-20 {
        width: 20% !important;
    }

    .w-45 {
        width: 45% !important;
    }

    .w-55 {
        width: 55% !important;
    }

    .symptoms_style {
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }

    .symptoms_mt-0 {
        margin-top: 0 !important;
    }

    .shadow-div {
        position: fixed;
        width: 100%;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: #000000a8;
        z-index: 9999;
        max-width: 100%;

    }

    /* .section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("../img/fondo.jpg");
        }    */

    .s-IA {
        width: 12% !important;
    }

    body {
        padding-right: 0px !important;
    }



    @media only screen and (max-width: 768px) {
        .s-IA {
            width: 50% !important;
        }
    }

    @media only screen and (max-width: 390px) {
        .data-medical {
            width: 185px !important;
            font-size: 13px;
        }

        .mb-style {
            flex-direction: column;
        }

        .m-mb {
            padding: 0 !important;
        }

        .pr-5 {
            padding: 0 0 5px !important;
        }

        .pl-5 {
            padding: 0 0 0 5px;
        }

        .btn-mb {
            padding-left: 30px;
            align-content: flex-end;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .IM-mb {
            margin-left: 0;
            margin-top: 7px;
        }

        .LF-mb {
            margin-top: 7px;
        }
    }

    @media (min-width: 391px) and (max-width: 576px) {
        .data-medical {
            width: 222px !important;
            font-size: 13px;
        }

        .mb-style {
            flex-direction: column;
        }

        .m-mb {
            padding: 0px 0px 9px !important;
        }

        .pr-5 {
            padding: 0 0 5 !important;
        }

        .pl-5 {
            padding: 5px 0 0;
        }

        .list-mb {
            max-height: 50px;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .mb-style {
            flex-direction: column;
        }

        .pr-5 {
            padding: 0 0 5 !important;
        }

        .pl-5 {
            padding: 5px 0 0;
        }

        .list-mb {
            max-height: 50px;
        }
    }

    @media (min-width: 769px) and (max-width: 992px) {
        .mb-style {
            flex-direction: column;
        }

        .pr-5 {
            padding: 0 0 5 !important;
        }

        .pl-5 {
            padding: 5px 0 0;
        }
    }

    textarea {
        padding-top: 10px;
        padding-bottom: 10px;
        width: 100%;
        display: block;
        height: 36px;
    }

    .pre-textarea {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        background-color: #f1f1f1;
        padding: 10px;
    }

    .dataTables_wrapper .dataTables_info {
        display: none;
    }

    .dataTables_wrapper .dataTables_paginate {
        display: none;
    }

    .table-info-allergies .dataTables_empty {
        display: none;
    }

    .table-info-medicines .dataTables_empty {
        display: none;
    }

    .table-info-cirugias .dataTables_empty {
        display: none;
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
    let valExams = '';
    let valStudy = '';
    let id = @json($id);
    let patient = @json($Patient);
    let symptoms = @json($symptoms);
    let study = @json($study);
    let exam = @json($exam);
    let exams_array = [];
    let symptom_array = [];
    let studies_array = [];
    let medications_supplements = [];
    let countMedicationAdd = 0;
    let exam_filter = [];
    let symptom_filter = [];
    let study_filter = [];
    let valSymptoms = '';
    let valExamenes = '';
    let valStudios = '';
    let find = {};
    let response_data = '';
    let user = @json(Auth::user());
    let doctor_centers = @json($doctor_centers);
    let validate_histroy = @json($validate_histroy);
    let countVitalSigns = 0;
    let family_back = @json($family_back);
    let pathology_back = @json($pathology_back);
    let non_pathology_back = @json($non_pathology_back);
    let mental_healths = @json($mental_healths);
    let inmunizations = @json($inmunizations);
    let medical_devices = @json($medical_devices);

    let prueba = [];

    $(document).ready(() => {
        $("#diagnosis-text").hide();
        // $("#background-text").hide();
        $("#razon-text").hide();
        $("#sintomas-text").hide();
        $("#exman-text").hide();
        $("#studies-text").hide();


        let url = "{{ route('search-detaly-patient', ':id') }}";

        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                patient_history(response);
            }
        });

        tinymce.init({
            selector: '#TextInforme',
            skin: false,
            content_css: false,
            valid_elements: "p,a[href|target=_blank],div[style]",
            height: 500,
            menubar: false,
            toolbar: 'undo redo | formatselect'
        });

        switch_type_plane(user);

        handlerUl(symptoms, 'symptoms', 'btn btn-outline-other check-cm', 12);

        handlerUl(exam, 'exam', 'btn btn-outline-primary check-cm', 5);

        handlerUl(study, 'studie', 'btn btn-outline-success check-cm', 4);



        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        tooltipTriggerList.forEach(element => {
            new bootstrap.Tooltip(element)
        });

        document.querySelectorAll('[data-bs-toggle="popover"]')
            .forEach(popover => {
                new bootstrap.Popover(popover)
            })

        $('#not-exam').hide();
        $('#not-studie').hide();
        if (user.type_plane !== '7' && doctor_centers.length === 0  && user.role == 'medico') {
            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.asociar_centro')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {
                window.location.href = "{{ route('Profile') }}";
            });
        } else if (validate_histroy === null) {
            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.crear_historia')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {
                let url = "{{ route('ClinicalHistoryDetail', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
            });
        }

        if (user.role == 'secretary' && user.center_id == null ) {
                    Swal.fire({
                        icon: 'warning',
                        title: '@lang('messages.alert.asociar_centro')',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: '@lang('messages.botton.aceptar')'
                    }).then((result) => {
                    window.location.href = "{{ route('profile-user-secretary') }}";
                });
            }

        $('#form-consulta').validate({
            ignore: [],
            rules: {
                razon: {
                    required: true,
                },
                diagnosis: {
                    required: true,
                },
                treatment: {
                    required: true,
                },
                center_id: {
                    required: true,
                },
            },
            messages: {
                razon: {
                    required: "@lang('messages.alert.razon_obligatorio')",
                },
                diagnosis: {
                    required: "@lang('messages.alert.diagnostico_obligatorio')",
                },
                treatment: {
                    required: "@lang('messages.alert.tratamiento_obligatorio')",
                },
                center_id: {
                    required: "@lang('messages.alert.centro_obligatorio')",
                },
            }
        });
        $.validator.addMethod("onlyText", function(value, element) {
            let pattern = /^[a-zA-ZñÑáéíóúü0-9\s]+$/g;
            return pattern.test(value);
        }, "@lang('messages.alert.no_caracteres')");
        $.validator.addMethod("validateSintoma", function(value, element) {

            if (symptom_array.length == 0 && value == "") {

                return false;

            } else {

                return true;
            }

        }, "@lang('messages.alert.seleccionar_sintoma')");

        //envio del formulario informe
        $('#form-informe-medico').validate({
            ignore: [],
            rules: {
                TextInforme: {
                    required: true,
                },
                center_id: {
                    required: true,
                },
            },
            messages: {
                TextInforme: {
                    required: "@lang('messages.alert.informe_vacio')",
                },
                center_id: {
                    required: "@lang('messages.alert.centro_obligatorio')",
                }
            }
        });

        $("#form-informe-medico").submit(function(event) {
            event.preventDefault();
            $("#form-informe-medico").validate();
            if ($("#form-informe-medico").valid()) {
                $('#spinner3').show();
                //preparar la data para el envio
                let data = $('#form-informe-medico').serialize();

                ////end
                $.ajax({
                    url: '{{ route('create-informe-medico') }}',
                    type: 'POST',
                    dataType: "json",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#spinner3').hide();
                        Swal.fire({
                            icon: 'success',
                            title: '@lang('messages.alert.operacion_exitosa')',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {
                            $("#form-informe-medico").trigger("reset");
                            $('#modalInformeMedico').modal('toggle');
                            setDatatable(response);
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
        // end

        //envio del formulario
        $("#form-consulta").submit(function(event) {
            event.preventDefault();
            $("#form-consulta").validate();
            if ($("#form-consulta").valid()) {
                $('#send').hide();
                $('#spinner').show();

                //preparar la data para el envio
                let formData = $('#form-consulta').serializeArray();
                let data = {};
                formData.map((item) => data[item.name] = item.value);
                data["exams_array"] = JSON.stringify(exams_array);
                data["symptom_array"] = JSON.stringify(symptom_array);
                data["studies_array"] = JSON.stringify(studies_array);


                data["medications_supplements"] = JSON.stringify(medications_supplements);

                ////end
                $.ajax({
                    url: '{{ route('MedicalRecordCreate') }}',
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
                        $("#form-consulta").trigger("reset");
                        $('#table-medicamento > tbody').empty();
                        Swal.fire({
                            icon: 'success',
                            title: '@lang('messages.alert.consulta_registrada')',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {
                            let url =
                                "{{ route('MedicalRecord', ':id') }}";
                            url = url.replace(':id', id);
                            window.location.href = url;
                        });
                    },
                    error: function(error) {
                        $('#send').show();
                        $('#spinner').hide();
                        console.log(error);

                    }
                });
            }
        });

        ///formularios del examne fisico
        $('#form-examen-fisico').validate({
            ignore: [],
            rules: {
                weight: {
                    required: true,
                },
                height: {
                    required: true,
                },
                strain: {
                    required: true,
                },
                strain_two: {
                    required: true,
                },
                temperature: {
                    required: true,
                },
                breaths: {
                    required: true,
                },
                pulse: {
                    required: true,
                },
                saturation: {
                    required: true,
                },
                condition: {
                    required: true,
                },
                observations: {
                    required: true,
                },
                center_id: {
                    required: true,
                }
            },
            messages: {
                center_id: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                weight: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                height: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                strain: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                strain_two: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                temperature: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                breaths: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                pulse: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                saturation: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                condition: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                },
                observations: {
                    required: "@lang('messages.alert.campo_obligatorio')",
                }
            }
        });

        $("#form-examen-fisico").submit(function(event) {
            event.preventDefault();
            $("#form-examen-fisico").validate();

            if ($("#form-examen-fisico").valid()) {
                $('#send').hide();
                $('#spinner4').show();

                //preparar la data para el envio
                let formData = $('#form-examen-fisico').serialize();

                ////end
                $.ajax({
                    url: '{{ route('create-examen-fisico') }}',
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#send').show();
                        $('#spinner4').hide();
                        $("#form-examen-fisico").trigger("reset");;
                        Swal.fire({
                            icon: 'success',
                            title: '@lang('messages.alert.operacion_exitosa')',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {
                            setDatatableExamenFisico(response);

                        });
                    },
                    error: function(error) {
                        $('#send').show();
                        $('#spinner4').hide();
                        console.log(error);

                    }
                });
            }
        });
        /////

        const autoTextarea = (id) => {
            document.getElementById(id).addEventListener('keyup', function() {
                this.style.overflow = 'hidden';
                this.style.height = 0;
                this.style.height = this.scrollHeight + 'px';
            }, false);
        }

        // autoTextarea('background');
        autoTextarea('sintomas');
        autoTextarea('razon');
        autoTextarea('diagnosis');
        autoTextarea('text_area_exman');
        autoTextarea('text_area_studies');
        autoTextarea('observations');

    });


    const patient_history = (response) => {

        if (patient.get_history != null) {

                // Antecedentes Personales y Familiares
            family_back.map((value, keyy) => {
                for (const [key, val] of Object
                    .entries(
                        patient.get_history
                    )) {

                    if (key == value.name) {

                        if (val != null) {
                            $('.family_back')
                                .append(
                                    `<small>${value.name === 'FB_C' ? '<strong> ✔ </strong>'+value.text+ ' ( ' +patient.get_history.FB_C_input+ ' )' : '<strong> ✔ </strong>'+value.text}.</small>`

                                );
                        }
                    };
                }
            });
            if (patient.get_history.observations_back_family) {
                $('.ob_family_back').append(
                    `<div class="d-flex w-100 justify-content-between">
                        <span class="text-justify mt-3">
                            <h6 class="mb-0 text-capitalize">
                                @lang('messages.label.observaciones'):
                            </h6>
                            <small>${patient.get_history.observations_back_family}</small>
                        </span>
                    </div>`
                );
            }
            // end

            // Antecedentes personales patológicos

            pathology_back.map((value, keyy) => {
                for (const [key, val] of Object
                    .entries(
                        patient.get_history
                    )) {

                    if (key == value.name) {
                        if (val != null) {

                            $('.pathology_back')
                                .append(
                                    `<small><strong> ✔ </strong>${value.text}. </small>`
                                );
                        }

                    };
                }
            });

            if (patient.get_history.observations_diagnosis) {
                $('.ob_pathology_back').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${patient.get_history.observations_diagnosis}</small>
                            </span>
                        </div>
                    </li>`
                );
            }
            // end

            // historia Antecedentes personales no patológicos

            non_pathology_back.map((value, keyy) => {
                for (const [key, val] of Object
                    .entries(
                        patient.get_history
                    )) {

                    if (key == value.name) {
                        if (val != null) {
                            $('.non_pathology_back')
                                .append(
                                    `<small><strong> ✔ </strong>${value.name === 'NPB_NA' ? value.text : value.text+ ': SI'}.</small>`
                                );
                        }
                    };
                }
            });

            if (patient.get_history.observations_not_pathological) {
                $('.ob_non_pathology_back').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${patient.get_history.observations_not_pathological}</small>
                            </span>
                        </div>
                    </li>`
                );
            }

            // end

            // historia Salud mental

            mental_healths.map((value, keyy) => {
                for (const [key, val] of Object
                    .entries(
                        patient.get_history
                    )) {

                    if (key == value.name) {
                        if (val != null) {
                            $('.mental_healths')
                                .append(
                                    `<small><strong> ✔ </strong>${value.text}.</small>`
                                );
                        }
                    };
                }
            });

            if (patient.get_history.observations_mental_healths) {
                $('.ob_mental_healths').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${patient.get_history.observations_mental_healths}</small>
                            </span>
                        </div>
                    </li>`
                );
            }

            // end

            // historia Inmunizacion

            inmunizations.map((value, keyy) => {
                for (const [key, val] of Object
                    .entries(
                        patient.get_history
                    )) {

                    if (key == value.name) {
                        if (val != null) {
                            $('.inmunizations')
                                .append(
                                    `<small>${value.name === 'IM_O' ? '<strong> ✔ </strong>' +value.text+ ' ( ' +patient.get_history.IM_V_input+ ' )' : '<strong> ✔ </strong>'+value.text}.</small>`
                                );
                        }
                    };
                }
            });

            if (patient.get_history.observations_inmunization) {
                $('.ob_inmunizations').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${patient.get_history.observations_inmunization}</small>
                            </span>
                        </div>
                    </li>`
                );
            }

            // end

            // historia dispositivos medicos

            medical_devices.map((value, keyy) => {
                for (const [key, val] of Object
                    .entries(
                        patient.get_history
                    )) {

                    if (key == value.name) {
                        if (val != null) {
                            $('.medical_device')
                                .append(
                                    `<small><strong> ✔ </strong>${value.description}. </small>`
                                );
                        }
                    };
                }
            });
            if (patient.get_history.observations_medical_devices) {
                $('.ob_medical_devices').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${patient.get_history.observations_medical_devices}</small>
                            </span>
                        </div>
                    </li>`
                );
            }

            // end

           // alegias

            if (response.allergies.length != 0) {
                $('#div_allergies').show();
                response.allergies.map((e, key) => {

                    let row = `
                    <tr>
                        <td class="text-center">${e.type_alergia}</td>
                        <td class="text-center"> ${e.detalle_alergia}</td>
                    </tr>`;

                    $('#table-info-allergies').find('tbody').append(row);

                });
            }
            if (response.patient.get_history.observations_allergies) {
                $('.ob-alergias').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${ response.patient.get_history.observations_allergies}</small>
                            </span>
                        </div>
                    </li>`
                );
            }
            // end

            // histoia quirurgica
            if (response.history_surgical.length != 0) {
                $('#div_cirugias').show();
                response.history_surgical.map((e, key) => {

                    let row = `
                    <tr>
                        <td class="text-center">${e.cirugia}</td>
                        <td class="text-center"> ${e.datecirugia}</td>
                    </tr>`;

                    $('#table-info-cirugias').find('tbody').append(row);

                });
            }
            if (response.patient.get_history.observations_quirurgicas) {
                $('.ob-cirugias').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${response.patient.get_history.observations_quirurgicas}</small>
                            </span>
                        </div>
                    </li>`
                );
            }
            // end

             // medicamentos
            if (response.medications_supplements.length != 0) {
                $('#div_medicamentos').show();
                response.medications_supplements.map((e, key) => {

                let row = `
                    <tr>
                    <td class="text-center">${e.medicine}</td>
                    <td class="text-center"> ${e.dose}</td>
                    <td class="text-center">${e.patologi}</td>
                    <td class="text-center">${e.effectiveness}</td>
                    <td class="text-center"> ${e.treatmentDuration}</td>
                    </tr>`;

                    $('#table-info-medicines').find('tbody').append(row);

                });
            }
            if (response.patient.get_history.observations_medication) {
                $('.ob-medicamentos').append(
                    `<li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="text-justify mt-3">
                                <h6 class="mb-0 text-capitalize">
                                    @lang('messages.label.observaciones'):
                                </h6>
                                <small>${response.patient.get_history.observations_medication}</small>
                            </span>
                        </div>
                    </li>`
                );
            }

        }
    }

    const resetForm = () => {
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
                $("#medical_record_id").val('');
                $("#form-consulta").trigger("reset");
                $('#table-medicamento > tbody').empty();
                $('.send').attr('disabled', false);
                $('.btn-check').attr('disabled', false);
                $(".medicine-form").show();
                $('.send-ai').show();
                // $("#indication").show();
                // $("#treatmentDuration").show();
                $("#center_id").attr('disabled', false);
                // $("#background").attr('disabled', false);
                $("#razon").attr('disabled', false);
                $("#diagnosis").attr('disabled', false);
                $("#treatment").attr('disabled', false);
                $(".addMedacition").show();
                $("#sintomas").attr('disabled', false);
                // $("#exams").attr('disabled', false);
                // $("#studies").attr('disabled', false);
                $('#form-consulta').find('input:checkbox').attr('checked', false);
                exams_array = [];
                symptom_array = [];
                studies_array = [];
                medications_supplements = [];
                $('#exam_filter').hide();
                $('#study_filter').hide();
                $('#symptoms_filter').hide();
                let exam_filter = [];
                let symptom_filter = [];
                let study_filter = [];
                $('#exam').show();
                $('#studie').show();
                $('#not-exam').hide();
                $('#not-studie').hide();
                valSymptoms = '';

                valExamenes = '';
                valStudios = '';
                $('#search_studie').show();
                $('#search_exam').show();
                $('#diagnosis_div').show();
                $('.btn-search-s').show();
                $('#search_studie_p').hide();
                $('#search_exam_p').hide();
                $("#div_spinner").show();
                $("#exam-text-area").show();
                $("#study-text-area").show();
                $("#symptoms_card1").removeClass("symptoms_style");
                $("#symptoms_card2").removeClass("symptoms_style");
                $("#symptoms_card3").removeClass("symptoms_mt-0");

                $("#diagnosis").show();
                $("#diagnosis-text").hide();
                // $("#background").show();
                // $("#background-text").hide();
                $("#razon").show();
                $("#razon-text").hide();
                $("#sintomas").show();
                $("#sintomas-text").hide();
                $("#text_area_exman").show();
                $("#exman-text").hide();
                $("#text_area_studies").show();
                $("#studies-text").hide();
                $("#symptoms_card1").show();
                $("#exam_study").show();
                $('#not-studie').hide();
                $('#not-exam').hide();
                $('#medicine').show();

            }
        });


    }

    const showDataEdit = (item, active = true) => {
        if (active) {
            $(".accordion-collapse2").collapse('show')
        }
        if(item.data.sintomas === '') {
            $("#symptoms_card1").hide();
        }
        if(item.data.study.length === 0 && item.data.exam.length === 0){
            $('#not-studie').show();
            $('#not-exam').show();
        }

        if(item.data.medications_supplements.length === 0){
            $('#medicine').hide();
        }

        $("#medical_record_id").val(item.id);
        $("#center_id").val(item.data.center_id).change().attr('disabled', true);
        // $("#background").val(item.data.background).attr('disabled', true);
        $("#razon").val(item.data.razon).attr('disabled', true);
        $("#diagnosis").val(item.data.diagnosis).attr('disabled', true);
        $("#treatment").val(item.data.treatment).attr('disabled', true);
        $("#sintomas").val(item.data.sintomas).attr('disabled', true);
        // $("#studies").val(item.data.studies);
        $(".medicine-form").hide();
        // $("#indication").hide();
        // $("#treatmentDuration").hide();
        $(".addMedacition").hide();
        $('.send').attr('disabled', true);
        $('.btn-check').attr('disabled', true);
        $('.send-ai').hide();
        $('#table-medicamento > tbody').empty();
        $('#exam_filter > ul').empty();
        $('#study_filter > ul').empty();
        exam_filter = [];
        study_filter = [];
        $('#exam').hide();
        $('#studie').hide();
        $('#exam_filter').show();
        $('#study_filter').show();
        $('#symptoms_filter').show();
        $('#search_studie').hide();
        $('#search_exam').hide();
        $('#diagnosis_div').hide();
        $('.btn-search-s').hide();
        $('#search_studie_p').show();
        $('#search_exam_p').show();
        $("#div_spinner").hide();
        $("#exam-text-area").hide();
        $("#study-text-area").hide();
        $("#symptoms_card1").addClass("symptoms_style");
        $("#symptoms_card2").addClass("symptoms_style");
        $("#symptoms_card3").addClass("symptoms_mt-0");

        $("#diagnosis").hide();
        $("#diagnosis-text").show().text(item.data.diagnosis);
        // $("#background").hide();
        // $("#background-text").show().text(item.data.background);
        $("#razon").hide();
        $("#razon-text").show().text(item.data.razon);
        $("#sintomas").hide();
        $("#sintomas-text").show().text(item.data.sintomas);
        $("#text_area_exman").hide();
        $("#exman-text").show().text(item.data.sintomas);
        $("#text_area_studies").hide();
        $("#studies-text").show().text(item.data.sintomas);

        item.data.medications_supplements.map((element, key) => {
            countMedicationAdd = countMedicationAdd + 1;
            var row = `
                    <tr id="${countMedicationAdd}">
                        <td class="text-center">${element.medicine}</td>
                        <td class="text-center">${element.indication}</td>
                        <td class="text-center">${element.hours} horas</td>
                        <td class="text-center">${element.treatmentDuration}</td>
                    </tr>`;
            $('#table-medicamento').find('tbody').append(row);

            //setiar examenes
            item.data.exam.map((elem, key) => {
                $(`#${elem.cod_exam}`).attr('checked', true);
                const examFilter = exam_filter.push(elem.description);
            });

            exam_filter.map((element) => {

                var list = `
                    <ul style="padding-inline-start: 0;">
                        <li style="margin-bottom: 10px; padding-right: 5px">
                            <input type="checkbox" class="btn-check" autocomplete="off" checked disabled >
                            <label class="btn btn-outline-primary check-cm" for={elem.cod_exam}> ${element} </label>
                        </li>
                    </ul>`;
                $('#exam_filter').append(list);
            })

            if (exam_filter.length == 0) {
                $('#not-exam').show();
            } else {
                $('#not-exam').hide();
            }

            //setiar estudios
            item.data.study.map((elem, key) => {
                $(`#${elem.cod_study}`).attr('checked', true);
                const examStudy = study_filter.push(elem.description);
            });

            study_filter.map((element) => {

                var list = `
                    <ul style="padding-inline-start: 0;">
                        <li style="margin-bottom: 10px; padding-right: 5px">
                            <input type="checkbox" class="btn-check" autocomplete="off" checked disabled >
                            <label class="btn btn-outline-success check-cm" for={elem.cod_exam}> ${element} </label>
                        </li>
                    </ul>`;
                $('#study_filter').append(list);
            })


            if (study_filter.length == 0) {
                $('#not-studie').show();
            } else {
                $('#not-studie').hide();
            }


        });
    }

    const search = (e, id) => {

        let value = e.target.value.toLowerCase();

        switch (id) {
            case 'studie':
                let data = study.filter(e => e.description.toLowerCase().includes(value));

                if (data.length > 0) {
                    handlerUl(data, id, 'btn btn-outline-success check-cm', 5);
                } else {
                    handlerUl(study, id, 'btn btn-outline-success check-cm', 5);
                }
                break;

            case 'exam':
                let data_exam = exam.filter(e => e.description.toLowerCase().includes(value));

                if (data_exam.length > 0) {
                    handlerUl(data_exam, id, 'btn btn-outline-primary check-cm', 4);
                } else {
                    handlerUl(exam, id, 'btn btn-outline-primary check-cm', 4);
                }
                break;

            default:
                let symptom = symptoms.filter(e => e.description.toLowerCase().includes(value));

                if (symptom.length > 0) {
                    handlerUl(symptom, id, 'btn btn-outline-other check-cm', 12);
                } else {
                    handlerUl(symptoms, id, 'btn btn-outline-other check-cm', 12);
                }
                break;
        }
    }

    const setSymptoms = (e, key, id) => {

        let symptom = symptoms.find(el => el.id == id);

        if ($(`#${e.target.id}`).is(':checked')) {

            // valSymptoms = valSymptoms.replace(',,', '');
            // valSymptoms = (valSymptoms == "") ? e.target.value : `${valSymptoms},${e.target.value}`;

            // $("#sintomas").val(valSymptoms);

            symptom_array = [...symptom_array, {
                code: $(`#${e.target.id}`).data('code'),
                description: e.target.value,
                id: id
            }];

            handlerCheckTrue(symptom);
        } else {
            // valSymptoms = valSymptoms.replace(`${e.target.value}`, '');

            symptom_array = symptom_array.filter((e) => e.id !== id);

            // valSymptoms = valSymptoms.replace(',,', '');

            // if (valSymptoms[0] == ',') {
            //     valSymptoms = valSymptoms.slice(1);
            // }

            // if (valSymptoms.substring(valSymptoms.indexOf() + 1) == "," || valSymptoms.substring(valSymptoms
            //         .indexOf() +
            //         1) == ",,") {
            //     $("#sintomas").val('');
            // }

            // $("#sintomas").val(valSymptoms);

            handlerCheckDelete(symptom);
        }

        $('#floatingInput').val('');
    }

    const handlerUl = (data, id, clas, number) => {

        let array = [];
        let check = '';
        let code = '';
        let callback = '';

        data.map((e, k) => {
            $(`#${id}`).empty();

            check = (e.check) ? 'checked' : '';
            if (id == "symptoms") {
                code = e.cod_symptoms;
                callback = `onclick="setSymptoms(event,${id}_${e.id},${e.id})"`;

            } else if (id == "studie") {
                code = e.cod_study;
                callback = `onclick="setStudy(event,${id}_${e.id},${e.id})"`;
            } else {
                code = e.cod_exam;
                callback = `onclick="setExams(event,${id}_${e.id},${e.id})"`;
            }

            if (k < number) {
                let el = `<li style="margin-bottom: 10px; padding-right: 5px">
                            <input type="checkbox" ${check} class="btn-check" id="${id}_${e.id}" name="chk${id}_${ e.id }" autocomplete="off" data-code="${code}" ${callback} value="${ e.description }">
                            <label class="${clas}" for="${id}_${e.id }"> ${ e.description } </label>
                        </li>`;
                array.push(el)
            }
        });

        $(`#${id}`).append(array);

    }

    const handlerCheckTrue = (find) => {

        find.check = true;
        let filter = symptoms.filter(e => e.id !== find.id);
        symptoms = [find, ...filter];
    }

    const handlerExamenCheckTrue = (val) => {

        val.check = true;
        let filter = exam.filter(e => e.id !== val.id);
        exam = [val, ...filter];
    }

    const handlerStudiesCheckTrue = (value) => {

        value.check = true;
        let filter = study.filter(e => e.id !== value.id);
        study = [value, ...filter];
    }

    const handlerCheckDelete = (find) => {

        delete find.check;
        let filter = symptoms.filter(e => e.id !== find.id);
        symptoms = [...filter, find];
    }

    const handlerStudiesCheckDelete = (value) => {

        delete value.check;
        let filter = study.filter(e => e.id !== value.id);
        study = [...filter, value];
    }

    const handlerExamenCheckDelete = (val) => {

        delete val.check;
        let filter = exam.filter(e => e.id !== val.id);
        exam = [...filter, val];
    }

    const setExams = (e, key, id) => {

        let data = exam.find(el => el.id == id);

        if ($(`#${e.target.id}`).is(':checked')) {

            exams_array = [...exams_array, {
                code_exams: $(`#${e.target.id}`).data('code'),
                description: e.target.value,
                id: id
            }];


            // valExamenes = (valExamenes == "") ? e.target.value : `${valExamenes},${e.target.value}`;
            // $("#text_area_exman").val(valExamenes);
            handlerExamenCheckTrue(data);

        } else {

            exams_array = exams_array.filter((e) => e.id !== id);

            // valExamenes = valExamenes.replace(`${e.target.value}`, '');

            // valExamenes = valExamenes.replace(',,', '');

            // if (valExamenes[0] == ',') {
            //     valExamenes = valExamenes.slice(1);
            // }

            // if (valExamenes.substring(valExamenes.indexOf() + 1) == "," || valExamenes.substring(valExamenes
            //         .indexOf() +
            //         1) == ",,") {
            //     $("#text_area_exman").val('');
            // }

            // $("#text_area_exman").val(valExamenes);
            // exams_array.splice(key, 1);

            handlerExamenCheckDelete(data);
        }

        $('.inputSearchExamen').val('');
    }

    const setStudy = (e, key, id) => {

        let data_study = study.find(el => el.id == id);

        if ($(`#${e.target.id}`).is(':checked')) {

            studies_array = [...studies_array, {
                code_studies: $(`#${e.target.id}`).data('code'),
                description: e.target.value,
                id: id
            }];

            // valStudios = (valStudios == "") ? e.target.value : `${valStudios},${e.target.value}`;
            // $("#text_area_studies").val(valStudios);
            handlerStudiesCheckTrue(data_study);

        } else {

            studies_array = studies_array.filter((e) => e.id !== id);

            // valStudios = valStudios.replace(`${e.target.value}`, '');

            // valStudios = valStudios.replace(',,', '');


            // if (valStudios[0] == ',') {
            //     valStudios = valStudios.slice(1);
            // }
            // if (valStudios.substring(valStudios.indexOf() + 1) == "," || valStudios.substring(valStudios.indexOf() +
            //         1) == ",,") {
            //     $("#text_area_studies").val('');
            // }

            // $("#text_area_studies").val(valStudios);
            // studies_array.splice(key, 1);
            handlerStudiesCheckDelete(data_study);
        }

        $('.inputSearchStudi').val('');
    }

    //agregar medicamento
    const addMedacition = (e) => {

        // validaciones para agragar medicacion
        if ($('#medicines').val() === "") {
            $("#medicine_span").text('@lang('messages.alert.campo_obligatorio')');
        } else if ($('#indication').val() === "") {
            $("#indication_span").text('@lang('messages.alert.campo_obligatorio')');
        } else if ($('#treatmentDuration').val() === "") {
            $("#treatmentDuration_span").text('@lang('messages.alert.campo_obligatorio')');
        } else if ($('#hours').val() === "") {
            $("#hours_span").text('@lang('messages.alert.campo_obligatorio')');
        } else {
            $("#medicine_span").text('');
            $("#indication_span").text('');
            $("#treatmentDuration_span").text('');
            $("#hours_span").text('');

            let btn =
                `<span onclick="deleteMedication(${countMedicationAdd})" ><i style="cursor: pointer" class="bi bi-x-circle-fill"></i></span>`;

            medications_supplements.push({
                medicine: $('#medicines').val(),
                route: $('#route').val(),
                indication: $('#indication').val(),
                treatmentDuration: $('#treatmentDuration').val(),
                hours: $('#hours').val(),
                btn: btn,
                id: countMedicationAdd
            });

            new DataTable(
                '#table-medicamento', {
                    language: {
                        url: url,
                    },
                    // reponsive: true,
                    bDestroy: true,
                    data: medications_supplements,
                    "searching": false,
                    "bLengthChange": false,
                    columns: [
                        {
                            data: 'medicine',
                            title: '@lang('messages.tabla.medicamento')',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'route',
                            title: '@lang('messages.tabla.via')',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'indication',
                            title: '@lang('messages.tabla.indicaciones')',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'hours',
                            title: '@lang('messages.tabla.horas')',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'treatmentDuration',
                            title: '@lang('messages.tabla.duracion')',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'btn',
                            title: `<i style='font-size: 15px' class="bi bi-trash-fill"></i>`,
                            className: "text-center td-pad",
                        }
                    ],
                    fnCreatedRow: function(rowEl, data) {
                        $(rowEl).attr('id', data.id);
                    }
                });

            countMedicationAdd = countMedicationAdd + 1;
            $('#countMedicationAdd').val(countMedicationAdd);
            // limpiar campos
            $('#medicines').val("");
            $('#route').val("");
            $('#indication').val("");
            $('#treatmentDuration').val("");
            $('#hours').val("");
        }


    }

    //borrar medicamento
    const deleteMedication = (count) => {
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
                medications_supplements.splice(count, 1);
                countMedicationAdd = countMedicationAdd - 1;
                $('#countMedicationAdd').val(countMedicationAdd);
                if (countMedicationAdd === 0) $('#countMedicationAdd').val('');
            }
        });
    }

    const switch_type_plane = (user) => {

        switch (Number(user.type_plane)) {
            case 1:
                if (Number(user.ref_counter) == 15) {

                    Swal.fire({
                        icon: 'warning',
                        title: '@lang('messages.alert.limite_plan')',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: '@lang('messages.botton.aceptar')'
                    });
                    return false;
                }
                break;
            case 2:
                if (Number(user.ref_counter) == 75) {

                    Swal.fire({
                        icon: 'warning',
                        title: '@lang('messages.alert.limite_plan')',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: '@lang('messages.botton.aceptar')'
                    });
                    return false;
                }
                break;

            case 7:
                $("#center_id").rules('remove');
                break;

            default:
                break;
        }
    }

    const showAlertNotExam = () => {
        Swal.fire({
            icon: 'warning',
            // iconHtml: `<img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">`,
            title: '@lang('messages.alert.no_orden_examenes')',
            allowOutsideClick: false,
            confirmButtonColor: '#42ABE2',
            confirmButtonText: '@lang('messages.botton.aceptar')',
            // customClass: {
            //     icon: 'no-border'
            // }
        });
        return false;
    }

    const showAlertNotStudy = () => {
        Swal.fire({
            icon: 'warning',
            title: '@lang('messages.alert.no_orden_estudios')',
            allowOutsideClick: false,
            confirmButtonColor: '#42ABE2',
            confirmButtonText: '@lang('messages.botton.aceptar')'
        });
        return false;
    }

    const handlerIA = () => {

        if ($("#sintomas").val() !== "" || symptom_array.length>0 ) {

            $(".send-ai").hide();
            $("#spinner2").show();

            let symtomsString = $("#sintomas").val();

            if(symptom_array.length>0){

                symptom_array.map((e) => symtomsString += (symtomsString=="")?`${e.description}`:`,${e.description}`);

            }

            $.ajax({
                url: '{{ route('medicard_record_ia') }}',
                type: 'POST',
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "symtoms":symtomsString,
                    "genere": patient.genere,
                    "age": patient.age,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    $('#modalIA').modal("show");
                    $("#p-ia").text(response.data);

                    response_data = response.data
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Operiación exitosa!',
                    //     allowOutsideClick: false,
                    //     confirmButtonColor: '#42ABE2',
                    //     confirmButtonText: 'Aceptar'
                    // }).then((result) => {
                    // });
                    $(".send-ai").show();
                    $("#spinner2").hide();

                },
                error: function(error) {

                    Swal.fire({
                        icon: 'error',
                        title: '@lang('messages.alert.error')',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: '@lang('messages.botton.aceptar')'
                    });

                    $(".send-ai").show();
                    $("#spinner2").hide();

                }
            });

        }
    }

    const InformaMedico = () => {
        $('#modalInformeMedico').modal("show");
    }

    function handleObservaciones(item) {

        $('#modalObservations').modal("show");
        $("#p-Observations").text(item.observations);
    }

    const triggerExample = async () => {

        try {
            await navigator.clipboard.writeText(response_data);
            $("#icon-copy").css("background", "#04AA6D");

            $('#copied').show();
            $("#copied").text('@lang('messages.alert.copiado')');

            setTimeout(function() {
                $('#copied').hide();
                $("#icon-copy").css("background", "#44525f");
            }, 2000);

        } catch (err) {
            console.error('Failed to copy: ', err);
            $("#copied").text('@lang('messages.alert.error_copiar')');
        }
    }

    const setDatatable = (data) => {
        let row = [];

        data.map((elem) => {
            let route = "{{ route('PDF_informe_medico', ':id') }}";
            route = route.replace(':id', elem.id);
            elem.btn = `
                <a target="_blank" href="${route}">
                    <img width="32" height="auto"
                    src="{{ asset('/img/icons/pdf-file.png') }}"
                    alt="avatar"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-custom-class="custom-tooltip"
                    data-html="true"
                    title='@lang('messages.tooltips.ver_informe')'>
                </a>
                `;

            elem.name = `${ elem.get_doctor.name} ${elem.get_doctor.last_name  }`
            row.push(elem);
        });
        new DataTable(
            '#table-medical-report', {
                bDestroy: true,
                data: row,
                "searching": false,
                "bLengthChange": false,
                columns: [{
                        data: 'cod_medical_report',
                        title: '@lang('messages.tabla.codigo_informe')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'name',
                        title: '@lang('messages.tabla.medico_remitente')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'date',
                        title: '@lang('messages.tabla.fecha')',
                        className: "text-center td-pad w-10",
                    },
                    {
                        data: 'btn',
                        title: '@lang('messages.tabla.acciones')',
                        className: "text-center td-pad",
                    }
                ],
            });
    }

    const handlerValidate = (e, input) => {

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

    const setDatatableExamenFisico = (data) => {

        let signosVitales = "";

        let row = []

        data.map((item) => {

            let elemData = JSON.stringify(item);

            item.btn =
                `<button onclick='handleObservaciones(${elemData})'>
                    <img width="25" height="auto"
                    src="{{ asset('/img/icons/justify.png') }}"
                    alt="avatar"
                    type="button"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    title="@lang('messages.tooltips.observaciones')">
                </button>`;

            row.push(item);
        });

        new DataTable(
            '#table-examen-fisico', {
                bDestroy: true,
                data: row,
                "searching": false,
                "bLengthChange": false,
                order: [[1, 'desc']],
                columns: [
                    {
                        data: 'get_center.description',
                        title: '@lang('messages.tabla.centro_salud')',
                        className: "text-center td-pad w-30",
                    },
                    {
                        data: 'date',
                        title: '@lang('messages.tabla.fecha')',
                        className: "text-center td-pad w-10",
                    },
                    {
                        data: 'weight',
                        title: '@lang('messages.tabla.peso')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'height',
                        title: '@lang('messages.tabla.altura')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'strain',
                        title: '@lang('messages.tabla.presion_arterial')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'temperature',
                        title: '@lang('messages.tabla.temperatura')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'breaths',
                        title: '@lang('messages.tabla.respiraciones')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'pulse',
                        title: '@lang('messages.tabla.pulso')',
                        className: "text-center td-pad",
                    },
                    {
                        data: 'saturation',
                        title: '@lang('messages.tabla.saturacion')',
                        className: "text-center td-pad",
                    },
                    {
                        data: `btn`,
                        title: '@lang('messages.tabla.observaciones')',
                        className: "text-center td-pad",
                    }
                ],
            });
    }

</script>
@endpush
@section('content')

    <div class="container-fluid" style="padding: 0 3% 3%">
        @if ($validate_histroy != null)
            <div class="accordion" id="accordionExample">
                {{-- datos del paciente --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person"></i> @lang('messages.acordion.datos_paciente')
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row mt-2">
                                        <div class="d-flex" style="align-items: center;">
                                            <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2"
                                                style="width: 135px;">
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
                                                <strong>@lang('messages.ficha_paciente.ci') {{ $Patient->is_minor === 'true' ? '(Rep)' : '' }}:</strong>
                                                <span> {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.genero'):</strong>
                                                <span class="text-capitalize"> {{ $Patient->genere }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.nro_historias'):</strong>
                                                <span> {{ $Patient->get_history != null ? $Patient->get_history->cod_history : '' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- historia médica --}}
                @if (Auth::user()->role == 'medico')
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingHistory">
                                    <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> @lang('messages.acordion.historia_medica')
                                    </button>
                                </span>
                                <div id="collapseHistory" class="accordion-collapseHistory collapse " aria-labelledby="headingHistory" data-bs-parent="#accordionExample">
                                    <div class="accordion-body m-mb">
                                        <div class="row mt-2" style="margin: 0px 16px;">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="family_back"> </div>
                                                    <div class="ob_family_back"> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per_pa')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="pathology_back"> </div>
                                                    <div class="ob_pathology_back"> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_per_no_pa')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="non_pathology_back"> </div>
                                                    <div class="ob_non_pathology_back"> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_salud')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="mental_healths"> </div>
                                                    <div class="ob_mental_healths"> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.inmunizaciones')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="inmunizations"> </div>
                                                    @if ($Patient->get_history->IMC19_covid === '1')
                                                        <hr class="mt-1" style="margin-bottom: 0;">
                                                        <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                            @lang('messages.form.IMC19_covid')</h6>
                                                        <hr style="margin-bottom: 0;">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive"  id="table-info-consulta">
                                                            <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_dosis')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.IMC19_fecha_ultima_dosis')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center text-capitalize"> {{ $Patient->get_history->IMC19_dosis}}</td>
                                                                        <td class="text-center text-capitalize"> {{ $Patient->get_history->IMC19_fecha_ultima_dosis}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif
                                                    <div class="ob_inmunizations"> </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.dispositivos_medicos')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="medical_device"> </div>
                                                    <div class="ob_medical_devices"> </div>
                                                </div>
                                            </div>
                                            @if ($Patient->genere == 'femenino')
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="row">
                                                        <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_gine')</h6>
                                                        <hr style="margin-top: 5px">
                                                        <div class="row">
                                                            <hr class="mt-1" style="margin-bottom: 0;">
                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                @lang('messages.subtitulos.ginecologicos')</h6>
                                                            <hr style="margin-bottom: 0;">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                <div id="table-info-consulta">
                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.edad_mestruacion')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.fecha_periodo')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ciclo_menstrual')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.infecciones')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.exam_previos')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.anticonceptivo')</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->GINE_menarquia}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->GINE_fecha_ultimo_pe}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->GINE_duracion}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->GINE_infecciones}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->GINE_ex_gine_previos}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->GINE_metodo_anti}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-3" style="margin-bottom: 0;">
                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                @lang('messages.subtitulos.obstetricos')</h6>
                                                            <hr style="margin-bottom: 0;">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                            <div id="table-info-consulta">
                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_embarazos')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_partos')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_cesareas')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.nro_abortos')</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->OBSTE_gravides}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->OBSTE_partos}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->OBSTE_cesareas}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->OBSTE_abortos}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-3" style="margin-bottom: 0;">
                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                @lang('messages.subtitulos.menopausia')</h6>
                                                            <hr style="margin-bottom: 0;">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                <div id="table-info-consulta">
                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_fecha_ini')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_sintomas')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_tratamiento')</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->MENOSPA_fecha_ini}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->MENOSPA_sintomas}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->MENOSPA_tratamiento}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-3" style="margin-bottom: 0;">
                                                            <h6 class="collapseBtn" style="margin-bottom: 10px; margin-top: 10px">
                                                                @lang('messages.subtitulos.act_sexual')</h6>
                                                            <hr style="margin-bottom: 0;">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                                <div id="table-info-consulta">
                                                                    <table id="table-info-consulta" class="table table-pag table-striped table-bordered" style="width:100%; ">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ACTSEX_activo')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.ACTSEX_enfermedades_ts')</th>
                                                                                <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.MENOSPA_tratamiento')</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->ACTSEX_activo === '1' ? "Activo" : "Inactivo"}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->ACTSEX_enfermedades_ts}}</td>
                                                                                <td class="text-center text-capitalize"> {{ $Patient->get_history->MENOSPA_tratamiento}}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <span class="text-justify mt-3">
                                                                    <h6 class="mb-0 text-capitalize">
                                                                        @lang('messages.label.observaciones'):
                                                                    </h6>
                                                                    <small>{{ $Patient->get_history->observations_ginecologica }}</small>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div id="div_allergies" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="display: none; border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_alerg')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="table-info-allergies">
                                                        <table class="table table-striped table-bordered table-info-allergies" id="table-info-allergies">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.tipo_alergia')</th>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.detalle')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="ob-alergias"> </div>
                                                </div>
                                            </div>
                                            <div id="div_cirugias" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="display: none; border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.antecedentes_qx')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="table-info-cirugias">
                                                        <table class="table table-striped table-bordered table-info-cirugias" id="table-info-cirugias">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.tipo_cirugia')</th>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.fecha')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="ob-cirugias"> </div>
                                                </div>
                                            </div>
                                            <div id="div_medicamentos" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="display: none; border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="row">
                                                    <h6 style="font-size: 18px">@lang('messages.acordion.medicamentos')</h6>
                                                    <hr style="margin-top: 5px">
                                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="table-info-medicines">
                                                        <table class="table table-striped table-bordered table-info-medicines" id="table-info-medicines">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.medicamento')</th>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.dosis')</th>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.patologia')</th>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.efectividad')</th>
                                                                    <th class="text-center" scope="col" data-orderable="false">@lang('messages.form.duracion_tratamiento')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="ob-medicamentos"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Examen fisico --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-activity"></i> @lang('messages.acordion.examen_fisico')
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body m-mb">
                                    <div class="row mt-2" style="margin: 0px 16px;">
                                        <form id="form-examen-fisico" method="post" action="">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="patient_id" id="patient_id"
                                                value="{{ $Patient->id }}">
                                            <div class="row">
                                                <div style="display: flex">
                                                    <span class="text-warning mt-2" id="EF" style="font-size: 15px;margin-right: 10px;"></span>
                                                </div>

                                                @if (Auth::user()->type_plane !== '7')
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <x-centers_user class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" />
                                                    </div>
                                                @endif
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="row">
                                                        <label style="font-size: 14px">@lang('messages.label.evaluacion_general')</label>
                                                        <hr style="margin-top: 5px">
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="condition" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.condicion')</label>
                                                                    <select name="condition" id="condition"
                                                                        placeholder="Seleccione"class="form-control"
                                                                        class="EF form-control combo-textbox-input">
                                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                                        @foreach ($get_condition as $item)
                                                                            <option value="{{ $item->description }}">
                                                                                {{ $item->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <i class="bi bi-activity st-icon"></i>
                                                                    <span id="condition_span" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="awareness" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.nivel_de_conciencia')</label>
                                                                    <input autocomplete="off" class="form-control" id="awareness" name="awareness" type="text" value="">
                                                                    <i class="bi bi-activity st-icon"></i>
                                                                    <span id="awareness_span" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="position" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.postura')</label>
                                                                    <input autocomplete="off" class="form-control" id="position" name="position" type="text" value="">
                                                                    <i class="bi bi-activity st-icon"></i>
                                                                    <span id="position_span" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="row">
                                                        <label style="font-size: 14px">@lang('messages.label.signos_vitales')</label>
                                                        <hr style="margin-top: 5px">
                                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="weight" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.peso')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="EF mask-input form-control" id="weight"
                                                                        name="weight" type="text"
                                                                        onchange="handlerValidate(event,'age');"
                                                                        value="">
                                                                    <i class="bi bi-file-earmark-medical st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="height" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.altura')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="EF mask-input-height form-control @error('height') is-invalid @enderror"
                                                                        id="height" name="height" type="text"
                                                                        onchange="handlerValidate(event,'height');"
                                                                        value="">
                                                                    <i class="bi bi-rulers st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <label for="strain" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                @lang('messages.form.presion_arterial')
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" name="strain" id="strain"
                                                                    class="EF form-control  mask-input-two input-one"
                                                                    placeholder="Sistólica 50 - 250"
                                                                    onchange="handlerValidate(event,'strain');"
                                                                    aria-label="strain" value="">
                                                                <span class="input-group-text span-input">/</span>
                                                                <input type="text" name="strain_two" id="strain_two"
                                                                    onchange="handlerValidate(event,'strain_two');"
                                                                    class="EF form-control mask-input-two input-border"
                                                                    placeholder="Diastólica 30 - 150" aria-label="strain"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="temperature" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.temperatura')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="EF mask-only-temperature form-control @error('temperature') is-invalid @enderror"
                                                                        id="temperature" name="temperature"
                                                                        type="text"
                                                                        onchange="handlerValidate(event,'temperature');"
                                                                        value="">
                                                                    <i class="bi bi-thermometer st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="breaths" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.respiraciones')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="EF mask-only-breaths form-control @error('breaths') is-invalid @enderror"
                                                                        onchange="handlerValidate(event,'breaths');"
                                                                        id="breaths" name="breaths" type="text"
                                                                        maxlength="3" value="">
                                                                    <i class="bi bi-lungs st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="pulse" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.pulso')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="EF mask-only-number form-control @error('pulse') is-invalid @enderror"
                                                                        onchange="handlerValidate(event,'pulse');"
                                                                        id="pulse" name="pulse" type="text"
                                                                        maxlength="3" value="">
                                                                    <i class="bi bi-heart-pulse st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="saturation" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.saturacion')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="EF mask-input-por form-control @error('saturation') is-invalid @enderror"
                                                                        id="saturation" name="saturation" type="text"
                                                                        onchange="handlerValidate(event,'saturation');"
                                                                        value="">
                                                                    <i class="bi bi-lungs st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                                        <div class="form-group">
                                                            <label for="observations" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.exploracion_fisica')</label>
                                                            <textarea id="observations" rows="1" name="observations" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="spinner4" style="display: none">
                                                <x-load-spinner show="true" />
                                            </div>
                                            <div class="row mt-2 justify-content-md-end mt-2">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 btn-mb"
                                                    id="send" style="display: flex; justify-content: flex-end;">
                                                    <input class="btn btnSave send" value="@lang('messages.botton.guardar')"
                                                        type="submit" style="padding: 8px" />
                                                </div>
                                            </div>
                                        </form>
                                        {{-- tabla.historial_examenes --}}
                                        <div class="row mt-3">
                                            <hr>
                                            <h5> @lang('messages.tabla.historial_examenes')</h5>
                                            <hr>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive" style="margin-top: 20px;">
                                                <table id="table-examen-fisico" class="table table-striped table-bordered" style="width:100%; ">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center w-30" scope="col" data-orderable="false">@lang('messages.tabla.centro_salud')</th>
                                                            <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.fecha')</th>
                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.peso')</th>
                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.altura')</th>
                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.presion_arterial')</th>
                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.temperatura')</th>
                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.respiraciones')</th>
                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.pulso')</th>
                                                            <th class="text-center" scope="col" data-orderable="false">@lang('messages.tabla.saturacion')</th>
                                                            <th class="text-center w-5" scope="col" data-orderable="false">@lang('messages.tabla.observaciones')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($physical_exams->sortByDesc('created_at') as $item)
                                                            <tr>
                                                                <td class="text-center td-pad"> {{ $item->get_center->description }}</td>
                                                                <td class="text-center td-pad"> {{ Carbon\Carbon::parse($item->date)->format('Y-m-d') }} </td>
                                                                <td class="text-center td-pad"> {{ $item->weight }} </td>
                                                                <td class="text-center td-pad"> {{ $item->height }} </td>
                                                                <td class="text-center td-pad"> {{ $item->strain }}</td>
                                                                <td class="text-center td-pad"> {{ $item->temperature }}</td>
                                                                <td class="text-center td-pad"> {{ $item->breaths }}</td>
                                                                <td class="text-center td-pad"> {{ $item->pulse }}</td>
                                                                <td class="text-center td-pad"> {{ $item->saturation }}
                                                                </td>
                                                                <td class="text-center td-pad">
                                                                    <button onclick='handleObservaciones({{ $item }})'>
                                                                        <img width="25" height="auto"
                                                                            src="{{ asset('/img/icons/justify.png') }}"
                                                                            alt="avatar" type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom"
                                                                            title="@lang('messages.tooltips.observaciones')">
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- consulta médica --}}
                @if (Auth::user()->role == 'medico')
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingThree">
                                    <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> @lang('messages.acordion.consulta_medica')
                                    </button>
                                </span>
                                <div id="collapseThree" class="accordion-collapse2 collapse " aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body m-mb">
                                        <form id="form-consulta" method="post" action="/">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="medical_record_id" id="medical_record_id" value="">
                                            <input type="hidden" name="id" id="id" value="{{ $Patient->id }}">
                                            <div id="input-array"></div>
                                            <div class="row mt-2" style="margin: 0px 16px;">
                                                @if (Auth::user()->type_plane !== '7')
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <x-centers_user class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" />
                                                    </div>
                                                @endif
                                                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-style' style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; display:flex">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 pl-5">
                                                        <div class="form-group">
                                                            <label for="razon" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.razon')</label>
                                                            <textarea id="razon" rows="1" name="razon" class="form-control"></textarea>
                                                            <pre class="pre-textarea"
                                                                style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                                                id="razon-text"></pre>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id='symptoms_card1'
                                                    class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                    style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div id='symptoms_card2'
                                                        class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                        style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; ">
                                                        <div
                                                            class="btn-search-s col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                            <div class="form-group"
                                                                style="display: flex; align-items: center;">
                                                                <label for="search_symptoms"
                                                                    class="form-label"style="font-size: 13px; margin-bottom: 5px; width: 130px">
                                                                    @lang('messages.form.buscar_sintoma') </label>
                                                                <input onkeyup="search(event,'symptoms')" type="text"
                                                                    style="border-radius: 30px;" class="form-control"
                                                                    id="floatingInput" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div id='diagnosis_div' class="overflow-auto mt-2"
                                                            style="max-width: 100%; min-height: 35px; position: relative;">
                                                            <ul id="symptoms_filter" class="symptoms"
                                                                style="padding-inline-start: 0; display: flex; flex-wrap: wrap; display: none">
                                                            </ul>
                                                            <ul id="symptoms" class="symptoms list-mb"
                                                                style="padding-inline-start: 0; display: flex; flex-wrap: wrap; margin-bottom: 0">
                                                            </ul>
                                                        </div>
                                                        <div id='symptoms_card3'
                                                            class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                            style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; margin-top: 0.5rem">
                                                            <div class="form-group">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.sintomas')</label>
                                                                <textarea id="sintomas" rows="2" name="sintomas" class="form-control"></textarea>
                                                                <pre class="pre-textarea"
                                                                    style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                                                    id="sintomas-text"></pre>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="div_spinner">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                            <div id="spinner2" style="display: none">
                                                                <div class="container shadow-div">
                                                                    <div class="row justify-content-center form-sq">
                                                                        <img class="spinnner s-IA"
                                                                            src="{{ asset('img/GIF-CONSULTAR-IA.gif') }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2 justify-content-md-end send-ai">
                                                        <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                            style="display: flex; justify-content: flex-end;">
                                                            <button onclick="handlerIA()" type="button"
                                                                class="btn btnSave">@lang('messages.botton.consulta_ai')</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                    style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="form-group">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.diagnostico')</label>
                                                        <textarea id="diagnosis" rows="1" name="diagnosis" class="form-control" spellcheck="false"></textarea>
                                                        <pre class="pre-textarea"
                                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                                            id="diagnosis-text"></pre>
                                                    </div>
                                                </div>

                                                <div id="exam_study" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-style" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; display: flex;">
                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pr-5">
                                                        <div style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <div class="form-group" id='search_exam'
                                                                    style="display: flex; align-items: center;">
                                                                    <label for="search_patient"
                                                                        class="form-label"style="font-size: 13px; margin-bottom: 5px; width: 135px">@lang('messages.form.buscar_examen')</label>
                                                                    <input onkeyup="search(event,'exam')" type="text"
                                                                        style="border-radius: 30px;"
                                                                        class="form-control inputSearchExamen"
                                                                        id="floatingInput" placeholder="">
                                                                </div>
                                                                <label id='search_exam_p'
                                                                    style="font-size: 13px; margin-bottom: 5px; display:none">@lang('messages.form.examenes')
                                                                </label>
                                                            </div>
                                                            <div id="exam-text-area">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                                    style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                    <div class="form-group">
                                                                        <label for="phone" class="form-label"
                                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.examenes')</label>
                                                                        <textarea id="text_area_exman" rows='2' name="text_area_exman" class="form-control"></textarea>
                                                                        <pre class="pre-textarea"
                                                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                                                            id="exman-text"></pre>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 overflow-auto"
                                                                style="max-width: 100%; position: relative; min-height: 60px;">
                                                                <ul id="exam_filter" class="exam"
                                                                    style="padding-inline-start: 0; display: flex; flex-wrap: wrap; ; margin-bottom: 0;">
                                                                </ul>
                                                                <div id='not-exam'>
                                                                    <img width="50" height="auto"
                                                                        src="{{ asset('/img/icons/no-file.png') }}"
                                                                        alt="avatar">
                                                                    <span>@lang('messages.label.info_3')</span>
                                                                </div>
                                                                <ul id="exam" class="exam list-mb"
                                                                    style="padding-inline-start: 0; display: flex; flex-wrap: wrap; margin-bottom: 0">
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pl-5">
                                                        <div
                                                            style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                <div class="form-group" id="search_studie"
                                                                    style="display: flex; align-items: center;">
                                                                    <label for="search_patient" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; width: 131px">@lang('messages.form.buscar_estudio')</label>
                                                                    <input onkeyup="search(event,'studie')" type="text"
                                                                        style="border-radius: 30px;"
                                                                        class="form-control inputSearchStudi" placeholder=""
                                                                        id="floatingInputt">
                                                                </div>
                                                            </div>
                                                            <label id='search_studie_p'
                                                                style="font-size: 13px; margin-bottom: 5px; display:none">@lang('messages.form.estudios')
                                                            </label>
                                                            <div id="study-text-area">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                                    id="study-text-area"
                                                                    style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                    <div class="form-group">
                                                                        <label for="phone" class="form-label"
                                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.estudios')</label>
                                                                        <textarea id="text_area_studies" rows="2" name="text_area_studies" class="form-control"></textarea>
                                                                        <pre class="pre-textarea"
                                                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                                                            id="studies-text"></pre>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 card-study overflow-auto"
                                                                style="max-width: 100%; min-height: 60px;">
                                                                <ul id="study_filter" class="studie"
                                                                    style="padding-inline-start: 0; display: flex; flex-wrap: wrap; margin-bottom: 0;">
                                                                </ul>
                                                                <div id='not-studie'>
                                                                    <img width="60" height="auto"
                                                                        src="{{ asset('/img/icons/no-file.png') }}"
                                                                        alt="avatar">
                                                                    <span>@lang('messages.label.info_4')</span>
                                                                </div>
                                                                <ul id="studie" class="studie list-mb"
                                                                    style="padding-inline-start: 0; display: flex; flex-wrap: wrap; margin-bottom: 0">
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Medicacion --}}
                                                <div id="medicine" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <label style="font-size: 14px">@lang('messages.label.tratamiento')</label>
                                                    <hr style="margin-bottom: 0; margin-top: 5px">
                                                    <div class="row medicine-form">
                                                        <div style="display: flex">
                                                            <span class="text-warning mt-2" id='med'
                                                                style="font-size: 14px;margin-right: 10px;"></span>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="phone" class="form-label" style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.medicamento')</label>
                                                                        <select name="medicines" id="medicines"
                                                                        placeholder="Seleccione"class="form-control"
                                                                        class="form-control combo-textbox-input">
                                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                                        @foreach ($medicines as $item)
                                                                        <option value={{ $item->description }}>{{ $item->description }} - {{ $item->concentration }} - {{ $item->shape }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <i class="bi bi-capsule st-icon"></i>
                                                                </div>
                                                                <span id="medicine_span" class="text-danger"></span>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-2 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="route" class="form-label" style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.via')</label>
                                                                        <select name="route" id="route"
                                                                        placeholder="@lang('messages.label.seleccione')" class="form-control"
                                                                        class="form-control combo-textbox-input">
                                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                                        @foreach ($medicines_vias as $item)
                                                                        <option value={{ $item->description }}>{{ $item->description }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <i class="bi bi-capsule st-icon"></i>
                                                                </div>
                                                                <span id="medicine_span" class="text-danger"></span>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="phone" class="form-label"
                                                                        style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.indicaciones')</label>
                                                                    <input autocomplete="off"
                                                                        class="form-control mask-only-text" id="indication"
                                                                        name="indication" type="text" value="">
                                                                    <i class="bi bi-file-medical st-icon"></i>
                                                                </div>
                                                                <span id="indication_span" class="text-danger"></span>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-1 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="phone" class="form-label"
                                                                        style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.horas')</label>
                                                                    <input autocomplete="off"
                                                                        class="form-control mask-only-number" id="hours"
                                                                        name="hours" type="text" value="">
                                                                    <i class="bi bi-file-medical st-icon"></i>
                                                                </div>
                                                                <span id="hours_span" class="text-danger"></span>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-1 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="treatmentDuration" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.duracion')</label>
                                                                    <select name="treatmentDuration" id="treatmentDuration"
                                                                        placeholder="Seleccione"class="form-control"
                                                                        class="form-control combo-textbox-input">
                                                                        <option value="">@lang('messages.label.seleccione')</option>
                                                                        <option value="@lang('messages.select.1_dia')">@lang('messages.select.1_dia')
                                                                        </option>
                                                                        <option value="@lang('messages.select.2_dia')">@lang('messages.select.2_dia')
                                                                        </option>
                                                                        <option value="@lang('messages.select.3_dia')">@lang('messages.select.3_dia')
                                                                        </option>
                                                                        <option value="@lang('messages.select.4_dia')">@lang('messages.select.4_dia')
                                                                        </option>
                                                                        <option value="@lang('messages.select.5_dia')">@lang('messages.select.5_dia')
                                                                        </option>
                                                                        <option value="@lang('messages.select.6_dia')">@lang('messages.select.6_dia')
                                                                        </option>
                                                                        <option value="@lang('messages.select.1_semana')">@lang('messages.select.1_semana')
                                                                        </option>
                                                                        <option value="@lang('messages.select.2_semana')">@lang('messages.select.2_semana')
                                                                        </option>
                                                                        <option value="@lang('messages.select.3_semana')">@lang('messages.select.3_semana')
                                                                        </option>
                                                                        <option value="@lang('messages.select.1_mes')">@lang('messages.select.1_mes')
                                                                        </option>
                                                                        <option value="@lang('messages.select.2_mes')">@lang('messages.select.2_mes')
                                                                        </option>
                                                                        <option value="@lang('messages.select.3_mes')">@lang('messages.select.3_mes')
                                                                        </option>
                                                                        <option value="@lang('messages.select.1_anio')">@lang('messages.select.1_anio')
                                                                        </option>
                                                                    </select>
                                                                    <i class="bi bi-calendar-range st-icon"></i>
                                                                    <span id="treatmentDuration_span"
                                                                        class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-2 mt-2"
                                                            style="display: flex; align-items: flex-end; margin-bottom: 3px;">
                                                            <span type="" onclick="addMedacition(event)"
                                                                class="btn btnSecond addMedacition" id="btn"
                                                                style="padding: 7px; font-size: 12px; width:100%">
                                                                <i class="bi bi-plus-lg"></i> @lang('messages.botton.añadir')
                                                            </span>
                                                        </div>
                                                    </div>
                                                    {{-- tabla --}}
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                                            style="margin-top: 20px; width: 100%;">
                                                            <table class="table table-striped table-bordered" id="table-medicamento">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center w-35" scope="col"> @lang('messages.tabla.medicamento') </th>
                                                                        <th class="text-center w-10" scope="col"> @lang('messages.tabla.via') </th>
                                                                        <th data-orderable="false" class="text-center w-55" scope="col"> @lang('messages.tabla.indicaciones') </th>
                                                                        <th data-orderable="false" class="text-center w-55" scope="col"> @lang('messages.tabla.horas') </th>
                                                                        <th data-orderable="false" class="text-center" scope="col"> @lang('messages.tabla.duracion') </th>
                                                                        <th data-orderable="false" class="text-center w-4" scope="col"> <i style='font-size: 15px' class="bi bi-trash-fill"></i> </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                            <tfoot>
                                                                <div class="row mt-2" style="display: none">
                                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                        <div class="input-group flex-nowrap">
                                                                            <span
                                                                                class="input-group-text">@lang('messages.label.info_5')</span>
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
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                    <div id="spinner" style="display: none">
                                                        <x-load-spinner show="true" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2 justify-content-md-end">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 btn-mb" id="send" style="display: flex; justify-content: flex-end; padding-right: 30px; align-items: flex-end;">
                                                    <input class="btn btnSave send" value="@lang('messages.botton.guardar')" type="submit" style="padding: 8px" />
                                                    <button style="margin-left: 20px;" type="button" onclick="resetForm();"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom" data-html="true"
                                                        title="@lang('messages.label.limpiar')">
                                                        <img width="60" height="auto" src="{{ asset('/img/icons/eraser.png') }}" alt="avatar">
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- ultimas consultas tabla --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingFour">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> @lang('messages.acordion.ultimas_consultas')
                                </button>
                            </span>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row" id="table-one">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive" style="margin-top: 20px;">
                                            <table id="table-medical-record" class="table table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        {{-- <th data-orderable="false" class="text-center w-8" scope="col" style="display: none">@lang('messages.tabla.id_consulta')</th> --}}
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha') </th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.medico_tratante')</th>
                                                        <th class="text-center w-30" scope="col">@lang('messages.tabla.centro_salud') </th>
                                                        <th data-orderable="false" class="text-center w-20" scope="col">@lang('messages.tabla.ordenes') </th>
                                                        <th data-orderable="false" class="text-center w-8" scope="col">@lang('messages.tabla.informe') </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- {{ dd(collect($medical_record_user)->sortBy('id')) }} --}}
                                                    @foreach ($medical_record_user->sortByDesc('created_at') as $item)
                                                        <tr>
                                                            <td class="text-center td-pad" onclick="showDataEdit({{ json_encode($item) }});"> {{ Carbon\Carbon::parse($item->record_date)->format('d-m-Y') }}</td>
                                                            <td class="text-center td-pad text-capitalize" onclick="showDataEdit({{ json_encode($item) }});">Dr. {{ $item->get_doctor->name . " " . $item->get_doctor->last_name }} </td>
                                                            <td class="text-center td-pad" onclick="showDataEdit({{ json_encode($item) }});"> {{ $item->get_center->description }}</td>
                                                            {{-- <td class="text-center td-pad" style="display: none" onclick="showDataEdit({{ json_encode($item) }});"> {{ $item->id }}</td> --}}
                                                            <td class="text-center td-pad">
                                                                <div class="d-flex">
                                                                    @if ($item->status_exam)
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <a target="_blank" href="{{ route('pdf_medical_prescription', $item->id) }}">
                                                                                <button type="button"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="@lang('messages.tooltips.ver_examenes')">
                                                                                    <img width="60" height="auto" src="{{ asset('/img/icons/pdf-orden-exam.png') }}" alt="avatar">
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <button type="button" onclick="showAlertNotExam();">
                                                                                <img width="55" height="auto"
                                                                                    src="{{ asset('/img/icons/not-file-icon.png') }}"
                                                                                    alt="avatar">
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    @if ($item->status_study)
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <a target="_blank" href="{{ route('pdf_medical_prescription', $item->id) }}">
                                                                                <button type="button"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="@lang('messages.tooltips.ver_estudios')">
                                                                                    <img width="60" height="auto"
                                                                                        src="{{ asset('/img/icons/pdf-orden-study.png') }}"
                                                                                        alt="avatar">
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <button type="button" onclick="showAlertNotStudy();">
                                                                                <img width="55" height="auto"
                                                                                    src="{{ asset('/img/icons/not-file-icon.png') }}"
                                                                                    alt="avatar">
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                        <a target="_blank" href="{{ route('pdf_medical_prescription', $item->id) }}">
                                                                            <button type="button">
                                                                                <img width="50" height="auto"
                                                                                    src="{{ asset('/img/icons/pdf-recipe.png') }}"
                                                                                    alt="avatar"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="@lang('messages.tooltips.ver_orden_medica')">
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center td-pad">
                                                                <div class="d-flex">
                                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: center;">
                                                                        <a target="_blank" href="{{ route('PDF_medical_record', $item->id) }}">
                                                                            <button type="button">
                                                                                <img width="60" height="auto"
                                                                                    src="{{ asset('/img/icons/pdf-consulta.png') }}"
                                                                                    alt="avatar"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="@lang('messages.tooltips.ver_consulta_medica')">
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- informes medicos --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3 mb-cd mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingFive">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseInfome" aria-expanded="false" aria-controls="collapseInfome"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> @lang('messages.acordion.informes_medico')
                                </button>
                            </span>
                            <div id="collapseInfome" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row" id="table-one">
                                        @if (Auth::user()->role == 'medico')
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                <button style="font-size: 3rem" type="button" onclick="InformaMedico();"
                                                    class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-html="true" title="@lang('messages.tooltips.generar_informe')">
                                                    <img width="70" height="auto" src="{{ asset('/img/icons/generar-informe.png') }}" alt="avatar">
                                                </button>
                                            </div>
                                        @endif
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive" style="margin-top: 20px;">
                                            <table id="table-medical-report" class="table table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.codigo')</th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.medico_tratante')</th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha') </th>
                                                        <th data-orderable="false" class="text-center" scope="col"> @lang('messages.tabla.acciones')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medical_report as $item)
                                                        <tr>
                                                            <td class="text-center td-pad"> {{ $item->cod_medical_report }}</td>
                                                            <td class="text-center td-pad"> {{ $item->get_doctor->name . ' ' . $item->get_doctor->last_name }} </td>
                                                            <td class="text-center td-pad"> {{ $item->date }}</td>
                                                            <td class="text-center td-pad">
                                                                <a target="_blank" href="{{ route('PDF_informe_medico', $item->id) }}">
                                                                    <button type="button">
                                                                        <img width="60" height="auto"
                                                                            src="{{ asset('/img/icons/pdf-informe.png') }}"
                                                                            alt="avatar" data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom"
                                                                            data-bs-custom-class="custom-tooltip"
                                                                            data-html="true" title="@lang('messages.tooltips.informe')">
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modal COnsulta IA-->
        <div class="modal fade" id="modalIA" tabindex="-1" aria-labelledby="modalIALabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header title">
                        <i class="bi bi-alexa"></i>
                        <span style="padding-left: 5px">@lang('messages.modal.titulo.resultado_ia')</span>
                        <button type="button" id="icon-copy" class="btn btn-iSecond rounded-circle"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="@lang('messages.tooltips.copiar_diagnostico')"
                            onclick="triggerExample();" style="margin-left: 5%; font-size: 14px;">
                                <img width="20" height="auto"
                                    src="{{ asset('/img/icons/copy-files.png') }}"
                                    alt="avatar"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    data-bs-custom-class="custom-tooltip"
                                    data-html="true">
                            {{-- <i class="bi bi-file-earmark-text"></i> --}}
                        </button> <span style="padding-left: 5px" id="copied"></span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">
                        <div class="div-ia">
                            <pre style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                id="p-ia"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Observaciones -->
        <div class="modal fade" id="modalObservations" tabindex="-1" aria-labelledby="modalObservationsLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header title">
                        <i class="bi bi-alexa"></i>
                        <span style="padding-left: 5px">@lang('messages.modal.titulo.observaciones')</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">
                        <div class="div-Observations">
                            <pre style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                id="p-Observations"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Informe medico -->
        <div class="modal fade" id="modalInformeMedico" tabindex="-1" aria-labelledby="modalInformeMedicoLabel"
            aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div id="spinner3" style="display: none">
                <x-load-spinner show="true" />
            </div>
            <div class="modal-dialog modal-dialog-centered modal-xl InformeMedicomodal">
                <div class="modal-content">
                    <div class="modal-header title">
                        <i class="bi bi-alexa"></i>
                        <span style="padding-left: 5px">@lang('messages.modal.titulo.informes_medico')</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="form-informe-medico">
                            {{ csrf_field() }}
                            <div class="d-flex" style="align-items: center;">
                                <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 80px;">
                                    <img src=" {{ $Patient->patient_img ? asset('/imgs/' . $Patient->patient_img) : ($Patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                        width="80" height="80" alt="Imagen del paciente"
                                        class="img-medical-modal">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical" style="margin-left: 20px;">
                                    <strong>@lang('messages.ficha_paciente.nombre'):</strong><span class="text-capitalize"> {{ $Patient->last_name . ', ' . $Patient->name }}</span>
                                    <br>
                                    <strong>@lang('messages.ficha_paciente.edad'):</strong><span> {{ $Patient->age }} @lang('messages.ficha_paciente.años')</span>
                                    <br>
                                    <strong>@lang('messages.ficha_paciente.ci') {{ $Patient->is_minor === 'true' ? '(Rep)' : '' }}:</strong>
                                    <span> {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                </div>
                            </div>

                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="patient_id" name="patient_id" value="{{ $Patient->id }}">
                            <input type="hidden" id="medical_report_id" name="medical_report_id" value="">

                            @if (Auth::user()->type_plane !== '7')
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                    <x-centers_user class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" />
                                </div>
                            @endif

                            <div class="mt-3">
                                <textarea id="TextInforme" name="TextInforme"></textarea>
                            </div>

                            <div class="row mt-2 justify-content-md-end">
                                <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id="send"
                                    style="display: flex; justify-content: flex-end; padding-right: 30px;">
                                    <input class="btn btnSave send" value="@lang('messages.botton.guardar')" type="submit" />
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

