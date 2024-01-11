<!DOCTYPE html>
<html>
<head>
    <title>SqlapioTechnology LLC.</title>
    <style>
        table,
        th {
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;" src="{{ asset('img/notification_email/cita_header.jpg') }}">
    <div style="margin: auto; width: 600px; padding: 10px;">
        <p style="text-align: justify; margin-left: 20px;">
            <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $mailData['dr_name'] }}</h2>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Usted a solicitado la actualización de si derección de correo electrónico<br>
            Por favor introduzca el siguiente código de validación:<br>
            <strong><h1 style="text-align: justify; margin-left: 20px;">{{ $mailData['code'] }}</h1></strong> 
        </p>
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
                    width: 128px;
                    height: auto;" src="{{ asset('img/notification_email/fir_jm.png') }}">
            Ing. Jhonny Martinez<br>CEO
        </p>
        <p style="text-align: justify; font-style: italic; margin-left: 20px;">
            Para mayor información puede comunicarse 24/7 con nuestro equipo a través de sqlapiotechnology@sqlapio.com
        </p>
    </div>
    <img style="
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: auto;" src="{{ asset('img/notification_email/footer.png') }}">

</body>
</html>
