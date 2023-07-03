<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @livewireStyles
</head>
@stack('scripts')
@vite(['resources/scss/app.scss', 'resources/js/app.js'])
<style>
    @import url('/fuentes/Roboto-Black.ttf');  
      @import url('/fuentes/Roboto-Regular.ttf');
    @import url('/fuentes/Roboto-Bold');

    body {
        font-family: 'Roboto-Regular' ,!important;
        /* font-size: 20px !important; */
        margin: 0 !important;
        margin-bottom: 40px !important;
    }   
</style>

<body>
    <x-nav-bar />
    @yield('content')
    @livewireScripts
</body>
<x-footer />

</html>
