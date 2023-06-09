<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @livewireStyles
</head>
{{-- llamado de js jquery --}}
<script src="{{ asset('jquery-ui-1.13.2/external/jquery/jquery.js') }}" type="text/javascript"></script>
{{-- llamado de js datepicker --}}
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
{{-- llamado de js jquery.mask --}}
<script src="{{ asset('jQuery-Mask-Plugin-master/dist/jquery.mask.min.js') }}" type="text/javascript"></script>
{{-- llamado de js locales datepicker --}}
<script src="{{ asset('assets/locales/bootstrap-datepicker.es.min.js') }}"></script>
{{-- llamado de js locales validation --}}
<script src="{{ asset('jquery-validation-1.19.5/dist/jquery.validate.min.js') }}" type="text/javascript"></script>

@vite(['resources/scss/app.scss', 'resources/js/app.js'])
<style>
    @import url('/fuentes/Roboto-Black.ttf');
    @import url('/fuentes/Roboto-Regular.ttf');

    body {
        font-family: 'Roboto-Regular',  !important;
        /* font-size: 20px !important; */
        margin: 0 !important;
        margin-bottom: 40px !important;
    }
</style>
<body>
    <x-nav-bar />
    @stack('scripts')
    @yield('content')
    @livewireScripts
</body>
<x-footer />

</html>
