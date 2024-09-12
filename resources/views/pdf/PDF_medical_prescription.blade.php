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
        background: url({{ asset('img/bg_pdf/'.$bg.'_horizontal.png') }}) no-repeat top fixed;

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
        margin: auto;
    }

    .container-fluid-1 {
        width: 100%;
        margin-top: 3cm;
    }

    .row-data {
        margin-left: 60px;
        margin-right: 60px;
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

    td {
        vertical-align: top;
    }

</style>
@push('scripts')
@endpush
@section('content')
    <body>
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

        <footer style="text-align: center;">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td class="table-border" style="width: 50%">
                            <div style="text-align: center;">
                                <img class="img-pat" style="border-radius: 20%; object-fit: cover" src="../public/imgs/seal/{{ Auth::user()->digital_cello }}" alt="Avatar" width="270" height="150">
                                <div style="margin-bottom: 5px; text-align: center;">
                                    <p>Direccion: {{ $direccion }}. Piso {{ $piso }}, Consultorio {{ $consultorio_num }}
                                        <br>Telefono: {{ $consultorio_tel }} / {{ $personal_tel }}
                                    </p>
                                </div>
                                <div style="text-align: center;" class="pagenum-container">Page <span class="pagenum"></span></div>
                            </div>
                        </td>
                        <td class="table-border" style="width: 50%">
                            <div style="text-align: center;">
                                <img class="img-pat" style="border-radius: 20%; object-fit: cover" src="../public/imgs/seal/{{ Auth::user()->digital_cello }}" alt="Avatar" width="270" height="150">
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

        <div class="container-fluid-1">
            <div>
                <div class="row">
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
                                    <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }} años</span>
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
                                    <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }} años</span>
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
                </div>
                <div class="row">
                    <table style="width: 100%; margin-top: 30px">
                        <tbody>
                            <tr>
                                <td class="table-border" style="width: 50%">
                                    <div class="row-barcode">
                                        <div class="text-center" style="text-align: center; font-size: 21px">
                                            <strong>Medicamentos</strong>
                                        </div>
                                    </div>
                                    <div>
                                        <div style="margin-top: 30px; font-size: 14px; margin-rigth: 62px; width:90%">
                                            <div style="padding-left: 62px; margin-rigth: 62px">
                                                <div style="align-items: left;">
                                                    @php
                                                        $medicaments = collect($medicamentos);
                                                        $arr = $medicaments->chunk(7);
                                                    @endphp
                                                    @foreach ($arr[0] as $item)
                                                        <span class="text-capitalize" style="font-size: 14px;"><strong>-</strong> {{ $item->medicine }}</span><br><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-border" style="width: 50%">
                                    <div class="row-barcode">
                                        <div class="text-center" style="text-align: center; font-size: 21px">
                                            <strong>Indicaciones</strong>
                                        </div>
                                    </div>
                                    <div>
                                        <div style="margin-top: 30px; font-size: 14px; margin-rigth: 50px; width:90%;">
                                            <div style="padding-left: 62px; margin-rigth: 50px; text-align: justify;">
                                                <div class="header">
                                                    <div style="align-items: left;">
                                                        {{-- @php
                                                            $medicaments = collect($medicamentos);
                                                            $arr = $medicaments->chunk(7);
                                                        @endphp --}}
                                                        @foreach ($arr[0] as $item)
                                                            <span class="text-capitalize" style="font-size: 14px;"><strong>- {{ $item->medicine }}</strong>.</span><br>
                                                            <span class="text-capitalize" style="font-size: 14px;"><strong> Indicaciones: </strong> {{ $item->indication }} cada {{ $item->hours }} horas.</span>
                                                            <span class="text-capitalize" style="font-size: 14px;"> <strong> Duracion: </strong> {{ $item->treatmentDuration}}.</span><br><br>
                                                        @endforeach
                                                        </div>
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
                @if(count($arr[0])> 5)
                    <div style="page-break-after:always;"></div>
                    <div style="height: 3cm"> </div>
                @endif
                @if (count($arr[0])> 5)
                    <div class="row">
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
                                        <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }} años</span>
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
                                        <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }} años</span>
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
                    </div>
                    <div class="row">
                        <table style="width: 100%; margin-top: 30px">
                            <tbody>
                                <tr>
                                    <td class="table-border" style="width: 50%">
                                            <div class="row-barcode">
                                                <div class="text-center" style="text-align: center; font-size: 21px">
                                                    <strong>Medicamentos</strong>
                                                </div>
                                            </div>
                                            <div>
                                                <div style="margin-top: 30px; font-size: 14px; margin-rigth: 62px; width:90%">
                                                    <div style="padding-left: 62px; margin-rigth: 62px">
                                                        <div style="align-items: left;">
                                                            @php
                                                                $medicaments = collect($medicamentos);
                                                                $arr = $medicaments->chunk(7);
                                                            @endphp
                                                            @foreach ($arr[1] as $item)
                                                                <span class="text-capitalize" style="font-size: 14px;"><strong>-</strong> {{ $item->medicine }}.</span><br><br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                    <td class="table-border" style="width: 50%">
                                        <div class="row-barcode">
                                            <div class="text-center" style="text-align: center; font-size: 21px">
                                                <strong>Indicaciones</strong>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="margin-top: 30px; font-size: 14px; margin-rigth: 50px; width:90%;">
                                                <div style="padding-left: 62px; margin-rigth: 50px; text-align: justify;">
                                                    <div class="header">
                                                        <div style="align-items: left;">
                                                            @foreach ($arr[1] as $item)
                                                                <span class="text-capitalize" style="font-size: 14px;"><strong>- {{ $item->medicine }}</strong>.</span><br>
                                                                <span class="text-capitalize" style="font-size: 14px;"><strong> Indicaciones: </strong> {{ $item->indication }} cada {{ $item->hours }} horas.</span>
                                                                <span class="text-capitalize" style="font-size: 14px;"> <strong> Duracion: </strong> {{ $item->treatmentDuration}}.</span><br><br>
                                                            @endforeach
                                                            </div>
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
                    @endif
                @if(isset($arr[2]))
                    <div style="page-break-after:always;"></div>
                    <div style="height: 3cm"> </div>
                @endif
                @if (isset($arr[2]))
                    <div class="row">
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
                                        <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }} años</span>
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
                                        <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }} años</span>
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
                    </div>
                    <div class="row">
                        <table style="width: 100%; margin-top: 30px">
                            <tbody>
                                <tr>
                                    <td class="table-border" style="width: 50%">
                                            <div class="row-barcode">
                                                <div class="text-center" style="text-align: center; font-size: 21px">
                                                    <strong>Medicamentos</strong>
                                                </div>
                                            </div>
                                            <div>
                                                <div style="margin-top: 30px; font-size: 14px; margin-rigth: 62px; width:90%">
                                                    <div style="padding-left: 62px; margin-rigth: 62px">
                                                        <div style="align-items: left;">
                                                            @php
                                                                $medicaments = collect($medicamentos);
                                                                $arr = $medicaments->chunk(7);
                                                            @endphp
                                                            @foreach ($arr[2] as $item)
                                                                <span class="text-capitalize" style="font-size: 14px;"><strong>-</strong> {{ $item->medicine }}.</span><br><br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                    <td class="table-border" style="width: 50%">
                                        <div class="row-barcode">
                                            <div class="text-center" style="text-align: center; font-size: 21px">
                                                <strong>Indicaciones</strong>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="margin-top: 30px; font-size: 14px; margin-rigth: 50px; width:90%;">
                                                <div style="padding-left: 62px; margin-rigth: 50px; text-align: justify;">
                                                    <div class="header">
                                                        <div style="align-items: left;">
                                                            @foreach ($arr[2] as $item)
                                                                <span class="text-capitalize" style="font-size: 14px;"><strong>- {{ $item->medicine }}</strong>.</span><br>
                                                                <span class="text-capitalize" style="font-size: 14px;"><strong> Indicaciones: </strong> {{ $item->indication }} cada {{ $item->hours }} horas.</span>
                                                                <span class="text-capitalize" style="font-size: 14px;"> <strong> Duracion: </strong> {{ $item->treatmentDuration}}.</span><br><br>
                                                            @endforeach
                                                            </div>
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
                @endif
            </div>
        </div>
    </body>
@endsection
