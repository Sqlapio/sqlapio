@extends('layouts.app-auth')
@section('title', 'Exámenes')
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

    .btn-idanger:hover,
    .btnSecond:active {
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
        let count = 0;
        let exams_array = [];
        let data = @json($data);
        let countTable = 0;
        let examen_sin_resul = @json($examen_sin_resul);
        let countTableDos = 0;
        let url = @json($url);

        $(document).ready(function() {


            countTable = data.count;

            countTableDos = examen_sin_resul.count




            new DataTable('.table-pag', {
                language: {
                    url: url,
                },
                reponsive: true,
                searching: false,
                bLengthChange: false,
                deferLoading: countTable,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('res_exam') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(resp) {
                        setDataTable(resp.data);
                    }
                }
            });

            new DataTable('.table-pag-dos', {
                language: {
                    url: url,
                },
                reponsive: true,
                searching: false,
                bLengthChange: false,
                deferLoading: countTableDos,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('res_exam_sin_resul') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(e) {

                        setdataDos(e.data);
                    }
                }
            });

            //validar formulario
            $('#form-load-img-examen').validate({
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
            $("#form-load-img-examen").submit(function(event) {
                event.preventDefault();
                $("#form-load-img-examen").validate();
                if ($("#form-load-img-examen").valid()) {
                    // $('#send').hide();
                    $('#spinner').show();
                    //preparar la data para el envio
                    let formData = $('#form-load-img-examen').serializeArray();
                    let data = {};
                    formData.map((item) => data[item.name] = item.value);
                    data["exams_array"] = JSON.stringify(exams_array);

                    ////end
                    $.ajax({
                        url: '{{ route('upload_result_exam') }}',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data": JSON.stringify(data),
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-load-img-examen").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: '@lang('messages.alert.operacion_exitosa')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {

                                let url = "{{ route('Examen') }}";
                                window.location.href = url;

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

        });

        function searchPerson() {
            if ($('#search_person').val() != '') {
                $('#spinner2').show();
                let msk_id= $('#search_person').val().replaceAll('-', '',);
                let route = '{{ route('search_person', [':value', ':row']) }}';
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
                            $('#spinner2').hide();
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
                title: '@lang('messages.alert.no_examenes')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            });
            return false;
        }

        function setDataTable(row) {

            let data = [];

            row.map((elem) => {
                // let elemData = JSON.stringify(elem);
                let target = `{{ URL::asset('/imgs/${elem.file}') }}`;
                elem.btn = `<div class="d-flex" style="justify-content: center;">
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <a target="_blank" href="${target}" style="color: #47525e; text-decoration: none; display: flex; justify-content: center;">
                                    <button type="button"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="@lang('messages.tooltips.ver_examenes')"
                                        style="margin-rigth: 0">
                                        <img width="32" height="auto"
                                        src="{{ asset('/img/icons/doc.png') }}"
                                        alt="avatar">
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

                elem.img = `<img class="avatar" src="${imagen}" alt="Imagen del paciente">`;

                if (user.contrie == '81') {
                    elem.ci = (elem.get_patients.is_minor == "true") ? elem.get_reprensetative.re_ci.replace(/^(\d{3})(\d{7})(\d{1}).*/, '$1-$2-$3') + ' ' + '(Rep)' :  elem.get_patients.ci.replace(/^(\d{3})(\d{7})(\d{1}).*/, '$1-$2-$3');
                } else {
                    elem.ci = (elem.get_patients.is_minor == "true") ? `${elem.get_reprensetative.re_ci} (Rep)` : elem.get_patients.ci;
                }



                elem.description = `${elem.description}`

                data.push(elem);
            });

            new DataTable('#table-info-examen', {
                language: {
                    url: url,
                },
                bDestroy: true,
                reponsive: true,
                searching: false,
                bLengthChange: false,
                deferLoading: countTable,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('res_exam') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "data": '',
                    },
                    success: function(resp) {
                        countTable = resp.count;
                        setDataTable(resp.data);
                    }
                },
                data: data,
                columns: [{

                        data: 'img',
                        title: '@lang('messages.tabla.foto')',
                        className: "text-center text-capitalize w-image",
                    },
                    {
                        data: 'date',
                        title: '@lang('messages.tabla.fecha_solicitud')',
                        className: "text-center",
                    },
                    {
                        data: 'date_result',
                        title: '@lang('messages.tabla.fecha_resultado')',
                        className: "text-center",
                    },
                    {

                        data: 'full_name',
                        title: '@lang('messages.tabla.nombre_apellido')',
                        className: "text-center w-17",
                    },
                    {
                        data: 'ci',
                        title: user.contrie === '81' ? 'CIE' : '@lang('messages.tabla.cedula')',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'description',
                        title: '@lang('messages.tabla.descripcion')',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'btn',
                        title: '@lang('messages.tabla.resultado')',
                        className: "text-center",
                    }
                ],
            });
        }

        function setdataDos(data) {

            let dataRef = [];

            data.map((e) => {

                if (e.get_examne_stutus_uno.length > 0) {

                    let target = `{{ URL::asset('/imgs/${e.file}') }}`;

                    let eData = JSON.stringify(e);

                    e.btn = `<button onclick='showModal(${ eData })'
                                data-bs-toggle='tooltip' data-bs-placement='right'
                                data-bs-custom-class='custom-tooltip' data-html='true'
                                title="@lang('messages.tooltips.cargar_examen')" type='button'
                                style="margin-rigth: 0">
                                <img width="30" height="auto" src="{{ asset('/img/icons/add-document.png') }}" alt="avatar">
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

                    e.img = `<img class="avatar" src="${imagen}" alt="Imagen del paciente">`;

                    if (user.contrie == '81') {
                        e.ci = (e.get_patient.is_minor == "true") ? e.get_reprensetative.re_ci.replace(/^(\d{3})(\d{7})(\d{1}).*/, '$1-$2-$3') + ' ' + '(Rep)' :  e.get_patient.ci.replace(/^(\d{3})(\d{7})(\d{1}).*/, '$1-$2-$3');
                    } else {
                        e.ci = (e.get_patient.is_minor == "true") ? `${e.get_reprensetative.re_ci} (Rep)` : e.get_patient.ci;
                    }

                    e.date = `${e.date}`

                    dataRef.push(e);

                }
            });

            new DataTable('#table-info-sin-examen', {
                language: {
                    url: url,
                },
                bDestroy: true,
                reponsive: true,
                searching: false,
                bLengthChange: false,
                deferLoading: countTableDos,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('res_exam_sin_resul') }}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(e) {

                        countTableDos = e.count;
                        setdataDos(e.data);
                    }
                },
                data: dataRef,
                columns: [{
                        data: 'img',
                        title: '@lang('messages.tabla.foto')',
                        className: "text-center text-capitalize w-image",
                    },
                    {
                        data: 'date',
                        title: '@lang('messages.tabla.fecha_solicitud')',
                        className: "text-center w-10",
                    },
                    {
                        data: 'cod_ref',
                        title: '@lang('messages.tabla.referencia')',
                        className: "text-center",
                    },
                    {
                        data: 'full_name',
                        title: '@lang('messages.tabla.nombre_apellido')',
                        className: "text-center text-capitalize w-17",
                    },
                    {
                        data: 'ci',
                        title: '@lang('messages.tabla.cedula')',
                        className: "text-center text-capitalize w-10",
                    },
                    {
                        data: 'btn',
                        title: '@lang('messages.tabla.cargar_res')',
                        className: "text-center",
                    }
                ],
            });
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

            item.get_examne_stutus_uno.map((elemt, index) => {
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
    <div id="spinner2" style="display: none">
        <x-load-spinner show="true" />
    </div>
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
                                    <i class="bi bi-person"></i></i> @lang('messages.acordion.examenes_cargados')
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapsee" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <x-search-person />
                                    {{-- examenes con resultados --}}
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                            <hr>
                                            <h5 class="mb-4">@lang('messages.subtitulos.examenes_res')</h5>
                                            <table id="table-info-examen" class="table-pag table-striped table-bordered" style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-image" scope="col"
                                                            data-orderable="false">@lang('messages.tabla.foto')</th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_solicitud')</th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_resultado')</th>
                                                        <th class="text-center w-17" scope="col">@lang('messages.tabla.nombre_apellido')</th>
                                                        @if (Auth::user()->contrie == '81')
                                                            <th class="text-center w-10" scope="col">@lang('messages.form.CIE')</th>
                                                        @else
                                                            <th class="text-center w-10" scope="col">@lang('messages.tabla.cedula')</th>
                                                        @endif
                                                        <th class="text-center" scope="col">@lang('messages.tabla.descripcion')</th>
                                                        <th class="text-center w-5"scope="col" data-orderable="false"> @lang('messages.tabla.resultado')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data['data'] as $item)
                                                        <tr>
                                                            <td class="table-avatar">
                                                                <img class="avatar"
                                                                    src=" {{ $item->get_patients->patient_img ? asset('/imgs/' . $item->get_patients->patient_img) : ($item->get_patients->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                    alt="Imagen del paciente">
                                                            </td>
                                                            <td class="text-center"> {{ $item->date }} </td>
                                                            <td class="text-center"> {{ $item->date_result }} </td>
                                                            <td class="text-center text-capitalize"> {{ $item->get_patients->name . ' ' . $item->get_patients->last_name }} </td>
                                                            @if (Auth::user()->contrie == '81')
                                                                <td class="text-center"> {{ $item->get_patients->is_minor === 'true' ? preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patients->get_reprensetative->re_ci) . '  (Rep)' : preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patients->ci) }} </td>
                                                            @else
                                                                <td class="text-center"> {{ $item->get_patients->is_minor === 'true' ? $item->get_patients->get_reprensetative->re_ci . '  (Rep)' : $item->get_patients->ci }} </td>
                                                            @endif
                                                            <td class="text-center"> {{ $item->description }} </td>
                                                            <td class="text-center">
                                                                <div class="d-flex" style="justify-content: center;">
                                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                        <a target="_blank"
                                                                            href="{{ URL::asset('/imgs/' . $item->file) }}"
                                                                            style="color: #47525e; text-decoration: none; display: flex; justify-content: center;">

                                                                            <button type="button"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                data-bs-custom-class="custom-tooltip"
                                                                                data-html="true"
                                                                                title="@lang('messages.tooltips.ver_examenes')">
                                                                                <img width="32" height="auto"
                                                                                    src="{{ asset('/img/icons/doc.png') }}"
                                                                                    alt="avatar">
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
                                    {{-- EXAMENES SIN RESULTADOS --}}
                                    <div class="row mt-3">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                            <hr>

                                            <h5 class="mb-4">@lang('messages.subtitulos.examenes_sin_res')</h5>
                                            <table id="table-info-sin-examen" class="table-pag-dos table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-image" scope="col" data-orderable="false">@lang('messages.tabla.foto')</th>
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
                                                    @foreach ($examen_sin_resul['data'] as $item)
                                                        @if (count($item->get_examne_stutus_uno) > 1)
                                                            <tr>
                                                                <td class="table-avatar">
                                                                    <img class="avatar"
                                                                        src=" {{ $item->get_patient->patient_img ? asset('/imgs/' . $item->get_patient->patient_img) : ($item->get_patient->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                        alt="Imagen del paciente">
                                                                </td>
                                                                <td class="text-center"> {{ $item->date }} </td>
                                                                <td class="text-center"> {{ $item->cod_ref }} </td>
                                                                <td class="text-center text-capitalize"> {{ $item->get_patient->name . ' ' . $item->get_patient->last_name }} </td>
                                                                @if (Auth::user()->contrie == '81')
                                                                    <td class="text-center"> {{ $item->get_patient->is_minor === 'true' ? preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patient->get_reprensetative->re_ci) . '  (Rep)' : preg_replace('~.*(\d{3})(\d{7})(\d{1}).*~', '$1-$2-$3', $item->get_patient->ci) }} </td>
                                                                @else
                                                                    <td class="text-center"> {{ $item->get_patient->is_minor === 'true' ? $item->get_patient->get_reprensetative->re_ci . '  (Rep)' : $item->get_patient->ci }} </td>
                                                                @endif
                                                                <td>
                                                                    <div class="d-flex" style="justify-content: center;">
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <a style="color: #47525e; text-decoration: none; display: flex; justify-content: center;">
                                                                                <button
                                                                                    onclick='showModal({{ $item }})'
                                                                                    data-bs-toggle='tooltip'
                                                                                    data-bs-placement='right'
                                                                                    data-bs-custom-class='custom-tooltip'
                                                                                    data-html='true' title="@lang('messages.tooltips.cargar_examen')"
                                                                                    type='button'
                                                                                    style="margin-right: 0">
                                                                                <img width="30" height="auto" src="{{ asset('/img/icons/add-document.png') }}" alt="avatar">
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
            aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" style='padding-right: 0;'>
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
                        <form id="form-load-img-examen" method="post" action="/">
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
                                        <input class="btn btnSave send " value="@lang('messages.botton.guardar')" type="submit" />
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
