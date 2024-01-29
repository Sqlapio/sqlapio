@extends('layouts.app-auth')
@section('title', 'Tablero')
{{-- @vite(['resources/js/graphic_laboratory_coun_study.js', 'resources/js/graphic_laboratory_coun_exam.js']) --}}
<style>
    .mt-gf {
        margin-top: 3rem !important;
    }

    @media screen and (max-width: 576px) {
        .mt-gf {
            margin-top: 0 !important;
        }
    }
</style>
@push('scripts')
    <script></script>
@endpush
@section('content')
    <div>
        <div class="container-fluid body" style="padding: 0 3% 3%">
            <div class="accordion" id="accordion">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item ">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-1" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-graph-up"></i> Estadisticas
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            {{-- gestion de usuarios --}}
            <div class="accordion" id="accordion">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item ">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-1" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-graph-up"></i> Visitadores Medicos
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">

                                    <div class="row">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                            <a id="Link-medicos" href="{{ Auth::user()->token_corporate }}" target="_blank"
                                                style="text-decoration: none;">
                                                <button type="button" class="btn btnPrimary">Nuevo visitador medico</button>
                                            </a>
                                            <button type="button" id="icon-copy" class="btn btn-iSecond rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Copiar enlace de registro"
                                                onclick="triggerExample('{{ Auth::user()->token_corporate }}');"
                                                style="margin-left: 5%;">
                                                <i class="bi bi-file-earmark-text"></i>
                                            </button> <span style="padding-left: 5px" id="copied"></span>
                                        </div>
                                    </div>

                                    <div class="table-responsive" id="div-patients-corp"
                                        style="margin-top: 20px; width: 100%;">
                                        <table id="table-patients-corp" class="table table-striped table-bordered"
                                            style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nombre y Apellido</th>
                                                    <th class="text-center">Número de Cédula</th>
                                                    <th class="text-center">Correo electrónico</th>
                                                    <th class="text-center">Cargo</th>
                                                    <th class="text-center">Numero teléfonico</th>
                                                    <th class="text-center" data-orderable="false">Habilitar/Deshabilitar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user_vm as $key => $item)
                                                    <tr>
                                                        <td class="text-center text-capitalize">
                                                            {{ $item->name . ' ' . $item->last_name }}</td>
                                                        <td class="text-center">{{ $item->ci }}</td>
                                                        <td class="text-center">{{ $item->email }}</td>
                                                        <td class="text-center">{{ $item->role }}</td>
                                                        <td class="text-center">{{ $item->phone }}</td>
                                                        <td class="text-center table-check w-5">
                                                            <div class="form-check form-switch"
                                                                style="display: flex; justify-content: center;">
                                                                <input onchange="handlerDoctor(event);" style="width: 5em"
                                                                    class="{{ $item->tipo_status == '1' ? 'form-check-input' : 'form-check-input ci' }}"
                                                                    type="checkbox" role="switch"
                                                                    id="flexSwitchCheckChecked" value="{{ $item->id }}"
                                                                    {{ $item->tipo_status != '1' ? '' : 'checked' }}>
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
    </div>

@endsection
