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
        box-shadow: 0px 0px 11px 0px rgba(120, 116, 116, 0.7);
        border-radius: 30px !important;
        font-size: 13px
    }
</style>
@push('scripts')
    <script>
        $(document).ready(function() {

            let data = @json($data);
            let id = @json($id);
            if (id != null) {
                showStudy(data);
                const bsCollapse = new bootstrap.Collapse('.collapsee', {
                        toggle: true
                    })
            }
            
        });

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

                            $("#content-result").hide();
                            $('#show-info-pat').show();

                            let data = [];
                            response.map((elem) => {
                                let elemData = JSON.stringify(elem);
                                elem.btn = ` 
                                                <button onclick='showStudy(${elemData})'
                                                type="button" class="btn-2 btnSecond">Ver estudios</button>
                                                </div>`;
                                data.push(elem);
                            });


                            new DataTable('#table-info-pat', {
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                                },
                                bDestroy: true,
                                data: data,
                                columns: [{

                                        data: 'full_name',
                                        title: 'Nombre',
                                        className: "text-center text-capitalize",
                                    },
                                    {

                                        data: 'ci',
                                        title: 'Cédula paciente',
                                        className: "text-center",
                                    },
                                    {
                                        data: 'genero',
                                        title: 'Género',
                                        className: "text-center text-capitalize",
                                    },
                                    {
                                        data: 'btn',
                                        title: 'Acciones',
                                        className: "text-center",
                                    }
                                ],
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

        function showStudy(item) {
            $('#show-info-pat').hide();
            $("#content-result").show();
            $('#content-data').empty();
            item.study.map((elem) => {
                let img = '{{ URL::asset('/img/V2/icon_img.png') }}';
                let target = `{{ URL::asset('/imgs/${elem.file}') }}`;

                let url = "{{ route('MedicalRecord', ':id') }}";
                url = url.replace(':id', elem.patient_id);

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
                                                    <strong class="text-capitalize color-f"> ${elem.get_laboratory.business_name}</strong>
                                                <br>                               
                                                    <strong class="text-capitalize color-f"> ${item.full_name}</strong>
                                                <br>
                                                    <span>Cod. consulta:
                                                        <a href="${url}" class="cod-co">
                                                            <strong class="text-capitalize" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Consulta"> ${elem.record_code}</strong>
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
                            <button class="accordion-button bg-7" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-person"></i></i> Estudios cargados
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapsee" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <x-search-person />

                                <div class="row" id="show-info-pat" style="display: none">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="mb-4">Resultados</h5>
                                        </h5>
                                        <table id="table-info-pat" class="table table-striped table-bordered"
                                            style="width:100%; ">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">Nombre</th>
                                                    <th class="text-center" scope="col">Cédula</th>
                                                    <th class="text-center" scope="col">Género</th>
                                                    <th class="text-center"scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mt-3" id="content-result" style="display: none">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
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
