@extends('layouts.app')
@section('title', 'Medical Record')
<style>
    body {
        /* font-family: 'Creato Display', sans-serif; */
        margin-top: 0cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 0cm;

        -webkit-background-size: contain;
        -moz-background-size: contain;
        -o-background-size: contain;
        background-size: contain !important;
        background: url({{ asset('img/bg_pdf/' . $bg) }}) no-repeat top fixed;
    }

    .imagen {
        /* text-align: left; */
        margin-top: 13px
    }

    .barcodeStyle {
        width: 90% !important;
        height: 37%;
    }

    .img-pat {
        padding: 10px;
        border-radius: 10px;
    }

    pre {
        white-space: pre-wrap;
        white-space: -moz-pre-wrap;
        white-space: -pre-wrap;
        white-space: -o-pre-wrap;
        word-wrap: break-word;
        text-align: justify;
        line-height: 1.4;
    }
</style>
@push('scripts')
@endpush
@section('content')
    <div>
        <div class="container-fluid" style="font-size: 12px">
            <div class="row" style="margin-top: 16%;">

                <hr>
                <div class="row mt-8">
                    <div class="col-md-12 d-flex mt-8 px-5">
                        {{-- Datos del paciente --}}
                        <div class="col-md-6">
                            <strong>Nombre:
                            </strong><span
                                class="text-capitalize">{{ $MedicalRecord->get_paciente->name . ' ' . $MedicalRecord->get_paciente->last_name }}</span>
                            <br>
                            <strong>C.I:</strong> <span class="text-capitalize">{{ $MedicalRecord->get_paciente->ci }}</span>
                            <br>
                            <strong>Género:</strong> <span>{{ $MedicalRecord->get_paciente->genere }}</span>
                            <strong>Edad:</strong> <span>{{ $MedicalRecord->get_paciente->age }}</span>
                            <br>
                            <strong>Correo electrónico:</strong>
                            <span>{{ $MedicalRecord->get_paciente->email }}</span>
                            <br>
                            <strong>Teléfono:</strong> <span>{{ $MedicalRecord->get_paciente->phone }}</span>
                            <br>
                            <strong>Dirección:</strong>
                            <span>{{ $MedicalRecord->get_paciente->address }}</span>
                        </div>
                        <div class="col-md-6"
                            style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="barcodeStyle" src="data:image/png;base64,{{ $barcode }}">
                            <span class="code-span">{{ $MedicalRecord->get_paciente->patient_code }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 justify-content-center text-center mt-3">
                        <strong> Informe Médico</strong>
                    </div>
                </div>
                <div class="row justify-content-center">
                    {{-- <div class="col-md-12 justify-content-center mt-3">
 <strong> Antecendente:</strong>
 <pre style="font-size: 12px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" >{{ $MedicalRecord->background }}</pre>

 </div> --}}
                    <div class="col-md-12 justify-content-center mt-3 px-5">
                        <strong> Descripcion del Informe:</strong>
                        <pre
                            style="font-size: 12px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $MedicalRecord->description }}</pre>

                        {{-- <p class="text-justify">{{ $MedicalRecord->razon }}</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
