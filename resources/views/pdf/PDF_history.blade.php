<!DOCTYPE html>
<html>

<head>
    <title>Historia clínica</title>
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

    .table {
        border-collapse: collapse;
        border: 09x;
        /* letter-spacing: 1px; */
        font-size: 0.8rem;
        width: 100%;
    }

    th {
        border: 0px;
        text-align: left;
        font-size: 15px;
        color: #38ABE2
    }

    td {
        text-align: center;
        text-align: justify;

    }

    .border-table {
        border: 1px solid black;
        font-size: 10px;
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

    h1 {
        color: #2A8ED7;
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

    .DIV {
        margin-top: 1%;
    }

    .container {

        display: flex;
        /* align-items: center; */
        justify-content: space-between;
    }

    #tab2 {
        float: left;
        width: 50%
    }

    #tab3 {
        float: left;
        width: 70%
    }

    .table-dos {
        width: 70%
    }
</style>

<body>
    <div class="header">
        <table class="inf-prueba table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-header">
                    <td colspan="2" style="text-align: center;padding-top: 10px;font-size: 25px;"> <strong> Historia
                            clínica</strong></td>
                </tr>
                <tr class="text-header" style="border-radius: 50px!important;">
                    <td>
                        <div style="text-align: justify;padding: 10px; margin-top:20px">
                            <strong>Nombre y
                                Apellido:</strong><span>{{ $history->get_paciente->name . ' ' . $history->get_paciente->last_name }}</span>
                            <br>
                            <strong>Cédula:</strong> <span>{{ $history->get_paciente->ci }}</span>
                            <br>
                            <strong>Género:</strong> <span>{{ $history->get_paciente->genere }}</span>
                            <br>
                            <strong>Edad:</strong> <span>{{ $history->get_paciente->age }}</span>
                            <br>
                            <strong>Correo electrónico:</strong>
                            <span>{{ $history->get_paciente->email }}</span>
                            <br>
                            <strong>Teléfono:</strong> <span>{{ $history->get_paciente->phone }}</span>
                            <br>
                            <strong>Dirección:</strong>
                            <span>{{ $history->get_paciente->address }}</span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <div class="text" style="margin-right: 40%;margin-top:40px">
                            <img class="img-pat" style="border-radius: 20%"
                                src="../public/imgs/{{ $history->get_paciente->patient_img }}" alt="Avatar"
                                width="100" height="auto">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <table class="table">
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

    <div class="DIV" style="padding: 5%">
        <h1>Datos principales de la historia</h1>
        <table class="table-info-pat table">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left;padding: 10px;">
                        <strong>Peso: </strong><span>{{ $history->weight }}</span>
                        <br>
                        <strong>Altura:</strong> <span>{{ $history->height }}</span>
                        <br>
                        <strong>Motivo de la consulta: </strong> <span>{{ $history->reason }}</span>
                        <br>
                        <strong>Enfermedad actual: </strong><span>{{ $history->current_illness }}</span>

                        <h2>Examen Físico: (Signos vitales)</h2>
                        <br>

                        <strong>Tensión: </strong><span>{{ $history->strain }}</span>
                        <br>
                        <strong>Temperatura: </strong> <span>{{ $history->temperature }}</span>
                        <br>
                        <strong>Resperaciones: </strong> <span>{{ $history->breaths }}</span>
                        <br>
                        <strong>Pulsaciones: </strong><span>{{ $history->pulse }}</span>
                        <br>
                        <strong>Saturación: </strong><span>{{ $history->saturation }}</span>
                        <br>
                        <strong>Condición general: </strong><span>{{ $history->condition }}</span>
                        <br>
                        <strong>Estudios Realizados: </strong><span>{{ $history->applied_studies }}</span>
                        <h2>Información basica adicional</h2>

                        <ul style="margin-left: -30px">
                            <li> {{ $history->hidratado === '1' ? 'Hidratado' : null }} </li>
                            <li> {{ $history->eupenio === '1' ? 'Eupenico' : null }} </li>
                            <li> {{ $history->febril === '1' ? 'Febril' : null }} </li>
                            <li> {{ $history->esfera_neurologica === '1' ? 'Esfera Neurologica (orientado en tiempo espacio y persona, fuerza muscular etc)' : null }}
                            </li>
                            <li> {{ $history->glasgow === '1' ? 'Glasgow (puntuación de la escala)' : null }} </li>
                            <li> {{ $history->esfera_orl === '1' ? 'Esfera ORL (oídos, nariz, boca, cuello)' : null }}
                            </li>
                            <li> {{ $history->esfera_cardiopulmonar === '1' ? 'Esfera cardiopulmonar (corazón y pulmones)' : null }}
                            </li>
                            <li> {{ $history->esfera_abdominal === '1' ? 'Esfera abdominal (semiología abdominal)' : null }}
                            </li>
                            <li> {{ $history->extremidades === '1' ? 'Extremidades (si aplica)' : null }} </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="page-break-after:always;"></div>
    <div style="margin-top: 5%">
        <table class="table-info-pat table">
            <thead>
                <tr>
                    <th class="border-table">Antecedentes Personales y Familiares</th>
                    <th class="border-table">Antecedentes personales patológicos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-table">
                        <ul>
                            <li> {{ $history->cancer === '1' ? 'Cancer' : null }} </li>
                            <li> {{ $history->diabetes === '1' ? 'Diabetes' : null }} </li>
                            <li> {{ $history->tension_alta === '1' ? 'Tension alta' : null }}</li>
                            <li> {{ $history->cardiacos === '1' ? 'Cardiacos' : null }}</li>
                            <li> {{ $history->psiquiatricas === '1' ? 'Psiquiátricas' : null }}</li>
                            <li> {{ $history->alteraciones_coagulacion === '1' ? 'Alteraciones en coagulación' : null }}
                            </li>
                            <li> {{ $history->trombosis_embolas === '1' ? 'Trombosis/Embolas' : null }}</li>
                            <li> {{ $history->tranfusiones_sanguineas === '1' ? 'Tranfusiones sanguineas' : null }}
                            </li>
                            <li> {{ $history->COVID19 === '1' ? 'COVID19' : null }} </li>
                            <li> {{ $history->no_aplica_back === '1' ? 'No aplica' : null }} </li>
                        </ul>
                    </td>
                    <td class="border-table">
                        <ul>
                            <li> {{ $history->hepatitis === '1' ? 'Hepatitis' : null }} </li>
                            <li> {{ $history->VIH_SIDA === '1' ? 'VIH/SIDA' : null }} </li>
                            <li> {{ $history->gastritis_ulceras === '1' ? 'Gastritis/Ulceras' : null }} </li>
                            <li> {{ $history->neurologia === '1' ? 'Neurología' : null }}</li>
                            <li> {{ $history->ansiedad_angustia === '1' ? 'Ansiedad/Angustia' : null }} </li>
                            <li> {{ $history->tiroides === '1' ? 'Tiroides' : null }}</li>
                            <li> {{ $history->lupus === '1' ? 'Lupus' : null }}</li>
                            <li> {{ $history->enfermedad_autoimmune === '1' ? 'Enfermedad autoimmune' : null }}</li>
                            <li> {{ $history->diabetes_mellitus === '1' ? 'Diabetes Mellitus' : null }} </li>
                            <li> {{ $history->presion_arterial_alta === '1' ? 'Presión arterial alta' : null }} </li>
                            <li> {{ $history->tiene_cateter_venoso === '1' ? 'Tiene cateter venoso?' : null }} </li>
                            <li> {{ $history->fracturas === '1' ? 'Fracturas' : null }} </li>
                            <li> {{ $history->trombosis_venosa === '1' ? 'Trombosis venosa' : null }} </li>
                            <li> {{ $history->embolia_pulmonar === '1' ? 'Embolia pulmonar' : null }} </li>
                            <li> {{ $history->varices_piernas === '1' ? 'Varices en piernas' : null }} </li>
                            <li> {{ $history->insuficiencia_arterial === '1' ? 'Insuficiencia arterial' : null }} </li>
                            <li> {{ $history->coagulacion_anormal === '1' ? 'Coagulación anormal' : null }} </li>
                            <li> {{ $history->moretones_frecuentes === '1' ? 'Moretones frecuentes' : null }} </li>
                            <li> {{ $history->sangrado_cirugías_previas === '1' ? 'Sangrado anormal en cirugías previas' : null }}
                            </li>
                            <li> {{ $history->sangrado_cepillado_dental === '1' ? 'Sangrado anormal en cepillado dental' : null }}
                            </li>
                            <li> {{ $history->no_aplic_pathology === '1' ? 'No aplica' : null }} </li>

                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="DIV">
        <table class="table-info-pat table">
            <thead>
                <tr>
                    <th class="border-table">Antecedentes personales no patológica</th>
                    <th class="border-table">Historia ginecologicos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-table">
                        <ul>
                            <li> {{ $history->alcohol === '1' ? 'Alcohol' : null }} </li>
                            <li> {{ $history->drogas === '1' ? 'Drogas' : null }} </li>
                            <li> {{ $history->vacunas_recientes === '1' ? 'Vacunas recientes' : null }} </li>
                            <li> {{ $history->transfusiones_sanguineas === '1' ? 'Transfusiones sanguíneas' : null }}
                            </li>
                            <li> {{ $history->no_aplica_no_pathology === '1' ? 'No aplica' : null }} </li>
                        </ul>
                    </td>

                    <td class="border-table">
                        <ul>
                            <li> {{ $history->edad_primera_menstruation != null ? 'Edad de la primera menstruation' : null }}
                            </li>
                            <li> {{ $history->fecha_ultima_regla != null ? 'Fecha ultima regla' : null }} </li>
                            <li> {{ $history->numero_embarazos != null ? 'Numero de embarazos' : null }} </li>
                            <li> {{ $history->numero_partos != null ? 'Numero de partos' : null }}</li>
                            <li> {{ $history->numero_abortos != null ? 'Numero de cesáreas' : null }}</li>
                            <li> {{ $history->pregunta != null ? 'Numero de abortos' : null }}</li>
                            <li> {{ $history->cesareas != null ? 'En la actualidad' : null }}</li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="page-break-after:always;"></div>

    <div class="container">
        @if ($history->allergies != 'null')
            <div id="tab2">
                <h1>Alergias</h1>
                <table class="table-info-pat table-dos">
                    <thead>
                        <tr>
                            <th class="border-table">Tipo de alergia</th>
                            <th class="border-table">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dataAllergies = json_decode($history->allergies, true);
                        @endphp
                        @foreach ($dataAllergies as $key => $item)
                            <tr>
                                @php
                                    $data = explode(',', $item);
                                @endphp
                                <td class="border-table">{{ $data[0] }}</td>
                                <td class="border-table"> {{ $data[1] }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
        @if ($history->history_surgical != 'null')
            <div id="tab3">
                <h1>Cirugías</h1>
                <table class="table-info-pat table-dos ">
                    <thead>
                        <tr>
                            <th class="border-table">Cirugía</th>
                            <th class="border-table">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $history_surgical = json_decode($history->history_surgical, true);
                        @endphp
                        @foreach ($history_surgical as $key => $item)
                            <tr>
                                @php
                                    $data = explode(',', $item);
                                @endphp
                                <td class="border-table">{{ $data[0] }}</td>
                                <td class="border-table"> {{ $data[1] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    @if ($history->medications_supplements != 'null')
        <div class="DIV" style="margin-top: 40%">
            <h1>Medicamentos</h1>
            <table class="table-info-pat table">
                <thead>
                    <tr>
                        <th class="border-table">Medicamento</th>
                        <th class="border-table">Dosis</th>
                        <th class="border-table">Patologia</th>
                        <th class="border-table">Via de administracion</th>
                        <th class="border-table">Duracion de tratameinto</th>
                        <th class="border-table">Fecha inicio</th>
                        <th class="border-table">Fecha fin</th>
                        <th class="border-table">N-Orden</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $medications_supplements = json_decode($history->medications_supplements, true);
                    @endphp
                    @foreach ($medications_supplements as $key => $item)
                        @php
                            $data = explode(',', $item);
                        @endphp
                        <tr>
                            <td class="border-table">{{ $data[0] }}</td>
                            <td class="border-table"> {{ $data[1] }}</td>
                            <td class="border-table"> {{ $data[2] }}</td>
                            <td class="border-table"> {{ $data[3] }}</td>
                            <td class="border-table"> {{ $data[4] }}</td>
                            <td class="border-table"> {{ $data[5] }}</td>
                            <td class="border-table"> {{ $data[6] }}</td>
                            <td class="border-table"> {{ $data[7] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

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
