@extends('layouts.app-auth')
@section('title', 'Gestión Pacientes')
<style>

</style>
@push('scripts')
    <script></script>
@endpush
@section('content')
    <div class="container-fluid" style="padding: 0 3% 3%">
        <div class="row mt-2">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd">
                <div class="accordion" id="accordion">
                    <div class="accordion-item">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button bg-4" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-hospital"></i>Gestión Pacientes
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">
                                {{-- Lista de pacientes con consultas  --}}
                                <div class="row" id="table-patients">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                        style="margin-top: 20px;">
                                        <table id="table-patient" class="table table-striped table-bordered"
                                            style="width:100%; ">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">Imagen</th>
                                                    <th class="text-center" scope="col">Código
                                                        paciente</th>
                                                    <th class="text-center" scope="col">Nombre</th>
                                                    <th class="text-center" scope="col">Cédula</th>
                                                    <th class="text-center" scope="col">Fecha de
                                                        Nacimiento </th>
                                                    <th class="text-center" scope="col">Género</th>
                                                    <th class="text-center" scope="col">Teléfono</th>
                                                    <th class="text-center" scope="col">Email</th>
                                                    <th class="text-center" scope="col">Centro de
                                                        salud</th>
                                                    <th class="text-center"scope="col">Acciones</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($patients as $item)
                                    <tr>
                                        <td class="table-avatar">
                                            <img class="avatar"
                                                src=" {{ $item->get_paciente->patient_img ? asset('/imgs/' . $item->get_paciente->patient_img) : ($item->get_paciente->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                alt="Imagen del paciente">
                                        </td>
                                        <td class="text-center">
                                            <button
                                                onclick="agendarCita({{ $item->get_paciente }},{{ $item->get_paciente->get_reprensetative }})"
                                                type="button" class="btn btnSecond"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-custom-class="custom-tooltip" data-html="true"
                                                title="Agendar cita">{{ $item->get_paciente->patient_code }}</button>
                                        </td>
                                        <td class="text-center text-capitalize">
                                            {{ $item->get_paciente->name }}
                                            {{ $item->get_paciente->last_name }}</td>
                                        <td class="text-center">
                                            {{ $item->get_paciente->is_minor === 'true' ? $item->get_paciente->get_reprensetative->re_ci . '  (Rep)' : $item->get_paciente->ci }}
                                        </td>
                                        <td class="text-center">
                                            {{ date('d-m-Y', strtotime($item->get_paciente->birthdate)) }}
                                        </td>
                                        <td class="text-center text-capitalize">
                                            {{ $item->get_paciente->genere }}</td>
                                        <td class="text-center">
                                            {{ $item->get_paciente->is_minor === 'true' ? $item->get_paciente->get_reprensetative->re_phone . '  (Rep)' : $item->get_paciente->phone }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->get_paciente->is_minor === 'true' ? $item->get_paciente->get_reprensetative->re_email . '  (Rep)' : $item->get_paciente->email }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->get_center->description }}</td>
                                        <td class="text-center">
                                            <div class="d-flex">
                                                <div
                                                    class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                    <button
                                                        onclick="editPatien({{ json_encode($item->get_paciente) }},true); "
                                                        type="button"
                                                        class="btn btn-iSecond rounded-circle"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Editar">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                </div>
                                                <div
                                                    class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                    <a
                                                        href="{{ route('MedicalRecord', $item->get_paciente->id) }}">
                                                        <button type="button"
                                                            class="btn btn-iPrimary rounded-circle"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom"
                                                            title="Consulta médica">
                                                            <i class="bi bi-file-earmark-text"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <div
                                                    class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                    <a
                                                        href="{{ route('ClinicalHistoryDetail', $item->get_paciente->id) }}">
                                                        <button type="button"
                                                            class="btn btn-iSecond rounded-circle"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom"
                                                            title="Historia Clínica">
                                                            <i class="bi bi-file-earmark-text"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
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

@endsection
