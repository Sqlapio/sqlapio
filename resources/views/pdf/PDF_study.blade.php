@extends('layouts.app')
@section('title', 'Medical Record')
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
        text-align: justify;
        line-height: 1.4;
    }

    .container-fluid {
        width: 100%;

    }

    .row-data {
        margin-left: 60px;
        margin-right: 60px;
        margin-top: 30px;
    }

    .row-barcode {
        margin-top: 30px;
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
    <div>
        <header>
            <span class="text-capitalize" style="font-size: 20px; margin-bottom: 5px">{{ $nombre }}</span></strong><br>
            <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} / MPPS: {{ $mpps }}</span><br>
            <span class="text-capitalize" style="font-size: 15px;">Especialidad: {{ $especialidad }}</span>
        </header>
        <div class="container-fluid">
            <div class="" style="margin-top: 16%;">
                <hr style="color:#0000001a">
                <div class="row-data" style="display: flex; width: 100%">
                    <div style="flex: 50%; font-size: 15px">
                        {{-- Datos del paciente --}}
                        <div class="col-md-6">
                            <strong>Nombre:
                            </strong><span class="text-capitalize">{{ $MedicalRecord->get_paciente->name . ' ' . $MedicalRecord->get_paciente->last_name }}</span>
                            <br>
                            <strong>C.I:</strong> <span class="text-capitalize">{{ $MedicalRecord->get_paciente->ci }}</span>
                            <br>
                            <strong>Género:</strong> <span class="text-capitalize">{{ $MedicalRecord->get_paciente->genere }}</span>
                            <strong>Edad:</strong> <span>{{ $MedicalRecord->get_paciente->age }}</span>
                            <br>
                            <strong>Correo electrónico:</strong>
                            <span>{{ $MedicalRecord->get_paciente->email }}</span>
                            <br>
                            <strong>Teléfono:</strong> <span>{{ $MedicalRecord->get_paciente->phone }}</span>
                            <br>
                            <strong>Dirección:</strong>
                            <span>{{ $MedicalRecord->get_paciente->address }}</span>
                            <br>
                            <strong>Código:</strong>
                            <span>{{ $MedicalRecord->get_paciente->patient_code }}</span>
                        </div>
                        {{-- <div class="col-md-6"
                            style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                            <img class="barcodeStyle" src="data:image/png;base64,{{ $barcode }}">
                            <span class="code-span">{{ $MedicalRecord->get_paciente->patient_code }}</span>
                        </div> --}}
                    </div>
                </div>
                <div class="row-barcode">
                    <div class="text-center" style="text-align: center; margin-top: 30px; font-size: 21px">
                        <strong>Solicitud de Estudios</strong>
                    </div>
                </div>
                <div class="row-barcode">
                    <div class="text-center" style="text-align: right; margin-top: 10px; font-size: 15px; margin-right: 60px;">
                        <span><strong>Fecha:</strong> {{ $MedicalRecord->record_date }}</span>
                    </div>
                </div>
                <div class="row-data">
                    <div style="margin-top: 30px">
                        <strong style="margin-bottom: 15px">Detalle de la solicitud:</strong><br><br>
                        @foreach ($data_exam as $item)
                            <pre style="font-size: 17px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">{{ $item->description }}</pre>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <footer style="text-align: center;">
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
    </div>
@endsection
