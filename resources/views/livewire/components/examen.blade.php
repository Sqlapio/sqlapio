@extends('layouts.app-auth')
@section('title', 'Examenes')
<style>
</style>
@push('scripts')
    <script>
        $(document).ready(() => {

        });


        function searchPerson() {
            if ($('#search_person').val() != '') {
                let route = '{{ route('search_person', [':value', ':row']) }}';
                route = route.replace(':value', $('#search_person').val());
                route = route.replace(':row', 'ci');
                console.log(route);
                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Operacion exitosamente!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            $("#content-result").show();
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: error.responseJSON.errors,
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            $('#send').show();
                            $('#spinner').hide();
                            $(".holder").hide();
                        });
                    }
                });
            }
        }
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

                                <x-search-person/>


                                <div class="row mt-3" id="content-result" style="display: none">
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
