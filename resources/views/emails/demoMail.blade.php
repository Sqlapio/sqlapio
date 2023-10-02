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
        src="{{ asset('img/notification_email/newsletter-header.jpg') }}">
        <div style="margin: auto;
                    width: 600px;
                    padding: 10px;">
            <p style="text-align: justify; margin-left: 20px;">
                <h2 style="text-align: justify; margin-left: 20px;">Dr(a). {{ $mailData['name'] }}</h2>
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                {{ $cuerpo1 }}
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                {{ $cuerpo2 }}
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                {{-- https://sqlapiodev.starkmedios.com/verify/{{ $verification_code }} --}}
                <h1>{{ $verification_code }}</h1>
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                Si tienes alguna duda te podemos ayudar en:
                <br>
                sqlapiotechnology@gmail.com
            </p>
            <p style="text-align: justify; margin-left: 20px;">
                ¡Gracias por su confianza!
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
        src="{{ asset('img/notification_email/footer.jpg') }}">
    
</body>
</html>