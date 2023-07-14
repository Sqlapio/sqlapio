<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @livewireStyles
</head>
<script src="{{ asset('jquery-ui-1.13.2/external/jquery/jquery.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.5/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
@vite(['resources/scss/app.scss', 'resources/js/app.js'])
<style>
    @import url('/fuentes/Roboto-Black.ttf');
    @import url('/fuentes/Roboto-Regular.ttf');
    @import url('/fuentes/Roboto-Bold');

    body {
        font-family: 'Roboto-Regular',  !important;
        background-repeat: no-repeat;
        background-position: top;
        background-image: url({{ asset('img/fondo.jpg') }});
    }
</style>

<body>
    @stack('scripts')
    @yield('content')

    @livewireScripts
</body>

</html>
