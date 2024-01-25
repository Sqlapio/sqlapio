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

    .btn-idanger:hover,
    .btnSecond:active {
        background: #ff7b0d;
        color: #fff;
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
        // $(document).ready(function() {

        //     let data = @json($data);
        //     let id = @json($id);
        //     if (id != null) {
        //         setDataTable(data);
        //         const bsCollapse = new bootstrap.Collapse('.collapsee', {
        //             toggle: true
        //         })
        //     }



        // });

        var popoverTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })


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

                            setDataTable(response);


                            // $("#content-result").hide();
                            // $('#show-info-pat').show();

                            // let data = [];
                            // response.map((elem) => {
                            //     let elemData = JSON.stringify(elem);
                            //     elem.btn = ` 
                        //                     <button onclick='showStudy(${elemData})'
                        //                     type="button" class="btn-2 btnSecond"
                        //                     data-bs-toggle="tooltip"
                        //                     data-bs-placement="bottom"
                        //                     data-bs-custom-class="custom-tooltip"
                        //                     data-html="true" title="ver estudios">Ver estudios</button>
                        //                     </div>`;

                            //     if (elem.study.length === 0) {
                            //         elem.btn = `<button type="button"
                        //                         class="refresf btn-idanger rounded-circle"
                        //                         onclick='showNotStudy()'>
                        //                         <i class="bi bi-exclamation-lg"></i>
                        //                     </button>`;
                            //     }
                            //     data.push(elem);
                            // });


                            // new DataTable('#table-info-pat', {
                            //     language: {
                            //         url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                            //     },
                            //     bDestroy: true,
                            //     data: data,
                            //     "searching": false,
                            //     "bLengthChange": false,
                            //     columns: [{

                            //             data: 'full_name',
                            //             title: 'Nombre',
                            //             className: "text-center text-capitalize",
                            //         },
                            //         {

                            //             data: 'ci',
                            //             title: 'Cédula paciente',
                            //             className: "text-center",
                            //         },
                            //         {
                            //             data: 'genero',
                            //             title: 'Género',
                            //             className: "text-center text-capitalize",
                            //         },
                            //         {
                            //             data: 'btn',
                            //             title: 'Acciones',
                            //             className: "text-center",
                            //         }
                            //     ],
                            // });

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
                <div class="card mt-2 card-ex">
                <div class="card-body">
                <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                <a target="_blank" href="${target}" style="color: #47525e; text-decoration: none; display: flex; flex-direction: column;">
                <img data-bs-toggle="tooltip"  data-bs-placement="bottom" title="Ver archivo" style="" src="${img}" width="50 " height="auto"
                alt="Imagen del paciente" class="img-medical">
                <span style="font-size: 11px;">Ver archivo</span>
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
                <span style="float:right; font-size: 12px;">${elem.cod_study}</span>
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

        function showNotStudy() {
            Swal.fire({
                icon: 'warning',
                title: 'No hay estudios cargados',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar'
            });
            return false;
        }

        function setDataTable(row) {

            let data = [];

            row.data.map((elem) => {
                // let elemData = JSON.stringify(elem);
                let target = `{{ URL::asset('/imgs/${elem.file}') }}`;
                elem.btn = `<div class="d-flex">
                <div
                class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <a target="_blank"
                href="${target}"
                style="color: #47525e; text-decoration: none; display: flex; flex-direction: column;">
                <button type="button"
                class="btn btn-iPrimary rounded-circle"
                data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                title="VEr archivo">
                <i class="bi bi-file-earmark-text"></i>
                </button>
                </a>
                </div>                          
                </div>`;


                elem.full_name = `${elem.get_patients.name } ${elem.get_patients.last_name }`;

                let imagen = `{{ URL::asset('/img/avatar/avatar mujer.png') }}`;

                if (elem.get_patients.patient_img != null) {
                    imagen = `{{ URL::asset('/imgs/${elem.get_patients.patient_img}') }}`;
                } else {
                    if (elem.get_patients.genere == "masculino") {
                        imagen = `{{ URL::asset('/img/avatar/avatar hombre.png') }}`;
                    }
                }

                elem.img = `<img class="avatar"
                src="${imagen}"
                alt="Imagen del paciente">`;

                elem.ci = (elem.get_patients.is_minor == "true") ? `${elem.get_reprensetative.re_ci} (Rep)` : elem
                    .get_patients.ci;

                data.push(elem);
            });

            new DataTable('#table-info-estudios', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                },
                bDestroy: true,
                data: data,
                "searching": false,
                "bLengthChange": false,
                columns: [{

                        data: 'img',
                        title: 'Foto',
                        className: "text-center text-capitalize",
                    },
                    {

                        data: 'full_name',
                        title: 'Nombre y apellido',
                        className: "text-center",
                    },
                    {
                        data: 'ci',
                        title: 'Cedula',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'description',
                        title: 'Descripcion del examen',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'btn',
                        title: 'Acciones',
                        className: "text-center",
                    }
                ],
            });
        }

        function setdataDos(data) {

            let dataRef = [];

            data.map((e) => {

                let target = `{{ URL::asset('/imgs/${e.file}') }}`;

                let eData = JSON.stringify(e);

                e.btn = `<button onclick='showModal(${ eData })'
                data-bs-toggle='tooltip' data-bs-placement='right'
                data-bs-custom-class='custom-tooltip' data-html='true'
                title='Ver examenes' type='button'
                class='btn btn-iPrimary rounded-circle'>
                <i class='bi bi-info-circle-fill'></i>
                </button>`;


                e.full_name = `${e.get_patient.name } ${e.get_patient.last_name }`;

                let imagen = `{{ URL::asset('/img/avatar/avatar mujer.png') }}`;

                if (e.get_patient.patient_img != null) {
                    imagen = `{{ URL::asset('/imgs/${e.get_patient.patient_img}') }}`;
                } else {
                    if (e.get_patient.genere == "masculino") {
                        imagen = `{{ URL::asset('/img/avatar/avatar hombre.png') }}`;
                    }
                }

                e.img = `<img class="avatar"
                src="${imagen}"
                alt="Imagen del paciente">`;

                e.ci = (e.get_patient.is_minor == "true") ? `${e.get_reprensetative.re_ci} (Rep)` : e
                    .get_patient.ci;

                dataRef.push(e);
            });

            new DataTable('#table-info-sin-estudios', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                },
                bDestroy: true,
                data: dataRef,
                "searching": false,
                "bLengthChange": false,
                columns: [{

                        data: 'img',
                        title: 'Foto',
                        className: "text-center text-capitalize",
                    },
                    {

                        data: 'date',
                        title: 'Fecha',
                        className: "text-center",
                    },
                    {

                        data: 'cod_ref',
                        title: 'Referencia',
                        className: "text-center",
                    },
                    {
                        data: 'cod_medical_record',
                        title: 'Referencia consulta médica',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'full_name',
                        title: 'Nombre y apellido',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'ci',
                        title: 'Cédula',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'btn',
                        title: 'Cargar Resultado',
                        className: "text-center",
                    }
                ],
            });
        }

        function showModal(item) {

            if (item.get_exam.length > 0) {
                count = 0;
                $('#count').val('');
                $('.holder').hide();
                $('#code_ref').val(item.cod_ref);
                $('#img').val('');
                $('#ModalLoadResult').modal('show');
                $('#table-info').find('tbody').empty();
                $('.modal-title').text('Examen del Paciente');
                ///
                $('#ref').text(item.cod_ref);
                $('#id').val(item.id);
                $('#ref-pat').text(`${item.get_patient.name} ${item.get_patient.last_name}`);

                item.get_exam.map((elemt, index) => {
                    let elemData = JSON.stringify(elemt);
                    let label =
                        `<label><input type="checkbox" id="cod_exam_${index}" onclick='cuontResul(event,${elemData},${index});'></label>`
                    if (Number(elemt.status) === 2) {
                        $('#div-result').hide();
                        $('#div-btn').hide();
                        label =
                            `<div  class="pad"><i class="bi bi-check-circle-fill" style="color: #239B56;"></i></div>`
                    }
                    if (Number(elemt.status) === 1) {
                        ;
                        $('#div-result').show();
                        $('#div-btn').show();
                    }
                    let row = `
                <tr>
                <td class="text-center">${elemt.cod_exam}</td>
                <td class="text-center">${elemt.description}</td>     
                <td class="text-center">${label}</td>                
                </tr>`;
                    $('#table-info').find('tbody').append(row);

                });

            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Paciente sin exámenes/estudios solicitados por el médico!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                });
            }

        }

        function cuontResul(e, item, key) {

            if ($(`#${e.target.id}`).is(':checked')) {
                exams_array.push({
                    cod_exam: item.cod_exam
                });

                count = count + 1;

                $('#count').val(count);

            } else {

                exams_array = exams_array.filter(e => e.cod_exam !== item.cod_exam);

                count = count - 1;

                $('#count').val(count);

                if (count === 0) $('#count').val('');
            }
        }
    </script>
