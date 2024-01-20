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

    table tr:last-child td:last-child {
        border-bottom-right-radius:10px;
    }

    table tr:last-child td:first-child {
        border-bottom-left-radius:10px;
    }

    table tr:first-child th:first-child,
    table tr:first-child td:first-child {
        border-top-left-radius:10px;
    }

    table tr:first-child th:last-child,
    table tr:first-child td:last-child {
        border-top-right-radius:10px;
    }

    .table-border {
        text-align: left;
        padding: 10px;
        text-align: justify;
    }


    .table-striped>tbody>tr:nth-child(even)>td,
    .table-striped>tbody>tr:nth-child(even)>th {
        /* background-color: #ccc; */
        background-color: #eee;
    }

    .page-break {
        /* page-break-after: always;
        text-align: right !important; */
        page-break-after: right
    }

    .div-seal{
        position: fixed;
        bottom: 3cm;
        left: 0cm;
        right: 0px;
        height: 50px;
        text-align: center;
        line-height: 35px;
        padding: 10px;
        font-size: 12px;
        margin-top: 3cm
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
            /* letter-spacing: 1px; */
        width: 100%;
        font-size: 12px;
        border: 09x;
        border-radius: 10px;
        border-spacing: 0px;
        border-collapse: separate;
    }
    
    .border-table {
        border: 1px solid black;
        border-radius: 10px; 
    }

    .border-b {
        border-bottom: 1px solid black;
    }

    .border-r {
        border-right: 1px solid black;
    }


    th {
        border: 0px;
        text-align: left;
        font-size: 10px;
        color: #38ABE2;
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
        background-color: #2A8ED7;
    }

    .barcodeStyle  {
        width: 50% !important;
        height: 3%;
        margin-left: 30%; 
        margin-bottom: 1% !important;
    }
    .code-span{
        margin-left: 40%;
    }
</style>

<body>
    <div class="header">
        <table class="inf-prueba" style="">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-header">
                    <td colspan="2" style="text-align: center;padding-top: 10px;font-size: 25px;"> <strong>Orden
                            Médica</strong></td>
                </tr>
                <tr class="text-header">
                    <td style="padding: 10px;">
                        <div>
                            <strong
                                style="font-size: 15px;">{{ $medical_prescription->get_center->description }}</strong>
                            <p style="margin-top: 0px">
                                Dirección: {{ ($medical_prescription->get_doctor->type_plane == "7")? ' corporativo': $medical_prescription->get_center_data->address }},
                                Local,
                                {{($medical_prescription->get_doctor->type_plane = "7")? $medical_prescription->get_doctor->number_floor  : $medical_prescription->get_center_data->number_floor }}<br>{{($medical_prescription->get_doctor->type_plane == "7")?  $medical_prescription->get_doctor->number_consulting_phone : $medical_prescription->get_center_data->phone_consulting_room }}
                            </p>
                            <strong> Médico Tratante:</strong>
                            <span>{{ Auth::user()->name . ' ' . Auth::user()->last_name }}</span>
                            <br>
                            <strong>Fecha de la Consulta:</strong>
                            <span>{{ $medical_prescription->record_date }}</span>
                        </div>
                    </td>
                    <td>
                        <div style="text-align: justify;padding: 10px; margin-top:-5%; margin-left: 25%">
                            <img class="barcodeStyle" src="data:image/png;base64,{{ $barcode }}">
                            <br>
                            <span class="code-span">{{ $medical_prescription->get_paciente->patient_code }}</span>
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

    <div style="margin-top: -5% !important">
        <table class="table-info-pat">
            <thead>
                <tr>
                    <th style="text-align: left;  padding: 10px; font-size: 20px; margin-bottom: 2em" scope="col">
                        Información del paciente:
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">
                        <div class="text info-pat">
                            <strong>Nombre Completo: </strong><span>{{ $medical_prescription->get_paciente->name . ' ' . $medical_prescription->get_paciente->last_name }}</span>
                            <br>
                            <strong>C.I:</strong> <span>{{ $medical_prescription->get_paciente->ci }}</span>
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
                            @if ($medical_prescription->get_paciente->patient_img)
                                <img class="img-pat" style="border-radius: 20%; object-fit: cover"
                                    src="../public/imgs/{{ $medical_prescription->get_paciente->patient_img }}" alt="Avatar"
                                    width="100" height="100">
                            @else
                                @if ($medical_prescription->get_paciente->genere == 'femenino')
                                    <img class="img-pat" src="../public/img/avatar/avatar mujer.png" width="100"
                                        height="100" style="border-radius: 20%; object-fit: cover" alt="Avatar">
                                @else
                                    <img class="img-pat" src="../public/img/avatar/avatar hombre.png" width="100"
                                        height="100" style="border-radius: 20%; object-fit: cover" alt="Avatar">
                                @endif
                            @endif
                        </div>                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <div>
            <table class="table-striped table-bordered border-table">
                <thead class="">
                    <tr>
                        <th class="border-b border-r" style="text-align: center;  padding: 10px;">
                            Recipe
                        </th>
                        <th class="border-b border-r" style="text-align: center; padding: 10px; width: 62%">
                            Indicaciones
                        </th>
                        <th class="border-b" style="text-align: center; padding: 10px;">
                            Duración
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $data = json_decode($medical_prescription->medications_supplements);
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td class="border-r" style="text-align: center; padding: 10px;">
                                {{ $item->medicine }}
                            </td>
                            <td class="border-r" style="text-align: center; padding: 10px;">
                                {{ $item->indication }}
                            </td>
                            <td class="border-" style="text-align: center; padding: 10px;">
                                {{ $item->treatmentDuration }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="div-seal">
            <img class="img-pat" style="border-radius: 20%; object-fit: cover"
            src="../public/imgs/seal/{{ Auth::user()->digital_cello }}"
            alt="Avatar" width="270" height="150">            
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
