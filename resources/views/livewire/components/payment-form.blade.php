@extends('layouts.app-auth')
@section('title', 'Pago del plan')
<style>
    .logo-bank {
        width: 40%;
        height: auto;
    }

    .ico-check {
        background: #C3D8ED;
        border-radius: 20px;
    }

    .logoSq {
        width: 50% !important;
        height: auto;
    }

    .img-icon-select-rol {
        width: 100%;
        height: auto;
    }

    @media only screen and (max-width: 576px) {

        .form-sq-mv {
            align-content: flex-start !important;
        }

        .mt-m3 {
            margin-top: 20px
        }

        .logoSq {
            width: 30%;
            height: auto;
        }

        .logo-bank {
            width: 20px;
            margin-left: 20px;
        }

    }
</style>
@push('scripts')
    <script>
        const handleSelect = (section) => {

            switch (section) {
                case "medico":

                    $("#div-content-medico").show();
                    $("#div-content-laboratorio").hide();
                    $("#div-content-corporativo").hide();

                    $(".corporativo").prop("class", "img-icon-select-rol corporativo");
                    $(".laboratorio").prop("class", "img-icon-select-rol laboratorio");
                    $(".medico").prop("class", "img-icon-select-rol medico ico-check");

                    break;
                case "laboratorio":

                    $("#div-content-laboratorio").show();
                    $("#div-content-medico").hide();
                    $("#div-content-corporativo").hide();

                    $(".medico").prop("class", "img-icon-select-rol medico");
                    $(".corporativo").prop("class", "img-icon-select-rol corporativo");
                    $(".laboratorio").prop("class", "img-icon-select-rol laboratorio ico-check");


                    break;
                case "corporativo":

                    $("#div-content-corporativo").show();
                    $("#div-content-laboratorio").hide();
                    $("#div-content-medico").hide();

                    $(".medico").prop("class", "img-icon-select-rol medico");
                    $(".laboratorio").prop("class", "img-icon-select-rol laboratorio");
                    $(".corporativo").prop("class", "img-icon-select-rol corporativo ico-check");


                    break;
            }
        }

        const handleSelectPlan = (type_plane) => {

            $("#exampleModal").modal("show");
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq form-sq-mv">
                <div class="col-sm-10 col-md-10 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="card mb-3 mt-m3" id="div-form">
                        <div class="card-body">
                            <div id="div-content">
                                <div class="container">
                                    <div class="row" style="display: grid; justify-items: center;">
                                        <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-03.png') }}"
                                            alt="">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2 mb-3"
                                            onclick="handleSelect('medico')">
                                            <img class="img-icon-select-rol ico-check medico"
                                                src="{{ asset('img/V2/Boton_medico.png') }}" alt="">
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2 mb-3"
                                            onclick="handleSelect('laboratorio')">
                                            <img class="img-icon-select-rol laboratorio"
                                                src="{{ asset('img/V2/Boton_laboratorio.png') }}" alt="">
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2 mb-3"
                                            onclick="handleSelect('corporativo')">
                                            <img class="img-icon-select-rol corporativo"
                                                src="{{ asset('img/V2/Boton_laboratorio_bg.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-payment']) }}
                                <div class="row" id="div-content-medico">
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2">
                                        <ul class="list-group">
                                            <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                                <h5>Plan Free</h5></b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 10 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Estudios con
                                                    videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Consultas en IA</b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i><b>Publicidad</b>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                                style="display: flex; justify-content: center;">
                                                <input class="btn btnSave send " value="Adquiere tu plan"
                                                    onclick="handleSelectPlan(1);" style="margin-left: 20px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2">
                                        <ul class="list-group">
                                            <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                                <h5>Plan Profesional</h5></b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 10 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Estudios con
                                                    videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Consultas en IA</b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i><b>Publicidad</b>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                                style="display: flex; justify-content: center;">
                                                <input class="btn btnSave send " value="Adquiere tu plan"
                                                    onclick="handleSelectPlan(2);" style="margin-left: 20px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2">
                                        <ul class="list-group">
                                            <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                                <h5>Plan Ilimitado</h5></b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 10 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Estudios con
                                                    videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Consultas en IA</b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i><b>Publicidad</b>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                                style="display: flex; justify-content: center;">
                                                <input class="btn btnSave send " value="Adquiere tu plan"
                                                    onclick="handleSelectPlan(3);" style="margin-left: 20px" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="div-content-laboratorio" style="display: none">
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2">
                                        <ul class="list-group">
                                            <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                                <h5>Plan Free</h5></b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 10 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Estudios con
                                                    videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Consultas en IA</b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i><b>Publicidad</b>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                                style="display: flex; justify-content: center;">
                                                <input class="btn btnSave send " value="Adquiere tu plan"
                                                    onclick="handleSelectPlan(4);" style="margin-left: 20px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2">
                                        <ul class="list-group">
                                            <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                                <h5>Plan Profesional</h5></b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 10 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Estudios con
                                                    videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Consultas en IA</b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i><b>Publicidad</b>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                                style="display: flex; justify-content: center;">
                                                <input class="btn btnSave send " value="Adquiere tu plan"
                                                    onclick="handleSelectPlan(5);" style="margin-left: 20px" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl--4 mt-2">
                                        <ul class="list-group">
                                            <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                                <h5>Plan Ilimitado</h5></b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 10 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Estudios con
                                                    videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Consultas en IA</b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i><b>Publicidad</b>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                                style="display: flex; justify-content: center;">
                                                <input class="btn btnSave send " value="Adquiere tu plan"
                                                    onclick="handleSelectPlan(6);" style="margin-left: 20px" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="div-content-corporativo" style="display: none">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl--12 mt-2">
                                        <ul class="list-group">
                                            <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                                <h5>Plan Ilimitado</h5></b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 10 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i> 20 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Estudios con
                                                    videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                    style="color: red;"></i> <b
                                                    style="text-decoration: line-through;">Consultas en IA</b>
                                            </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                    style="color: green;"></i><b>Publicidad</b>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                                style="display: flex; justify-content: center;">
                                                <input class="btn btnSave send " value="Adquiere tu plan"
                                                    onclick="handleSelectPlan(7);" style="margin-left: 20px" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header title">
                            <i class="bi bi-calendar-week"></i>
                            <span style="padding-left: 5px">
                                @lang('messages.modal.titulo.agendar_cita')
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="font-size: 12px;"></button>
                        </div>
                        <div class="modal-body">
                            <H1>Integrar pasarela de pago</H1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
