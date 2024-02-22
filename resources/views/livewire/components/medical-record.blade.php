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
        height: 60px;
    }

    .pre-textarea {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        background-color: #f1f1f1;
        padding: 10px;
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
        let countVitalSigns = 0;


        $(document).ready(() => {
            $("#diagnosis-text").hide();
            $("#background-text").hide();
            $("#razon-text").hide();
            $("#sintomas-text").hide();
            $("#exman-text").hide();
            $("#studies-text").hide();

           

            tinymce.init({
                selector: '#TextInforme',
                skin: false,
                content_css: false,
                valid_elements: "p,a[href|target=_blank],div[style]",
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
                    conut_vital_sing: {
                        required: true,
                    },
                    center_id: {
                        required: true,
                    }
                },
                messages: {
                    center_id: {
                        required: "Campo Obligatorio",
                    },
                    weight: {
                        required: "Campo Obligatorio",
                    },
                    height: {
                        required: "Campo Obligatorio",
                    },
                    strain: {
                        required: "Campo Obligatorio",
                    },
                    strain_two: {
                        required: "Campo Obligatorio",
                    },
                    temperature: {
                        required: "Campo Obligatorio",
                    },
                    breaths: {
                        required: "Campo Obligatorio",
                    },
                    pulse: {
                        required: "Campo Obligatorio",
                    },

                    saturation: {
                        required: "Campo Obligatorio",
                    },
                    condition: {
                        required: "Campo Obligatorio",
                    },
                    observations: {
                        required: "Campo Obligatorio",
                    },
                    conut_vital_sing: {
                        required: "Debe seleccionar un signo vital",
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
                                title: 'Operacion exitosa!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
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
    
            autoTextarea('background');
            autoTextarea('sintomas');
            autoTextarea('razon');
            autoTextarea('diagnosis');
            autoTextarea('text_area_exman');
            autoTextarea('text_area_studies');
            autoTextarea('observations');

        });

        const resetForm = () => {
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
                    $("#background").show();
                    $("#background-text").hide();
                    $("#razon").show();
                    $("#razon-text").hide();
                    $("#sintomas").show();
                    $("#sintomas-text").hide();
                    $("#text_area_exman").show();
                    $("#exman-text").hide();
                    $("#text_area_studies").show();
                    $("#studies-text").hide();
                }
            });


        }

        const showDataEdit = (item, active = true) => {
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

            $("#diagnosis").hide();
            $("#diagnosis-text").show().text(item.data.diagnosis);
            $("#background").hide();
            $("#background-text").show().text(item.data.background);
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

                if (valSymptoms.substring(valSymptoms.indexOf() + 1) == "," || valSymptoms.substring(valSymptoms
                        .indexOf() +
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

                if (valExamenes.substring(valExamenes.indexOf() + 1) == "," || valExamenes.substring(valExamenes
                        .indexOf() +
                        1) == ",,") {
                    $("#text_area_exman").val('');
                }

                $("#text_area_exman").val(valExamenes);
                handlerExamenCheckDelete(data);
                exams_array.splice(key, 1);
            }
            $('.inputSearchExamen').val('');
        }

        const setStudy = (e, key, id) => {

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
        const addMedacition = (e) => {

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
        const deleteMedication = (count) => {
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

        const switch_type_plane = (user) => {

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

        const showAlertNotExam = () => {
            Swal.fire({
                icon: 'warning',
                // iconHtml: `<img width="150" height="auto" src="{{ asset('/img/icons/no-file.png') }}" alt="avatar">`,
                title: 'No hay exámenes cargados',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar',
                // customClass: {
                //     icon: 'no-border'
                // }
            });
            return false;
        }

        const showAlertNotStudy = () => {
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

        function handleObservaciones(item) {

            $('#modalObservations').modal("show");
            $("#p-Observations").text(item.observations);
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
                        title="Ver informe">
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
                            className: "text-center td-pad w-10",
                        },
                        {
                            data: 'btn',
                            title: 'Ver',
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

        const handlerVitalSigns = (e) => {
            if ($(`#${e.target.id}`).is(':checked')) {
                $(`#${e.target.id}`).val(1);
                countVitalSigns = countVitalSigns + 1;
                $('#conut_vital_sing').val(countVitalSigns);
            } else {
                $(`#${e.target.id}`).val(null);
                countVitalSigns = countVitalSigns - 1;

                if (countVitalSigns == 0) {
                    $('#conut_vital_sing').val('');
                }
            }
        }

        const setDatatableExamenFisico = (data) => {

            let signosVitales = "";

            let row = []

            data.map((item) => {

                let elemData = JSON.stringify(item);
                let signosVitales = '';
                let eupenio = '';
                let febril = '';
                let esfera_neurologica = '';
                let glasgow = '';
                let esfera_cardiopulmonar = '';
                let esfera_abdominal = '';
                let extremidades = '';
                let esfera_orl = '';
                let hidratado = '';

                if (item.hidratado) {
                hidratado = 'Hidratado';
                } 
                if (item.eupenio) {
                eupenio = ',Eupenio';
                } 
                if (item.febril) {
                febril = ',Febril';
                } 
                if (item.esfera_neurologica) {
                esfera_neurologica = 'Enfera Neurologica';
                } 
                if (item.glasgow) {
                glasgow = ',Glasgow';
                } 
                if (item.esfera_orl) {
                esfera_orl = ',Esfera oral';
                } 
                if (item.esfera_cardiopulmonar) {
                esfera_cardiopulmonar = 'Cardio Pulmorar';
                } 
                if (item.esfera_abdominal) {
                esfera_abdominal = ',Esfera Abdominal';
                } 
                if (item.extremidades) {
                extremidades = ',Extremidades';
                }               

                item.signos_vitales = `${hidratado}${eupenio}${febril}${esfera_neurologica}${glasgow}${esfera_orl}${esfera_cardiopulmonar}${esfera_abdominal}${extremidades}`

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
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                    },
                    // reponsive: true,
                    bDestroy: true,
                    data: row,
                    "searching": false,
                    "bLengthChange": false,
                    columns: [{
                            data: 'get_center.description',
                            title: 'Centro de salud',
                            className: "text-center td-pad w-30",
                        },
                        {
                            data: 'date',
                            title: 'Fecha',
                            className: "text-center td-pad w-10",
                        },
                        {
                            data: 'weight',
                            title: 'Peso',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'height',
                            title: 'Altura',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'strain' + 'strain_two',
                            title: 'Presión arterial',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'temperature',
                            title: 'Temperatura',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'breaths',
                            title: 'Respiraciones',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'pulse',
                            title: 'Pulso',
                            className: "text-center td-pad",
                        },
                        {
                            data: 'saturation',
                            title: 'Saturación',
                            className: "text-center td-pad",
                        },
                        // {
                        //     data: 'condition',
                        //     title: 'Condición general',
                        //     className: "text-center td-pad",
                        // },
                        // {
                        //     data: 'signos_vitales',
                        //     title: 'Signos vitales',
                        //     className: "text-center td-pad",
                        // },
                        {
                            data: `btn`,
                            title: 'Observación',
                            className: "text-center td-pad",
                        }
                    ],
                });
        }

        (function() {
            
            
        })

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
                                <button class="accordion-button bg-5"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne"
                                    aria-expanded="true"
                                    aria-controls="collapseOne"
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
                                                <strong>@lang('messages.ficha_paciente.nombre'):</strong><span class="text-capitalize">
                                                    {{ $Patient->last_name . ', ' . $Patient->name }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.fecha_nacimiento'):</strong><span>
                                                    {{ date('d-m-Y', strtotime($Patient->birthdate)) }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.edad'):</strong><span> {{ $Patient->age }} años</span>
                                                <br>
                                                <strong>{{ $Patient->is_minor === 'true' ? 'C.I del representante:' : 'C.I:' }}</strong>
                                                <span>
                                                    {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.genero'):</strong> <span class="text-capitalize">
                                                    {{ $Patient->genere }}</span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.nro_historias'):</strong><span>
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

                {{-- Examen fisico --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button collapsed bg-5"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo"
                                    aria-expanded="true"
                                    aria-controls="collapseTwo"
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
                                                    <span class="text-warning mt-2" id="EF"
                                                        style="font-size: 15px;margin-right: 10px;"></span>
                                                </div>

                                                @if (Auth::user()->type_plane !== '7')
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.centro_salud')</label>
                                                                <select name="center_id" id="center_id"
                                                                    placeholder="Seleccione"class="form-control"
                                                                    class="form-control combo-textbox-input">
                                                                    <option value="">@lang('messages.label.seleccione')</option>
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
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="weight" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.peso')
                                                                    </label>
                                                                    <input autocomplete="off" class="EF mask-input form-control"
                                                                        id="weight" name="weight" type="text"
                                                                        onchange="handlerValidate(event,'age');" value="">
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
                                                                        onchange="handlerValidate(event,'height');" value="">
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
                                                                    placeholder="Sistólica 50 - 250" onchange="handlerValidate(event,'strain');"
                                                                    aria-label="strain" value="">
                                                                <span class="input-group-text span-input">/</span>
                                                                <input type="text" name="strain_two" id="strain_two"
                                                                    onchange="handlerValidate(event,'strain_two');"
                                                                    class="EF form-control mask-input-two input-border"
                                                                    placeholder="Diastólica 30 - 150" aria-label="strain" value="">
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
                                                                        id="temperature" name="temperature" type="text"
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
                                                                        onchange="handlerValidate(event,'breaths');" id="breaths"
                                                                        name="breaths" type="text" maxlength="3" value="">
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
                                                                        onchange="handlerValidate(event,'pulse');" id="pulse"
                                                                        name="pulse" type="text" maxlength="3" value="">
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach ($vital_sing as $item)
                                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                        <div style="display: flex">
                                                            <span class="text-warning mt-2" id="VS"
                                                                style="font-size: 15px;margin-right: 10px;"></span>
                                                        </div>
                                                        <div class="floating-label-group">
                                                            <div class="form-check" style="display: flex; ">
                                                                <div style="margin-right: 30px;">
                                                                    <input onclick="handlerVitalSigns(event);"
                                                                        class="form-check" name="{{ $item->name }}"
                                                                        type="checkbox" id="{{ $item->name }}"
                                                                        value="">
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

                                                <input type="hidden" name="conut_vital_sing" id="conut_vital_sing" value="">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                                        <div class="form-group">
                                                            <label for="observations" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.observaciones')</label>
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
                                                    id="send"
                                                    style="display: flex; justify-content: flex-end;">
                                                    <input class="btn btnSave send" value="@lang('messages.botton.guardar')" type="submit" style="padding: 8px" />
                                                </div>
                                            </div>
                                        </form>

                                        <div class="row mt-3">

                                            <hr>
                                            <h5> Historial de @lang('messages.acordion.examen_fisico')</h5>
                                            <hr>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                                style="margin-top: 20px;">
                                                <table id="table-examen-fisico" class="table table-striped table-bordered"
                                                    style="width:100%; ">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center w-30" scope="col">Centro de salud</th>
                                                            <th class="text-center w-10" scope="col">Fecha</th>
                                                            <th class="text-center" scope="col" data-orderable="false">Peso</th>
                                                            <th class="text-center" scope="col" data-orderable="false">Altura</th>
                                                            <th class="text-center" scope="col" data-orderable="false">Presion arterial</th>
                                                            <th class="text-center" scope="col" data-orderable="false">Temperatura</th>
                                                            <th class="text-center" scope="col" data-orderable="false">Respiraciones</th>
                                                            <th class="text-center" scope="col" data-orderable="false">Pulso</th>
                                                            <th class="text-center" scope="col" data-orderable="false">Saturación</th>
                                                            {{-- <th class="text-center" scope="col">Condición general</th> --}}
                                                            {{-- <th class="text-center" scope="col">Signos vitales</th> --}}
                                                            <th class="text-center w-5" scope="col" data-orderable="false">Observación</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php                                                        
                                                                    $signosVitales = '';
                                                                    $eupenio = '';
                                                                    $febril = '';
                                                                    $esfera_neurologica = '';
                                                                    $glasgow = '';
                                                                    $esfera_cardiopulmonar = '';
                                                                    $esfera_abdominal = '';
                                                                    $extremidades = '';
                                                                    $esfera_orl = '';
                                                        @endphp

                                                        @foreach ($physical_exams as $item)
                                                            <tr>
                                                                <td class="text-center td-pad"> {{ $item->get_center->description }}</td>
                                                                <td class="text-center td-pad"> {{ $item->date }} </td>
                                                                <td class="text-center td-pad"> {{ $item->weight }} </td>
                                                                <td class="text-center td-pad"> {{ $item->height }} </td>
                                                                <td class="text-center td-pad"> {{ $item->strain }}</td>
                                                                <td class="text-center td-pad"> {{ $item->temperature }}</td>
                                                                <td class="text-center td-pad"> {{ $item->breaths }}</td>
                                                                <td class="text-center td-pad"> {{ $item->pulse }}</td>
                                                                <td class="text-center td-pad"> {{ $item->saturation }}</td>
                                                                {{-- <td class="text-center td-pad"> {{ $item->condition }}</td> --}}
                                                                {{-- @php
                                                                    if ($item->hidratado) {
                                                                        $hidratado = 'Hidratado';
                                                                    } 
                                                                    if ($item->eupenio) {
                                                                        $eupenio = ',Eupenio';
                                                                    } 
                                                                    if ($item->febril) {
                                                                        $febril = ',Febril';
                                                                    } 
                                                                    if ($item->esfera_neurologica) {
                                                                        $esfera_neurologica = 'Enfera Neurologica';
                                                                    } 
                                                                    if ($item->glasgow) {
                                                                        $glasgow = ',Glasgow';
                                                                    } 
                                                                    if ($item->esfera_orl) {
                                                                        $esfera_orl = ',Esfera oral';
                                                                    } 
                                                                    if ($item->esfera_cardiopulmonar) {
                                                                        $esfera_cardiopulmonar = 'Cardio Pulmorar';
                                                                    } 
                                                                    if ($item->esfera_abdominal) {
                                                                        $esfera_abdominal = ',Esfera Abdominal';
                                                                    } 
                                                                    if ($item->extremidades) {
                                                                        $extremidades = ',Extremidades';
                                                                    }
                                                                @endphp
                                                                <td class="text-center td-pad">
                                                                    {{ $hidratado.$eupenio.$febril.$esfera_neurologica.$glasgow.$esfera_orl.$esfera_cardiopulmonar.$esfera_abdominal.$extremidades }}
                                                                </td> --}}
                                                                {{-- <td class="text-center td-pad"> {{ $item->observations }}</td> --}}
                                                                <td class="text-center td-pad">
                                                                    <button onclick='handleObservaciones({{ $item }})'>
                                                                        <img width="25" height="auto"
                                                                        src="{{ asset('/img/icons/justify.png') }}"
                                                                        alt="avatar"
                                                                        type="button"
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
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingThree">
                                <button class="accordion-button collapsed bg-5" 
                                    type="button" 
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" 
                                    aria-expanded="false" 
                                    aria-controls="collapseThree"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> @lang('messages.acordion.consulta_medica')
                                </button>
                            </span>
                            <div id="collapseThree" class="accordion-collapse2 collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body m-mb">
                                    <form id="form-consulta" method="post" action="/">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medical_record_id" id="medical_record_id" value="">
                                        <input type="hidden" name="id" id="id" value="{{ $Patient->id }}">
                                        <div id="input-array"></div>
                                        <div class="row mt-2" style="margin: 0px 16px;">
                                            @if (Auth::user()->type_plane !== '7')
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.centro_salud')</label>
                                                            <select name="center_id" id="center_id"
                                                                placeholder="Seleccione"class="form-control"
                                                                class="form-control combo-textbox-input">
                                                                <option value="">@lang('messages.label.seleccione')</option>
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
                                            <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-style' style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; display:flex">
                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pr-5">
                                                    <div class="form-group">
                                                        <label for="background" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.antecedentes')</label>
                                                        <textarea id="background" rows="1" name="background" class="form-control"></textarea>
                                                        <pre class="pre-textarea"
                                                            style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"
                                                            id="background-text"></pre>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pl-5">
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
                                                    <div  class="btn-search-s col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
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

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-style"
                                                style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px; display: flex;">
                                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pr-5">
                                                    <div
                                                        style="border: 0.5px solid #4595948c; box-shadow: 0px 0px 3px 0px rgba(66,60,60,0.55); border-radius: 9px; padding: 16px;">
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
                                                                <img width="50" height="auto"
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
                                                                    style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.medicamento')</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-only-text" id="medicine"
                                                                    placeholder="@lang('messages.placeholder.info_1')" name="medicine"
                                                                    type="text" value="">
                                                                <i class="bi bi-capsule st-icon"></i>
                                                            </div>
                                                            <span id="medicine_span" class="text-danger"></span>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 col-xxl-5 mt-2">
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
                                                    <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mt-2">
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
                                                                    <option value="@lang('messages.select.7_dia')">@lang('messages.select.7_dia')
                                                                    </option>
                                                                    <option value="@lang('messages.select.1_semana')">@lang('messages.select.1_semana')
                                                                    </option>
                                                                    <option value="@lang('messages.select.2_semana')">@lang('messages.select.2_semana')
                                                                    </option>
                                                                    <option value="@lang('messages.select.3_semana')">@lang('messages.select.3_semana')
                                                                    </option>
                                                                    <option value="@lang('messages.select.4_semana')">@lang('messages.select.4_semana')
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
                                                    <div class="col-sm-6 col-md-6 col-lg-1 col-xl-1 col-xxl-1 mt-2"
                                                        style="display: flex; align-items: flex-end; margin-bottom: 3px;">
                                                        <span type="" onclick="addMedacition(event)"
                                                            class="btn btn-outline-secondary addMedacition" id="btn"
                                                            style="padding: 7px; font-size: 12px; width:100%">
                                                            <i class="bi bi-plus-lg"></i> @lang('messages.botton.añadir')
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
                                                                        @lang('messages.tabla.medicamento') </th>
                                                                    <th data-orderable="false" class="text-center w-55"
                                                                        scope="col"> @lang('messages.tabla.indicaciones') </th>
                                                                    <th data-orderable="false" class="text-center"
                                                                        scope="col"> @lang('messages.tabla.duracion') </th>
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
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 btn-mb"
                                                id="send"
                                                style="display: flex; justify-content: flex-end; padding-right: 30px;">
                                                <input class="btn btnSave send" value="@lang('messages.botton.guardar')" type="submit"
                                                    style="padding: 8px" />
                                                <button style="margin-left: 20px;" type="button" onclick="resetForm();"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-html="true"
                                                    title="Limpiar Formulario">
                                                    <img width="32" height="auto"
                                                        src="{{ asset('/img/icons/eraser.png') }}" alt="avatar">
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row" id="table-one">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive" style="margin-top: 20px;">
                                            <table id="table-medical-record" class="table table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-8" scope="col">@lang('messages.tabla.id_consulta')</th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha') </th>
                                                        <th class="text-center" scope="col">@lang('messages.tabla.medico_tratante')</th>
                                                        <th class="text-center w-30" scope="col">@lang('messages.tabla.centro_salud') </th>
                                                        <th data-orderable="false" class="text-center w-20" scope="col">@lang('messages.tabla.acciones') </th>
                                                        {{-- <th class="text-center" scope="col">Código de la referencia </th> --}}
                                                        {{-- <th class="text-center" scope="col">Nombre del paciente</th> --}}
                                                        {{-- <th class="text-center" scope="col">Género</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medical_record_user as $item)
                                                        <tr>
                                                            <td class="text-center td-pad" onclick="showDataEdit({{ json_encode($item) }});"> {{ $item['data']['record_code'] }}</td>
                                                            <td class="text-center td-pad" onclick="showDataEdit({{ json_encode($item) }});"> {{ $item['date'] }}</td>
                                                            <td class="text-center td-pad text-capitalize" onclick="showDataEdit({{ json_encode($item) }});">Dr. {{ $item['full_name_doc'] }} </td>
                                                            <td class="text-center td-pad"  onclick="showDataEdit({{ json_encode($item) }});"> {{ $item['center'] }}</td>
                                                            {{-- <td class="text-center td-pad"  onclick="showDataEdit({{ json_encode($item) }});"> {{ $item['data']['cod_ref'] }}</td> --}}
                                                            {{-- <td class="text-center td-pad text-capitalize" onclick="showDataEdit({{ json_encode($item) }});"> {{ $item['name_patient'] }} </td> --}}
                                                            {{-- <td class="text-center td-pad text-capitalize"  onclick="showDataEdit({{ json_encode($item) }});"> {{ $item['genere'] }} </td> --}}
                                                            <td class="text-center td-pad">
                                                                <div class="d-flex">
                                                                    @if ($item['data']['status_exam'])
                                                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <a href="{{ route('mr_exam', $item['patient_id']) }}">
                                                                                <button type="button"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="@lang('messages.tooltips.ver_examenes')">
                                                                                    <img width="32" height="auto"
                                                                                        src="{{ asset('/img/icons/doc.png') }}"
                                                                                        alt="avatar">
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <button type="button"
                                                                                onclick="showAlertNotExam();">
                                                                                <img width="32" height="auto"
                                                                                    src="{{ asset('/img/icons/not-file-icon.png') }}"
                                                                                    alt="avatar">
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    @if ($item['data']['status_study'])
                                                                        <div
                                                                            class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <a
                                                                                href="{{ route('mr_study', $item['patient_id']) }}">
                                                                                <button type="button"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="@lang('messages.tooltips.ver_estudios')">
                                                                                    <img width="32" height="auto"
                                                                                        src="{{ asset('/img/icons/doc.png') }}"
                                                                                        alt="avatar">
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                            <button type="button"
                                                                                onclick="showAlertNotStudy();">
                                                                                <img width="32" height="auto"
                                                                                    src="{{ asset('/img/icons/not-file-icon.png') }}"
                                                                                    alt="avatar">
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    <div
                                                                        class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                        <a target="_blank"
                                                                            href="{{ route('pdf_medical_prescription', $item['id']) }}">
                                                                            <button type="button">
                                                                                <img width="32" height="auto"
                                                                                    src="{{ asset('/img/icons/pdf-file.png') }}"
                                                                                    alt="avatar"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="@lang('messages.tooltips.ver_orden_medica')">
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <div
                                                                        class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                        <a target="_blank"
                                                                            href="{{ route('PDF_medical_record', $item['id']) }}">
                                                                            <button type="button">
                                                                                <img width="32" height="auto"
                                                                                    src="{{ asset('/img/icons/pdf-file.png') }}"
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
                            <div id="collapseInfome" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row" id="table-one">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <button style="font-size: 3rem" type="button" onclick="InformaMedico();"
                                                class="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-html="true" title="@lang('messages.tooltips.generar_informe')"><i
                                                    class="bi bi-plus-circle-dotted"></i>
                                            </button>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive" style="margin-top: 20px;">
                                            <table id="table-medical-report" class="table table-striped table-bordered"
                                                style="width:100%; ">
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
                                                                <a target="_blank"
                                                                    href="{{ route('PDF_informe_medico', $item->id) }}">
                                                                    <button type="button">
                                                                        <img width="32" height="auto"
                                                                        src="{{ asset('/img/icons/pdf-file.png') }}"
                                                                        alt="avatar"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-placement="bottom"
                                                                        data-bs-custom-class="custom-tooltip"
                                                                        data-html="true"
                                                                        title="@lang('messages.tooltips.ver_informe')">
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
        <div class="modal fade" id="modalIA" tabindex="-1" aria-labelledby="modalIALabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
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

        <!-- Modal Observaciones -->
        <div class="modal fade" id="modalObservations" tabindex="-1" aria-labelledby="modalObservationsLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header title">
                        <i class="bi bi-alexa"></i>
                        <span style="padding-left: 5px">Observaciones</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
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
        <div class="modal fade" id="modalInformeMedico" tabindex="-1" aria-labelledby="modalInformeMedicoLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div id="spinner3" style="display: none">
                <x-load-spinner show="true" />
            </div>
            <div class="modal-dialog modal-dialog-centered modal-xl InformeMedicomodal">
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
@endsection
