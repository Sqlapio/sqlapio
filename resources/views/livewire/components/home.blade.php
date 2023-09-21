@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div>
        <div class="container text-center" >
            <div style="margin-top: 50px;">
                <x-user-profile />
            </div>

            <div class="" style="margin-top: 24px;">
                <x-dashboard/>
            </div>
        </div>
    </div>
@endsection
