@extends('layouts.app')
@section('title', 'Cancel')
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

</style>
@section('content')
    <div>
        <video id="background-video" autoplay loop muted>
            <source src="img/cancelada.mp4" type="video/mp4">
        </video>
    </div>
@endsection

