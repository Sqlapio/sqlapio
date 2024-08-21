@extends('layouts.app')
@section('title', 'Medical Record')
<style>
    @page { margin:0px; }
    body {
        /* font-family: 'Creato Display', sans-serif; */
        margin-top: 0cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 0cm;

        -webkit-background-size: 100%;
        -moz-background-size: 100%;
        -o-background-size: 100%;
        background-size: 100% !important;
        background: url({{ asset('img/bg_pdf/blue.png') }}) no-repeat top fixed;
    }

    .imagen {
        /* text-align: left; */
        margin-top: 13px
    }

    .barcodeStyle {
        width: 30% !important;
        height: auto;
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

    header {
        position: fixed;
        top: 1cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        text-align: center;
        display: flex;
    }

/** Define the footer rules **/
    footer {
        position: fixed;
        bottom: 1cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        text-align: center;
        font-size: 12px;
    }
    footer .pagenum:before {
        content: counter(page);
    }

</style>
@push('scripts')
@endpush
@section('content')
    <div>
        <header>
            <span class="text-capitalize" style="font-size: 20px; margin-bottom: 5px">{{ $nombre }}</span></strong><br>
            <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} / MPPS: {{ $mpps }}</span><br>
            <span class="text-capitalize" style="font-size: 15px;">Especialidad: {{ $especialidad }}</span>
        </header>
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
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 justify-content-center text-center mb-5">
                        <img class="barcodeStyle" src="data:image/png;base64,{{ $barcode }}"><br>
                        <span class="code-span">{{ $MedicalRecord->get_paciente->patient_code }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 justify-content-center text-center mb-5">
                        <strong>Solicitud de Examenes</strong>
                    </div>
                </div>
                <div class="row justify-content-center">
                    {{-- <div class="col-md-12 justify-content-center mt-3">
                    <strong> Antecendente:</strong>
                    <pre style="font-size: 12px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" >{{ $MedicalRecord->background }}</pre>

                    </div> --}}
                    <div class="col-md-12 justify-content-center mt-3 px-5">
                        <strong class="mt-10">Detalle de la solicitud:</strong><br>
                        @foreach ($data_exam as $item)
                            <pre
                                style="font-size: 12px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $item->description }}</pre>
                        @endforeach

                        {{-- <p class="text-justify">{{ $MedicalRecord->razon }}</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <footer style="text-align: center;">
            <div>
                <div style="margin-bottom: 5px; text-align: center;">
                    <p>Direccion: {{ $direccion }}. Piso {{ $piso }}, Consultorio {{ $consultorio_num }}
                        <br>Telefono: {{ $consultorio_tel }} / {{ $personal_tel }}
                    </p>
                </div>
                <div class="pagenum-container">Page <span class="pagenum"></span></div>
            </div>
        </footer>
    </div>
@endsection
