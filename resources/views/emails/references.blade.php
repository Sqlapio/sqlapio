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
    <h2 style="text-align: justify; margin-left: 20px;">Referencia Médica</h2>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/notificaciones_img_3.png') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $mailData['patient_name'] }}</h2>
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                Nos complace informarle que usted acaba de tener una consulta médica con el <strong>Dr(a): {{ $mailData['dr_name'] }}</strong>, en el centro médico: <strong>{{ $mailData['center'] }}</strong>.
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                <strong>El Dr(a): {{ $mailData['dr_name'] }}</strong> <br> generó una referencia médica con las siguientes especificaciones:
            </p>
            <table style="width: 600px; margin-left: 20px;">
                <tr>
                  <th style="text-align: center; padding: 10px">
                    Código de referencia: {{ $mailData['reference_code'] }}
                    <br>
                    Fecha: {{ $mailData['reference_date'] }}
                    <br>
                    Exámenes solicitados:
                    <br>
                        @foreach ($mailData['patient_exam'] as $item)
                                {{ $item->description}}<br>
                        @endforeach

                    <br>
                    Estudios o imagenes médicas solicitadas:
                    <br>

                            @foreach ($mailData['patient_study'] as $item)
                            {{ $item->description}}<br>
                            @endforeach
                  </th>
                </tr>
              </table>
              <p style="text-align: justify; margin-left: 20px;">
                Gracias por ser parte de nosotros, Sqlapio.com, innovando para el futuro.
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                Atentamente,
                <br>
                <br>
                <img style="
                    display: block;
                    margin-left: 0px;
                    width: 128px;
                    height: auto;"
                src="{{ asset('img/notification_email/fir_jm.png') }}">
                Ing. Jhonny Martinez<br>CEO
            </p>
            <p style="text-align: justify; font-style: italic; margin-left: 20px;">
                Para mayor información puede comunicarse 24/7 con nuestro equipo a través de soporte@sqlapio.com
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
