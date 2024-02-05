<!DOCTYPE html>
<html>
<head>
    <title>SqlapioTechnology LLC.</title>
</head>
<body>

    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;"
        src="{{ asset('img/notification_email/notificaciones_img_1.png') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h2 style="text-align: justify; margin-left: 20px;">Paciente: {{ $mailData['patient_name'] }}</h2>
            </p>

            <p style="text-align: justify; margin-left: 20px;">
                Su registro se realizó de forma exitosa:
            </p>

            <p style="text-align: justify; margin-left: 20px;">
                <h3 style="text-align: justify; margin-left: 20px;">
                    Médico tratante Dr(a): {{ $mailData['dr_name'] }}
                    <br>
                    Centro médico: {{ $mailData['center'] }}
                    <br>
                    Dirección: {{ $mailData['center_address'] }}
                    <br>
                    Piso: {{ $mailData['center_piso'] }}
                    <br>
                    Nro. de consultorio: {{ $mailData['center_consulting_room'] }}
                    <br>
                    Teléfono: {{ $mailData['center_phone'] }}
                </h3>
            </p>

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
