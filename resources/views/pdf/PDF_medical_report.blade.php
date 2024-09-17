@extends('layouts.app')
@section('title', 'Medical Report')
<style>
    @page { margin:0px; }

    body {
        font-family: 'Creato Display', sans-serif;
        margin-top: 0cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 0cm;

        -webkit-background-size: contain;
        -moz-background-size: contain;
        -o-background-size: contain;
        background-size: contain !important;
        background: url({{ asset('img/bg_pdf/'.$bg.'.png') }}) no-repeat top fixed;
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
        line-height: 1.4;
    }

    .container-fluid {
        width: 100%;
        margin-top: 3cm;
    }

    .row-data {
        margin-left: 60px;
        margin-right: 60px;
        margin-top: 15px;
    }

    .row-barcode {
        margin-top: 15px;
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


    footer {
        position: fixed;
        bottom: 1cm;
        left: 0cm;
        right: 0cm;
        height: 5cm;
        text-align: center;
        font-size: 14px;
    }
    footer .pagenum:before {
        content: counter(page);
    }
</style>
@push('scripts')
@endpush
@section('content')
<body>
    <header>
        <span class="text-capitalize" style="font-size: 20px; margin-bottom: 5px">{{ $nombre }}</span></strong><br>
        <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} / MPPS: {{ $mpps }}</span><br>
        <span class="text-capitalize" style="font-size: 15px;">Especialidad: {{ $especialidad }}</span>
    </header>

    <footer class="footer">
        <div>
            <img class="img-pat" style="border-radius: 20%; object-fit: cover"src="../public/imgs/seal/{{ Auth::user()->digital_cello }}" alt="Avatar" width="270" height="150">
            <div style="margin-bottom: 5px; text-align: center;">
                <p>Direccion: {{ $direccion }}. Piso {{ $piso }}, Consultorio {{ $consultorio_num }}
                    <br>Telefono: {{ $consultorio_tel }} / {{ $personal_tel }}
                </p>
            </div>
            <div class="pagenum-container">Page <span class="pagenum"></span></div>
        </div>
    </footer>

    <div class="container-fluid">
        <div>
            <hr style="color:#0000001a">
            <div class="row-data" style="display: flex; width: 100%">
                <div style="flex: 50%; font-size: 15px">
                    {{-- Datos del paciente --}}
                    <div class="col-md-6">
                        <strong>Nombre:
                        </strong><span class="text-capitalize">{{ $MedicalReport->get_paciente->name . ' ' . $MedicalReport->get_paciente->last_name }}</span>
                        <br>
                        <strong>C.I:</strong> <span class="text-capitalize">{{ $MedicalReport->get_paciente->ci }}</span>
                        <br>
                        <strong>Género:</strong> <span class="text-capitalize">{{ $MedicalReport->get_paciente->genere }}</span>
                        <strong>Edad:</strong> <span>{{ $MedicalReport->get_paciente->age }}</span>
                        <br>
                        <strong>Correo electrónico:</strong>
                        <span>{{ $MedicalReport->get_paciente->email }}</span>
                        <br>
                        <strong>Teléfono:</strong> <span>{{ $MedicalReport->get_paciente->phone }}</span>
                        <br>
                        <strong>Dirección:</strong>
                        <span>{{ $MedicalReport->get_paciente->address }}</span>
                        <br>
                        <strong>Código:</strong>
                        <span>{{ $MedicalReport->get_paciente->patient_code }}</span>
                    </div>
                </div>
                {{-- <div style="flex: 50%;">
                    <div style="text-align: center">
                        <img class="barcodeStyle" src="data:image/png;base64,{{ $barcode }}"><br>
                        <span class="code-span">{{ $MedicalRecord->get_paciente->patient_code }}</span>
                    </div>
                </div> --}}
            </div>
            <div class="row-barcode">
                <div class="text-center" style="text-align: right; margin-top: 10px; font-size: 15px; margin-right: 60px;">
                    <span><strong>Fecha:</strong> {{ $MedicalReport->date }}</span>
                </div>
            </div>
            <div class="row-barcode">
                <div class="text-center" style="text-align: center; margin-top: 15px; font-size: 21px">
                    <strong>Informe Médico</strong>
                </div>
            </div>
            <div id="prueba" class="row-data">
                <div style="margin-top: 15px">
                    @php

                        // $des = str_replace("\r\n\r\n", "\r\n", $MedicalReport->description);

                        // dump($des);

                        // $des = explode("\r\n", $des);
                    @endphp
                    <pre style=" white-space: pre-line; font-size: 16px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $MedicalReport->description }}</pre>
                    {{-- @if (isset($des[1]))
                        <pre style=" white-space: pre-line; font-size: 16px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $des[1] }}</pre>
                    @endif
                    @if (isset($des[2]))
                        <pre style=" white-space: pre-line; font-size: 16px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $des[2] }}</pre>
                    @endif
                    @if (isset($des[3]))
                        <pre style=" white-space: pre-line; font-size: 16px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $des[3] }}</pre>
                    @endif
                    @if (isset($des[4]))
                        <pre style=" white-space: pre-line; font-size: 16px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $des[4] }}</pre>
                    @endif
                    @if (isset($des[5]))
                        <pre style=" white-space: pre-line; font-size: 16px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $des[5] }}</pre>
                    @endif --}}

                </div>
            </div>
            <br>

        </div>
    </div>
</body>
@endsection
