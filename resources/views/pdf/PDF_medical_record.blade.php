@extends('layouts.app')
@section('title', 'Medical Record')
<style>
    body {
        /* font-family: 'Creato Display', sans-serif; */
        margin-top: 5cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 2cm;

        -webkit-background-size: contain;
        -moz-background-size: contain;
        -o-background-size: contain;
        background-size: contain !important;
        background: url({{ asset('img/fondo-pdf.png') }}) no-repeat top fixed;
    }

    .imagen {
        /* text-align: left; */
        margin-top: 13px
    }

    .barcodeStyle  {
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
        <div class="container-fluid" style="width: 32%; font-size: 12px">
            <div class="row" style="margin-top: 6%;">
                <div class="row">
                    <div class="col-md-12" style="display: flex; flex-direction: column; align-items: center;">
                        <strong style="font-size: 15px;"> Dr.
                        <span class="text-capitalize" style="font-size: 15px;">{{ Auth::user()->name . ' ' . Auth::user()->last_name}}</span></strong>
                        <span class="text-capitalize" style="font-size: 13px;">{{ Auth::user()->specialty}}</span>
                        <span class="text-capitalize" style="font-size: 13px;">C.I: {{ Auth::user()->ci}} / MPPS: {{ Auth::user()->cod_mpps}}</span>
                        {{-- </div>
                            <div class="col-md-6" style="display: flex; flex-direction: column;"> --}}
                        <br>
                        <strong style="font-size: 15px;">{{ $MedicalRecord->get_center->description }}</strong>
                        <span>{{ ($MedicalRecord->get_doctor->type_plane == "7") ? 'corporativo' : $doctor_center->address }}. </span>
                        <span>Piso {{($MedicalRecord->get_doctor->type_plane == "7") ? $MedicalRecord->get_doctor->number_floor  : $doctor_center->number_floor }}, Consultorio {{ $doctor_center->number_consulting_room }} </span>
                        <span>{{($MedicalRecord->get_doctor->type_plane == "7") ?  $MedicalRecord->get_doctor->number_consulting_phone :  $doctor_center->phone_consulting_room }}</span>
                        <br>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <strong style="font-size: 15px;">Fecha:</strong>
                        <span style="font-size: 15px;">{{ $MedicalRecord->record_date }}</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 d-flex mt-4" >
                        <div class="col-md-6">
                            <strong>Nombre:
                            </strong><span class="text-capitalize">{{ $MedicalRecord->get_paciente->name . ' ' . $MedicalRecord->get_paciente->last_name }}</span>
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
                        <div class="col-md-6" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="barcodeStyle" src="data:image/png;base64,{{ $barcode }}">
                            <span class="code-span">{{ $MedicalRecord->get_paciente->patient_code }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 justify-content-center text-center mt-3">
                        <strong> Consulta Médica</strong>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 justify-content-center mt-3">
                        <strong> Antecendente:</strong>
                        <pre style="font-size: 12px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" >{{ $MedicalRecord->background }}</pre>
                        {{-- <p class="text-justify"></p> --}}
                    </div>
                    <div class="col-md-12 justify-content-center mt-3">
                        <strong> Razón de la visita:</strong>
                        <pre style="font-size: 12px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" >{{ $MedicalRecord->razon }}</pre>

                        {{-- <p class="text-justify">{{ $MedicalRecord->razon }}</p> --}}
                    </div>
                    <div class="col-md-12 justify-content-center mt-3">
                        <strong> Diagnóstico:</strong>
                        <pre style="font-size: 12px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" >{{ $MedicalRecord->diagnosis }}</pre>

                        {{-- <p class="text-justify">{{ $MedicalRecord->diagnosis }}</p> --}}
                    </div>
                    <div class="col-md-12 justify-content-center mt-3">
                        <strong> Exámenes:</strong>
                        <p class="text-justify">
                            @foreach ($MedicalRecord->get_exam_medical as $item)
                            {{ $item->description . ',' }}
                            @endforeach
                        </p>
                    </div>
                    <div class="col-md-12 justify-content-center mt-3">
                        <strong> Estudios:</strong>
                        <p class="text-justify">
                            @foreach ($MedicalRecord->get_study_medical as $item)
                                {{ $item->description . ',' }}
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <img class="img-pat" style="object-fit: contain; width: 200px; heigth: auto" src="{{ asset('/imgs/seal/' . Auth::user()->digital_cello) }}" alt="Avatar">
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-md-12 justify-content-center text-center">
                    <span>Copyright © 2024 SqLapioTechnology LLC. All rights reserved.</span>
                    </div>
                </div>
            </div>
          </div>
    </div>
@endsection
