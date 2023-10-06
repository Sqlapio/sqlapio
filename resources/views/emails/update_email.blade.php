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
            <h2 style="text-align: justify; margin-left: 20px;">Actualizacion de correo electrónico</h2>
            <h2 style="text-align: justify; margin-left: 20px;">Sr(a). {{ $mailData['dr_name'] }}</h2>
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Usted a solicitado la actualizacion de si derección de correo electrónico<br>
            Por favor introdusca el siguiente codigo de validacion:<br>
            <strong><h1 style="text-align: justify; margin-left: 20px;">{{ $mailData['code'] }}</h1></strong> 
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Para cualquier consulta o asistencia adicional que necesite, puede comunicarse las 24
            horas del dia con nuestro equipo a traves de sqlapiotechnology@gmail.com
        </p>
        <p style="text-align: justify; margin-left: 20px;">
            Atentamente,
            <br>
            <br>
            <img style="
                    display: block;
                    margin-left: 0px;
                    width: 100px;
                    height: auto;" src="{{ asset('img/notification_email/firma_ceo.png') }}">
            Ing. Jhonny Martinez<br>CEO
        </p>
        <p style="text-align: justify; font-style: italic; margin-left: 20px;">
            La información contenida en este mensaje y sus anexos tiene carácter confidencial, y está dirigida únicamente al destinatario de la misma.
            Si usted ha recibido este mensaje por error, por favor notifique inmediatamente al remitente por este mismo medio y borre el mensaje de su sistema. La información por correo electrónico, no garantiza que la misma sea segura o esté libre de error, por consiguiente, se recomienda
            su verificación.
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
