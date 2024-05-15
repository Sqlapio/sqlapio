<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @livewireStyles
    {{-- select dos --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="icon" sizes="256x256" href="{{ asset('img/favicon.ico') }}">
<link rel="icon" sizes="180x180" href="{{ asset('img/Isotipo_Mesa de trabajo 1 copia.png') }}">
<link rel="apple-touch-icon" href="{{ asset('img/Isotipo_Mesa de trabajo 1 copia.png') }}"/>
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
{{-- select dos --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.ico') }}">

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

    @php

        $lang = session()->get('locale');

        if($lang == 'en') {
            $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/en-EN.json';
        } else{
            $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json';
        }

        if($lang == 'en') {
            $lang_datepicker = 'en';
        } else{
            $lang_datepicker = 'es';
        }

    @endphp

    <x-nav-bar />

    @stack('scripts')

    @yield('content')

    @livewireScripts

    @stack('js')

    <input type="hidden" id="lang" value='@json(__('messages'))'>

</body>
<script>
        var url = @json($url);
        var lang_session = @json($lang);
    </script>
<x-footer />

</html>
