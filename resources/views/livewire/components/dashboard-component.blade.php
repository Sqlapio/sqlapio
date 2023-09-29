@extends('layouts.app-auth')
@section('title', 'Tablero')
@vite(['resources/js/graphicCountAll.js', 'resources/js/dairy.js'])
<style>

    body {
        font-size: 15px !important;

    }

</style>
@push('scripts')
    <script>
        let countPatientRegister = @json($count_patient_register);
        let countMedicalRecordr = @json($count_medical_recordr);
        let countHistoryRegister = @json($count_history_register);
        let count_patient_genero = @json($count_patient_genero);
        let elderly = @json($elderly);
        let boy_girl = @json($boy_girl);
        let teen = @json($teen);
        let adult = @json($adult);
        let urlPost;
        let count = 0;
        let exams_array = [];
        let studies_array = [];
        let row = ""

        $(document).ready(() => {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });
            get_patient_register(countPatientRegister);
            get_medical_record(countMedicalRecordr);
            get_history_register(countHistoryRegister);
            get_genere(boy_girl, teen);
            get_general(elderly, adult);
            //validar formulario
            $('#form-load-img').validate({
                ignore: [],
                rules: {
                    img: {
                        required: true,
                    },
                    count: {
                        required: true,
                    }
                },
                messages: {
                    img: {
                        required: 'Debe cargar un Archivo',
                    },
                    count: {
                        required: 'Debe selecionar un resultado',
                    }
                }
            });

            //envio del formulario
            $("#form-load-img").submit(function(event) {
                event.preventDefault();
                $("#form-load-img").validate();
                if ($("#form-load-img").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    //preparar la data para el envio
                    let formData = $('#form-load-img').serializeArray();
                    let data = {};
                    formData.map((item) => data[item.name] = item.value);
                    data["exams_array"] = JSON.stringify(exams_array);
                    data["studies_array"] = JSON.stringify(studies_array);
                    ////end
                    $.ajax({
                        url: urlPost,
                        type: 'POST',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data": JSON.stringify(data),
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-load-img").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: 'Centro registrado exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                $('#ModalLoadResult').modal('toggle');
                                $("#content-table-ref").hide();
                                $('#search_person').val('');
                                get_data_table()
                            });
                        },
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Click para salir'
                                }).then((result) => {
                                    $('#send').show();
                                    $('#spinner').hide();
                                });
                            });
                        }
                    });
                }
            })

        });

        function showModal(item, active, info) {
            count = 0;
            $('#count').val('');
            $('.holder').hide();
            $('#code_ref').val(item.cod_ref);
            $('#img').val('');
            $('#ModalLoadResult').modal('show');
            $('#table-info').find('tbody').empty();
            if (active == 0) {
                urlPost = '{{ route('upload_result_exam') }}';
                $('.modal-title').text('Examen del Paciente');
                info.map((elemt, index) => {
                    let elemData = JSON.stringify(elemt);
                    let label =
                        `<label><input type="checkbox" id="cod_exam_${index}" onclick='cuontResul(event,${elemData},0,${index});'></label>`
                    if (Number(elemt.status) === 2) {
                        label =
                            `<div  class="pad"><i class="bi bi-check-circle-fill" style="color: #239B56;"></i></div>`
                    }
                    let row = `
                        <tr>
                        <td class="text-center">${elemt.cod_exam}</td>
                        <td class="text-center">${elemt.description}</td>     
                        <td class="text-center">${label}</td>                
                        </tr>`;
                    $('#table-info').find('tbody').append(row);
                });
            } else {
                urlPost = '{{ route('upload_result_study') }}';
                $('.modal-title').text('Información del Estudios');
                info.map((elemt, index) => {
                    let elemData = JSON.stringify(elemt);
                    let label =
                        `<label><input type="checkbox"  id="cod_exam_${index}" onclick='cuontResul(event,${elemData},1,${index});'></label>`
                    if (Number(elemt.status) === 2) {
                        label =
                            `<div  class="prueba"><i class="bi bi-check-circle-fill" style="color: #239B56;"></i></div>`
                    }
                    let row = `
                        <tr>
                        <td class="text-center">${elemt.cod_study}</td>
                        <td class="text-center">${elemt.description}</td>     
                        <td class="text-center">${label}</label></td>                
                        </tr>`;
                    $('#table-info').find('tbody').append(row);
                });
            }
            $('#ref').text(item.cod_ref);
            $('#id').val(item.id);
            $('#ref-pat').text(`${item.get_patient.name} ${item.get_patient.last_name}`);
        }

        function cuontResul(e, item, type, key) {
            if (type == 0) {
                if ($(`#${e.target.id}`).is(':checked')) {
                    exams_array.push({
                        cod_exam: item.cod_exam
                    });
                    count = count + 1;
                    $('#count').val(count);
                } else {
                    exams_array.splice(key, 1);
                    count = count - 1;
                    $('#count').val(count);
                    if (count === 0) $('#count').val('');
                }
            } else {
                if ($(`#${e.target.id}`).is(':checked')) {
                    studies_array.push({
                        cod_study: item.cod_study
                    });
                    count = count + 1;
                    $('#count').val(count);
                } else {
                    studies_array.splice(key, 1);
                    count = count - 1;
                    $('#count').val(count);
                    if (count === 0) $('#count').val('');
                }
            }
        }

        function refreshTable(datatable) {
            let route = "{{ route('PDF_ref', ':id') }}";
            route = route.replace(':id', datatable.id);
            let get_exam = JSON.stringify(datatable.get_exam);
            let get_studie = JSON.stringify(datatable.get_studie);
            let elemetData = JSON.stringify(datatable);
            datatable.btn =
                `<button  onclick='showModal(${ elemetData },0,${ get_exam })'                         
                                data-bs-toggle='tooltip' data-bs-placement='right'
                                data-bs-custom-class='custom-tooltip' data-html='true'
                                title='Ver examenes' type='button' class='btn-2 btnPrimary'>
                                <i class='bi bi-info-circle-fill'></i>
                                </button>`;
            datatable.btn1 =
                `<button onclick='showModal(${ elemetData },1,${ get_studie } )' 
                            data-bs-toggle='tooltip' data-bs-placement='right'
                            data-bs-custom-class='custom-tooltip' data-html='true'
                            title='Ver estudios' type='button' class='btn-2 btnPrimary'>
                            <i class='bi bi-info-circle-fill'></i>
                    </button>`;

            datatable.btn2 =
                ` <a target='_blank' href='${route}'>
                        <button type='button' data-bs-toggle='tooltip'
                        data-bs-placement='right'
                        data-bs-custom-class='custom-tooltip' data-html='true'
                        title='Ver pdf' class='btn-2 btnSecond'><i
                        class='bi bi-file-earmark-pdf'></i></button>
                        </a>`;

            let data = [datatable];

            new DataTable('#table-ref', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                },
                reponsive: true,
                bDestroy: true,
                data: data,
                columns: [{
                        data: 'date',
                        title: 'Fecha',
                        className: "text-center",
                    },
                    {
                        data: 'cod_ref',
                        title: 'Referencia',
                        className: "text-center",
                    },
                    {
                        data: 'cod_medical_record',
                        title: 'Referencia consulta medica',
                        className: "text-center",
                    },
                    {
                        data: 'get_patient.name',
                        title: 'Nombres',
                        className: "text-center",
                    },
                    {
                        data: 'get_patient.ci',
                        title: 'Cédula',
                        className: "text-center",
                    },
                    {
                        data: 'get_patient.genere',
                        title: 'Género',
                        className: "text-center",
                    },
                    {
                        data: 'get_patient.phone',
                        title: 'Teléfono',
                        className: "text-center",
                    },
                    {
                        data: 'btn',
                        title: 'Examenes',
                        className: "text-center",
                    },
                    {
                        data: 'btn1',
                        title: 'Estudios',
                        className: "text-center",
                    },
                    {
                        data: 'btn2',
                        title: 'Acciones',
                        className: "text-center",
                    },
                ],
            });

        }

        function handlerSearPerson(e) {
            if (Number(e.target.value) === 0) {
                row = 'ci';
            } else {
                row = 'code_ref';
            }
            $('#search_person').attr('disabled', false);
        }

        function searchPerson() {
            if ($('#search_person').val() != '') {
                // let route = '{{ route('search_person', [':row', ':value']) }}';
                let route = '{{ route('search_person', ':value') }}';
                // route = route.replace(':row', row);
                route = route.replace(':value', $('#search_person').val());

                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Operacion exitosamente!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            $("#content-table-ref").show();
                            refreshTable(response);
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: error.responseJSON.errors,
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            $('#send').show();
                            $('#spinner').hide();
                            $(".holder").hide();
                        });
                    }
                });
            }
        }

        function get_data_table(data) {
            $.ajax({
                url: '{{ route('references_res') }}',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    ///refrezcar table examenes
                    new DataTable('#table-ref-examenes', {
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                        },
                        reponsive: true,
                        bDestroy: true,
                        data: response.data_exam_res,
                        columns: [{
                                data: 'date_ref',
                                title: 'Fecha referencia',
                                className: "text-center",
                            },
                            {
                                data: 'cod_ref',
                                title: 'Referencia',
                                className: "text-center",
                            },
                            {
                                data: 'cod_exam',
                                title: 'código Examen',
                                className: "text-center",
                            },
                            {
                                data: 'description',
                                title: 'Descripción',
                                className: "text-center",
                            },
                            {
                                data: 'date_upload_res',
                                title: 'Fecha resultado',
                                className: "text-center",
                            },
                            {
                                data: 'patient_info.full_name',
                                title: 'Nombres',
                                className: "text-center",
                            },
                            {
                                data: 'patient_info.ci',
                                title: 'Cédula',
                                className: "text-center",
                            },
                            {
                                data: 'patient_info.genere',
                                title: 'Género',
                                className: "text-center",
                            }
                        ],
                    });
                    ///refrezcar table estudios
                    new DataTable('#table-ref-estudios', {
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                        },
                        reponsive: true,
                        bDestroy: true,
                        data: response.data_study_res,
                        columns: [{
                                data: 'date_ref',
                                title: 'Fecha referencia',
                                className: "text-center",
                            },
                            {
                                data: 'cod_ref',
                                title: 'Referencia',
                                className: "text-center",
                            },
                            {
                                data: 'cod_study',
                                title: 'código Examen',
                                className: "text-center",
                            },
                            {
                                data: 'description',
                                title: 'Descripción',
                                className: "text-center",
                            },
                            {
                                data: 'date_upload_res',
                                title: 'Fecha resultado',
                                className: "text-center",
                            },
                            {
                                data: 'patient_info.full_name',
                                title: 'Nombres',
                                className: "text-center",
                            },
                            {
                                data: 'patient_info.ci',
                                title: 'Cédula',
                                className: "text-center",
                            },
                            {
                                data: 'patient_info.genere',
                                title: 'Género',
                                className: "text-center",
                            }
                        ],
                    });

                },
                error: function(error) {

                }
            });

        }
    </script>
