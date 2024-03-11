@extends('layouts.app')
@section('title', 'Pago del plan')
<style>
    .logo-bank {
        width: 40%;
        height: auto;
    }

    .logoSq {
        width: 50% !important;
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
    <script></script>
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
                                    <div id="free"
                                        style="display: none; display: flex; justify-content: center; text-align: center;">
                                        <div class="row" style="display: flex; width: 60%; font-size: 14px;">
                                            <ul class="list-group">
                                                <li class="list-group-item"
                                                    style="background-color: #6f6f6e; color: white;">
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
                                        </div>
                                    </diV>


                                </div>
                                {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-payment']) }}
                                <div class="row">

                                    <h1>Adquiere tu plan informacion de planes bueno flujo</h1>

                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-2 mb-3"
                                        style="display: flex; justify-content: center;">
                                        <input disabled class="btn btnSave send " value="Adquiere tu plan"
                                            onclick="handlerSubmit();" style="margin-left: 20px" />
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
