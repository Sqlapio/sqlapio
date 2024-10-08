@extends('layouts.app-auth')
@section('title', 'Tablero')
@vite(['resources/js/graphicCountAll.js'])
<style>
    .mt-gf {
        margin-top: 3rem !important;
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

    @media screen and (max-width: 576px) {
        .mt-gf {
            margin-top: 0 !important;
        }
    }
</style>
@push('scripts')
    <script>
        let patients = @json($patients);
        let doctors_active = @json($doctor_active);
        let doctors_inactive = @json($doctor_inacactive);
        let dairy_unconfirmed_master_corporate = @json($dairy_unconfirmed_master_corporate);
        let meses = @json($meses);
        let specialty = @json($specialty);
        let user_asociate = @json($user_asociate);
        let patient_corporate = @json($patient_corporate);
        let doctor_speciality = @json($doctor_speciality);
        let patient_attended_corporate = @json($patient_attended_corporate);

        $(document).ready(() => {

            let user = @json(Auth::user());

            get_recorded_appointments(dairy_unconfirmed_master_corporate, meses);
            get_doctors(doctors_active, doctors_inactive);
            get_patient_attended_corporate(patient_attended_corporate, meses);
            get_doctor_speciality(doctor_speciality, specialty);

        });

    </script>
@endpush
@section('content')
    <div>
       <div id="spinner" style="display: none" class="spinner-md">
            <x-load-spinner show="true" />
        </div>
        <div class="container-fluid body" style="padding: 2% 3% 3%">
            <div class="row mt-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                    <div class="card bg-9">
                        <div class="card-body" style="position: sticky; padding: 1% 2%;">
                            <h4 class="mb-4 mt-2" style="color: #596167">Dashboard Sqlapio</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                <div class="row mt-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                        <div class="card" style="background-color: #eee">
                                            <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.citas_registradas')</h5>
                                            <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                    <canvas id="recorded_appointments" style="height:40vh; width:100vw"> </canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                        <div class="card" style="background-color: #eee">
                                            <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> Pacientes Atendidos por Mes</h5>
                                            <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                    <canvas id="patient_attended_corporate" style="height:40vh; width:100vw"> </canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                        <div class="card" style="background-color: #eee">
                                            <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> Medicos por especialidad</h5>
                                            <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                <div class="c-chart-wrapper mt-2 mx-3" style="height:350px; width:100%">
                                                    <canvas id="doctor_speciality" style="height:40vh; width:100vw"> </canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-lg-6">
                                            <div class="card" style="background-color: #eee">
                                            <h5 style="color: #596167; padding: 1.5rem 1.5rem 0 !important;"><i class="bi bi-bar-chart"></i> @lang('messages.graficas.doctores_activos') / @lang('messages.graficas.doctores_inactivos')</h5>

                                            <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                    <canvas id="doctors"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                        <div class="card" style="background-color: #eee;">
                                            <div class="card-body p-4">
                                                <div class="row" id="table-patients">
                                                    <h5 style="color: #596167"><i class="bi bi-people"></i> @lang('messages.menu.pacientes')</h5>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                        <table id="table-patient" class="table table-striped table-bordered" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.codigo_paciente')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.nombre_apellido')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.cedula')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.fecha_nacimiento')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.telefono')</th>
                                                                    <th class="text-center w-30" scope="col" data-orderable="false">@lang('messages.tabla.centro_salud') </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($patients as $item)

                                                                    <tr>
                                                                        <td class="text-center text-capitalize"> {{ $item->patient_code }}</td>
                                                                        <td class="text-center text-capitalize"> {{ $item->name }} {{ $item->last_name }} </td>
                                                                        <td class="text-center text-capitalize"> {{ $item->is_minor === 'true' ? $item->re_ci . '  (Rep)' : $item->ci }} </td>
                                                                        <td class="text-center text-capitalize"> {{ $item->birthdate }}</td>
                                                                        <td class="text-center text-capitalize"> {{ $item->phone }}</td>
                                                                        <td class="text-center text-capitalize"> {{ $item->get_center->description }} </td>
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

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12">
                                        <div class="card" style="background-color: #eee;">
                                            <div class="card-body p-4">
                                                <div class="row" id="table-patients">
                                                    <h5 style="color: #596167"><i class="bi bi-people"></i> Médicos</h5>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                        <table id="table-patient" class="table table-striped table-bordered" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center w-image" scope="col" data-orderable="false">@lang('messages.tabla.foto')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.especialidad')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.nombre_apellido')</th>
                                                                    <th class="text-center w-30" scope="col" data-orderable="false">@lang('messages.tabla.centro_salud') </th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.piso') / @lang('messages.tabla.consultorio')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.telefono')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.email')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($dortors as $key => $item)
                                                                    <tr>
                                                                        <td class="table-avatar">
                                                                            <img class="avatar" src=" {{ $item->user_img ? asset('/imgs/' .$item->user_img) : asset('/img/avatar/avatar.png') }}" alt="Imagen del paciente">
                                                                        </td>
                                                                        <td class="text-center">{{ $item->specialty }}</td>
                                                                        <td class="text-center text-capitalize">{{ $item->name . ' ' . $item->last_name }}</td>
                                                                        <td class="text-center text-capitalize"> Dr. {{ $item->get_center->description }} </td>
                                                                        <td class="text-center">{{ $item->number_floor }} / {{ $item->number_consulting_room }}</td>
                                                                        <td class="text-center">{{ $item->phone }}</td>
                                                                        <td class="text-center">{{ $item->email }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
