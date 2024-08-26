@extends('layouts.app')
@section('title', 'Error 404')
<style>
    @page { margin:0px; }

    .error404 {
        background-size: 100% 100% !important;
        background: url({{ asset('img/ERROR-404.jpg') }});
    }

    body {
        font-family: 'Creato Display', sans-serif;
        margin-top: 0cm;
        margin-left: 0cm;
        margin-right: 0cm;
        margin-bottom: 0cm;

        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        -o-background-size: 100% 100%;
        background-size: 100% 100% !important;
        background: url({{ asset('img/ERROR-404.jpg') }});
    }

</style>
@section('content')
    <div>
        <div style="background-size: 100% 100% !important; background: url({{ asset('img/ERROR-404.jpg') }}); width: 100%; height: 100vh">
        </div>
    </div>
@endsection

