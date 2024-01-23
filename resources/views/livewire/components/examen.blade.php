@extends('layouts.app-auth')
@section('title', 'Examenes')
<style>
    .cod-co {
        text-decoration: none !important;
        color: #47525e;
    }

    .color-f {
        color: #47525e;
    }

    .btn-idanger {
        cursor: pointer;
        display: inline-block;
        text-align: center;
        white-space: nowrap;
        background: #ff7b0d;
        color: #fff;
        font-size: 22px;
        font-weight: 400;
        letter-spacing: -.01em;
        padding: 5px;
        margin-right: 9px;
    }

    .btn-idanger:hover, .btnSecond:active {
        background: #ff7b0d;
        color: #fff;
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
    /* nuevos estilos  */
    .div-select {
        padding-left: 16px !important;
        padding-right: 7px !important;
    }

    #img-pat {
        border-radius: 27px;
        border: 2px solid #44525F;
        height: 125px;
        margin: 5px 15px;
        object-fit: cover;
    }

    body {
        /* font-family: 'Roboto', 'Inter', "Helvetica Neue", Helvetica, 'Source Sans Pro' !important; */
        letter-spacing: -.022em;
        color: #1d1d1f;
    }

    .form-switch {
        padding-left: 1.5em !important;
    }

    .avatar {
        border-radius: 50%;
        width: 45px !important;
        height: 45px !important;
        border: 2px solid #44525f;
        object-fit: cover;
    }

    .table-avatar {
        text-align: center;
        vertical-align: middle;
    }

    .borde {
        border-radius: 0 !important;
    }

    .img img {
        max-height: 220px;
        text-align: left;
        margin-right: 70%;
    }

    #btn-margin {
        margin-left: -14px !important;
    }

    .modal-d {
        max-width: 200px;
    }


    @media screen and (max-width: 390px) {
        #btn-margin {
            margin-left: -14px !important;
        }

        #img-pat {
            margin: 4px 20px 0 0;
        }

    }

    @media (min-width: 391px) and (max-width: 576px) {
        .modal-d {
            max-width: 165px;
        }

        #img-pat {
            margin: 4px 20px 0 0;
        }
    }
