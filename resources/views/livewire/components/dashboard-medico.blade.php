@extends('layouts.app-auth')
@section('title', 'Tablero')
@vite(['resources/js/graphicCountAll.js', 'resources/js/dairy.js', 'resources/js/graphic_laboratory_coun_study.js', 'resources/js/graphic_laboratory_coun_exam.js'])
<style>
    .mt-gf {
        margin-top: 1rem !important;
    }

    .w-10 {
        width: 10% !important;
    }

    .w-5 {
        width: 5% !important;
    }

    .pr-5 {
        padding: 0 5px 0 0;
    }

    .pl-5 {
        padding: 0 0 0 5px;
    }

    .avatar {
        border-radius: 50%;
        width: 55px !important;
        height: 55px !important;
        border: 2px solid #44525f;
        object-fit: cover;
    }

    .table-avatar {
        text-align: center;
        vertical-align: middle;
    }


    @media screen and (max-width: 1200px) {
        .graficas-3 canvas {
            height: auto !important;
            width: 100% !important;
        }
    }

    @media screen and (max-width: 576px) {
        .mt-gf {
            margin-top: 0 !important;
        }
    }
</style>
@php
    $lang = session()->get('locale');
    if ($lang == 'en') {
        $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/en-EN.json';
    } else {
        $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json';
    }
@endphp
@push('scripts')
    <script>
        let countPatientRegister = @json($count_patient_register);
        let countMedicalRecordr = @json($count_medical_recordr);
        let countHistoryRegister = @json($count_history_register);
        let count_patient_genero = @json($count_patient_genero);
        let queries_month = @json($queries_month);
        let count_study = @json($count_study);
        let count_examen = @json($count_examen);
        let appointments_attended = @json($appointments_attended);
        let appointments_canceled = @json($appointments_canceled);
        let appointments_confirmed = @json($appointments_confirmed);
        let appointments_count_all = @json($appointments_count_all);
        let elderly = @json($elderly);
        let boy_girl = @json($boy_girl);
        let teen = @json($teen);
        let adult = @json($adult);
        let patients = @json($patients);
        let urlPost;
        let count = 0;
        let exams_array = [];
        let studies_array = [];
        let row = "";

        $(document).ready(() => {

            let user = @json(Auth::user());

            let appointments = @json($appointments);

            let data_palnes = [{
                    type_plan: 1,
                    count_patients: 10,
                    count_ref: 20,
                    count_exam: 20,
                    count_study: 20,
                },
                {
                    type_plan: 2,
                    count_patients: 40,
                    count_ref: 40,
                    count_exam: 80,
                    count_study: 80,
                },
                {
                    type_plan: 3,
                    count_patients: '@lang('messages.label.ilimitado')',
                    count_ref: '@lang('messages.label.ilimitado')',
                    count_exam: '@lang('messages.label.ilimitado')',
                    count_study: '@lang('messages.label.ilimitado')',
                },
                {
                    type_plan: 4,
                    description: "Plan - ILIMITADO",
                    count_patients: 'ILIMITADO',
                    count_ref: 'ILIMITADO',
                    count_exam: 'ILIMITADO',
                    count_study: 'ILIMITADO',
                },
                {
                    type_plan: 5,
                    description: "Plan - ILIMITADO",
                    count_patients: 'ILIMITADO',
                    count_ref: 'ILIMITADO',
                    count_exam: 'ILIMITADO',
                    count_study: 'ILIMITADO',
                },
                {
                    type_plan: 6,
                    description: "Plan - ILIMITADO",
                    count_patients: 'ILIMITADO',
                    count_ref: 'ILIMITADO',
                    count_exam: 'ILIMITADO',
                    count_study: 'ILIMITADO',
                }
            ];

            const data = data_palnes.find((e) => e.type_plan == user.type_plane);
            if(user.role!="secretary"){

                $('.card-title').text(data.description);
                $('#pacientes').text(`${data.count_patients}`);
                $('#consultas').text(`${data.count_ref}`);
                $('#examenes').text(`${data.count_exam}`);
                $('#estudios').text(`${data.count_study}`);
            }

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            get_general(elderly, adult, boy_girl, teen);
            get_quotes(appointments_count_all);
            get_queries_month(queries_month);
            get_consultas_history(countMedicalRecordr, countHistoryRegister);
            get_appointments_attended(appointments_attended);
            get_appointments_canceled(appointments_canceled);
            get_appointments_confirmed(appointments_confirmed);
            get_study(count_study),
            get_examen(count_examen),


            $('#table-patients').DataTable({
                pageLength: 5,
                paging: true,
                scroller: true,
                scrollY: '200px',
            });


        });


        const alertInfoPaciente = (id_patient) => {
            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.actualizar_paciente')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {

                let url = "{{ route('Patients', ':id_patient') }}";

                url = url.replace(':id_patient', id_patient);

                window.location.href = url;
            });
        }

        const handleFilter = (e) => {

            let route = '{{ route('filter_month_dashboard', [':month']) }}';
            route = route.replace(':month', $('#moth_filter').val());
                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        updat_graphc(response);
                    },
                });
        }

        function resend_reminder(code) {
            $('#spinner').show();
            let route = '{{ route('dash-notifications', [':code']) }}';
            route = route.replace(':code', code);
            $.ajax({
                url: route,
                type: 'POST',
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#spinner').hide();

                    Swal.fire({
                        icon: 'success',
                        title: '@lang('messages.alert.recordatorio_enviado')',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: '@lang('messages.botton.aceptar')'
                    }).then((result) => {

                    });
                },
            });
        }
    </script>
