@extends('layouts.app')
@section('title', 'Confirm')
<style>


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

    @media only screen and (min-width: 768px) {
        #background-video-mobile {
            display: none;
        }
    }


    @media only screen and (max-width: 768px) {
        #background-video-mobile {
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

        #background-video {
            display: none;
        }
    }

</style>
@section('content')
    <div>
        <video id="background-video" autoplay loop muted>
            <source src="{{ asset('img/confirmada.mp4') }}" type="video/mp4">
        </video>
        <video id="background-video-mobile" autoplay loop muted>
            <source src="{{ asset('img/FONDO_APP.mp4') }}" type="video/mp4">
        </video>
    </div>
@endsection