@endpush
@section('content')
    <div class="container-fluid">
        {{-- rol medico --}}
        @if (Auth::user()->role == 'medico')
            <div id="spinner" style="display: none" class="spinner-md">
                <x-load-spinner show="true" />
            </div>
            <div class="accordion" id="accordion">
                <div class="container-fluid" style="padding: 3%">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item accordion-dashboard">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-calendar2-check"></i> Citas del día
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row"id="table-patients">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                            style="margin-top: 20px:">
                                            
                                            <table id="table-patient" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">Fecha</th>
                                                        <th class="text-center" scope="col">Hora</th>
                                                        <th class="text-center" scope="col">Nombre</th>
                                                        <th class="text-center" scope="col">Cédula</th>
                                                        <th class="text-center" scope="col">Género</th>
                                                        <th class="text-center" scope="col">Teléfono</th>
                                                        <th class="text-center" scope="col">Email</th>
                                                        <th class="text-center" scope="col">Centro de salud</th>
                                                        <th class="text-center" scope="col">Confirmación</th>
                                                        <th class="text-center" scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($appointments as $item)
                                                        <tr>
                                                            <td class="text-center td-pad">
                                                                {{ date('d-m-Y', strtotime($item['extendedProps']['data_app'])) }}
                                                            </td>
                                                            <td class="text-center td-pad">
                                                                {{ $item['extendedProps']['data'] . ' ' . $item['extendedProps']['time_zone_start'] }}
                                                            </td>
                                                            <td class="text-center td-pad text-capitalize">
                                                                {{ $item['extendedProps']['name'] . ' ' . $item['extendedProps']['last_name'] }}
                                                            </td>
                                                            <td class="text-center td-pad">
                                                                {{ $item['extendedProps']['ci'] }}</td>
                                                            <td class="text-center td-pad text-capitalize">
                                                                {{ $item['extendedProps']['genere'] }}</td>
                                                            <td class="text-center td-pad">
                                                                {{ $item['extendedProps']['phone'] }}</td>
                                                            <td class="text-center td-pad">
                                                                {{ $item['extendedProps']['email'] }}</td>
                                                            <td class="text-center td-pad">
                                                                {{ $item['extendedProps']['center'] }}</td>
                                                            <td class="text-center td-pad">
                                                                @if ($item['extendedProps']['confirmation'] != 0)
                                                                    <span
                                                                        class="badge rounded-pill bg-success">Confimada</span>
                                                                @else
                                                                    <span class="badge rounded-pill bg-secondary">Sin confirmar</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="d-flex" style="justify-content: center;">
                                                                    <div
                                                                        class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3" style="width: 32px;">
                                                                        <a href="{{ route('MedicalRecord', $item['extendedProps']['patient_id']) }}">
                                                                            <button type="button"
                                                                                class="btn btn-iPrimary rounded-circle"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                title="Consulta médica">
                                                                                <i class="bi bi-file-earmark-text"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3"
                                                                        style="margin-left: 10px; width: 32px;">
                                                                        <button type="button"
                                                                            class="btn btn-iSecond rounded-circle"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom" title="Cancelar Cita"
                                                                            onclick="cancelled_appointments('{{ $item['extendedProps']['id'] }}' ,'{{ route('cancelled_appointments', ':id') }}','{{ route('DashboardComponent') }}')">
                                                                            <i class="bi bi-calendar-x"></i>
                                                                        </button>
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

                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item accordion-dashboard">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-graph-up"></i> Estadísticas
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-1">
                                            <div class="card text-white" style="background-color: rgb(251,220,226)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countPatientRegister"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-1">
                                            <div class="card text-white" style="background-color: rgb(219,242,242)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countMedicalRecordr"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-1">
                                            <div class="card text-white" style="background-color: rgb(235,224,255)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countHistoryRegister"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-1">
                                            <div class="card text-white" style="background-color: rgb(255,255,255)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countGenere"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-1">
                                            <div class="card text-white" style="background-color: rgb(255,255,255)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countGereral"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- rol laboratorio --}}
            <div class="accordion" id="accordion">
                <div class="container-fluid" style="padding: 3%">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item accordion-dashboard">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-graph-up"></i> Estadisticas
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-1">
                                            <div class="card text-white" style="background-color: rgb(251,220,226)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countPatientRegister"></canvas>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-1">
                                            <div class="card text-white" style="background-color: rgb(219,242,242)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countMedicalRecordr"></canvas>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-1">
                                            <div class="card text-white" style="background-color: rgb(235,224,255)">
                                                <div class="c-chart-wrapper mt-3 mx-3" style="height:auto; width:auto">
                                                    <canvas id="countHistoryRegister"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Pacientes con referencias --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item accordion-dashboard">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-text"></i> Pacientes con referencias
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <x-search-person />
                                    <div class="row mt-3" id="content-table-ref" style="display: none">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                            style="margin-top: 20px:">
                                            <table id="table-ref" class="table table-striped table-bordered" style="width:100%">
                                                <thead>

                                                    <tr>
                                                        <th class="text-center" scope="col">Fecha</th>
                                                        <th class="text-center" scope="col">Referencia</th>
                                                        <th class="text-center" scope="col">Referencia consulta médica</th>
                                                        <th class="text-center" scope="col">Nombres</th>
                                                        <th class="text-center" scope="col">Cédula</th>
                                                        <th class="text-center" scope="col">Género</th>
                                                        <th class="text-center" scope="col">Teléfono</th>
                                                        <th class="text-center" scope="col">Examenes</th>
                                                        <th class="text-center" scope="col">Estudios</th>
                                                        <th class="text-center" scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- examenes atendidos --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item accordion-dashboard">
                            <span class="accordion-header title" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-card-list"></i> Examenes atendidos
                                </button>
                            </span>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <table id="table-ref-examenes" class="table table-striped table-bordered"
                                    style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Fecha</th>
                                                <th class="text-center" scope="col">Referencia</th>
                                                <th class="text-center" scope="col">código Examen</th>
                                                <th class="text-center" scope="col">Descripción</th>
                                                <th class="text-center" scope="col">Nombres</th>
                                                <th class="text-center" scope="col">Cédula</th>
                                                <th class="text-center" scope="col">Género</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Estudios atendidos --}}
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item accordion-dashboard">
                            <span class="accordion-header title" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-card-list"></i> Estudios atendidos
                                </button>
                            </span>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <table id="table-ref-estudios" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Fecha</th>
                                                <th class="text-center" scope="col">Referencia</th>
                                                <th class="text-center" scope="col">código Estudios</th>
                                                <th class="text-center" scope="col">Descripción</th>
                                                <th class="text-center" scope="col">Nombres</th>
                                                <th class="text-center" scope="col">Cédula</th>
                                                <th class="text-center" scope="col">Género</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ModalLoadResult" tabindex="-1" aria-labelledby="ModalLoadResultLabel"
        aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div id="spinner" style="display: none">
            <x-load-spinner show="true" />
        </div>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-load-img" method="post" action="/">
                            {{ csrf_field() }}
                            <input type="hidden" id="id" name="id" value="">
                            <input type="hidden" id="code_ref" name="code_ref" value="">
                            <div class="row mt-3">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <strong>Referencia: </strong><span id="ref"></span>
                                    <br>
                                    <strong>Paciente: </strong><span id="ref-pat"></span>
                                </div>
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-3 table-responsive" id="info-show">
                                    <table class="table table-striped table-bordered" id="table-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Código</th>
                                                <th class="text-center" scope="col">Descripción</th>
                                                <th class="text-center" scope="col">Cargar Resultado</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div class="col-sm-7 md-7 lg-7 xl-7 xxl-7">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text">Total resultados
                                        </span>
                                        <input type="text" id="count" name="count" class="form-control"
                                            readonly value="">
                                    </div>
                                </div>
                            </div>

                            <div id="input-array"></div>
                            <div class="row mt-3" id="div-result">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <x-upload-image title="Cargar Resultados" />
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">   
                                    <input class="btn btnPrimary send " value="Guardar" type="submit" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