@endpush
@section('content')
    <div>
        {{-- rol medico y secretaria natural --}}
        @if (Auth::user()->role == 'medico' || Auth::user()->role == 'secretary')
            <div id="spinner" style="display: none" class="spinner-md">
                <x-load-spinner show="true" />
            </div>
            <div class="container-fluid body" style="padding: 2% 3% 3%">
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                        <div class="card bg-4">
                            <div class="card-body" style="position: sticky; padding: 1% 2%;">
                                <h4 class="mb-4 mt-2" style="color: #ffff">Dashboard Sqlapio</h4>
                                <div class="row" style="justify-content: flex-end;">
                                    <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="moth_filter" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px;color:white">@lang('messages.graficas.filtros_mes')</label>
                                                <select onchange="handleFilter(event)" name="moth_filter" id="moth_filter" placeholder="Seleccione" class="form-control combo-textbox-input " style="color: #929598;
                                                background-color: #222f3e;
                                                border: var(--bs-border-width) solid #9d9fa1;">
                                                    <option value="">@lang('messages.graficas.mes')</option>
                                                    <option value="01">@lang('messages.graficas.enero')</option>
                                                    <option value="02">@lang('messages.graficas.febrero')</option>
                                                    <option value="03">@lang('messages.graficas.marzo')</option>
                                                    <option value="04">@lang('messages.graficas.abril')</option>
                                                    <option value="05">@lang('messages.graficas.mayo')</option>
                                                    <option value="06">@lang('messages.graficas.junio')</option>
                                                    <option value="07">@lang('messages.graficas.julio')</option>
                                                    <option value="08">@lang('messages.graficas.agosto')</option>
                                                    <option value="09">@lang('messages.graficas.septiembre')</option>
                                                    <option value="10">@lang('messages.graficas.octubre')</option>
                                                    <option value="11">@lang('messages.graficas.noviembre')</option>
                                                    <option value="12">@lang('messages.graficas.diciembre')</option>
                                                </select>
                                                <i class="bi bi-caret-down st-icon"></i>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                            <div class="card" style="background-color: #222f3e">
                                                <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                    <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                        <canvas id="queries_month" style="height:40vh; width:100vw"> </canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->role == 'medico' && Auth::user()->type_plane != 7)
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-lg-3">
                                                <div class="card l-bg-cherry">
                                                    <div class="card-statistic-3 p-4">
                                                        <div class="card-icon card-icon-large"><img width="120" height="auto" src="{{ asset('/img/icons/patients-w.png') }}" alt="avatar"></div>
                                                        <div class="mb-4">
                                                            <h5 class="card-title mb-0">@lang('messages.label.paciente')</h5>
                                                        </div>
                                                        <div class="row align-items-center mb-2 d-flex">
                                                            <div class="col-8" style="display: flex">
                                                                <h2 class="d-flex align-items-center mb-0">
                                                                    {{ auth()->user()->patient_counter }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-lg-3">
                                                <div class="card l-bg-blue-dark">
                                                    <div class="card-statistic-3 p-4">
                                                        <div class="card-icon card-icon-large"> <img width="120" height="auto" src="{{ asset('/img/icons/medical-report3-w.png') }}" alt="avatar"></div>
                                                        <div class="mb-4">
                                                            <h5 class="card-title mb-0">@lang('messages.label.consulta')</h5>
                                                        </div>
                                                        <div class="row align-items-center mb-2 d-flex">
                                                            <div class="col-8" style="display: flex">
                                                                <h2 class="d-flex align-items-center mb-0">
                                                                    {{ auth()->user()->medical_record_counter }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-lg-3">
                                                <div class="card l-bg-green-dark">
                                                    <div class="card-statistic-3 p-4">
                                                        <div class="card-icon card-icon-large"> <img width="120" height="auto" src="{{ asset('/img/icons/medical-report-w.png') }}" alt="avatar"></div>
                                                        <div class="mb-4">
                                                            <h5 class="card-title mb-0">@lang('messages.label.examenes')</h5>
                                                        </div>
                                                        <div class="row align-items-center mb-2 d-flex">
                                                            <div class="col-8" style="display: flex">
                                                                <h2 class="d-flex align-items-center mb-0">
                                                                    {{ auth()->user()->ref_counter }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-lg-3">
                                                <div class="card l-bg-orange-dark">
                                                    <div class="card-statistic-3 p-4">
                                                        <div class="card-icon card-icon-large"><img width="120" height="auto" src="{{ asset('/img/icons/medical1-w.png') }}" alt="avatar"></div>
                                                        <div class="mb-4">
                                                            <h5 class="card-title mb-0">@lang('messages.label.estudios')</h5>
                                                        </div>
                                                        <div class="row align-items-center mb-2 d-flex">
                                                            <div class="col-8" style="display: flex">
                                                                <h2 class="d-flex align-items-center mb-0">
                                                                    {{ auth()->user()->ref_counter }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-lg-4">
                                            <div class="card" style="background-color: #222f3e">
                                                <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="appointments_attended"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-lg-4">
                                            <div class="card " style="background-color: #222f3e">
                                                <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="appointments_confirmed"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-lg-4">
                                            <div class="card " style="background-color: #222f3e">
                                                <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="appointments_canceled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                            <div class="card" style="background-color: #222f3e">
                                                <div class="card-body p-4">
                                                    <div class="row" id="table-patients" style="color: #b3b3b3">
                                                        <h5><i class="bi bi-calendar2-check" style="color: #fffff"></i>
                                                            @lang('messages.acordion.citas')</h5>
                                                        <div
                                                            class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                            <table id="table-patient" class="table table-striped table-bordered table-dark" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center w-10" scope="col"> @lang('messages.tabla.hora') </th>
                                                                        <th class="text-center w-17" scope="col"> @lang('messages.tabla.nombre_apellido') </th>
                                                                        @if (Auth::user()->contrie == '81')
                                                                            <th class="text-center w-10" scope="col"> @lang('messages.form.CIE')</th>
                                                                        @else
                                                                            <th class="text-center w-10" scope="col"> @lang('messages.tabla.cedula')</th>
                                                                        @endif
                                                                        <th class="text-center w-17" scope="col"> @lang('messages.tabla.centro_salud')</th>
                                                                        <th class="text-center w-10" scope="col"> @lang('messages.tabla.estatus')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.acciones')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($appointments as $item)
                                                                        @php
                                                                            $hora = '';

                                                                                if (substr($item['extendedProps']['data'], 6)) {
                                                                                    $hora = substr($item['extendedProps']['data'], 6);
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '13:00') {
                                                                                    $hora = '01:00';
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '14:00') {
                                                                                    $hora = '02:00';
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '15:00') {
                                                                                    $hora = '03:00';
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '16:00') {
                                                                                    $hora = '04:00';
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '17:00') {
                                                                                    $hora = '05:00';
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '18:00') {
                                                                                    $hora = '06:00';
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '19:00') {
                                                                                    $hora = '07:00';
                                                                                }

                                                                                if (substr($item['extendedProps']['data'], 6) == '20:00') {
                                                                                    $hora = '08:00';
                                                                                }
                                                                        @endphp

                                                                        <tr>
                                                                            <td class="text-center td-pad">
                                                                                {{ $hora . ' ' . $item['extendedProps']['time_zone_start'] }}
                                                                            </td>
                                                                            <td class="text-center td-pad text-capitalize">
                                                                                {{ $item['extendedProps']['name'] . ' ' . $item['extendedProps']['last_name'] }}
                                                                            </td>
                                                                            @if (Auth::user()->contrie == '81')
                                                                                <td class="text-center td-pad">
                                                                                    {{ preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item['extendedProps']['ci']) }}
                                                                                </td>
                                                                            @else
                                                                                <td class="text-center td-pad"> {{ $item['extendedProps']['ci'] }}</td>
                                                                            @endif
                                                                            <td class="text-center td-pad"> {{ $item['extendedProps']['center'] }}</td>
                                                                            @php
                                                                                $status2 = $item['extendedProps']['status'];
                                                                            @endphp
                                                                            <td class="text-center td-pad">
                                                                                <span class="badge rounded-pill bg-{{ $item['extendedProps']['status_class'] }}">@lang('messages.tabla.' . $status2)</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex" style="justify-content: center;">
                                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                                        <a href="{{ $item['extendedProps']['age'] == '' ? '#' : route('MedicalRecord', $item['extendedProps']['patient_id']) }}"
                                                                                            @php
                                                                                                $id_patient =  $item["extendedProps"]["patient_id"];
                                                                                            @endphp
                                                                                            onclick='{{ $item['extendedProps']['age'] == '' ? "alertInfoPaciente($id_patient )" : '' }}'>
                                                                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="@lang('messages.tooltips.consulta_medica')">
                                                                                                <img width="35" height="auto" src="{{ asset('/img/icons/monitor.png') }}" alt="avatar">
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                                        <button type="button"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="bottom"
                                                                                            title="@lang('messages.tooltips.cancelar_cita')"
                                                                                            onclick="cancelled_appointments('{{ $item['extendedProps']['id'] }}' ,'{{ route('cancelled_appointments', ':id') }}','{{ route('DashboardComponent') }}')">
                                                                                            <img width="33" height="auto" src="{{ asset('/img/icons/canceled.png') }}" alt="avatar">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="@lang('messages.tooltips.enviar_recordatorio')"
                                                                                            onclick="resend_reminder('{{ $item['extendedProps']['id'] }}')">
                                                                                            <img width="35" height="auto" src="{{ asset('/img/icons/send.png') }}" alt="avatar">
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
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7 col-lg-7">
                                            <div class="card" style="background-color: #222f3e;">
                                                <div class="card-body p-4">
                                                    <div class="row" id="table-patients" style="color: #b3b3b3">
                                                        <h5><i class="bi bi-people" style="color: #fffff"></i>  @lang('messages.menu.pacientes')</h5>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                            <table id="table-patient" class="table table-striped table-bordered table-dark" style="width:100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center w-image" scope="col" data-orderable="false">@lang('messages.tabla.foto')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.nombre_apellido')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.email')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.telefono')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($patients as $item)
                                                                        <tr>
                                                                            <td class="table-avatar">
                                                                                <img class="avatar"
                                                                                    src=" {{ $item->patient_img ? asset('/imgs/' . $item->patient_img) : ($item->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                                    alt="Imagen del paciente">
                                                                            </td>
                                                                            <td class="text-center text-capitalize"> {{ $item->name }} {{ $item->last_name }} </td>
                                                                            <td class="text-center text-capitalize"> {{ $item->email }}</td>
                                                                            <td class="text-center text-capitalize"> {{ $item->phone }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 col-xxl-5">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12">
                                                    <div class="card" style="background-color: #222f3e; margin-bottom: 25px;">
                                                        <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                            <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                                <canvas id="countGereral2"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="card " style="background-color: #222f3e;">
                                                        <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                            <div class="c-chart-wrapper mt-2 mx-3" style="height:auto; width:100%">
                                                                <canvas id="quotes" style="height:auto; width:100vw"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="card " style="background-color: #222f3e;">
                                                        <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                            <div class="c-chart-wrapper mt-2 mx-3" style="height:auto; width:100%">
                                                                <canvas id="consultas_history" style="height:auto; width:100vw"></canvas>
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
                    <div class="modal-header title">
                        <span style="padding-left: 5px">@lang('messages.modal.titulo.carga_resultados')</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-load-img" method="post" action="/">
                            {{ csrf_field() }}
                            <input type="hidden" id="id" name="id" value="">
                            <input type="hidden" id="code_ref" name="code_ref" value="">
                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <strong>@lang('messages.modal.titulo.referencia'): </strong><span id="ref"></span>
                                <br>
                                <strong>@lang('messages.modal.titulo.paciente'): </strong><span class="text-capitalize" id="ref-pat"></span>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="info-show">
                                    <table class="table table-striped table-bordered" id="table-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">@lang('messages.modal.tabla.codigo')</th>
                                                <th class="text-center" scope="col">@lang('messages.modal.tabla.descripcion')</th>
                                                <th class="text-center" scope="col" data-orderable="false"> @lang('messages.modal.tabla.carga_resultado') </th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <div class="col-sm-7 md-7 lg-7 xl-7 xxl-7" style="display: none">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text">Total resultados </span>
                                        <input type="text" id="count" name="count" class="form-control"  readonly value="">
                                    </div>
                                </div>
                            </div>

                            <div id="input-array"></div>
                            <div id="div-btn">
                                <div class="row mt-2 div-result">
                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                        <x-upload-image title="@lang('messages.modal.tabla.carga_resultado')" />
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                        <input class="btn btnPrimary send " value="@lang('messages.botton.guardar')" type="submit" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
