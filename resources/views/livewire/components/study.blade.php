@extends('layouts.app-auth')
@section('title', 'Estudios')
<style>
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
                            title: 'Operacion exitosamente!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            $("#content-result").show();
                            $('#content-data').empty();
                            response.map((elem) => {
                                let img = '{{ URL::asset('/img/V2/descarga.png') }}';
                                let target = `{{ URL::asset('/imgs/${elem.file}') }}`;

                                let url = "{{ route('MedicalRecord', ':id') }}";
                                url = url.replace(':id', elem.patient.patient_id);

                                let div = `
                                <div class="card  mt-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <a target="_blank" href="${target}">
                                                    <img  data-bs-toggle="tooltip"  data-bs-placement="bottom" title="Ver documento" style="padding: 10px 10px 10px 10px;" src="${img}" width="100" height="100"
                                                    alt="Imagen del paciente" class="img-medical">
                                                </a> 
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <strong>Nombre del paciente:</strong><span class="text-capitalize">
                                                ${elem.patient.full_name}</span>
                                                <br>                               
                                                <strong>Código del estudio:</strong><span> ${elem.cod_exam}</span>
                                                <br>
                                                <strong>Descripción:</strong><span class="text-capitalize"> ${elem.description}</span>
                                                <br>
                                                <strong>Laboratorio:</strong><span class="text-capitalize"> ${elem.laboratory_id}</span>
                                                <br>
                                                <strong>Código de la consulta:</strong><a href="${url}"><span class="text-capitalize"> ${elem.patient.cod_medical_record}</span></a> 
                                                </span>
                                            </div>                             
                                        </div>
                                    </div>
                                </div>`;

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
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                        <div id="content-data"></div>
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

