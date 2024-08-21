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
        /* background: url({{ asset('img/bg_pdf/horizontal_green.png') }}) no-repeat top fixed; */
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
            <div class="row justify-content-center" style="display: flex;">
                <div class="col-sm-12 justify-content-center mt-3 px-5">
                    <div class="container text-center">
                        <div class="row justify-content-evenly">
                            <div class="col-sm-6" style="padding-right: 60px">
                                <div style="display: flex; flex-direction: column; align-items: center; margin-right: 10px;">
                                    <span class="text-capitalize"
                                        style="font-size: 20px; font-weight: bold;">{{ $nombre }}</span></strong>
                                    <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} / MPPS:
                                        {{ $mpps }}</span>
                                    <span class="text-capitalize" style="font-size: 15px;">Especialidad:
                                        {{ $especialidad }}</span>
                                </div>
                                <div class="header mt-2">
                                    <div
                                        style="display: flex; flex-direction: column; align-items: center; margin-right: 10px;">
                                        <span class="text-capitalize" style="font-size: 12px;">Nombre:
                                            {{ $medical_prescription->get_paciente->name . ' ' . $medical_prescription->get_paciente->last_name }}</span>
                                        <span class="text-capitalize" style="font-size: 12px;">C.I:
                                            {{ $medical_prescription->get_paciente->ci }}</span>
                                        <span class="text-capitalize" style="font-size: 12px;">Genero:
                                            {{ $medical_prescription->get_paciente->genere }}</span>
                                        <span class="text-capitalize" style="font-size: 12px;">Edad:
                                            {{ $medical_prescription->get_paciente->age }}</span>
                                    </div>
                                </div>
                                <div class='mt-2'style="margin-bottom: 5px; text-align: center; font-size: 12px;">
                                    <p>Direccion: {{ $direccion }}. Piso {{ $piso }}, Consultorio
                                        {{ $consultorio_num }}
                                        <br>Telefono: {{ $consultorio_tel }} / {{ $personal_tel }}
                                        <br>Redes Sociales: Instagram: @gf.com
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 60px">
                                <div class="header">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <span class="text-capitalize"
                                            style="font-size: 20px; font-weight: bold;">{{ $nombre }}</span></strong>
                                        <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} /
                                            MPPS: {{ $mpps }}</span>
                                        <span class="text-capitalize" style="font-size: 15px;">Especialidad:
                                            {{ $especialidad }}</span>
                                    </div>
                                </div>
                                <div class="header mt-2">
                                    <div
                                        style="display: flex; flex-direction: column; align-items: center; margin-right: 10px;">
                                        <span class="text-capitalize" style="font-size: 12px;">Nombre:
                                            {{ $medical_prescription->get_paciente->name . ' ' . $medical_prescription->get_paciente->last_name }}</span>
                                        <span class="text-capitalize" style="font-size: 12px;">C.I:
                                            {{ $medical_prescription->get_paciente->ci }}</span>
                                        <span class="text-capitalize" style="font-size: 12px;">Genero:
                                            {{ $medical_prescription->get_paciente->genere }}</span>
                                        <span class="text-capitalize" style="font-size: 12px;">Edad:
                                            {{ $medical_prescription->get_paciente->age }}</span>
                                    </div>
                                </div>
                                <div class='mt-2'style="margin-bottom: 5px; text-align: center; font-size: 12px;">
                                    <p>Direccion: {{ $direccion }}. Piso {{ $piso }}, Consultorio
                                        {{ $consultorio_num }}
                                        <br>Telefono: {{ $consultorio_tel }} / {{ $personal_tel }}
                                        <br>Redes Sociales: Instagram: @gf.com
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center text-left" style="margin-top: 10px;">
                <div class="col-sm-12 justify-content-center mt-3 px-5">
                    <div class="container">
                        <div class="row justify-content-evenly mt-3">
                            <div class="col-sm-6" style="padding-left: 14px;">
                                <div class="header">
                                    <div style="display: flex; flex-direction: column">
                                        <span class="text-capitalize"
                                            style="font-size: 15px; font-weight: bold;">Medicamentos</span></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-left: 62px;">
                                <div class="header">
                                    <div style="display: flex; flex-direction: column">
                                        <span class="text-capitalize"
                                            style="font-size: 15px; font-weight: bold;">Indicaciones</span></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-evenly mt-3">
                            @foreach ($medicamentos as $item)
                                <div class="col-sm-6 mt-3" style="padding-left: 14px;">
                                    <div style="display: flex; flex-direction: column; align-items: left;">
                                        <span class="text-capitalize"
                                            style="font-size: 10px;">{{ $item->medicine }}</span></strong>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3" style="padding-left: 62px;">
                                    <div class="header">
                                        <div style="display: flex; flex-direction: column; align-items: left;">
                                            <span class="text-capitalize" style="font-size: 10px;">Medicamento:
                                                {{ $item->medicine }}</span></strong>
                                            <span class="text-capitalize" style="font-size: 10px;">Indicaciones:
                                                {{ $item->indication }} cada {{ $item->hours }} horas.</span></strong>
                                            <span class="text-capitalize" style="font-size: 10px;">Duracion:
                                                {{ $item->treatmentDuration }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