</style>
@push('scripts')
    <script>
        $(document).ready(function() {

            let data = @json($data);
            let id = @json($id);
            if (id != null) {
                showExam(data);
                const bsCollapse = new bootstrap.Collapse('.collapsee', {
                    toggle: true
                })
            }
        });
        

        function searchPerson() {
            if ($('#search_person').val() != '') {
                let route = '{{ route('search_person', [':value', ':row']) }}';
                route = route.replace(':value', $('#search_person').val());
                route = route.replace(':row', 'ci');
                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.length === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'El paciente no tiene información cargada en el sistema!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            });
                            return false;

                        }
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

                                elem.btn = `<button onclick='showExam(${elemData})'
                                                type="button" class="btn-2 btnSecond">Ver estudios</button>
                                                </div>`;
                                if(elem.exam.length===0){
                                    elem.btn  = `<button type="button"
                                                        class="refresf btn-idanger rounded-circle"
                                                        onclick='showAlertNotExam()'>
                                                        <i class="bi bi-exclamation-lg"></i>
                                                    </button>`;
                                }
                                data.push(elem);
                            });

                            new DataTable('#table-info-pat', {
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                                },
                                bDestroy: true,
                                data: data,
                                "searching": false,
                                "bLengthChange": false,
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

        function showExam(item) {
            $('#show-info-pat').hide();
            $("#content-result").show();
            $('#content-data').empty();
            item.exam.map((elem) => {
                let img = '{{ URL::asset('/img/V2/icon_pdf_v1.png') }}';
                let target = `{{ URL::asset('/imgs/${elem.file}') }}`;

                let url = "{{ route('MedicalRecord', ':id') }}";
                url = url.replace(':id', elem.patient_id);

                let div = `
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3">
                                <div class="card mt-2 card-ex">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                                                <a target="_blank" href="${target}" style="color: #47525e; text-decoration: none; display: flex; flex-direction: column;">
                                                    <img data-bs-toggle="tooltip"  data-bs-placement="bottom" title="Ver archivo" style="" src="${img}" width="50 " height="auto"
                                                    alt="Imagen del paciente" class="img-medical">
                                                    <span style="font-size: 11px;" >Ver archivo</span>
                                                </a> 
                                            </div>
                                            <div class="col-sm-8 col-md-8 col-lg-9 col-xl-9 col-xxl-9">
                                                    <strong class="text-capitalize color-f"> ${elem.get_laboratory.business_name}</strong>
                                                <br>                               
                                                    <strong class="text-capitalize color-f"> ${item.full_name}</strong>
                                                <br>
                                                    <span>Ver consulta:
                                                        <a href="${url}" class="cod-co">
                                                            <strong class="text-capitalize" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Consulta"> ${elem.record_code}</strong>
                                                        </a>
                                                    </span>
                                                <br>
                                                <br>
                                                    <span style="float:right; font-size: 12px;">${elem.cod_exam}</span>
                                                <br>
                                                <span class="text-capitalize" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 100%; display: flex; justify-content: flex-end;"> ${elem.description}</span>
                                            </div>                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;

                $('#content-data').append(div);

                
            });
            
        }

        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]')
        tooltipTriggerList.forEach(element => {
            new bootstrap.Tooltip(element)
        });

        function showAlertNotExam() {
            Swal.fire({
                icon: 'warning',
                title: 'No hay exámenes cargados',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar'
            });
            return false;
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid" style="padding: 0 3% 3%">
            <div class="accordion" id="accordionExample">
                {{-- datos del paciente --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person"></i></i> Exámenes cargados
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapsee" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <x-search-person />

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                            <hr>
                                            <h5 class="mb-4">Resultados</h5>
                                            <table id="table-info-examen" class="table table-striped table-bordered"
                                                style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">Imagen</th>
                                                        <th class="text-center" scope="col">Nombre y apellido</th>
                                                        <th class="text-center" scope="col">Cedula</th>
                                                        <th class="text-center" scope="col">Descripcion del examen o estudio</th>
                                                        <th class="text-center"scope="col" data-orderable="false">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td class="table-avatar">
                                                                <img class="avatar"
                                                                    src=" {{ $item->get_patients->patient_img ? asset('/imgs/' . $item->get_patients->patient_img) : ($item->get_patients->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                    alt="Imagen del paciente">
                                                            </td>  
                                                            <td class="text-center text-capitalize"> {{ $item->get_patients->name." ".$item->get_patients->last_name }}</td>                                                         
                                                            <td class="text-center">  {{ $item->get_patients->is_minor === 'true' ? $item->get_patients->get_reprensetative->re_ci . '  (Rep)' : $item->get_patients->ci }} </td>
                                                            <td class="text-center"> {{ $item->description }} </td>
                                                            <td class="text-center">
                                                                <div class="d-flex">
                                                                    <div
                                                                        class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                        <a target="_blank" href="{{ URL::asset('/imgs/'.$item->file) }}" style="color: #47525e; text-decoration: none; display: flex; flex-direction: column;">
                                                                            <button type="button"
                                                                                class="btn btn-iPrimary rounded-circle"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                title="VEr archivo">
                                                                                <i class="bi bi-file-earmark-text"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <div
                                                                        class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                        <a href="{{ route('MedicalRecord', $item->get_patients->id) }}" style="color: #47525e; text-decoration: none; display: flex; flex-direction: column;">                                                                       
                                                                            <button type="button"
                                                                                class="btn btn-iPrimary rounded-circle"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                title="Cargar Estudio">
                                                                                <i class="bi bi-file-earmark-text"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row" id="show-info-pat" style="display: none">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                            <hr>
                                            <h5 class="mb-4">Resultados</h5>
                                            <table id="table-info-pat" class="table table-striped table-bordered"
                                                style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">Nombre</th>
                                                        <th class="text-center" scope="col">Cédula</th>
                                                        <th class="text-center" scope="col">Género</th>
                                                        <th class="text-center"scope="col" data-orderable="false">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row mt-2" id="content-result" style="display: none">
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
    </div>
@endsection
