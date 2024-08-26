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
        let countHistoryRegister = @json($count_history_register);
        let count_patient_genero = @json($count_patient_genero);
        let queries_month = @json($queries_month);
        let count_study = @json($count_study);
        let count_examen = @json($count_examen);
        let meses = @json($meses);
        let appointments_attended = @json($appointments_attended);
        let appointments_canceled = @json($appointments_canceled);
        let appointments_confirmed = @json($appointments_confirmed);
        let appointments_unconfirmed = @json($appointments_unconfirmed);
        let appointments_not_attended = @json($appointments_not_attended);
        let appointments_count_all_attended = @json($appointments_count_all_attended);
        let appointments_count_all_canceled = @json($appointments_count_all_canceled);
        let appointments_count_all_confirmada = @json($appointments_count_all_confirmada);
        let appointments_count_all_no_atendida = @json($appointments_count_all_no_atendida);
        let all_patient_boy_girl = @json($all_patient_boy_girl);
        let all_patient_teen = @json($all_patient_teen);
        let all_patient_adult = @json($all_patient_adult);
        let all_patient_elderly = @json($all_patient_elderly);
        let all_patient_gender = @json($all_patient_gender);

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

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            get_general(boy_girl, teen, adult, elderly);
            // get_general_appointments2(appointments_confirmed, appointments_attended)
            // get_general_appointments(appointments_unconfirmed, appointments_canceled)
            get_quotes(appointments_count_all_confirmada, appointments_count_all_canceled, appointments_count_all_attended);
            get_queries_month(queries_month, meses);
            // get_consultas_history(countMedicalRecordr, countHistoryRegister);
            get_appointments_attended(appointments_attended);
            get_appointments_canceled(appointments_canceled);
            get_appointments_confirmed(appointments_confirmed);
            get_recorded_appointments(appointments_unconfirmed);
            get_study(count_study);
            get_examen(count_examen);
            get_appointments_attended_scheduled(appointments_unconfirmed, appointments_attended);
            get_appointments_canceled_scheduled(appointments_unconfirmed, appointments_canceled);
            get_appointments_confirmed_scheduled(appointments_unconfirmed, appointments_confirmed);
            get_appointments_not_attended_scheduled(appointments_unconfirmed, appointments_not_attended);
            get_appointments_general(appointments_unconfirmed, appointments_confirmed, appointments_attended, appointments_canceled, appointments_not_attended);
            get_age(all_patient_boy_girl, all_patient_teen, all_patient_adult, all_patient_elderly);
            get_gender(all_patient_gender);

        });


        const alertInfoPaciente = (id_patient, age, status) => {
            if (status === 'Cancelada') {
                Swal.fire({
                            icon: 'error',
                            title: 'Cita Cancelada',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {

                        });

                } else if (status === 'Finalizada') {
                Swal.fire({
                            icon: 'error',
                            title: 'Cita Finalizada',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {

                        });
            } else {
                if(age === '') {
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
                } else {

                    let url = "{{ route('MedicalRecord', ':id_patient') }}";

                        url = url.replace(':id_patient', id_patient);

                        window.location.href = url;
                }
            }
        }

        const alertInfoStatus = (status) => {
            Swal.fire({
                icon: 'error',
                title: 'prueba',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {

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

        function resend_reminder(code, status) {
            $('#spinner').show();
            if (status === 'Cancelada') {

                $('#spinner').hide();
                Swal.fire({
                            icon: 'error',
                            title: 'Cita Cancelada',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {

                        });

            } else if (status === 'Finalizada') {
                $('#spinner').hide();
                Swal.fire({
                            icon: 'error',
                            title: 'Cita Finalizada',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {

                        });
            } else {
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
        }
    </script>
@endpush
@section('content')
    <div>
        {{-- rol medico y secretaria natural --}}
        @if (Auth::user()->type_plane == 1 || Auth::user()->type_plane == 2 || Auth::user()->type_plane == 3 || Auth::user()->role == 'secretary')
            <div id="spinner" style="display: none" class="spinner-md">
                <x-load-spinner show="true" />
            </div>
            <div class="container-fluid body" style="padding: 2% 3% 3%">
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                        <div class="card bg-9" >
                            <div class="card-body" style="position: sticky; padding: 1% 2%;">
                                <h4 class="mb-4 mt-2" style="color: #596167">Dashboard Sqlapio</h4>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                            <div class="card" style="background-color: #eee">
                                                <div class="card-body p-4">
                                                    <div class="row" id="table-patients">
                                                        <h5 style="color: #596167"><i class="bi bi-calendar2-check"></i> @lang('messages.acordion.citas')</h5>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                            <table id="table-patient" class="table table-striped table-bordered" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false" > @lang('messages.tabla.hora') </th>
                                                                        <th class="text-center w-17" scope="col" data-orderable="false"> @lang('messages.tabla.nombre_apellido') </th>
                                                                        @if (Auth::user()->contrie == '81')
                                                                            <th class="text-center w-10" scope="col" data-orderable="false"> @lang('messages.form.CIE')</th>
                                                                        @else
                                                                            <th class="text-center w-10" scope="col" data-orderable="false"> @lang('messages.tabla.cedula')</th>
                                                                        @endif
                                                                        <th class="text-center w-17" scope="col"data-orderable="false"> @lang('messages.tabla.centro_salud')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false"> @lang('messages.tabla.estatus')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.acciones')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach (collect($appointments)->sortBy('start') as $item)

                                                                        <tr>
                                                                            <td class="text-center td-pad"> {{ Carbon\Carbon::parse($item['start'])->format('H:i') }} </td>
                                                                            <td class="text-center td-pad text-capitalize"> {{ $item['extendedProps']['name'] . ' ' . $item['extendedProps']['last_name'] }} </td>
                                                                            @if (Auth::user()->contrie == '81')
                                                                                <td class="text-center td-pad"> {{ preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item['extendedProps']['ci']) }} </td>
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
                                                                                    @if (Auth::user()->role == 'medico')
                                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; justify-content: center;">
                                                                                            @php
                                                                                                $id_patient =  $item["extendedProps"]["patient_id"];
                                                                                                $age =  $item['extendedProps']['age'];
                                                                                            @endphp
                                                                                        <button type="button" data-bs-toggle="tooltip"
                                                                                            data-bs-placement="bottom" title="@lang('messages.tooltips.consulta_medica')"
                                                                                            onclick="alertInfoPaciente('{{ $id_patient }}','{{ $age }}', '{{ $status2 }}')">
                                                                                            <img width="51" height="auto" src="{{ asset('/img/icons/monitor.png') }}" alt="avatar">
                                                                                        </button>
                                                                                        </div>
                                                                                    @endif
                                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; justify-content: center;">
                                                                                        <button type="button"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="bottom"
                                                                                            title="@lang('messages.tooltips.cancelar_cita')"
                                                                                            onclick="cancelled_appointments('{{ $item['extendedProps']['id'] }}','{{ route('cancelled_appointments', ':id') }}','{{ route('DashboardComponent') }}', '{{  $status2 }}')">
                                                                                            <img width="51" height="auto" src="{{ asset('/img/icons/canceled.png') }}" alt="avatar">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; justify-content: center;">
                                                                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="@lang('messages.tooltips.enviar_recordatorio')"
                                                                                            onclick="resend_reminder('{{ $item['extendedProps']['id'] }}', '{{  $status2 }}')">
                                                                                            <img width="55" height="auto" src="{{ asset('/img/icons/send.png') }}" alt="avatar">
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
                                {{-- <div class="row" style="justify-content: flex-end;">
                                    <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="moth_filter" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px;color:white">@lang('messages.graficas.filtros_mes')</label>
                                                <select onchange="handleFilter(event)" name="moth_filter" id="moth_filter" placeholder="Seleccione" class="form-control combo-textbox-input " style="color: #929598;
                                                background-color: #eee;
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
                                </div> --}}
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.consultas_mes')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                        <canvas id="queries_month" style="height:40vh; width:100vw"> </canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        {{-- agendadas vs confirmadas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general2')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="confirmed_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- agendadas vs atendidas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="attended_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- agendadas vs canceladas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general3')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="canceled_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- agendadas vs no antendidas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general4')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="not_attended_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Genero --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card " style="background-color: #eee;">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.pacientes_tipo_sex')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="get_gender"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Edad --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.pacientes_tipo')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="get_age"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Total citas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                        <canvas id="appointments_general"  style="height:40vh; width:100vw"></canvas>
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
             {{-- rol medico y secretaria corporativo --}}
        @elseif (Auth::user()->type_plane == 7 && Auth::user()->role == "medico")
            <div id="spinner" style="display: none" class="spinner-md">
                <x-load-spinner show="true" />
            </div>
            <div class="container-fluid body" style="padding: 2% 3% 3%">
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                        <div class="card bg-9" >
                            <div class="card-body" style="position: sticky; padding: 1% 2%;">
                                <h4 class="mb-4 mt-2" style="color: #596167">Dashboard Sqlapio</h4>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                            <div class="card" style="background-color: #eee">
                                                <div class="card-body p-4">
                                                    <div class="row" id="table-patients">
                                                        <h5 style="color: #596167"><i class="bi bi-calendar2-check"></i> @lang('messages.acordion.citas')</h5>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                            <table id="table-patient" class="table table-striped table-bordered" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false" > @lang('messages.tabla.hora') </th>
                                                                        <th class="text-center w-17" scope="col" data-orderable="false"> @lang('messages.tabla.nombre_apellido') </th>
                                                                        @if (Auth::user()->contrie == '81')
                                                                            <th class="text-center w-10" scope="col" data-orderable="false"> @lang('messages.form.CIE')</th>
                                                                        @else
                                                                            <th class="text-center w-10" scope="col" data-orderable="false"> @lang('messages.tabla.cedula')</th>
                                                                        @endif
                                                                        <th class="text-center w-17" scope="col"data-orderable="false"> @lang('messages.tabla.centro_salud')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false"> @lang('messages.tabla.estatus')</th>
                                                                        <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.acciones')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach (collect($appointments)->sortBy('start') as $item)

                                                                        <tr>
                                                                            <td class="text-center td-pad"> {{ Carbon\Carbon::parse($item['start'])->format('H:i') }} </td>
                                                                            <td class="text-center td-pad text-capitalize"> {{ $item['extendedProps']['name'] . ' ' . $item['extendedProps']['last_name'] }} </td>
                                                                            @if (Auth::user()->contrie == '81')
                                                                                <td class="text-center td-pad"> {{ preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item['extendedProps']['ci']) }} </td>
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
                                                                                    @if (Auth::user()->role == 'medico')
                                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; justify-content: center;">
                                                                                            @php
                                                                                                $id_patient =  $item["extendedProps"]["patient_id"];
                                                                                                $age =  $item['extendedProps']['age'];
                                                                                            @endphp
                                                                                        <button type="button" data-bs-toggle="tooltip"
                                                                                            data-bs-placement="bottom" title="@lang('messages.tooltips.consulta_medica')"
                                                                                            onclick="alertInfoPaciente('{{ $id_patient }}','{{ $age }}', '{{ $status2 }}')">
                                                                                            <img width="51" height="auto" src="{{ asset('/img/icons/monitor.png') }}" alt="avatar">
                                                                                        </button>
                                                                                        </div>
                                                                                    @endif
                                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; justify-content: center;">
                                                                                        <button type="button"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="bottom"
                                                                                            title="@lang('messages.tooltips.cancelar_cita')"
                                                                                            onclick="cancelled_appointments('{{ $item['extendedProps']['id'] }}','{{ route('cancelled_appointments', ':id') }}','{{ route('DashboardComponent') }}', '{{  $status2 }}')">
                                                                                            <img width="51" height="auto" src="{{ asset('/img/icons/canceled.png') }}" alt="avatar">
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; justify-content: center;">
                                                                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="@lang('messages.tooltips.enviar_recordatorio')"
                                                                                            onclick="resend_reminder('{{ $item['extendedProps']['id'] }}', '{{  $status2 }}')">
                                                                                            <img width="55" height="auto" src="{{ asset('/img/icons/send.png') }}" alt="avatar">
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
                                {{-- <div class="row" style="justify-content: flex-end;">
                                    <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="moth_filter" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px;color:white">@lang('messages.graficas.filtros_mes')</label>
                                                <select onchange="handleFilter(event)" name="moth_filter" id="moth_filter" placeholder="Seleccione" class="form-control combo-textbox-input " style="color: #929598;
                                                background-color: #eee;
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
                                </div> --}}
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.consultas_mes')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                        <canvas id="queries_month" style="height:40vh; width:100vw"> </canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        {{-- agendadas vs confirmadas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general2')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="confirmed_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- agendadas vs atendidas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="attended_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- agendadas vs canceladas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general3')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="canceled_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- agendadas vs no antendidas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_general4')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="not_attended_scheduled"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Genero --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card " style="background-color: #eee;">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.pacientes_tipo_sex')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="get_gender"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Edad --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.pacientes_tipo')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                        <canvas id="get_age"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Total citas --}}
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div class="card" style="background-color: #eee">
                                                <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas')</h5>
                                                <div class="card-body" style="display: flex; justify-content: center; padding: 0 1.5rem 1.5rem 1.5rem">
                                                    <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                        <canvas id="appointments_general"  style="height:40vh; width:100vw"></canvas>
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
        @else
            {{-- rol laboratorio --}}
            <div id="spinner2" style="display: none" class="spinner-md">
                <x-load-spinner show="true" />
            </div>
            <div class="container-fluid body" style="padding: 0 3% 3%">
                <div class="accordion" id="accordion">
                </div>
            </div>
        @endif
    </div>


    <!-- Modal -->
@endsection
