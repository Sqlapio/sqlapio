@extends('layouts.app')
@section('title', 'Confirm')
<style>


</style>
@section('content')
    <div>
        <div class="container-fluid text-center">
            <div class="row form-sq" style="position: relative">
                <div class="col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 loginDric">
                    <div class="card" id="div-form">
                        <div class="card-body">
                            
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <div class="text-center">
                                    <img class="img" src="{{ asset('img/logo sqlapio variaciones-03.png') }}" style="width: 200px;">
                                </div>
                                <div class="text-center">
                                    <img class="img" src="{{ asset('img/confimation.jpg') }}" style="width: 200px;">
                                </div>

                                <h4>Su cita ha sido confirmada</h4>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

