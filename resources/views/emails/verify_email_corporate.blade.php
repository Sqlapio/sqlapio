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
                Gracias por ser parte de nuestra familia Sqlapio.com, usted acaba de registrarse como un usuario corporativo en nuestro sistema.
                <br>
                <br>
                Es importate para nosotro que realize la confirmación de su correo electrónico a través del siguiente link:
                <br>
                <br>
                http://sqldevelop.sqlapio.net/verify/{{ $mailData['verify_code'] }}
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
                    height: auto;"
                src="{{ asset('img/notification_email/fir_jm.png') }}">
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
            height: auto;"
        src="{{ asset('img/notification_email/footer.png') }}">

</body>
</html>
