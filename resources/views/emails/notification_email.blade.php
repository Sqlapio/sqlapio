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

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        
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