@endpush
@section('content')
    <div class="container-fluid" style="padding: 0 3% 3%">
        <div class="accordion" id="accordionExample">
            {{-- datos del paciente --}}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd mt-2">
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

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                        <hr>
                                        <h5 class="mb-4">Estudios con resultados</h5>
                                        <table id="table-info-estudios" class="table table-striped table-bordered"
                                            style="width:100%; ">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">Foto</th>
                                                    <th class="text-center" scope="col">Nombre y apellido</th>
                                                    <th class="text-center" scope="col">Cédula</th>
                                                    <th class="text-center" scope="col">Descripcion del examen o
                                                        estudio</th>
                                                    <th class="text-center"scope="col" data-orderable="false">Ver
                                                        resultado
                                                    </th>
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
                                                        <td class="text-center text-capitalize">
                                                            {{ $item->get_patients->name . ' ' . $item->get_patients->last_name }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $item->get_patients->is_minor === 'true' ? $item->get_patients->get_reprensetative->re_ci . '  (Rep)' : $item->get_patients->ci }}
                                                        </td>
                                                        <td class="text-center"> {{ $item->description }} </td>
                                                        <td class="text-center">
                                                            <div class="d-flex">
                                                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                    <a target="_blank"
                                                                        href="{{ URL::asset('/imgs/' . $item->file) }}"
                                                                        style="color: #47525e; text-decoration: none; display: flex; flex-direction: column;">
                                                                        <button type="button"
                                                                            class="btn btn-iPrimary rounded-circle"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom" title="VEr archivo">
                                                                            <i class="bi bi-file-earmark-text"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                {{-- <div
                                                                        class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                        <a href="{{ route('MedicalRecord', $item->get_patients->id) }}"
                                                                            style="color: #47525e; text-decoration: none; display: flex; flex-direction: column;">
                                                                            <button type="button"
                                                                                class="btn btn-iPrimary rounded-circle"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                title="Cargar Estudio">
                                                                                <i class="bi bi-file-earmark-text"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div> --}}

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                        <hr>
                                        <h5 class="mb-4">Estudios sin resultados</h5>
                                        <table id="table-info-sin-estudios" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">Foto</th>
                                                    <th class="text-center" scope="col">Fecha</th>
                                                    <th class="text-center" scope="col">Referencia</th>
                                                    <th class="text-center" scope="col">Referencia consulta médica
                                                    </th>
                                                    <th class="text-center" scope="col">Nombre y apellido</th>
                                                    <th class="text-center" scope="col">Cédula</th>
                                                    <th class="text-center" scope="col">Cargar Resultado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($examen_sin_resul as $item)
                                                    <tr>
                                                        <td class="table-avatar">
                                                            <img class="avatar"
                                                                src=" {{ $item->get_patient->patient_img ? asset('/imgs/' . $item->get_patient->patient_img) : ($item->get_patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                alt="Imagen del paciente">
                                                        </td>
                                                        <td class="text-center"> {{ $item->date }} </td>
                                                        <td class="text-center"> {{ $item->cod_ref }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $item->cod_medical_record }} </td>
                                                        <td class="text-center">
                                                            {{ $item->get_patient->name . ' ' . $item->get_patient->last_name }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $item->get_patient->is_minor === 'true' ? $item->get_patient->get_reprensetative->re_ci . '  (Rep)' : $item->get_patient->ci }}
                                                        </td>
                                                        <td>
                                                            <button onclick='showModal({{ $item }})'
                                                                data-bs-toggle='tooltip' data-bs-placement='right'
                                                                data-bs-custom-class='custom-tooltip' data-html='true'
                                                                title='Ver examenes' type='button'
                                                                class='btn btn-iPrimary rounded-circle'>
                                                                <i class='bi bi-info-circle-fill'></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalLoadResult" tabindex="-1" aria-labelledby="ModalLoadResultLabel"
            aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div id="spinner" style="display: none">
                <x-load-spinner show="true" />
            </div>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header title">
                            <span style="padding-left: 5px">Carga de resultados</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="font-size: 12px;"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-load-img-estudios" method="post" action="/">
                                {{ csrf_field() }}
                                <input type="hidden" id="id" name="id" value="">
                                <input type="hidden" id="code_ref" name="code_ref" value="">
                                <input type="hidden" id="doctor_id" name="doctor_id" value="{{ Auth::user()->id }}">

                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <strong>Referencia: </strong><span id="ref"></span>
                                    <br>
                                    <strong>Paciente: </strong><span class="text-capitalize" id="ref-pat"></span>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="info-show">
                                        <table class="table table-striped table-bordered" id="table-info">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">Código</th>
                                                    <th class="text-center" scope="col">Descripción</th>
                                                    <th class="text-center" scope="col">Cargar Resultado</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>

                                    <div class="col-sm-7 md-7 lg-7 xl-7 xxl-7" style="display: none">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total resultados
                                            </span>
                                            <input type="text" id="count" name="count" class="form-control"
                                                readonly value="">
                                        </div>
                                    </div>
                                </div>

                                <div id="input-array"></div>
                                <div id="div-btn">
                                    <div class="row mt-2 div-result">
                                        <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                            <x-upload-image title="Cargar Resultados" />
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                            <input class="btn btnPrimary send " value="Guardar" type="submit" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
