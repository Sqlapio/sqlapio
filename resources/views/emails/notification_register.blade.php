<!DOCTYPE html>
<html>
<head>
    <title>SqlapioTechnology</title>
</head>
<body>

    <!--Centered Image Start-->
    <div style="text-align: center;">
        <img src="{{ asset('img/notification_email/newsletter-header.png') }}">
        <h1>{{ $title }}</h1>
        <h2>{{ $body['cuerpo'] }}</h2>
        <h2>{{ $body['name'] }}</h2>
        {{-- Paciente menor de edad --}}
        @if(isset($body['ci']))
            <h3>{{ $body['ci'] }}</h3>
            <h3>{{ $body['email'] }}</h3>
            <h3>{{ $body['phone'] }}</h3>
        @endif
        @if(isset($body['cod_history']))
            <h3>{{ $body['cod_history'] }}</h3>
        @endif
        @if(isset($body['fecha']))
            <h3>{{ $body['fecha'] }}</h3>
            <h3>{{ $body['horario'] }}</h3>
            <h3>{{ $body['centro'] }}</h3>
        @endif

        <h1>ESTO ES UN EMAIL DE PRUEBA</h1>

        <p style="text-align: center;">
            Su registro a Sqlapio fue exitoso. Gracias por ser parte de nuestro portafolio médico, ahora tiene acceso completo a la plataforma.
        </p>
        <br>
        <p style="text-align: center;">
            Lo invitamos acceder primero al menú de configuración, donde puede terminar de registrar su información personal y definir la configuración de su imagen dentro del sistema (imagen, logotipo o avatar).
        </p>
        <br>
        <p style="text-align: center;">
            Si tienes alguna duda te podemos ayudar en: sqlapiotechnology@gmail.com
        </p>
        <br>
        <p style="text-align: center;">
            Recuerde que sus datos serán almacenados en nuestro sistema.<br>¡Gracias por su confianza!
        </p>
        <br>
        <p style="text-align: center; font-style: italic;">
            La información contenida en este mensaje y sus anexos tiene carácter confidencial, y está dirigida únicamente al destinatario de la misma.
            Si usted ha recibido este mensaje por error, por favor notifique inmediatamente al remitente por este mismo medio y borre el mensaje de su sistema. La información por correo electrónico, no garantiza que la misma sea segura o esté libre de error, por consiguiente, se recomienda
            su verificación.
        </p>
        
        <p>Thank you</p>
    </div>
    <!--Centered Image End-->

    

    <!--Centered footer Image Start-->
    <div style="text-align: center;">
        <img src="{{ asset('img/notification_email/newsletter-footer.png') }}">
    </div>
    <!--Centered footer Image End-->
</body>
</html>