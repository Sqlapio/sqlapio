@extends('layouts.app-auth')
@section('title', 'Estudios')
<style>
    .cod-co {
        text-decoration: none !important;
        color: #47525e;
    }

    .color-f {
        color: #47525e;
    }
    .card-ex {
        -webkit-background-size: cover !important;
        -moz-background-size: cover !important;
        -o-background-size: cover !important;
        background-size: cover !important;
        background: url('/img/bg2.jpg') no-repeat center center;
        box-shadow: 0px 0px 11px 0px rgba(120,116,116,0.7);
        border-radius: 30px !important;
        font-size: 13px
    }
</style>
@push('scripts')
    <script>
        function searchPerson() {
            if ($('#search_person').val() != '') {
                let route = '{{ route('search_studio', [':value', ':row']) }}';
                route = route.replace(':value', $('#search_person').val());
                route = route.replace(':row', 'ci');
                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Operación exitosa!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            $("#content-result").show();
                            $('#content-data').empty();
                            response.map((elem) => {
                                let img = '{{ URL::asset('/img/V2/icon_pdf_v1.png') }}';
                                let target = `{{ URL::asset('/imgs/${elem.file}') }}`;

                                let url = "{{ route('MedicalRecord', ':id') }}";
                                url = url.replace(':id', elem.patient.patient_id);

                                let div = `
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3">
                                    <div class="card mt-3 card-ex">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                                                    <a target="_blank" href="${target}">
                                                        <img data-bs-toggle="tooltip"  data-bs-placement="bottom" title="Ver documento" style="" src="${img}" width="50 " height="auto"
                                                        alt="Imagen del paciente" class="img-medical">
                                                    </a> 
                                                </div>
                                                <div class="col-sm-8 col-md-8 col-lg-9 col-xl-9 col-xxl-9">
                                                        <strong class="text-capitalize color-f"> ${elem.laboratory_id}</strong>
                                                    <br>                               
                                                        <strong class="text-capitalize color-f"> ${elem.patient.full_name}</strong>
                                                    <br>
                                                        <span>Cod. consulta:
                                                            <a href="${url}" class="cod-co">
                                                                <strong class="text-capitalize" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Consulta"> ${elem.patient.cod_medical_record}</strong>
                                                            </a>
                                                        </span>
                                                    <br>
                                                    <br>
                                                        <span style="float:right; font-size: 12px;">${elem.cod_study}</span>
                                                    <br>
                                                        <span class="text-capitalize" style="float:right;"> ${elem.description}</span>
                                                </div>                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;

                                $('#content-data').append(div);

                                const tooltipTriggerList = document.querySelectorAll(
                                    '[data-bs-toggle="tooltip"]')
                                tooltipTriggerList.forEach(element => {
                                    new bootstrap.Tooltip(element)
                                });

                            });

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
                                <i class="bi bi-person"></i></i> Estudios cargados
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <x-search-person />
                                <div class="row mt-3" id="content-result" style="display: none">
                                    <div  class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="row" id="content-data"></div>
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

