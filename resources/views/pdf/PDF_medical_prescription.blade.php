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

        -webkit-background-size: contain;
        -moz-background-size: contain;
        -o-background-size: contain;
        background-size: contain !important;
        /* background: url({{ asset('img/bg_pdf/horizontal_green.png') }}) no-repeat top fixed; */
        background: url({{ asset('img/bg_pdf/green_horizontal.png') }}) no-repeat top fixed;

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

    .container-fluid {
        width: 100%;
        margin-top: 150px;
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
        height: 3cm;
        text-align: center;
        display: flex;
        width: 100%
    }

/** Define the footer rules **/
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
    <div>
        <header style="text-align: center;">
            <table style="width: 100%; text-align: center;">
                <tbody>
                    <tr>
                        <td class="table-border" style="width: 50%">
                            <span class="text-capitalize" style="font-size: 20px; margin-bottom: 5px">{{ $nombre }}</span></strong><br>
                            <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} / MPPS: {{ $mpps }}</span><br>
                            <span class="text-capitalize" style="font-size: 15px;">Especialidad: {{ $especialidad }}</span>
                        </td>
                        <td class="table-border" style="width: 50%">
                            <span class="text-capitalize" style="font-size: 20px; margin-bottom: 5px">{{ $nombre }}</span></strong><br>
                            <span class="text-capitalize" style="font-size: 15px;">C.I: {{ $ci }} / MPPS: {{ $mpps }}</span><br>
                            <span class="text-capitalize" style="font-size: 15px;">Especialidad: {{ $especialidad }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </header>
        <div>
            <div class="container-fluid">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td class="table-border" style="width: 50%">
                                <div style="font-size: 14px; margin-left: 62px">
                                    <strong>Nombre:
                                    </strong><span class="text-capitalize">{{ $medical_prescription->get_paciente->name . ' ' . $medical_prescription->get_paciente->last_name }}</span>
                                    <br>
                                    <strong>C.I:</strong> <span class="text-capitalize">{{ $medical_prescription->get_paciente->ci }}</span>
                                    <br>
                                    <strong>Género:</strong> <span class="text-capitalize">{{ $medical_prescription->get_paciente->genere }}</span>
                                    <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }}</span>
                                    <br>
                                    <strong>Correo electrónico:</strong>
                                    <span>{{ $medical_prescription->get_paciente->email }}</span>
                                    <br>
                                    <strong>Teléfono:</strong> <span>{{ $medical_prescription->get_paciente->phone }}</span>
                                    <br>
                                    <strong>Dirección:</strong>
                                    <span>{{ $medical_prescription->get_paciente->address }}</span>
                                    <br>
                                    <strong>Código:</strong>
                                    <span>{{ $medical_prescription->get_paciente->patient_code }}</span>
                                </div>
                            </td>
                            <td class="table-border" style="width: 50%">
                                <div style="font-size: 14px; margin-left: 62px">
                                    <strong>Nombre:
                                    </strong><span class="text-capitalize">{{ $medical_prescription->get_paciente->name . ' ' . $medical_prescription->get_paciente->last_name }}</span>
                                    <br>
                                    <strong>C.I:</strong> <span class="text-capitalize">{{ $medical_prescription->get_paciente->ci }}</span>
                                    <br>
                                    <strong>Género:</strong> <span class="text-capitalize">{{ $medical_prescription->get_paciente->genere }}</span>
                                    <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }}</span>
                                    <br>
                                    <strong>Correo electrónico:</strong>
                                    <span>{{ $medical_prescription->get_paciente->email }}</span>
                                    <br>
                                    <strong>Teléfono:</strong> <span>{{ $medical_prescription->get_paciente->phone }}</span>
                                    <br>
                                    <strong>Dirección:</strong>
                                    <span>{{ $medical_prescription->get_paciente->address }}</span>
                                    <br>
                                    <strong>Código:</strong>
                                    <span>{{ $medical_prescription->get_paciente->patient_code }}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td class="table-border" style="width: 50%">
                                <div class="row-barcode">
                                    <div class="text-center" style="text-align: center; margin-top: 30px; font-size: 21px">
                                        <strong>Medicamentos</strong>
                                    </div>
                                </div>
                                <div>
                                    <div style="margin-top: 30px; font-size: 14px; margin-rigth: 62px; width:90%">
                                        <div style="padding-left: 62px; margin-rigth: 62px">
                                            <div style="display: flex; flex-direction: column; align-items: left;">
                                                @foreach ($medicamentos as $item)
                                                    <span class="text-capitalize" style="font-size: 10px;"><strong>-</strong> {{ $item->medicine }}</span><br><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="table-border" style="width: 50%">
                                <div class="row-barcode">
                                    <div class="text-center" style="text-align: center; margin-top: 70px; font-size: 21px">
                                        <strong>Indicaciones</strong>
                                    </div>
                                </div>
                                <div>
                                    <div style="margin-top: 30px; font-size: 14px; margin-rigth: 62px; width:80%">
                                        <div style="padding-left: 62px; margin-rigth: 62px;">
                                            <div class="header">
                                                <div style="display: flex; flex-direction: column; align-items: left;">
                                                        @foreach ($medicamentos as $item)
                                                            <span class="text-capitalize" style="font-size: 10px;"><strong>- Medicamento: </strong> {{ $item->medicine }}</span>
                                                            <span class="text-capitalize" style="font-size: 10px;"><strong> Indicaciones: </strong> {{ $item->indication }} cada {{ $item->hours }} horas.</span>
                                                            <span class="text-capitalize" style="font-size: 10px;"> <strong> Duracion: </strong> {{ $item->treatmentDuration }}</span><br><br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <footer style="text-align: center;">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td class="table-border" style="width: 50%">
                            <div>
                                <div style="margin-bottom: 5px; text-align: center;">
                                    <p>Direccion: {{ $direccion }}. Piso {{ $piso }}, Consultorio {{ $consultorio_num }}
                                        <br>Telefono: {{ $consultorio_tel }} / {{ $personal_tel }}
                                    </p>
                                </div>
                                <div style="text-align: center;" class="pagenum-container">Page <span class="pagenum"></span></div>
                            </div>
                        </td>
                        <td class="table-border" style="width: 50%">
                            <div>
                                <div style="margin-bottom: 5px; text-align: center;">
                                    <p>Direccion: {{ $direccion }}. Piso {{ $piso }}, Consultorio {{ $consultorio_num }}
                                        <br>Telefono: {{ $consultorio_tel }} / {{ $personal_tel }}
                                    </p>
                                </div>
                                <div style="text-align: center;" class="pagenum-container">Page <span class="pagenum"></span></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </footer>
    </div>
@endsection
