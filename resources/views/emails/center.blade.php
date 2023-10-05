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
        src="{{ asset('img/notification_email/newsletter-header.png') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h2 style="text-align: justify; margin-left: 20px;">Dr(a). {{ $mailData['dr_name'] }}</h2>
            </p>
    
            <p style="text-align: justify; margin-left: 20px;">
                Espero se encuentre muy bien.
                <br>
                Gracias por ser parte de nuestra familia Sqlapio.com, usted acaba de asociar el siguiente centro:
            </p>

            <p style="text-align: justify; margin-left: 20px;">
                <h3 style="text-align: justify; margin-left: 20px;">
                    Centro: {{ $mailData['center_name'] }}
                    <br>
                    Direccion: {{ $mailData['center_address'] }}
                    <br>
                    Telefono: {{ $mailData['center_phone'] }}
                </h3>
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
                    margin-left: 20px;
                    width: 300px;
                    height: auto;"
                src="{{ asset('img/notification_email/firma_ceo.png') }}">
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
            height: auto;"
        src="{{ asset('img/notification_email/footer.png') }}">
    
</body>
</html>