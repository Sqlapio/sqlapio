<!DOCTYPE html>
<html>

<head>
    <title>Consulta medica</title>
</head>
<style>
    body {
        font-family: 'Creato Display', sans-serif;
        font-size: 12px;
        margin-top: 5cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 2cm;

    }

    .table-border {
        text-align: left;
        padding: 10px;
        text-align: justify;
    }

    .page-break {
        /* page-break-after: always;
        text-align: right !important; */
        page-break-after: right
    }

    .footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0px;
        height: 50px;
        text-align: center;
        line-height: 35px;
        padding: 10px;
        font-size: 12px;
        margin-top: 3cm
    }

    table {
        border-collapse: collapse;
        border: 09x;
        /* letter-spacing: 1px; */
        font-size: 0.8rem;
        width: 100%;
    }
    .border-table {
        border: 1px solid black;
        font-size: 10px;
    }


    th {
        border: 0px;
        text-align: left;
        font-size: 20px;
        color: #38ABE2
    }

    td {
        text-align: left;
        text-align: justify;

    }

    .text {
        text-align: left;
    }

    .img-pat {
        margin-top: -40px !important;
        padding: 10px;
        border-radius: 10px;
    }

    span {
        text-transform: capitalize;
    }

    /* ////////////// */
    .text-header {
        background-color: #2A8ED7;
        color: white;
        border-radius: 50px !important;
    }

    .table-info-pat {
        border: 1px solid black;
    }

    .info-pat {
        margin-top: -20px !important;
        padding: 10px;
    }

    .imagen {
        text-align: left;
        margin-top: 13px
    }

    .header {
        position: fixed;
        top: 0cm;
        left: -1cm;
        width: 100%;
    }

    .inf-prueba {
        float: left;
        margin-left: 1cm;
    }
</style>

<body>
    <div class="header">
        <table class="inf-prueba">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-header">
                    <td colspan="2" style="text-align: center;padding-top: 10px;font-size: 25px;"> <strong>Recipe
                            medico</strong></td>
                </tr>
                <tr class="text-header" style="border-radius: 50px!important;">
                    <td style="padding: 10px;">
                        <div>
                            <strong
                                style="font-size: 15px;">{{ $medical_prescription->get_center->description }}</strong>
                            <p style="margin-top: 0px">
                                Dirección: {{ $medical_prescription->get_center_data->address }},
                                Local,
                                {{ $medical_prescription->get_center_data->number_floor }}<br>{{ $medical_prescription->get_center_data->phone_consulting_room }}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div style="text-align: justify;padding: 10px; margin-top:20px; margin-left: 25%">
                            <strong> Médico Tratante:</strong>
                            <span>{{ Auth::user()->name . ' ' . Auth::user()->last_name }}</span>
                            <br>
                            <strong>Fecha de la Consulta:</strong>
                            <span>{{ $medical_prescription->record_date }}</span>
                            <br>
                            <strong> Código del paciente:</strong>
                            <span>{{ $medical_prescription->get_paciente->patient_code }}</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <table>
            <thead>
                <tr>
                    <th>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img class="imagen" src="../public/img/avatar/img.jpg" alt="" width="150"
                            height="auto">
                    </td>
                    <td style="padding: 20px">
                        Copyright © 2023 SqLapioTechnology LLC. All rights reserved.
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>

    <div>
        <table class="table-info-pat">
            <thead>
                <tr>
                    <th style="text-align: left;  padding: 10px;" scope="col">
                        Información del paciente:
                    </th>
                    <th style="text-align: left;" scope="col">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">
                        <div class="text  info-pat">
                            <strong>Nombre y
                                Apellido:</strong><span>{{ $medical_prescription->get_paciente->name . ' ' . $medical_prescription->get_paciente->last_name }}</span>
                            {{-- <br> --}}
                            <strong>Cédula:</strong> <span>{{ $medical_prescription->get_paciente->ci }}</span>
                            <br>
                            <strong>Género:</strong> <span>{{ $medical_prescription->get_paciente->genere }}</span>
                            <strong>Edad:</strong> <span>{{ $medical_prescription->get_paciente->age }}</span>
                            <br>
                            <strong>Correo electrónico:</strong>
                            <span>{{ $medical_prescription->get_paciente->email }}</span>
                            <br>
                            <strong>Teléfono:</strong> <span>{{ $medical_prescription->get_paciente->phone }}</span>
                            <br>
                            <strong>Dirección:</strong>
                            <span>{{ $medical_prescription->get_paciente->address }}</span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="text" style="margin-right: -20px">
                            <img class="img-pat" style="border-radius: 20%"
                                src="../public/imgs/{{ $medical_prescription->get_paciente->patient_img }}"
                                alt="Avatar" width="100" height="auto">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div>
        <div>
            <table class="table-info-pat">
                <thead>
                    <tr>
                        <th style="text-align: left;  padding: 10px;" scope="col">
                            Rep:
                        </th>
                        <th style="text-align: left; padding: 10px;" scope="col">
                            Indicaciones:
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $data = json_decode($medical_prescription->medications_supplements);
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td style="text-align: center;">
                            <div class="text  info-pat">
                                <span>{{ $item->medicine }}</span>                             
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <div class="text  info-pat">
                                <<span>{{ $item->indication . ' ' . $item->treatmentDuration }}</span>                             
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(500, 790, "Pag $PAGE_NUM/$PAGE_COUNT", $font, 10);
            ');
        }
    </script>
</body>

</html>
