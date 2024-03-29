@extends('layouts.app-auth')
@section('title', 'Detalle Médico')
<style>
    ul {
        list-style-type: none;
    }

    .check-cm {
        padding: 5px 12px !important;
        border-radius: 20px !important;
        font-size: 13px;
    }

    .btn-outline-primary:checked+.btn,
    :not(.btn-outline-primary)+.btn:active,
    .btn:first-child:active,
    .btn.active,
    .btn.show {
        color: var(--bs-btn-active-color);
        background-color: #81d1d0 !important;
        border-color: #81d1d0 !important;
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
        background-color: #459594 !important;
        border-color: #459594 !important;
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

    @media only screen and (max-width: 390px) {
        .data-medical {
            width: 185px !important;
            font-size: 14px;
        }
    }

    @media (min-width: 391px) and (max-width: 576px) {
        .data-medical {
            width: 222px !important;
            font-size: 14px;
        }
    }
</style>
@push('scripts')
    <script>
        let valExams = '';
        let valStudy = '';
        let id = @json($id);
        let exams_array = [];
        let studies_array = [];
        let medications_supplements = [];
        let countMedicationAdd = 0;
        let exam_filter = [];
        let study_filter = [];

        let user = @json(Auth::user());

        $(document).ready(() => {
            switch_type_plane(user);

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            document.querySelectorAll('[data-bs-toggle="popover"]')
                .forEach(popover => {
                    new bootstrap.Popover(popover)
                })

            let doctor_centers = @json($doctor_centers);
            let validate_histroy = @json($validate_histroy);
            $('#not-exam').hide();
            $('#not-studie').hide();

            if ( user.type_plane !== '7' && doctor_centers.length === 0) {
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
                    // studies: {
                    //     required: true,
                    // },
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
                    // studies: {
                    //     required: "Estudios es obligatorio",
                    // },
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


            //envio del formulario
            $("#form-consulta").submit(function(event) {
                event.preventDefault();
                $("#form-consulta").validate();
                if(countMedicationAdd === 0) {
                    $("#med").html(`Debe agregar al menos un tratamiento <i style="font-size:18px; margin-top: 11px" class="bi bi-exclamation-triangle st-icon text-warning "></i>`);
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
                    // $("#indication").show();
                    // $("#treatmentDuration").show();
                    $("#center_id").attr('disabled', false);
                    $("#background").attr('disabled', false);
                    $("#razon").attr('disabled', false);
                    $("#diagnosis").attr('disabled', false);
                    $("#treatment").attr('disabled', false);
                    $(".addMedacition").show();
                    // $("#exams").attr('disabled', false);
                    // $("#studies").attr('disabled', false);
                    $('#form-consulta').find('input:checkbox').attr('checked', false);
                    exams_array = [];
                    studies_array = [];
                    medications_supplements = [];
                    $('#exam_filter').hide();
                    $('#study_filter').hide();
                    $('#exam').show();
                    $('#studie').show();
                    $('#not-exam').hide();
                    $('#not-studie').hide();
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
            // $("#exams").val(item.data.exams);
            // $("#studies").val(item.data.studies);
            $(".medicine-form").hide();
            // $("#indication").hide();
            // $("#treatmentDuration").hide();
            $(".addMedacition").hide();
            $('.send').attr('disabled', true);
            $('.btn-check').attr('disabled', true);
            $('#table-medicamento > tbody').empty();
            $('#exam_filter > ul').empty();
            $('#study_filter > ul').empty();
            exam_filter = [];
            study_filter = [];
            $('#exam').hide();
            $('#studie').hide();
            $('#exam_filter').show();
            $('#study_filter').show();
            item.data.medications_supplements.map((element, key) => {
                countMedicationAdd = countMedicationAdd + 1;
                var row = `
                        <tr id="${countMedicationAdd}">
                        <td class="text-center">${element.medicine}</td>
                        <td class="text-center">${element.indication}</td>
                        <td class="text-center">${element.treatmentDuration}</td>                  
                        <td class="text-center"><span><i class="bi bi-archive"></i></span></td>                    
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
            var value = e.target.value.toLowerCase();
            $(`#${id} li`).filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(e.target.value) > -1);
            });
        }

        function setExams(e, key) {
            if ($(`#${e.target.id}`).is(':checked')) {
                exams_array.push({
                    code_exams: $(`#${e.target.id}`).data('code'),
                    description: $(`#${e.target.id}`).val(),
                });
            } else {
                exams_array.splice(key, 1);
            }
        }

        function setStudy(e, key) {
            if ($(`#${e.target.id}`).is(':checked')) {
                studies_array.push({
                    code_studies: $(`#${e.target.id}`).data('code'),
                    description: $(`#${e.target.id}`).val(),

                });
            } else {
                studies_array.splice(key, 1);
            }
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

                let btn = `<span onclick="deleteMedication(${countMedicationAdd})" ><i class="bi bi-archive"></i></span>`;

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
                                title: 'Duración de tratamiento',
                                className: "text-center td-pad",
                            },
                            {
                                data: 'btn',
                                title: 'Eliminar',
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

    </script>
@endpush
@section('content')

    <div class="container-fluid" style="padding: 0 3% 3%">
        @if ($validate_histroy != null)
            <div class="accordion" id="accordionExample">
                {{-- datos del paciente --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person"></i></i> Datos del paciente
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 162px;">
                                            <img src=" {{ $Patient->patient_img ? asset('/imgs/' . $Patient->patient_img) : ($Patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                width="150" height="150" alt="Imagen del paciente" class="img-medical">
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
                {{-- consulta médica --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
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
                                <div class="accordion-body">
                                    <form id="form-consulta" method="post" action="/">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medical_record_id" id="medical_record_id"
                                            value="">
                                        <input type="hidden" name="id" id="id" value="{{ $Patient->id }}">
                                        <div id="input-array"></div>
                                        <div class="row">
                                            @if (Auth::user()->type_plane !=='7')                                                
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Centro de salud</label>
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
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Antecedentes</label>
                                                    <textarea id="background" rows="8" name="background" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Razón
                                                        de la visita</label>
                                                    <textarea id="razon" rows="8" name="razon" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Diagnóstico</label>
                                                    <textarea id="diagnosis" rows="8" name="diagnosis" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="search_patient"
                                                        class="form-label"style="font-size: 13px; margin-bottom: 5px;">Buscar
                                                        Examen</label>
                                                    <input onkeyup="search(event,'exam')" type="text"
                                                        class="form-control" id="floatingInput" placeholder="">
                                                </div>
                                                <div class="overflow-auto p-3 bg-light mt-3"
                                                    style="max-width: 100%; max-height: 245px; min-height: 245px ;position: relative;">
                                                    <ul id="exam_filter" class="exam"
                                                        style="padding-inline-start: 0; display: flex; flex-wrap: wrap;">
                                                    </ul>
                                                    <span id='not-exam'>No hay exámenes para mostrar de este paciente
                                                    </span>
                                                    <ul id="exam" class="exam"
                                                        style="padding-inline-start: 0; display: flex;
                                                    flex-wrap: wrap;">
                                                        @foreach ($exam as $key => $item)
                                                            <li style="margin-bottom: 10px; padding-right: 5px">
                                                                <input type="checkbox" class="btn-check"
                                                                    id="{{ $item->cod_exam }}"
                                                                    name="chk{{ $key }}" autocomplete="off"
                                                                    data-code="{{ $item->cod_exam }}"
                                                                    onclick="setExams(event,{{ $key }})"
                                                                    value="{{ $item->description }}">
                                                                <label class="btn btn-outline-primary check-cm"
                                                                    for="{{ $item->cod_exam }}">
                                                                    {{ $item->description }}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="search_patient"
                                                        class="form-label"style="font-size: 13px; margin-bottom: 5px;">Buscar
                                                        Estudio</label>
                                                    <input onkeyup="search(event,'studie')" type="text"
                                                        class="form-control" placeholder="" id="floatingInputt">
                                                </div>
                                                <div class="overflow-auto p-3 bg-light mt-3 card-study"
                                                    style="max-width: 100%; max-height: 245px;  min-height: 245px; position: relative;">
                                                    <ul id="study_filter" class="studie"
                                                        style="padding-inline-start: 0; display: flex; flex-wrap: wrap;">
                                                    </ul>
                                                    <span id='not-studie'>No hay estudios para mostrar de este paciente
                                                    </span>
                                                    <ul id="studie" class="studie"
                                                        style="display: flex; flex-wrap: wrap;">
                                                        @foreach ($study as $key => $item)
                                                            <li style="margin-bottom: 10px; padding-right: 5px">
                                                                <input type="checkbox" class="btn-check"
                                                                    autocomplete="off" name="chk{{ $key }}"
                                                                    id="{{ $item->cod_study }}"
                                                                    onclick="setStudy(event,{{ $key }})"
                                                                    data-code="{{ $item->cod_study }}"
                                                                    value="{{ $item->description }}">
                                                                <label class="btn btn-outline-success check-cm"
                                                                    for="{{ $item->cod_study }}">{{ $item->description }}</label><br>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Medicacion --}}
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <hr>
                                                <h5 style="margin-bottom: 17px;">Tratamiento</h5>
                                                <hr style="margin-bottom: 0;">
                                                <div class="row mt-3 medicine-form">
                                                    <div style="display: flex">
                                                        <span class="text-warning mt-3" id='med'
                                                            style="font-size: 14px;margin-right: 10px;"></span>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">Medicamento</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-only-text" id="medicine"
                                                                    name="medicine" type="text" value="">
                                                                <i class="bi bi-capsule st-icon"></i>
                                                            </div>
                                                            <span id="medicine_span" class="text-danger"></span>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
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
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="treatmentDuration" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Duración
                                                                    de tratamiento</label>
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
                                                    <div
                                                        class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3 offset-md-5">
                                                        <span type="" onclick="addMedacition(event)"
                                                            class="btn btn-outline-secondary addMedacition" id="btn"
                                                            style="padding: 7px"><i class="bi bi-plus-lg"></i>Añadir
                                                            Tratamiento</span>
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
                                                                    <th class="text-center" scope="col">
                                                                        Medicamento</th>
                                                                    <th class="text-center" scope="col">
                                                                        Indicaciones</th>
                                                                    <th class="text-center" scope="col">
                                                                        Duración de tratamiento
                                                                    </th>
                                                                    <th class="text-center" scope="col">
                                                                        Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                        <tfoot>
                                                            <div class="row mt-3" style="display: none">
                                                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                    <div class="input-group flex-nowrap">
                                                                        <span class="input-group-text">Total de
                                                                            medicamentos
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
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div id="spinner" style="display: none">
                                                    <x-load-spinner show="true" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 justify-content-md-end">
                                            <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                id="send" style="display: flex; justify-content: flex-end;">
                                                <input class="btn btnSave send" value="Guardar Consulta"
                                                    type="submit" />
                                                <button style="margin-left: 20px; padding: 8px;" type="button"
                                                    onclick="resetForm();" class="btn btnSecond" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" data-html="true"
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
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3 mb-cd" style="margin-top: 20px;">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingThree">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> Ultimas Consultas
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
                                                        <th class="text-center" scope="col">Ver</th>
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
                                                                {{ $item['name_patient'] }}
                                                            </td>
                                                            <td class="text-center td-pad text-capitalize"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['genere'] }}
                                                            </td>
                                                            <td class="text-center td-pad"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['center'] }}</td>
                                                            <td class="text-center td-pad text-capitalize"
                                                                onclick="showDataEdit({{ json_encode($item) }});">
                                                                {{ $item['full_name_doc'] }}
                                                            </td>
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
            </div>
        @endif
    </div>
@endsection
