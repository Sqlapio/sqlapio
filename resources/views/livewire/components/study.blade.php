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
        padding-right: 0px !important;
    }

    .form-switch {
        padding-left: 1.5em !important;
    }

    .avatar {
        border-radius: 50%;
        width: 40px !important;
        height: 40px !important;
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
@php
    $lang = session()->get('locale');
    if ($lang == 'en') {
        $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/en-EN.json';
    } else{
        $url = '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json';
    }
@endphp
@push('scripts')
    <script>
        let studies_array = [];
        let count = 0;

        let data = @json($data);
        let countTable = 0;
        let estudios_sin_resul = @json($estudios_sin_resul);
        let countTableDos = 0;
        let url = @json($url);
        let user = @json(auth()->user())

        $(document).ready(function() {

            countTable = data.count;

            countTableDos = estudios_sin_resul.count

            //validar formulario
            $('#form-load-img-estudios').validate({
                ignore: [],
                rules: {
                    img: {
                        required: true,
                    },
                    count: {
                        required: true,
                    }
                },
                messages: {
                    img: {
                        required: '@lang('messages.alert.cargar_archivo')',
                    },
                    count: {
                        required: '@lang('messages.alert.seleccionar_resultado')',
                    }
                }
            });

            //envio del formulario
            $("#form-load-img-estudios").submit(function(event) {
                event.preventDefault();
                $("#form-load-img-estudios").validate();
                if ($("#form-load-img-estudios").valid()) {
                    // $('#send').hide();
                    $('#spinner').show();
                    //preparar la data para el envio
                    let formData = $('#form-load-img-estudios').serializeArray();
                    let data = {};
                    formData.map((item) => data[item.name] = item.value);
                    data["studies_array"] = JSON.stringify(studies_array);

                    ////end
                    $.ajax({
                        url: '{{ route('upload_result_study') }}',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data": JSON.stringify(data),
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-load-img-estudios").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: '@lang('messages.alert.operacion_exitosa')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                }).then((result) => {
                                    $('#send').show();
                                    $('#spinner').hide();
                                });
                            });
                        }
                    });
                }
            });

            new DataTable('#table-info-estudios', {
                initComplete: function () {
                    this.api()
                        .columns()
                        .every(function () {
                            let column = this;
                            let input = document.createElement('input');

                            input.addEventListener('keyup', () => {
                                if (column.search() !== this.value) {
                                    column.search(input.value).draw();
                                }
                            });
                        });
                },
            });
        });

        var popoverTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })




        function searchPerson() {

            if ($('#search_person').val() != '') {
                $('#spinner2').show();
                let msk_id= $('#search_person').val().replaceAll('-', '',);
                let route = '{{ route('search_studio', [':value', ':row']) }}';
                route = route.replace(':value', msk_id);
                route = route.replace(':row', 'ci');
                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#spinner2').hide();

                        if (response.pat.length === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: '@lang('messages.alert.paciente_no')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            });
                            return false;
                        }

                        if (response.data.data.length === 0 && response.reference.data.length === 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: '@lang('messages.alert.paciente_sin_info')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            });
                            return false;

                        }
                        Swal.fire({
                            icon: 'success',
                            title: '@lang('messages.alert.operacion_exitosa')',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {
                            $('#spinner2').hide();

                            let countTable = response.data.count;

                            setDataTable(response.data.data);

                            let countTableDos = response.reference.count;

                            setdataDos(response.reference.data);

                        });

                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: error.responseJSON.errors,
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {
                            $('#send').show();
                            $('#spinner').hide();
                            $(".holder").hide();
                        });
                    }
                });
            }
        }

        const deleteStudy = (id) => {
            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.accion')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')',
                showCancelButton: true,
                cancelButtonText: '@lang('messages.botton.cancelar')'
            }).then((result) => {
                $('#spinner').show();
                let route = '{{ route("delete_file_study", [':id']) }}';
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: 'POST',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#spinner').hide();

                            Swal.fire({
                                icon: 'success',
                                title: '@lang('messages.alert.operacion_exitosa')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {

                                let url = "{{ route('Study') }}";
                                    window.location.href = url;

                            });
                        },
                    });

            });
        }

        function showNotStudy() {
            Swal.fire({
                icon: 'warning',
                title: '@lang('messages.alert.no_estudios')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            });
            return false;
        }

        function showModal(item) {

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

                let elemData = JSON.stringify(item);
                let label =
                    `<label><input type="checkbox" id="cod_study_0" onclick='cuontResul(event, ${elemData});'></label>`
                if (Number(item.status) === 2) {
                    $('#div-result').hide();
                    $('#div-btn').hide();
                    label =
                        `<div  class="pad"><i class="bi bi-check-circle-fill" style="color: #239B56;"></i></div>`
                }
                if (Number(item.status) === 1) {
                    ;
                    $('#div-result').show();
                    $('#div-btn').show();
                }
                let row = `
                    <tr>
                        <td class="text-center">${item.cod_study}</td>
                        <td class="text-center">${item.description}</td>
                        <td class="text-center">${label}</td>
                    </tr>`;
                $('#table-info').find('tbody').append(row);

        }

        function cuontResul(e, item) {

            if ($(`#${e.target.id}`).is(':checked')) {
                studies_array.push({
                    cod_study: item.cod_study
                });

                count = count + 1;

                $('#count').val(count);

            } else {

                studies_array = studies_array.filter(e => e.cod_study !== item.cod_study);

                count = count - 1;

                $('#count').val(count);

                if (count === 0) $('#count').val('');
            }
        }
    </script>
@endpush
@section('content')
    <div id="spinner2" style="display: none">
        <x-load-spinner show="true" />
    </div>
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
                                <i class="bi bi-person"></i></i> @lang('messages.acordion.estudios_cargados')
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapsee" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{-- <x-search-person /> --}}
                                {{-- estudios --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                        {{-- <hr> --}}
                                        {{-- <h5 class="mb-4">@lang('messages.subtitulos.estudios_res')</h5> --}}
                                        <table id="table-info-estudios" class="table table-striped table-bordered" style="width:100%; ">
                                            <thead>
                                                <tr>
                                                    <th class="text-center w-image" scope="col" data-orderable="false"> @lang('messages.tabla.foto')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_solicitud')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_resultado')</th>
                                                    <th class="text-center" scope="col">@lang('messages.tabla.referencia')</th>
                                                    <th class="text-center w-17" scope="col">@lang('messages.tabla.nombre_apellido')</th>
                                                    @if (Auth::user()->contrie == '81')
                                                        <th class="text-center w-10" scope="col">@lang('messages.form.CIE')</th>
                                                    @else
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.cedula')</th>
                                                    @endif
                                                    <th class="text-center" scope="col">@lang('messages.tabla.descripcion')</th>
                                                    <th class="text-center w-10"scope="col" data-orderable="false"> @lang('messages.tabla.resultado')</th>
                                                    <th class="text-center w-10"scope="col" data-orderable="false"> @lang('messages.tabla.resultado')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($study->sortByDesc('created_at') as $item)
                                                    <tr>
                                                        <td class="table-avatar">
                                                            <img class="avatar"
                                                                src=" {{ $item->get_patient->patient_img ? asset('/imgs/' . $item->get_patient->patient_img) : ($item->get_patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                alt="Imagen del paciente">
                                                        </td>
                                                        <td class="text-center"> {{ $item->date }} </td>
                                                        <td class="text-center"> {{!$item->date_result ? "-----" : $item->date_result }} </td>
                                                        <td class="text-center"> {{ $item->cod_ref }} </td>
                                                        <td class="text-center text-capitalize"> {{ $item->get_patient->name . ' ' . $item->get_patient->last_name }} </td>
                                                        @if (Auth::user()->contrie == '81')
                                                            <td class="text-center"> {{ $item->get_patient->is_minor === 'true' ? preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patient->re_ci). ' (Rep)' : preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patient->ci) }} </td>
                                                        @else
                                                            <td class="text-center"> {{ $item->get_patient->is_minor === 'true' ? $item->get_patient->re_ci. ' (Rep)' : $item->get_patient->ci }} </td>
                                                        @endif
                                                        <td class="text-center"> {{ $item->description }} </td>
                                                        <td class="text-center">
                                                            <div class="d-flex" style="justify-content: center;">
                                                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                    @if ($item->status === '1')
                                                                        <a style="text-decoration: none; display: flex; justify-content: center;">
                                                                            <button
                                                                                onclick='showModal({{ $item }})'
                                                                                data-bs-toggle='tooltip'
                                                                                data-bs-placement='right'
                                                                                data-bs-custom-class='custom-tooltip'
                                                                                data-html='true' title="@lang('messages.tooltips.cargar_estudio')"
                                                                                type='button'
                                                                                style="margin-right: 0">
                                                                                <img width="60" height="auto" src="{{ asset('/img/icons/CARGAR-RESULTADO.png') }}" alt="avatar">
                                                                            </button>
                                                                        </a>
                                                                    @else
                                                                        <a target="_blank"  href="{{ URL::asset('/imgs/' . $item->file) }}" style="color: #47525e; text-decoration: none; display: flex; justify-content: center;">
                                                                            <button type="button"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                data-bs-custom-class="custom-tooltip"
                                                                                data-html="true"
                                                                                title="@lang('messages.tooltips.ver_estudios')">
                                                                                <img width="60" height="auto" src="{{ asset('/img/icons/VER-RESULTADO.png') }}" alt="avatar">
                                                                            </button>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex" style="justify-content: center;">
                                                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                    @if ($item->status === '1')
                                                                        <span>-----</span>
                                                                    @else
                                                                        <a style="text-decoration: none; display: flex; justify-content: center;">
                                                                            <button
                                                                                onclick="deleteStudy({{ $item->id }})"
                                                                                data-bs-toggle='tooltip'
                                                                                data-bs-placement='right'
                                                                                data-bs-custom-class='custom-tooltip'
                                                                                data-html='true' title="@lang('messages.tooltips.eliminar_estudio')"
                                                                                type='button'
                                                                                style="margin-right: 0">
                                                                                <img width="60" height="auto" src="{{ asset('/img/icons/ELIMINAR-RESULTADO.png') }}" alt="avatar">
                                                                            </button>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- EXAMENES SIN RESULTADOS --}}
                                {{-- <div class="row mt-3">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                        <hr>
                                        <h5 class="mb-4">@lang('messages.subtitulos.estudios_sin_res')</h5>
                                        <table id="table-info-sin-estudios"
                                            class="table-pag-dos table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center w-image" scope="col" data-orderable="false"> @lang('messages.tabla.foto')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_solicitud')</th>
                                                    <th class="text-center" scope="col">@lang('messages.tabla.referencia')</th>
                                                    <th class="text-center w-17" scope="col">@lang('messages.tabla.nombre_apellido')</th>
                                                    @if (Auth::user()->contrie == '81')
                                                        <th class="text-center w-10" scope="col">@lang('messages.form.CIE')</th>
                                                    @else
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.cedula')</th>
                                                    @endif
                                                    <th class="text-center w-10" scope="col" data-orderable="false"> @lang('messages.tabla.cargar_res')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($estudios_sin_resul['data'] as $item)
                                                    @if (count($item->get_estudio_stutus_uno) >= 1)
                                                        <tr>
                                                            <td class="table-avatar">
                                                                <img class="avatar"
                                                                    src=" {{ $item->get_patient->patient_img ? asset('/imgs/' . $item->get_patient->patient_img) : ($item->get_patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                    alt="Imagen del paciente">
                                                            </td>
                                                            <td class="text-center"> {{ $item->date }} </td>
                                                            <td class="text-center"> {{ $item->cod_ref }} </td>
                                                            <td class="text-center">  {{ $item->get_patient->name . ' ' . $item->get_patient->last_name }} </td>
                                                            @if (Auth::user()->contrie == '81')
                                                                <td class="text-center"> {{ $item->get_patient->is_minor === 'true' ? preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patient->get_reprensetative->re_ci) . '  (Rep)' : preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patient->ci) }} </td>
                                                            @else
                                                                <td class="text-center"> {{ $item->get_patient->is_minor === 'true' ? $item->get_patient->get_reprensetative->re_ci . '  (Rep)' : $item->get_patient->ci }} </td>
                                                            @endif
                                                            <td class="text-center">
                                                                <div class="d-flex" style="justify-content: center;">
                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                        <a style="text-decoration: none; display: flex; justify-content: center;">
                                                                            <button
                                                                                onclick='showModal({{ $item }})'
                                                                                data-bs-toggle='tooltip'
                                                                                data-bs-placement='right'
                                                                                data-bs-custom-class='custom-tooltip'
                                                                                data-html='true' title="@lang('messages.tooltips.cargar_estudio')"
                                                                                type='button'
                                                                                style="margin-right: 0">
                                                                                <img width="60" height="auto" src="{{ asset('/img/icons/pdf-result-study.png') }}" alt="avatar">
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
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
                <div class="modal-content">
                    <div class="modal-header title">
                        <span style="padding-left: 5px">@lang('messages.modal.titulo.carga_resultados')</span>
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
                                <strong>@lang('messages.modal.titulo.referencia'): </strong><span id="ref"></span>
                                <br>
                                <strong>@lang('messages.modal.titulo.paciente'): </strong><span class="text-capitalize" id="ref-pat"></span>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2 table-responsive" id="info-show">
                                    <table class="table table-striped table-bordered" id="table-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">@lang('messages.modal.tabla.codigo')</th>
                                                <th class="text-center" scope="col">@lang('messages.modal.tabla.descripcion')</th>
                                                <th class="text-center" scope="col" data-orderable="false">@lang('messages.modal.tabla.carga_resultado')</th>
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
                                        <input class="btn btnPrimary send " value="@lang('messages.botton.guardar')" type="submit" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
