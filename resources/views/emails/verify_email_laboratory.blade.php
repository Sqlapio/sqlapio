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
                <h1 style="text-align: justify; margin-left: 20px;">{{ $mailData['laboratory_name'] }}</h1>
            </p>
    
            <p style="text-align: justify; margin-left: 20px;">
                Espero se encuentre muy bien.
                <br>
                Gracias por ser parte de nuestra familia Sqlapio.com, usted acaba de registrarse como laboratorio en nuestro sistema.
                <br>
                <br>
                Es importate para nosotro que realize la confirmacion de su correo electronico a travez del siguiente link:
                <br>
                <br>
                http://sqldevelop.sqlapio.net/verify/{{ $mailData['verify_code'] }}
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
                    height: auto;"
                src="{{ asset('img/notification_email/fir_jm.png') }}">
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