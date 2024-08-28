@extends('layouts.app')
@section('title', 'Confirm')
<style>
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
        background: url({{ asset('img/confirmada.mp4') }});
    }

    #background-video {
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: -1;
    }

</style>
@section('content')
    <div>
        <video id="background-video" autoplay loop muted>
            <source src="img/confirmada.mp4" type="video/mp4">
        </video>
    </div>
@endsection

