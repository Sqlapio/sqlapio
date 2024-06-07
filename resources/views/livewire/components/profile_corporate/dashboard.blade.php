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

        $(document).ready(() => {

        let user = @json(Auth::user());

            get_recorded_appointments();
            get_active_doctors();
            get_inactive_doctors();
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
                                                    <canvas id="recorded_appointments" style="height:40vh; width:100vw"> </canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-lg-6">
                                        <div class="card" style="background-color: #222f3e">
                                            <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                    <canvas id="active_doctors"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-lg-6">
                                        <div class="card " style="background-color: #222f3e">
                                            <div class="card-body p-4" style="display: flex; justify-content: center;">
                                                <div class="c-chart-wrapper mt-2 mx-3 graficas-3" style="height:auto; width:100%">
                                                    <canvas id="inactive_doctors"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-lg-6">
                                        <div class="card" style="background-color: #222f3e;">
                                            <div class="card-body p-4">
                                                <div class="row" id="table-patients" style="color: #b3b3b3">
                                                    <h5><i class="bi bi-people" style="color: #fffff"></i>  @lang('messages.menu.pacientes')</h5>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                        <table id="table-patient" class="table table-striped table-bordered table-dark" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center w-image" scope="col"
                                                                        data-orderable="false">@lang('messages.tabla.foto')</th>
                                                                    <th class="text-center w-10" scope="col"
                                                                        data-orderable="false">@lang('messages.tabla.nombre_apellido')</th>
                                                                    <th class="text-center w-10" scope="col"
                                                                        data-orderable="false">@lang('messages.form.email')</th>
                                                                    <th class="text-center w-10" scope="col"
                                                                        data-orderable="false">@lang('messages.tabla.telefono')</th>

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
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-lg-6">
                                        <div class="card" style="background-color: #222f3e;">
                                            <div class="card-body p-4">
                                                <div class="row" id="table-patients" style="color: #b3b3b3">
                                                    <h5><i class="bi bi-people" style="color: #fffff"></i> Médicos</h5>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                        <table id="table-patient" class="table table-striped table-bordered table-dark" style="width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center w-image" scope="col" data-orderable="false">@lang('messages.tabla.foto')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.nombre_apellido')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.email')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.form.especialidad')</th>
                                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.telefono')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($dortors as $key => $item)
                                                                    <tr>
                                                                        <td class="table-avatar">
                                                                            <img class="avatar" src=" {{ $item->user_img ? asset('/imgs/' .$item->user_img) : asset('/img/avatar/avatar.png') }}" alt="Imagen del paciente">
                                                                        </td>
                                                                        <td class="text-center text-capitalize">{{ $item->name . ' ' . $item->last_name }}</td>
                                                                        <td class="text-center">{{ $item->email }}</td>
                                                                        <td class="text-center">{{ $item->specialty }}</td>
                                                                        <td class="text-center">{{ $item->phone }}</td>
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
