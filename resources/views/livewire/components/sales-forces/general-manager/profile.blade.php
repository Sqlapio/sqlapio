@extends('layouts.app-auth')
@section('title', 'Perfil')
@section('content')
    <div class="container-fluid body" style="padding: 0 3% 3%">
        <div class="accordion" id="accordion">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                    <div class="accordion-item ">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button bg-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-graph-up"></i> Datos del usuario
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">

                                <x-input-form-profile-sale-component/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
