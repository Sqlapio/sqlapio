<!DOCTYPE html>

@extends('layouts.app-auth')
@section('title', 'Detalle Médico')

<style>
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

    .w-35 {
        width: 35% !important;
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
        box-shadow: 0 0 0 64em rgba(0, 0, 0, 0.75);
        position: absolute;
        z-index: 1;

    }

    /* .section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("../img/fondo.jpg");
    }    */

    .s-IA {
        width: 12% !important;
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
            padding: 0 !important;
        }

        .pr-5 {
            padding: 0 0 5 !important;
        }

        .pl-5 {
            padding: 5px 0 0;
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
</style>
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

        $(document).ready(() => {//    
            
            tinymce.init({
                selector: '#TextInforme',
                skin: false,
                content_css: false,
                height: 500,
                menubar: false,              
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
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

            if (user.type_plane !== '7' && doctor_centers.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debe asociar un centro!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    window.location.href = "{{ route('Centers') }}";
                });
            } else if (validate_histroy === null) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debe crear una historia clinica para este paciente!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    let url = "{{ route('ClinicalHistoryDetail', ':id') }}";
                    url = url.replace(':id', id);
                    window.location.href = url;
                });
            }

            $('#form-consulta').validate({
                ignore: [],
                rules: {
                    background: {
                        required: true,
                    },
                    razon: {
                        required: true,
                    },
                    diagnosis: {
                        required: true,
                    },
                    treatment: {
                        required: true,
                    },
                    // exams: {
                    //     required: true,
                    // },
                    sintomas: {
                        required: true,
                    },
                    center_id: {
                        required: true,
                    },
                    countMedicationAdd: {
                        required: true,
                    }
                },
                messages: {
                    background: {
                        required: "Antecedentes es obligatorio",
                    },
                    razon: {
                        required: "Razón de la visita es obligatoria",
                    },

                    diagnosis: {
                        required: "Diagnostico es obligatorio",
                    },
                    treatment: {
                        required: "Tratamiento es obligatorio",
                    },
                    // exams: {
                    //     required: "Examenes es obligatorio",
                    // },
                    sintomas: {
                        required: "Sintomas es obligatorio",
                    },
                    center_id: {
                        required: "Centro es obligatorio",
                    },
                    countMedicationAdd: {
                        required: "debe agregar un tratamiento",
                    }
                }
            });
            $.validator.addMethod("onlyText", function(value, element) {
                let pattern = /^[a-zA-ZñÑáéíóúü0-9\s]+$/g;
                return pattern.test(value);
            }, "No se permiten caracteres especiales");

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
                        required: "Informe medico no puede estar vacio",
                    },
                    center_id: {
                        required: "Centro es obligatorio",
                    }
                }
            });

            $("#form-informe-medico").submit(function(event) {
                event.preventDefault();
                $("#form-informe-medico").validate();
                if ($("#form-informe-medico").valid()) {
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

                            Swal.fire({
                                icon: 'success',
                                title: 'Operación exitosa!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
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
                if (countMedicationAdd === 0) {
                    $("#med").html(
                        `Debe agregar al menos un tratamiento <i style="font-size:18px; margin-top: 11px" class="bi bi-exclamation-triangle st-icon text-warning "></i>`
                    );
                    Swal.fire({
                        icon: 'warning',
                        title: 'Debe agregar al menos un tratamiento',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: 'Aceptar'
                    });
                    return false;
                }
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
                                title: 'Consulta registrada exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                let url =
                                    "{{ route('MedicalRecord', ':id') }}";
                                url = url.replace(':id', id);
                                window.location.href = url;
                                // let url =
                                //     "{{ route('get_medical_record_user', ':id') }}";
                                // url = url.replace(':id', id);
                                // $.ajax({
                                //     url: url,
                                //     type: 'GET',
                                //     headers: {
                                //         'X-CSRF-TOKEN': $(
                                //                 'meta[name="csrf-token"]')
                                //             .attr(
                                //                 'content')
                                //     },
                                //     success: function(res) {
                                //         let data = [];
                                //         res.map((elem) => {
                                //             let route =
                                //                 "{{ route('PDF_medical_record', ':id') }}";
                                //             route = route
                                //                 .replace(
                                //                     ':id', elem
                                //                     .id);

                                //             let route_mr_exam =
                                //                 "{{ route('mr_exam', ':id') }}";
                                //             route_mr_exam =
                                //                 route_mr_exam
                                //                 .replace(
                                //                     ':id', elem
                                //                     .patient_id);

                                //             let route_mr_study =
                                //                 "{{ route('mr_study', ':id') }}";
                                //             route_mr_study =
                                //                 route_mr_study
                                //                 .replace(
                                //                     ':id', elem
                                //                     .patient_id);

                                //             let route_pdf_medical_prescription =
                                //                 "{{ route('pdf_medical_prescription', ':id') }}";
                                //             route_pdf_medical_prescription
                                //                 =
                                //                 route_pdf_medical_prescription
                                //                 .replace(
                                //                     ':id', elem
                                //                     .id);

                                //             let btnExam = `
                            //             <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            //                     <button type="button"
                            //                         class="refresf btn-idanger rounded-circle"
                            //                         data-bs-container="body"
                            //                         data-bs-toggle="popover"
                            //                         data-bs-custom-class="custom-popover"
                            //                         data-bs-placement="bottom"
                            //                         data-bs-content="No hay exámenes cargados">
                            //                         <i class="bi bi-exclamation-lg"></i>
                            //                     </button>
                            //             </div>`;

                                //             if (elem.data
                                //                 .status_exam != null
                                //             ) {
                                //                 btnExam = `
                            //                         <div
                            //                     class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            //                     <a href="${route_mr_exam}">
                            //                     <button type="button"
                            //                     class="btn refresf btn-iSecond rounded-circle"
                            //                     data-bs-toggle="tooltip"
                            //                     data-bs-placement="bottom"
                            //                     data-bs-custom-class="custom-tooltip"
                            //                     data-html="true" title="ver exámenes">
                            //                     <i class="i bi-card-heading"></i>
                            //                     </button>
                            //                     </a>
                            //                     </div>`

                                //             }
                                //             let btnStudy = `<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            //                                 <button type="button"
                            //                                     class="refresf btn-idanger rounded-circle"
                            //                                     data-bs-container="body"
                            //                                     data-bs-toggle="popover"
                            //                                     data-bs-custom-class="custom-popover"
                            //                                     data-bs-placement="bottom"
                            //                                     data-bs-content="No hay estudios cargados">
                            //                                     <i class="bi bi-exclamation-lg"></i>
                            //                                 </button>
                            //                             </div>`

                                //             if (elem.data
                                //                 .status_study !=
                                //                 null
                                //             ) {
                                //                 btnStudy = `
                            //                     <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            //                     <a
                            //                     href="${route_mr_study}">
                            //                     <button type="button"
                            //                     class="btn refresf btn-iSecond rounded-circle"
                            //                     data-bs-toggle="tooltip"
                            //                     data-bs-placement="bottom"
                            //                     data-bs-custom-class="custom-tooltip"
                            //                     data-html="true" title="ver estudios">
                            //                     <i class="i bi-card-heading"></i>
                            //                     </button>
                            //                     </a>
                            //                     </div>`

                                //             }


                                //             elem.btn = `
                            //                     <div class="d-flex">
                            //                     ${btnExam}
                            //                     ${btnStudy}
                            //                     <div
                            //                     class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            //                     <a target="_blank"
                            //                     href="${route_pdf_medical_prescription}">
                            //                     <button type="button"
                            //                     class="btn refresf btn-iSecond rounded-circle"><i
                            //                     class="bi bi-file-earmark-pdf"
                            //                     data-bs-toggle="tooltip"
                            //                     data-bs-placement="bottom"
                            //                     data-bs-custom-class="custom-tooltip"
                            //                     data-html="true"
                            //                     title="Ver recipe"></i>
                            //                     </button>
                            //                     </a>
                            //                     </div>
                            //                     <div
                            //                     class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            //                     <a target="_blank"
                            //                     href="${route}">
                            //                     <button type="button"
                            //                     class="btn refresf btn-iSecond rounded-circle"><i
                            //                     class="bi bi-file-earmark-pdf"
                            //                     data-bs-toggle="tooltip"
                            //                     data-bs-placement="bottom"
                            //                     data-bs-custom-class="custom-tooltip"
                            //                     data-html="true" title="ver PDF"></i>
                            //                     </button>
                            //                     </a>
                            //                     </div>
                            //                     </div>`;
                                //             data.push(elem);
                                //         });

                                //         new DataTable(
                                //             '#table-medical-record', {
                                //                 language: {
                                //                     url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                                //                 },
                                //                 // reponsive: true,
                                //                 bDestroy: true,
                                //                 data: data,
                                //                 "searching": false,
                                //                 "bLengthChange": false,
                                //                 columns: [{
                                //                         data: 'data.record_code',
                                //                         title: 'Código de la consulta',
                                //                         className: "text-center td-pad",
                                //                     },
                                //                     {
                                //                         data: 'data.cod_ref',
                                //                         title: 'Código de la referencia',
                                //                         className: "text-center td-pad",
                                //                     },
                                //                     {
                                //                         data: 'date',
                                //                         title: 'Fecha de la consulta',
                                //                         className: "text-center td-pad",
                                //                     },
                                //                     {
                                //                         data: 'name_patient',
                                //                         title: 'Nombre del paciente',
                                //                         className: "text-center td-pad",
                                //                     },
                                //                     {
                                //                         data: 'genere',
                                //                         title: 'Género',
                                //                         className: "text-center td-pad",
                                //                     },
                                //                     {
                                //                         data: 'center',
                                //                         title: 'Centro',
                                //                         className: "text-center td-pad",
                                //                     },
                                //                     {
                                //                         data: 'full_name_doc',
                                //                         title: 'Médico',
                                //                         className: "text-center td-pad",
                                //                     },
                                //                     {
                                //                         data: 'btn',
                                //                         title: 'Ver',
                                //                         className: "text-center td-pad",
                                //                     }
                                //                 ],
                                //             });
                                //         $('#table-medical-record').on(
                                //             'click', 'td',
                                //             function() {
                                //                 let table =
                                //                     new DataTable(
                                //                         '.table'
                                //                     );
                                //                 let row = table.row(
                                //                     this).data();
                                //                 showDataEdit(row);
                                //             })

                                //     }
                                // });
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
        });

        function resetForm() {
            Swal.fire({
                icon: 'warning',
                title: 'Desea realizar esta acción?',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
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
                    $("#background").attr('disabled', false);
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
                }
            });


        }

        function showDataEdit(item, active = true) {
            if (active) {
                $(".accordion-collapse2").collapse('show')
            }
            $("#medical_record_id").val(item.id);
            $("#center_id").val(item.data.center_id).change().attr('disabled', true);
            $("#background").val(item.data.background).attr('disabled', true);
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

            item.data.medications_supplements.map((element, key) => {
                countMedicationAdd = countMedicationAdd + 1;
                var row = `
                        <tr id="${countMedicationAdd}">
                        <td class="text-center">${element.medicine}</td>
                        <td class="text-center">${element.indication}</td>
                        <td class="text-center">${element.treatmentDuration}</td>
                        <td class="text-center"><span><i class="bi bi-x-circle-fill"></i></span></td>
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
                            <input type="checkbox" class="btn-check"
                                autocomplete="off"
                                checked
                                disabled >
                            <label class="btn btn-outline-primary check-cm"
                                for={elem.cod_exam}>
                                ${element}
                            </label>
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
                            <input type="checkbox" class="btn-check"
                                autocomplete="off"
                                checked
                                disabled >
                            <label class="btn btn-outline-success check-cm"
                                for={elem.cod_exam}>
                                ${element}
                            </label>
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

        function search(e, id) {

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

        function setSymptoms(e, key, id) {

            let symptom = symptoms.find(el => el.id == id);

            if ($(`#${e.target.id}`).is(':checked')) {
                valSymptoms = valSymptoms.replace(',,', '');
                valSymptoms = (valSymptoms == "") ? e.target.value : `${valSymptoms},${e.target.value}`;

                $("#sintomas").val(valSymptoms);
                handlerCheckTrue(symptom);
            } else {
                valSymptoms = valSymptoms.replace(`${e.target.value}`, '');

                valSymptoms = valSymptoms.replace(',,', '');

                if (valSymptoms[0] == ',') {
                    valSymptoms = valSymptoms.slice(1);
                }

                if (valSymptoms.substring(valSymptoms.indexOf() + 1) == "," || valSymptoms.substring(valSymptoms.indexOf() +
                        1) == ",,") {
                    $("#sintomas").val('');
                }

                $("#sintomas").val(valSymptoms);

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
                            <input type="checkbox" ${check} class="btn-check"
                            id="${id}_${e.id}"
                            name="chk${id}_${ e.id }"
                            autocomplete="off"
                            data-code="${code}"
                            ${callback}
                            value="${ e.description }">
                            <label class="${clas}"
                            for="${id}_${e.id }">
                            ${ e.description }
                            </label>
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

        function setExams(e, key, id) {

            let data = exam.find(el => el.id == id);

            if ($(`#${e.target.id}`).is(':checked')) {
                exams_array.push({
                    code_exams: $(`#${e.target.id}`).data('code'),
                    description: $(`#${e.target.id}`).val(),
                });

                valExamenes = (valExamenes == "") ? e.target.value : `${valExamenes},${e.target.value}`;
                $("#text_area_exman").val(valExamenes);
                handlerExamenCheckTrue(data);

            } else {
                valExamenes = valExamenes.replace(`${e.target.value}`, '');

                valExamenes = valExamenes.replace(',,', '');

                if (valExamenes[0] == ',') {
                    valExamenes = valExamenes.slice(1);
                }

                if (valExamenes.substring(valExamenes.indexOf() + 1) == "," || valExamenes.substring(valExamenes.indexOf() +
                        1) == ",,") {
                    $("#text_area_exman").val('');
                }

                $("#text_area_exman").val(valExamenes);
                handlerExamenCheckDelete(data);
                exams_array.splice(key, 1);
            }
            $('.inputSearchExamen').val('');
        }

        function setStudy(e, key, id) {

            let data_study = study.find(el => el.id == id);

            if ($(`#${e.target.id}`).is(':checked')) {
                studies_array.push({
                    code_studies: $(`#${e.target.id}`).data('code'),
                    description: $(`#${e.target.id}`).val(),

                });

                valStudios = (valStudios == "") ? e.target.value : `${valStudios},${e.target.value}`;
                $("#text_area_studies").val(valStudios);
                handlerStudiesCheckTrue(data_study);
            } else {
                valStudios = valStudios.replace(`${e.target.value}`, '');

                valStudios = valStudios.replace(',,', '');


                if (valStudios[0] == ',') {
                    valStudios = valStudios.slice(1);
                }
                if (valStudios.substring(valStudios.indexOf() + 1) == "," || valStudios.substring(valStudios.indexOf() +
                        1) == ",,") {
                    $("#text_area_studies").val('');
                }

                $("#text_area_studies").val(valStudios);
                studies_array.splice(key, 1);
                handlerStudiesCheckDelete(data_study);
            }
            $('.inputSearchStudi').val('');
        }

        //agregar medicamento
        function addMedacition(e) {

            // validaciones para agragar medicacion
            if ($('#medicine').val() === "") {
                $("#medicine_span").text('Campo obligatorio');
            } else if ($('#indication').val() === "") {
                $("#indication_span").text('Campo obligatorio');
            } else if ($('#treatmentDuration').val() === "") {
                $("#treatmentDuration_span").text('Campo obligatorio');
            } else {
                $("#medicine_span").text('');
                $("#indication_span").text('');
                $("#treatmentDuration_span").text('');

                let btn =
                    `<span onclick="deleteMedication(${countMedicationAdd})" ><i style="cursor: pointer" class="bi bi-x-circle-fill"></i></span>`;

                medications_supplements.push({
                    medicine: $('#medicine').val(),
                    indication: $('#indication').val(),
                    treatmentDuration: $('#treatmentDuration').val(),
                    btn: btn,
                    id: countMedicationAdd
                });


                new DataTable(
                    '#table-medicamento', {
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                        },
                        // reponsive: true,
                        bDestroy: true,
                        data: medications_supplements,
                        "searching": false,
                        "bLengthChange": false,
                        columns: [{
                                data: 'medicine',
                                title: 'Medicamento',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'indication',
                                title: 'Indicaciones',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'treatmentDuration',
                                title: 'Duración',
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
                $('#medicine').val("");
                $('#indication').val("");
                $('#treatmentDuration').val("");
            }


        }

        //borrar medicamento
        function deleteMedication(count) {
            Swal.fire({
                icon: 'warning',
                title: 'Desea realizar esta acción?',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
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

        function switch_type_plane(user) {

            switch (Number(user.type_plane)) {
                case 1:
                    if (Number(user.ref_counter) == 15) {

                        Swal.fire({
                            icon: 'warning',
                            title: '¡Su plan está en el límite de su capacidad de registro!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        });
                        return false;
                    }
                    break;
                case 2:
                    if (Number(user.ref_counter) == 75) {

                        Swal.fire({
                            icon: 'warning',
                            title: '¡Su plan está en el límite de su capacidad de registro!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
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

        function showAlertNotExam() {
            Swal.fire({
                icon: 'warning',
                title: 'No hay exámenes cargados',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar'
            });
            return false;
        }

        function showAlertNotStudy() {
            Swal.fire({
                icon: 'warning',
                title: 'No hay estudios cargados',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar'
            });
            return false;
        }

        const handlerIA = () => {

            if ($("#sintomas").val() !== "") {

                $(".send-ai").hide();
                $("#spinner2").show();

                $.ajax({
                    url: '{{ route('medicard_record_ia') }}',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "symtoms": $("#sintomas").val(),
                        "genere": patient.genere,
                        "age": patient.age
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
                            title: 'A ocurrido en error!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
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

        const triggerExample = async () => {

            try {
                await navigator.clipboard.writeText(response_data);
                $("#icon-copy").css("background", "#04AA6D");

                $("#copied").text('copiado!');

                setTimeout(function() {
                    $('#copied').hide();
                }, 2000);

            } catch (err) {
                console.error('Failed to copy: ', err);
                $("#copied").text('Error al copiar ');
            }
        }

        const setDatatable = (data) => {
            
            let row=[];

            data.map((elem) => {

                let route =
                    "{{ route('pdf_medical_prescription', ':id') }}";
                route
                    =
                    route
                    .replace(
                        ':id', elem
                        .id);

                elem.btn = `                                
                                                <a target="_blank"
                                                href="${route}">
                                                <button type="button"
                                                class="btn refresf btn-iSecond rounded-circle"><i
                                                class="bi bi-file-earmark-pdf"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                data-bs-custom-class="custom-tooltip"
                                                data-html="true" title="ver PDF"></i>
                                                </button>
                                                </a>
                                               `;

                elem.name = `${ elem.get_doctor.name} ${elem.get_doctor.last_name  }`
                row.push(elem);
            });          
            new DataTable(
                '#table-medical-report', {
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                    },
                    // reponsive: true,
                    bDestroy: true,
                    data: row,
                    "searching": false,
                    "bLengthChange": false,
                    columns: [{
                            data: 'cod_medical_report',
                            title: 'Código del informe',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'name',
                            title: 'Medico remitente',
                            className: "text-center td-pad",
                        },                      
                        {
                            data: 'date',
                            title: 'Fecha',
                            className: "text-center td-pad",
                        },                      
                        {
                            data: 'btn',
                            title: 'Ver',
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
                                    <i class="bi bi-person"></i> Datos del paciente
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
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
                                                <strong>Nombre Completo:</strong><span class="text-capitalize">
                                                    {{ $Patient->last_name . ', ' . $Patient->name }}</span>
                                                <br>
                                                <strong>Fecha de Nacimiento:</strong><span>
                                                    {{ date('d-m-Y', strtotime($Patient->birthdate)) }}</span>
                                                <br>
                                                <strong>Edad:</strong><span> {{ $Patient->age }} años</span>
                                                <br>
                                                <strong>{{ $Patient->is_minor === 'true' ? 'C.I del representante:' : 'C.I:' }}</strong>
                                                <span>
                                                    {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                                <br>
                                                <strong>Genero:</strong> <span class="text-capitalize">
                                                    {{ $Patient->genere }}</span>
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
                </div>
                {{-- consulta médica --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> Consulta médica
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse2 collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body m-mb">
                                    <form id="form-consulta" method="post" action="/">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medical_record_id" id="medical_record_id"
                                            value="">
                                        <input type="hidden" name="id" id="id" value="{{ $Patient->id }}">
                                        <div id="input-array"></div>
                                        <div class="row mt-2" style="margin: 0px 16px;">
                                            @if (Auth::user()->type_plane !== '7')
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="phone" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Centro
                                                                de salud</label>
                                                            <select name="center_id" id="center_id"
                                                                placeholder="Seleccione"class="form-control"
                                                                class="form-control combo-textbox-input">
                                                                <option value="">Seleccione</option>
                                                                @foreach ($doctor_centers as $item)
                                                                    <option value="{{ $item->center_id }}">
                                                                        {{ $item->get_center->description }}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="bi bi-hospital st-icon"></i>
                                                            <span id="type_alergia_span" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-style'
                                                style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; display:flex">
                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pr-5">
                                                    <div class="form-group">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Antecedentes</label>
                                                        <textarea id="background" rows="3" name="background" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pl-5">
                                                    <div class="form-group">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Razón
                                                            de la visita</label>
                                                        <textarea id="razon" rows="3" name="razon" class="form-control"></textarea>
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
                                                                Buscar Sintomas
                                                            </label>
                                                            <input onkeyup="search(event,'symptoms')" type="text"
                                                                style="border-radius: 30px;" class="form-control"
                                                                id="floatingInput" placeholder="">
                                                        </div>
                                                    </div>

                                                    <div id='symptoms_card3'
                                                        class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                        style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; margin-top: 0.5rem">
                                                        <div class="form-group">
                                                            <label for="phone" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Sintomas</label>
                                                            <textarea id="sintomas" rows="2" name="sintomas" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                    <div id='diagnosis_div' class="overflow-auto"
                                                        style="max-width: 100%; max-height: 40px; min-height: 40px; position: relative;">
                                                        <ul id="symptoms_filter" class="symptoms"
                                                            style="padding-inline-start: 0; display: flex; flex-wrap: wrap; display: none">
                                                        </ul>
                                                        <ul id="symptoms" class="symptoms"
                                                            style="padding-inline-start: 0; display: flex; flex-wrap: wrap; margin-top: 5px; margin-bottom: 0">
                                                        </ul>
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
                                                            class="btn btnSave">Consulta con inteligencia
                                                            artificial</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Diagnostico</label>
                                                    <textarea id="diagnosis" rows="2" name="diagnosis" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-style"
                                                style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; display: flex;">
                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pr-5">
                                                    <div
                                                        style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                            <div class="form-group" id='search_exam'
                                                                style="display: flex; align-items: center;">
                                                                <label for="search_patient"
                                                                    class="form-label"style="font-size: 13px; margin-bottom: 5px; width: 135px">Buscar
                                                                    Examen</label>
                                                                <input onkeyup="search(event,'exam')" type="text"
                                                                    style="border-radius: 30px;"
                                                                    class="form-control inputSearchExamen"
                                                                    id="floatingInput" placeholder="">
                                                            </div>
                                                            <label id='search_exam_p'
                                                                style="font-size: 13px; margin-bottom: 5px; display:none">Exámenes
                                                            </label>
                                                        </div>
                                                        <div id="exam-text-area">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                                style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="form-group">
                                                                    <label for="phone" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Exámenes</label>
                                                                    <textarea id="text_area_exman" rows="2" name="text_area_exman" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 overflow-auto"
                                                            style="max-width: 100%; max-height: 35px; min-height: 35px; position: relative;">
                                                            <ul id="exam_filter" class="exam"
                                                                style="padding-inline-start: 0; display: flex; flex-wrap: wrap; ; margin-bottom: 0;">
                                                            </ul>
                                                            <span id='not-exam'>No hay exámenes para mostrar de este
                                                                paciente </span>
                                                            <ul id="exam" class="exam"
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
                                                                    style="font-size: 13px; margin-bottom: 5px; width: 131px">Buscar
                                                                    Estudio</label>
                                                                <input onkeyup="search(event,'studie')" type="text"
                                                                    style="border-radius: 30px;"
                                                                    class="form-control inputSearchStudi" placeholder=""
                                                                    id="floatingInputt">
                                                            </div>
                                                        </div>
                                                        <label id='search_studie_p'
                                                            style="font-size: 13px; margin-bottom: 5px; display:none">Estudios
                                                        </label>
                                                        <div id="study-text-area">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                                id="study-text-area"
                                                                style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                                <div class="form-group">
                                                                    <label for="phone" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Estudios</label>
                                                                    <textarea id="text_area_studies" rows="2" name="text_area_studies" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 card-study overflow-auto"
                                                            style="max-width: 100%; max-height:35px;  min-height: 35px;">
                                                            <ul id="study_filter" class="studie"
                                                                style="padding-inline-start: 0; display: flex; flex-wrap: wrap; margin-bottom: 0;">
                                                            </ul>
                                                            <span id='not-studie'>No hay estudios para mostrar de este
                                                                paciente </span>
                                                            <ul id="studie" class="studie"
                                                                style="padding-inline-start: 0; display: flex; flex-wrap: wrap; margin-bottom: 0">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Medicacion --}}
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                                style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                <label style="font-size: 14px">Tratamiento</label>
                                                <hr style="margin-bottom: 0; margin-top: 5px">
                                                <div class="row medicine-form">
                                                    <div style="display: flex">
                                                        <span class="text-warning mt-2" id='med'
                                                            style="font-size: 14px;margin-right: 10px;"></span>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">Medicamento</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-only-text" id="medicine"
                                                                    placeholder="Se debe agregar un medicamento a la vez"
                                                                    name="medicine" type="text"
                                                                    style='font-size: 13px !important' value="">
                                                                <i class="bi bi-capsule st-icon"></i>
                                                            </div>
                                                            <span id="medicine_span" class="text-danger"></span>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 col-xxl-5 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">Indicaciones</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-only-text" id="indication"
                                                                    name="indication" type="text" value="">
                                                                <i class="bi bi-file-medical st-icon"></i>
                                                            </div>
                                                            <span id="indication_span" class="text-danger"></span>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="treatmentDuration" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Duración</label>
                                                                <select name="treatmentDuration" id="treatmentDuration"
                                                                    placeholder="Seleccione"class="form-control"
                                                                    class="form-control combo-textbox-input">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="1 Día">1 Día</option>
                                                                    <option value="2 Días">2 Días</option>
                                                                    <option value="3 Días">3 Días</option>
                                                                    <option value="4 Días">4 Días</option>
                                                                    <option value="5 Días">5 Días</option>
                                                                    <option value="6 Días">6 Días</option>
                                                                    <option value="7 Días">7 Días</option>
                                                                    <option value="1 Semana">1 Semana</option>
                                                                    <option value="2 Semanas">2 Semanas</option>
                                                                    <option value="3 Semanas">3 Semanas</option>
                                                                    <option value="4 Semanas">4 Semanas</option>
                                                                    <option value="1 Mes">1 Mes</option>
                                                                    <option value="2 Mes">2 Meses</option>
                                                                    <option value="3 Mes">3 Meses</option>
                                                                    <option value="1 Año">1 Año</option>
                                                                </select>
                                                                <i class="bi bi-calendar-range st-icon"></i>
                                                                <span id="treatmentDuration_span"
                                                                    class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-1 col-xl-1 col-xxl-1 mt-2"
                                                        style="display: flex; align-items: flex-end; margin-bottom: 3px;">
                                                        <span type="" onclick="addMedacition(event)"
                                                            class="btn btn-outline-secondary addMedacition" id="btn"
                                                            style="padding: 7px; font-size: 12px; width:100%">
                                                            <i class="bi bi-plus-lg"></i> Añadir
                                                        </span>
                                                    </div>
                                                </div>
                                                {{-- tabla --}}
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                                        style="margin-top: 20px; width: 100%;">
                                                        <table class="table table-striped table-bordered"
                                                            id="table-medicamento">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center w-35" scope="col">
                                                                        Medicamento </th>
                                                                    <th data-orderable="false" class="text-center w-55"
                                                                        scope="col"> Indicaciones </th>
                                                                    <th data-orderable="false" class="text-center"
                                                                        scope="col"> Duración </th>
                                                                    <th data-orderable="false" class="text-center w-4"
                                                                        scope="col"> <i style='font-size: 15px'
                                                                            class="bi bi-trash-fill"></i> </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                        <tfoot>
                                                            <div class="row mt-2" style="display: none">
                                                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                    <div class="input-group flex-nowrap">
                                                                        <span class="input-group-text">Total de
                                                                            medicamentos </span>
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
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 btn-mb"
                                                id="send"
                                                style="display: flex; justify-content: flex-end; padding-right: 30px;">
                                                <input class="btn btnSave send" value="Guardar Consulta" type="submit"
                                                    style="padding: 8px" />
                                                <button style="margin-left: 20px; padding: 8px;" type="button"
                                                    onclick="resetForm();" class="btn btnSecond LF-mb"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-html="true"
                                                    title="Limpiar Formulario">
                                                    <i class="bi bi-eraser"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- tabla --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingThree">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> Ultimas consultas
                                </button>
                            </span>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row" id="table-one">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                            style="margin-top: 20px;">
                                            <table id="table-medical-record" class="table table-striped table-bordered"
                                                style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">Código de la consulta</th>
                                                        <th class="text-center" scope="col">Código de la referencia
                                                        </th>
                                                        <th class="text-center" scope="col">Fecha de la consulta</th>
                                                        <th class="text-center" scope="col">Nombre del paciente</th>
                                                        <th class="text-center" scope="col">Género</th>
                                                        <th class="text-center" scope="col">Centro</th>
                                                        <th class="text-center" scope="col">Médico</th>
                                                        <th data-orderable="false" class="text-center" scope="col">Ver
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medical_record_user as $item)
                                                        <tr>
                                                            <td class="text-center td-pad"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['data']['record_code'] }}</td>
                                                            <td class="text-center td-pad"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['data']['cod_ref'] }}</td>
                                                            <td class="text-center td-pad"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['date'] }}</td>
                                                            <td class="text-center td-pad text-capitalize"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['name_patient'] }} </td>
                                                            <td class="text-center td-pad text-capitalize"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['genere'] }} </td>
                                                            <td class="text-center td-pad"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['center'] }}</td>
                                                            <td class="text-center td-pad text-capitalize"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['full_name_doc'] }} </td>
                                                            <td class="text-center td-pad">
                                                                <div class="d-flex">
                                                                    @if ($item['data']['status_exam'])
                                                                        <div
                                                                            class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <a
                                                                                href="{{ route('mr_exam', $item['patient_id']) }}">
                                                                                <button type="button"
                                                                                    class="btn refresf btn-iSecond rounded-circle"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true" title="ver exámenes">
                                                                                    <i class="i bi-card-heading"></i>
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <button type="button"
                                                                                class="refresf btn-idanger rounded-circle"
                                                                                onclick="showAlertNotExam();">
                                                                                <i class="bi bi-exclamation-lg"></i>
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    @if ($item['data']['status_study'])
                                                                        <div
                                                                            class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <a
                                                                                href="{{ route('mr_study', $item['patient_id']) }}">
                                                                                <button type="button"
                                                                                    class="btn refresf btn-iSecond rounded-circle"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true" title="ver estudios">
                                                                                    <i class="i bi-card-heading"></i>
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <button type="button"
                                                                                class="refresf btn-idanger rounded-circle"
                                                                                onclick="showAlertNotStudy();">
                                                                                <i class="bi bi-exclamation-lg"></i>
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    <div
                                                                        class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                        <a target="_blank"
                                                                            href="{{ route('pdf_medical_prescription', $item['id']) }}">
                                                                            <button type="button"
                                                                                class="btn refresf btn-iSecond rounded-circle"><i
                                                                                    class="bi bi-filetype-pdf"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="Ver recipe"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <div
                                                                        class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                        <a target="_blank"
                                                                            href="{{ route('PDF_medical_record', $item['id']) }}">
                                                                            <button type="button"
                                                                                class="btn refresf btn-iSecond rounded-circle"><i
                                                                                    class="bi bi-filetype-pdf"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true" title="ver PDF"></i>
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
                            <span class="accordion-header title" id="headingThree">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseInfome" aria-expanded="false" aria-controls="collapseInfome"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> Informes medicos
                                </button>
                            </span>
                            <div id="collapseInfome" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row" id="table-one">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <button style="font-size: 3rem" type="button" onclick="InformaMedico();"
                                                class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-html="true" title="Generar informe medico"><i
                                                    class="bi bi-plus-circle-dotted"></i>
                                            </button>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                            style="margin-top: 20px;">
                                            <table id="table-medical-report" class="table table-striped table-bordered"
                                                style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">Código del informe</th>
                                                        <th class="text-center" scope="col">Medico remitente </th>
                                                        <th class="text-center" scope="col">Fecha</th>
                                                        <th data-orderable="false" class="text-center" scope="col">Ver
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medical_report as $item)
                                                        <tr>
                                                            <td class="text-center td-pad">
                                                                {{ $item->cod_medical_report }}</td>
                                                            <td class="text-center td-pad">
                                                                {{ $item->get_doctor->name.' '.$item->get_doctor->last_name  }}</td>
                                                            <td class="text-center td-pad">
                                                                {{ $item->date }}</td>
                                                            <td class="text-center td-pad">
                                                                <a target="_blank"
                                                                    href="{{ route('PDF_medical_record', $item['id']) }}">
                                                                    <button type="button"
                                                                        class="btn refresf btn-iSecond rounded-circle"><i
                                                                            class="bi bi-filetype-pdf"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom"
                                                                            data-bs-custom-class="custom-tooltip"
                                                                            data-html="true" title="ver PDF"></i>
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

        <!-- Modal -->
        <div class="modal fade" id="modalIA" tabindex="-1" aria-labelledby="modalIALabel" aria-hidden="true"
            id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header title">
                            <i class="bi bi-alexa"></i>
                            <span style="padding-left: 5px">Resultado de la consulta con inteligencia artificial</span>
                            <button type="button" id="icon-copy" class="btn btn-iSecond rounded-circle"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Copiar diagnostico"
                                onclick="triggerExample();" style="margin-left: 5%;">
                                <i class="bi bi-file-earmark-text"></i>
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
        </div>

        <!-- Modal Informe medico -->
        <div class="modal fade" id="modalInformeMedico" tabindex="-1" aria-labelledby="modalInformeMedicoLabel"
            aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl InformeMedicomodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header title">
                            <i class="bi bi-alexa"></i>
                            <span style="padding-left: 5px">Informe medico</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="font-size: 12px;"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" id="form-informe-medico">

                                {{ csrf_field() }}

                                <div class="d-flex" style="align-items: center;">
                                    <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 90px;">
                                        <img src=" {{ $Patient->patient_img ? asset('/imgs/' . $Patient->patient_img) : ($Patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                            width="80" height="80" alt="Imagen del paciente"
                                            class="img-medical-modal">
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 data-medical">
                                        <strong>Nombre:</strong><span class="text-capitalize">
                                            {{ $Patient->last_name . ', ' . $Patient->name }}</span>
                                        <br>
                                        <strong>Edad:</strong><span> {{ $Patient->age }} años</span>
                                        <br>
                                        <strong>{{ $Patient->is_minor === 'true' ? 'C.I del representante:' : 'C.I:' }}</strong>
                                        <span>
                                            {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                    </div>
                                </div>

                                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" id="patient_id" name="patient_id" value="{{ $Patient->id }}">
                                <input type="hidden" id="medical_report_id" name="medical_report_id" value="">

                                @if (Auth::user()->type_plane !== '7')
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3"
                                        style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="phone" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Centro
                                                    de salud</label>
                                                <select name="center_id" id="center_id"
                                                    placeholder="Seleccione"class="form-control"
                                                    class="form-control combo-textbox-input">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($doctor_centers as $item)
                                                        <option value="{{ $item->center_id }}">
                                                            {{ $item->get_center->description }}</option>
                                                    @endforeach
                                                </select>
                                                <i class="bi bi-hospital st-icon"></i>
                                                <span id="type_alergia_span" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-3">
                                    <textarea id="TextInforme" name="TextInforme"></textarea>
                                </div>

                                <div class="row mt-2 justify-content-md-end">
                                    <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                        id="send"
                                        style="display: flex; justify-content: flex-end; padding-right: 30px;">
                                        <input class="btn btnSave send" value="Enviar" type="submit" />

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
