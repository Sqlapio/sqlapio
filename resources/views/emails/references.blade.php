<!DOCTYPE html>
<html>
<head>
    <title>SqlapioTechnology LLC.</title>
    <style>
        table, th{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h2 style="text-align: justify; margin-left: 20px;">Referencia Medica</h2>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/cita_header.jpg') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $mailData['patient_name'] }}</h2>
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                Nos complace informarle que usted acaba de realizarce una consulta medica con el <strong>Dr(a): {{ $mailData['dr_name'] }}</strong>, en el centro medico: <strong>{{ $mailData['center'] }}</strong>.
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                <strong>El Dr(a): {{ $mailData['dr_name'] }}</strong> <br> genero una referencia medica con las siguientes especificaciones:
            </p>
            <table style="width: 600px; margin-left: 20px;">
                <tr>
                  <th style="text-align: center; padding: 10px">
                    Código de referencia: {{ $mailData['reference_code'] }}
                    <br>
                    Fecha: {{ $mailData['reference_date'] }}
                    <br>
                    Examenes solicitados:
                    <br>                       
                        @foreach ($mailData['patient_exam'] as $item)
                                {{ $item->description}}<br>
                        @endforeach

                    <br>
                    Estudios o imagenes medicas solicitadas:
                    <br>

                            @foreach ($mailData['patient_study'] as $item)
                            {{ $item->description}}<br>
                            @endforeach                   
                  </th>
                </tr>
              </table>
              <p style="text-align: justify; margin-left: 20px;">
                Gracias por ser parte de nosotro, Sqlapio.com, innovando para el futuro.
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                Atentamente,
                <br>
                <br>
                <img style="
                    display: block;
                    margin-left: 0px;
                    width: 100px;
                    height: auto;"
                src="{{ asset('img/notification_email/fir_jm.png') }}">
                Ing. Jhonny Martinez<br>CEO
            </p>
            <p style="text-align: justify; font-style: italic; margin-left: 20px;">
                Para mayor información puede comunicarse 24/7 con nuestro equipo a traves de sqlapiotechnology@sqlapio.com
            </p>
        </div>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/footer.png') }}">
    
</body>
</html>