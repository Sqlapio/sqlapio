@extends('layouts.app-auth')
@section('title', 'Examenes')
<style>
</style>
@push('scripts')
    <script>
        $(document).ready(() => {

        });
    </script>
@endpush
@section('content')
    <div class="container-fluid" style="padding: 3%">
        <div class="accordion" id="accordionExample">
            {{-- datos del paciente --}}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                    <div class="accordion-item">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-person"></i></i> Examenes cargados
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                    <img src="{{ asset('img/V2/Settings.png') }}" width="100" height="100"
                                                    alt="Imagen del paciente" class="img-medical">
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                    <h5 class="text-capitalize">descripcion de examens</h5>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
