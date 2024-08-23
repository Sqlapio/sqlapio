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

    .container-fluid {
        width: 100%;
        margin-top: 3cm;
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


    footer {
        position: fixed;
        bottom: 1cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
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
                </div>
                {{-- <div style="flex: 50%;">
                    <div style="text-align: center">
                        <img class="barcodeStyle" src="data:image/png;base64,{{ $barcode }}"><br>
                        <span class="code-span">{{ $MedicalRecord->get_paciente->patient_code }}</span>
                    </div>
                </div> --}}
            </div>
            <div class="row-barcode">
                <div class="text-center" style="text-align: center; margin-top: 30px; font-size: 21px">
                    <strong> Informe Médico de Consulta</strong>
                </div>
            </div>
            <div class="row-data">
                <div style="margin-top: 30px">
                    <strong>Razón de la visita:</strong>
                    <pre style="font-size: 17px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">{{ $MedicalRecord->razon }}</pre>
                    <br>
                </div>
            </div>
            @if(strlen($MedicalRecord->razon)>1000)
                <div style="page-break-after:always;"></div>
            @endif
            <div class="row-data">
                <strong>Diagnóstico:</strong>
                @php
                    $des = str_replace('Diagnóstico: ', '', $MedicalRecord->diagnosis);
                    $description = str_replace('\r\n', "<br>", $des)
                @endphp
                    <pre style="font-size: 17px ; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">{{ $description }}</pre>
            </div>
            <br>
            @if(strlen($MedicalRecord->diagnosis)>600)
                <div style="page-break-after:always;"></div>
            @endif
            <div style="height: 3cm"> </div>
            <div class="row-data">
                <strong>Sintomas:</strong>
                <p style="font-size: 17px">{{ $MedicalRecord->sintomas }}</p>
                <br>
                <strong>Exámenes:</strong>
                @foreach ($MedicalRecord->get_exam_medical as $item)
                <p style="font-size: 17px">{{ $item->description }}</p>
                @endforeach
                <br>
                <strong>Estudios:</strong>
                @foreach ($MedicalRecord->get_study_medical as $item)
                <p style="font-size: 17px">{{ $item->description }}</p>
                @endforeach
                <br>
                <strong>Tratamiento:</strong>
                @foreach (json_decode($MedicalRecord->medications_supplements) as $item)
                    <p style="font-size: 17px"><strong>Medicamento:</strong> {{ $item->medicine }}, <strong>Indicaciones:</strong> {{ $item->indication }}, <strong>Via:</strong> {{ $item->route }}, <strong>Duración:</strong> {{ $item->treatmentDuration}}, cada {{ $item->hours }} Horas.</p>
                @endforeach
                <br>
            </div>
        </div>
    </div>
</body>
@endsection
