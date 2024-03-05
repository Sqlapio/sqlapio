@extends('layouts.app-auth')
@section('title', 'Pacientes')
<style>
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

    .w-10 {
        width: 10%;
    }

    .w-17 {
        width: 17%;
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


        .w-10 {
            width: 10%;
        }

        .w-17 {
            width: 17%;
        }
    }
</style>
@push('scripts')
    @vite(['resources/js/dairy.js'])
    <script>
        let pathologiesArray = [];
        let patients = @json($patients);
        let centers = @json($centers);
        let user = @json($user);

        let urlPostCreateAppointment = '{{ route('CreateAppointment') }}';
        let urlDiary = "{{ route('Diary') }}";
        let status = "";
        let url = "{{ route('MedicalRecord', ':id') }}";
        let urlhist = "{{ route('ClinicalHistoryDetail', ':id') }}";
        let path = "{{ route('verify-plans') }}";
        let patient = @json($patient);



        $(document).ready(() => {

            if(patient.length==undefined){

                editPatien(patient,true);

            }
            
            let ulrImge = `{{ URL::asset('/img/V2/combinado.png') }}`;
            $(".holder").find('img').attr('src', ulrImge);

            switch (Number(user.type_plane)) {
                case 1:
                    if (Number(user.patient_counter) == 5) {

                        Swal.fire({
                            icon: 'warning',
                            title: '¡Su plan está en el límite de su capacidad de registro!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        });
                        return false;
                    }
                    if (Number(user.patient_counter) >= 10) {
                        $('#content-patient').hide();
                        $('#paciente-registrado').hide();
                        $('#paciente-warnig').show();
                        return false;
                    }

                    break;
                case 2:
                    if (Number(user.patient_counter) == 35) {

                        Swal.fire({
                            icon: 'warning',
                            title: '¡Su plan está en el límite de su capacidad de registro!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        });
                        return false;
                    }
                    if (Number(user.patient_counter) >= 40) {
                        $('#content-patient').hide();
                        $('#paciente-registrado').hide();
                        $('#paciente-warnig').show();
                        return false;
                    }
                    break;
                default:
                    break;
            }

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            getUrl(urlPostCreateAppointment, urlDiary);
            if (user.type_plane != '7' && centers.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debe asociar  un centro!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    window.location.href = "{{ route('Centers') }}";
                });
            }

            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();
            var minDate = year + '-' + month + '-' + day;
            $('.date-diary').attr('min', minDate);

            var today = new Date();
            var day = today.getDate() > 9 ? today.getDate() : "0" + today.getDate();
            var month = (today.getMonth() + 1) > 9 ? (today.getMonth() + 1) : "0" + (today.getMonth() + 1);
            var year = today.getFullYear();

            $(".date-bd").attr('max', year + "-" + month + "-" + day);

            $('#form-patients').validate({
                rules: {
                    ignore: [],
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    last_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                        email: true
                    },
                    ci: {
                        required: true,
                        minlength: 5,
                        maxlength: 8,
                        onlyNumber: true
                    },
                    genere: {
                        required: true,
                    },
                    birthdate: {
                        required: true,
                    },
                    // state: {
                    //     required: true,
                    // },
                    // city: {
                    //     required: true,
                    // },
                    address: {
                        required: true,
                    },
                    zip_code: {
                        required: true,
                    },
                    re_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    re_last_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    re_email: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                        email: true
                    },
                    re_ci: {
                        required: true,
                        minlength: 5,
                        maxlength: 8,
                        onlyNumber: true
                    },
                    re_phone: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    profession: {
                        required: true,
                    },
                    center_id: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Nombres es obligatorio",
                        minlength: "Nombres debe ser mayor a 3 caracteres",
                        maxlength: "Nombres debe ser menor a 50 caracteres",
                    },
                    last_name: {
                        required: "Apellidos es obligatorio",
                        minlength: "Apellidos debe ser mayor a 6 caracteres",
                        maxlength: "Apellidos debe ser menor a 8 caracteres",
                    },

                    email: {
                        required: "Correo Electrónico es obligatorio",
                        minlength: "Correo Electrónico debe ser mayor a 6 caracteres",
                        maxlength: "Correo Electrónico debe ser menor a 8 caracteres",
                        email: "Correo Electrónico incorrecto"
                    },
                    ci: {
                        required: "Cédula de identidad es obligatoria",
                        minlength: "Cédula de identidad  debe ser mayor a 5 caracteres",
                        maxlength: "Cédula de identidad  debe ser menor a 8 caracteres",
                    },
                    genere: {
                        required: "Género es obligatorio",
                    },
                    birthdate: {
                        required: "Fecha de nacimiento es obligatorio",
                    },
                    // state: {
                    //     required: "Estado es obligatoria",
                    // },
                    // city: {
                    //     required: "Ciudad es obligatoria",
                    // },
                    address: {
                        required: "Dirección es obligatoria",
                    },
                    zip_code: {
                        required: "Código postal es obligatorio",
                    },
                    re_name: {
                        required: "Nombre del representante es obligatorio",
                        minlength: "Nombre del representante debe ser mayor a 3 caracteres",
                        maxlength: "Nombre del representante debe ser menor a 50 caracteres",
                    },
                    re_last_name: {
                        required: "Apellido del representante es obligatorio",
                        minlength: "Apellido del representante debe ser mayor a 3 caracteres",
                        maxlength: "Apellido del representante debe ser menor a 50 caracteres",
                    },
                    re_email: {
                        required: "Correo del representante es obligatorio",
                        minlength: "Correo debe ser mayor a 6 caracteres",
                        maxlength: "Correo debe ser menor a 8 caracteres",
                        email: "Correo incorrecto"
                    },
                    re_ci: {
                        required: "Cédula del representante es obligatorio",
                        minlength: "Cédula del representante  debe ser mayor a 5 caracteres",
                        maxlength: "Cédula del representante  debe ser menor a 8 caracteres",
                    },
                    re_phone: {
                        required: "Teléfono del representante es obligatorio",
                    },
                    profession: {
                        required: "Profesión es obligatoria",
                    },
                    phone: {
                        required: "Teléfono es obligatorio",
                    },
                    center_id: {
                        required: "Centro es obligatorio",
                    }

                }
            });

            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo numérico");

            //envio del formulario
            $("#form-patients").submit(function(event) {
                event.preventDefault();
                $("#form-patients").validate();
                if ($("#form-patients").valid()) {
                    $('#btn-save').attr('disabled', true);
                    $('#send').hide();
                    $('#spinner2').show();
                    var data = $('#form-patients').serialize();
                    $.ajax({
                        url: "{{ route('register-patients') }}",
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            $('#send').show();
                            $('#spinner2').hide();
                            // $("#form-patients").trigger("reset");
                            // $(".holder").hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Paciente registrado exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                url = url.replace(':id', response[0].id);
                                $("#bnt-cons").show();
                                $("#bnt-cons").find('a').remove();
                                $("#bnt-cons").append(
                                    `<a href="${url}"><button type="button" class="btn btnSecond">Consulta medica</button></a>`
                                );

                                switch_type_plane(user.type_plane, response[1]);
                            });
                        },
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                $('#spinner2').hide();
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    $('#btn-save').attr('disabled', false);
                                    $('#spinner2').hide();
                                    // $(".holder").hide();
                                });
                            });
                        }
                    });
                }
            });
        });

        function handlerAge(e) {
            if (Number($("#age").val()) >= 18) {
                $("#ci").rules('add', {
                    required: true,
                    minlength: 5,
                    maxlength: 8,
                    onlyNumber: true
                });
                $('#data-rep').hide();
                $('#is_minor').val(false);
                $("#profesion-div").show();
                $("#ci-div").show();
                $("#email-div").show();
                $("#div-phone").show();

            } else {
                $("#profesion-div").hide();
                $("#ci-div").hide();
                $("#email-div").hide();
                $("#div-phone").hide();

                // validar si el nino tiene menos de 8 anos
                // if (Number($("#age").val()) > 8) {
                //     $("#ci-div").show();
                //     $("#ci").rules('remove');
                // }

                $('#data-rep').show();
                $('#is_minor').val(true);
            }
        }

        //seteiar data en el formalario para su edicion
        function editPatien(item, active = true) {
            if (active) {
                $(".accordion-collapseOne").collapse('show')
            }

            $("#id").val(item.id);
            $("#name").val(item.name);
            $("#name").val(item.name);
            $("#last_name").val(item.last_name);
            $("#ci").val(item.ci);
            $("#address").val(item.address);
            $("#genere").val(item.genere).change();
            $("#email").val(item.email);
            $("#phone").val(item.phone);
            $("#profession").val(item.profession);
            $("#birthdate").val(item.birthdate).change();
            $("#zip_code").val(item.zip_code);
            $("#center_id").val(item.center_id).change();
            $("#state").val(item.state).change();
            $("#city").val(item.city).change();
            $('#btn-save').attr('disabled', false);
            $(".holder").show();
            if (item.is_minor === 'true') {
                $("#re_name").val(item.get_reprensetative.re_name);
                $("#re_last_name").val(item.get_reprensetative.re_last_name);
                $("#re_ci").val(item.get_reprensetative.re_ci);
                $("#re_email").val(item.get_reprensetative.re_email);
                $("#re_phone").val(item.get_reprensetative.re_phone);
            }
            if (item.patient_img === null) {
                let ulrImge = `{{ URL::asset('/img/V2/combinado.png') }}`;
                $(".holder").find('img').attr('src', ulrImge);
                $("#img").val(ulrImge);
            } else {
                let ulrImge = `{{ URL::asset('/imgs/${item.patient_img}') }}`;
                $(".holder").find('img').attr('src', ulrImge);
                $("#img").val(item.patient_img);
            }

        }

        function refreshForm() {
            // $(".holder").hide();
            $("#show-info-pat").hide();
            $("#bnt-save").show();
            $("#bnt-cons").hide();
            $("#bnt-hist").hide();
            $("#bnt-dairy").hide();
            $("#form-patients").trigger("reset");
            $('#data-rep').hide();
            $('#is_minor').val(false);
            $('#id').val('');
            $('#btn-save').attr('disabled', false);
            $("#div-otros").hide();
            $("#profesion-div").show();
            $("#ci-div").show();
            $("#email-div").show();
            $("#div-phone").show();
            $("#profesion-div").show();
            $('#search_patient').val('');
            let ulrImge = `{{ URL::asset('/img/V2/combinado.png') }}`;
            $(".holder").find('img').attr('src', ulrImge);

        }

        function handlerPatExit(e) {
            $("#search_patient").val('');
            if ($(`#${e.target.id}`).is(':checked')) {
                $('#content-patient').hide();
                $('#content-search-pat').show();

            } else {
                refreshForm();
                $('#bnt-cons').hide();
                $('#bnt-hist').hide();
                $('#bnt-dairy').hide();
                $('#content-search-pat').hide();
                $('#content-patient').show();
            }

        }

        function searchPat() {
            $('#spinner2').show();
            if ($('#search_patient').val() != '') {
                let route = "{{ route('search-patient', ':value') }}";
                route = route.replace(':value', `${$('#search_patient').val()}-${status}`);
                $.ajax({
                    url: route,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $('#search_patient').val('');
                        $('#spinner2').hide();
                        $(".accordion-collapseOne").collapse('show')
                        if (response.length > 1) {
                            $('#show-info-pat').show();
                            $('#content-patient').hide();
                            let data = [];

                            response.map((elem) => {

                                elem.name_full = (elem.is_minor == "true") ?
                                    `${elem.get_reprensetative.re_name} ${elem.get_reprensetative.re_last_name}` :
                                    `${elem.name} ${elem.last_name}`;

                                elem.ci = (elem.is_minor == "true") ? elem.get_reprensetative.re_ci :
                                    elem.ci;

                                let elemData = JSON.stringify(elem);
                                elem.btn = `
                                                <button onclick='setValue(${elemData})' type="button" class="btn-2 btnSecond">
                                                    Consultar
                                                </button>`;
                                data.push(elem);

                            })

                            new DataTable('#table-show-info-pat', {
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                                },
                                bDestroy: true,
                                data: data,
                                "searching": false,
                                "bLengthChange": false,
                                columns: [{

                                        data: 'name_full',
                                        title: 'Nombre',
                                        className: "text-center text-capitalize",
                                    },
                                    {

                                        data: 'ci',
                                        title: 'Cédula',
                                        className: "text-center w-10",
                                    },

                                    {
                                        data: 'birthdate',
                                        title: 'Fecha de Nacimiento ',
                                        className: "text-center w-10",
                                    },
                                    {
                                        data: 'genere',
                                        title: 'Género',
                                        className: "text-center text-capitalize",
                                    },
                                    {
                                        data: 'btn',
                                        title: 'Acciones',
                                        className: "text-center w-20",
                                    }
                                ],
                            });
                        } else {
                            if (response.is_minor != undefined) {
                                setValue(response);
                            } else {
                                setValue(response[0]);
                            }
                        }
                        // });
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
                            $('#spinner2').hide();
                            // $(".holder").hide();
                        });
                    }
                });
            }
        }

        function setValue(data) {
            $('#content-search-pat').hide();
            $('#show-info-pat').hide();
            $('#search_patient').val('');
            $('#content-patient').show();
            $('#bnt-save').hide();
            $('#bnt-cons').show();
            $('#bnt-hist').show();
            $('#bnt-dairy').show();
            $('#flexSwitchCheckChecked').prop('checked', false);
            url = url.replace(':id', data.id);
            urlhist = urlhist.replace(':id', data.id);
            $("#bnt-cons").find('a').remove();
            $("#bnt-dairy").find('button').remove();
            $("#bnt-hist").find('button').remove();
            $("#bnt-cons").append(
                `<a href="${url}"><button type="button" class="btn btnSecond">Consulta medica</button></a>`);
            let elemData = JSON.stringify(data);
            let elemRep = JSON.stringify(data.get_reprensetative);
            $("#bnt-dairy").append(
                `<button onclick='agendarCita(${elemData},${elemRep});' type="button" class="btn btnPrimary">Agendar cita</button>`
            );
            $("#bnt-hist").append(
                `<a href="${urlhist}"><button type="button" class="btn btnSecond">Historia clinica</button></a>`
            );
            editPatien(data, false);
        }

        function agendarCita(item, info) {

            $('#exampleModal').modal('show');
            if (item.is_minor == 'true') {
                $("#name-pat").text(item.name + ' ' + item.last_name);
                $("#email-pat").text(`${info.re_email} (Rep)`);
                $("#phone-pat").text(`${info.re_phone} (Rep)`);
                $("#ci-pat").text(`${info.re_ci} (Rep)`);
                $("#genere-pat").text(item.genere);
                $("#age-pat").text(item.age);
                $("#patient_id").val(item.id);
            } else {
                $("#name-pat").text(item.name + ' ' + item.last_name);
                $("#email-pat").text(item.email);
                $("#phone-pat").text(item.phone);
                $("#ci-pat").text(item.ci);
                $("#genere-pat").text(item.genere);
                $("#age-pat").text(item.age);
                $("#patient_id").val(item.id);
            }
            $('#div-pat').show();
            let img_url = `{{ URL::asset('/img/avatar/avatar mujer.png') }}`;
            if (item.patient_img === null) {
                if (item.genere == "masculino") {
                    img_url = `{{ URL::asset('/img/avatar/avatar hombre.png') }}`;
                }
            } else {
                img_url = `{{ URL::asset('/imgs/') }}/${item.patient_img}`;
            }
            $("#img-pat").attr("src", `${img_url}`);
            $('#registrer-pac').attr("disabled", false);
            $('#timeIni').focus()
        }

        function habdlerPatSearch(e) {
            if (Number(e.target.value) === 0) {
                status = true;
            } else {
                status = false;
            }
            $('#search_patient').attr('disabled', false)
        }

        function handlerEmail(e, email) {
            if (e.target.value === email) {
                Swal.fire({
                    icon: 'error',
                    title: 'Accion no permitida, el correo se encuentra logueado en el sistema!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    $('#email').val('');
                });
            }
        }

        function switch_type_plane(type_plane, count_pat) {

            switch (Number(type_plane)) {
                case 1:
                    if (Number(count_pat) == 5) {

                        Swal.fire({
                            icon: 'warning',
                            title: '¡Su plan está en el límite de su capacidad de registro!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        });
                        return false;
                    }
                    if (Number(count_pat) >= 10) {
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Ha consumido el total de pacientes registrados!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            window.location.href = path;
                        });
                    }
                    break;
                case 2:
                    if (Number(count_pat) == 35) {

                        Swal.fire({
                            icon: 'warning',
                            title: '¡Su plan está en el límite de su capacidad de registro!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        });
                        return false;
                    }
                    if (Number(count_pat) >= 40) {
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Ha consumido el total de pacientes registrados!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            window.location.href = path;
                        });
                    }
                    break;

                default:
                    break;
            }
        }

        const alertInfoPaciente = (item) => {
            Swal.fire({
                icon: 'warning',
                title: 'Debe actualizar la información del paciente!',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                editPatien(item,true);

            });
        }
    </script>
@endpush
@section('content')
    <div>
        <div id="spinner2" style="display: none">
            <x-load-spinner show="true" />
        </div>
        <div class="container-fluid body" style="padding: 0 3% 3%">
            <div class="accordion" id="accordion">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person-add"></i> @lang('messages.acordion.nuevo_paciente')
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapseOne accordion-collapse collapse"
                                aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row mt-3 justify-content-center" id="paciente-warnig" style="display: none">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <div class="row justify-content-center">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                    <h5 class="card-title" style="text-align: center; margin-bottom: 10px;">
                                                        @lang('messages.label.info_1') </h5>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="display: flex; justify-content: center;">
                                                    <img width="150" height="auto"
                                                        src="{{ asset('/img/icons/icon-warning.png') }}" alt="avatar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                            style="display: flex; justify-content: flex-end;">
                                            <a style="margin-top: 10px;" href="{{ route('verify-plans') }}"
                                                class="btn btnSecond">
                                                @lang('messages.label.detalle_plan')
                                            </a>
                                        </div>
                                    </div>
                                    <div id="content-patient">
                                        <form id="form-patients" method="post" action="/" style="margin-bottom: 0px">
                                            {{ csrf_field() }}
                                            <div class="row" style="align-items: flex-end;">
                                                <input type="hidden" name="is_minor" id="is_minor" value="false">
                                                <input type="hidden" name="id" id="id" value="">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        @foreach ($errors->all() as $message)
                                                            <span class="text-danger error-span">
                                                                {{ $message }}
                                                            </span>
                                                            <br />
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 col-xxl-2 ">
                                                    <x-upload-image title />
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-10">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="name" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.nombre')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="form-control mask-text @error('name') is-invalid @enderror"
                                                                        id="name" name="name" type="text"
                                                                        value="">
                                                                    <i class="bi bi-person-circle st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="last_name" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.apellido')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="form-control mask-text @error('last_name') is-invalid @enderror"
                                                                        id="last_name" name="last_name" type="text"
                                                                        value="">
                                                                    <i class="bi bi-person-circle st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                                            <div class="form-group">
                                                                <label for="birthdate" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                    @lang('messages.form.fecha_nacimiento')
                                                                </label>
                                                                <input class="form-control date-bd" id="birthdate"
                                                                    name="birthdate" type="date" value=""
                                                                    style="padding: 0.375rem 5px 0.375rem 0.75rem;"
                                                                    onchange="calculateAge(event,'age'), handlerAge(event)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="genere" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.genero')
                                                                    </label>
                                                                    <select name="genere" id="genere"
                                                                        placeholder="Seleccione"class="form-control @error('genere') is-invalid @enderror"
                                                                        class="form-control combo-textbox-input">
                                                                        <option value="">@lang('messages.placeholder.seleccione')</option>
                                                                        <option value="femenino">@lang('messages.label.femenino')
                                                                        </option>
                                                                        <option value="masculino">@lang('messages.label.masculino')
                                                                        </option>
                                                                    </select>
                                                                    <i class="bi bi-gender-ambiguous st-icon"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2"
                                                            id="ci-div">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="ci" class="form-label"
                                                                        type="number"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                        @lang('messages.form.cedula_identidad')
                                                                    </label>
                                                                    <input autocomplete="off"
                                                                        class="form-control @error('ci') is-invalid @enderror"
                                                                        id="ci" name="ci" type="text"
                                                                        value="">
                                                                    <i class="bi bi-person-vcard st-icon"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3"
                                                            id="div-phone">
                                                            <x-phone_component/>

                                                            {{-- <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="phone" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.telefono')</label>
                                                                    <input autocomplete="off" placeholder=""
                                                                        class="form-control phone @error('phone') is-invalid @enderror"
                                                                        id="phone" name="phone" type="text"
                                                                        value="">
                                                                    <i class="bi bi-telephone-forward st-icon"></i>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-10">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="address" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.direccion')</label>
                                                            <textarea id="address" name="address" class="form-control" rows="1"></textarea>
                                                            <i class="bi bi-geo st-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="zip_code" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.codigo_postal')</label>
                                                            <input autocomplete="off"
                                                                class="form-control mask-only-text @error('zip_code') is-invalid @enderror"
                                                                id="zip_code" name="zip_code" type="text"
                                                                value="">
                                                            <i class="bi bi-geo st-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2"
                                                    id="email-div">
                                                    <div class="form-group">
                                                        <div class="Icon-inside">
                                                            <label for="email" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label>
                                                            @php
                                                                $email = Auth::user()->email;
                                                            @endphp
                                                            <input autocomplete="off"
                                                                onchange='handlerEmail(event,@json($email))'
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                id="email" name="email" type="text"
                                                                value="">
                                                            <i class="bi bi-envelope-at st-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input id="age" name="age" type="hidden" value="">
                                                <x-professions
                                                    class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3" />


                                                @if (Auth::user()->type_plane !== '7')
                                                    <x-centers_user
                                                        class="col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mt-2" />
                                                @endif
                                                {{-- data del representante --}}
                                                <div class="row mt-3" id="data-rep"
                                                    style="display: none; padding-right: 0px;">
                                                    <hr>
                                                    <h5>@lang('messages.label.datos_representante')</h5>
                                                    <hr>
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="re_name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre')</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-text @error('re_name') is-invalid @enderror"
                                                                    id="re_name" name="re_name" type="text"
                                                                    value="">
                                                                <i class="bi bi-person-circle st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="re_last_name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.apellido')</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-text @error('re_last_name') is-invalid @enderror"
                                                                    id="re_last_name" name="re_last_name" type="text"
                                                                    value="">
                                                                <i class="bi bi-person-circle st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="ci" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.cedula_identidad')</label>
                                                                <input autocomplete="off"
                                                                    class="form-control @error('re_ci') is-invalid @enderror"
                                                                    id="re_ci" name="re_ci" type="text"
                                                                    value="">
                                                                <i class="bi bi-person-vcard st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="telefono" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.telefono')</label>
                                                                <input autocomplete="off"
                                                                    class="form-control phone @error('re_phone') is-invalid @enderror"
                                                                    id="re_phone" name="re_phone" type="text"
                                                                    value="">
                                                                <i class="bi bi-telephone-forward st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-2"
                                                        style="padding-right: 0;">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="email" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label>
                                                                <input autocomplete="off"
                                                                    onchange='handlerEmail(event,@json($email))'
                                                                    class="form-control @error('re_email') is-invalid @enderror"
                                                                    id="re_email" name="re_email" type="text"
                                                                    value="">
                                                                <i class="bi bi-envelope-at st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                </div>
                                                {{-- end --}}
                                            </div>

                                            <div class="row mt-3 justify-content-md-end">
                                                <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="display: flex; justify-content: flex-end; align-items: flex-end; flex-wrap: wrap;">
                                                    <div id="bnt-dairy"
                                                        style="display: none;margin-left: 10px; ; margin-bottom: 10px">
                                                    </div>
                                                    <div id="bnt-cons"
                                                        style="display: none;margin-left: 10px; margin-bottom: 10px"></div>
                                                    <div id="bnt-hist"
                                                        style="display: none;margin-left: 10px; margin-bottom: 10px"></div>
                                                    <input class="btn btnSave send" id="btn-save"
                                                        value="@lang('messages.botton.guardar')" type="submit"
                                                        style="margin-left: 10px; margin-bottom: 10px" />
                                                    <button style="margin-left: 10px; margin-bottom: 10px;" type="button"
                                                        onclick="refreshForm();" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-html="true"
                                                        title="@lang('messages.label.limpiar')">
                                                        <img width="32" height="auto"
                                                            src="{{ asset('/img/icons/eraser.png') }}" alt="avatar">
                                                    </button>
                                                </div>
                                                <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="display: flex; justify-content: center;"> </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row" id="show-info-pat" style="display: none">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive">
                                            <hr>
                                            <h5 style="margin-bottom: 17px;">@lang('messages.label.hijos_registrados')</h5>
                                            <hr>
                                            <table id="table-show-info-pat" class="table table-striped table-bordered"
                                                style="width:100%; ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-17" scope="col">@lang('messages.tabla.nombre_apellido')
                                                        </th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.cedula')
                                                        </th>
                                                        <th class="text-center w-17" scope="col">@lang('messages.tabla.fecha_nacimiento')
                                                        </th>
                                                        <th class="text-center w-10" scope="col">@lang('messages.tabla.genero')
                                                        </th>
                                                        <th class="text-center w-20" scope="col"
                                                            data-orderable="false">@lang('messages.tabla.acciones')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Pacientes registrados  --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-cd">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person-add"></i> @lang('messages.acordion.paciente_registrado')
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row mt-3" {{-- id="content-search-pat" --}}>
                                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group" style="margin-top: 5px;">
                                                <label for="search_patient"
                                                    class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: -23px">
                                                    @lang('messages.form.cedula_identidad')
                                                </label>
                                                <input maxlength="10" type="text"
                                                    class="form-control mask-only-number" id="search_patient"
                                                    name="search_patient" placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1 mt-3" style='display: flex; align-items: flex-end;'>
                                            <button style="margin-top: 2px;" onclick="searchPat()" class="btn btnSave">
                                                @lang('messages.botton.buscar')
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="row" id="table-patients">
                                            <div
                                                class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 table-responsive">
                                                <table id="table-patient" class="table table-striped table-bordered"
                                                    style="width:100%; ">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center w-image" scope="col"
                                                                data-orderable="false">@lang('messages.tabla.foto')</th>
                                                            <th class="text-center w-10" scope="col">@lang('messages.tabla.codigo_paciente')
                                                            </th>
                                                            <th class="text-center w-17" scope="col">@lang('messages.tabla.nombre_apellido')
                                                            </th>
                                                            <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_nacimiento')
                                                            </th>
                                                            <th class="text-center w-30" scope="col">@lang('messages.tabla.centro_salud')
                                                            </th>
                                                            <th class="text-center w-17" scope="col" data-orderable="false">@lang('messages.tabla.acciones')</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($patients as $item)
                                                            <tr>
                                                                <td class="table-avatar">
                                                                    <img class="avatar"
                                                                        src=" {{ $item->patient_img ? asset('/imgs/' . $item->patient_img) : ($item->genere == 'femenino' ? asset('/img/avatar/avatar mujer.png') : asset('/img/avatar/avatar hombre.png')) }}"
                                                                        alt="Imagen del paciente">
                                                                </td>
                                                                <td class="text-center">
                                                                    <button
                                                                        onclick="agendarCita({{ $item }},{{ $item->get_reprensetative }})"
                                                                        type="button" class="btn btnSecond"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-placement="bottom"
                                                                        data-bs-custom-class="custom-tooltip"
                                                                        data-html="true" title="Agendar cita"
                                                                        style="font-size: 13px; padding: 0px 11px 0px 11px; !important">{{ $item->patient_code }}</button>
                                                                </td>
                                                                <td class="text-center text-capitalize"> {{ $item->name }} {{ $item->last_name }}</td>
                                                                <td class="text-center"> {{ date('d-m-Y', strtotime($item->birthdate)) }} </td>
                                                                <td class="text-center"> {{ $item->get_center->description }} </td>
                                                                <td class="text-center">
                                                                    <div class="d-flex">
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <button
                                                                                onclick="editPatien({{ json_encode($item) }},true); "
                                                                                type="button" data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                title="@lang('messages.tooltips.editar')">
                                                                                <img width="40" height="auto"
                                                                                    src="{{ asset('/img/icons/user-edit.png') }}"
                                                                                    alt="avatar">
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <a href="{{ $item->age == '' ? '#' : route('MedicalRecord', $item->id) }}"
                                                                                onclick='{{ $item->age == '' ? "alertInfoPaciente($item)"  : '' }}'>
                                                                                <button type="button"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="@lang('messages.tooltips.consulta_medica')">
                                                                                    <img width="40" height="auto"
                                                                                        src="{{ asset('/img/icons/monitor.png') }}"
                                                                                        alt="avatar">
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <a href="{{ $item->age == '' ? '#' : route('ClinicalHistoryDetail', $item->id) }}"                                                                            
                                                                                onclick='{{ $item->age == '' ? "alertInfoPaciente($item)"  : '' }}'>
                                                                                <button type="button"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="@lang('messages.tooltips.historia')">
                                                                                    <img width="40" height="auto" src="{{ asset('/img/icons/recipe.png') }}" alt="avatar">
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

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
            <div id="spinner" style="display: none">
                <x-load-spinner show="true" />
            </div>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header title">
                            <i class="bi bi-calendar-week"></i>
                            <span style="padding-left: 5px">
                                @lang('messages.modal.titulo.agendar_cita')
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="font-size: 12px;"></button>
                        </div>
                        <div class="modal-body">
                            <div id="div-pat" style="display: none">
                                <div class="d-flex" style="align-items: center;">
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 modal-d">
                                        <div class="img">
                                            <img id="img-pat" src="" width="125" height="125"
                                                alt="Imagen del paciente">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6" style="font-size: 13px;">
                                        <div>
                                            <strong><span class="text-capitalize" id="name-pat"></span></strong>
                                            <br>
                                            <strong>@lang('messages.ficha_paciente.ci') </strong><span id="ci-pat"></span>
                                            <br>
                                            <strong>@lang('messages.ficha_paciente.edad'): </strong><span id="age-pat"></span>
                                            <br>
                                            <strong>@lang('messages.ficha_paciente.genero'): </strong><span class="text-capitalize"
                                                id="genere-pat"></span>
                                            <br>
                                            <strong>@lang('messages.ficha_paciente.correo'): </strong><span id="email-pat"></span>
                                            <br>
                                            <strong>@lang('messages.ficha_paciente.telefono'): </strong><span id="phone-pat"></span>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" id="form-appointment">
                                {{ csrf_field() }}
                                <div class="row mt-1">
                                    <input type="hidden" id="patient_id" name="patient_id" value="">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="date" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                    @lang('messages.modal.form.fecha')
                                                </label>
                                                <input class="form-control date-diary" id="date_start" name="date_start"
                                                    type="date" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="phone" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.tiempo_horario')</label>
                                                <select id="timeIni" name="timeIni" onchange="handlerTime(event)"
                                                    class="form-control valid">
                                                    <option value="">@lang('messages.placeholder.seleccione')</option>
                                                    <option value="am">@lang('messages.label.am')</option>
                                                    <option value="pm">@lang('messages.label.pm')</option>
                                                </select>
                                                <i class="bi bi-stopwatch st-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="phone" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                    @lang('messages.modal.form.horarios_cita')
                                                </label>
                                                <select id="hour_start" name="hour_start"
                                                    class="form-control valid"></select>
                                                <i class="bi bi-stopwatch st-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    @if (Auth::user()->type_plane != 7)
                                        <x-centers_user class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" />
                                    @endif

                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 text-center">
                                        <div class="form-check form-switch">
                                            <input onchange="handlerPrice(event);" style="width: 5em"
                                                class="form-check-input" type="checkbox" role="switch" id="showPrice"
                                                value="">
                                            <label style="margin-left: -146px;margin-top: 8px; font-size: 15px"
                                                for="showPrice">
                                                @lang('messages.modal.form.precio')
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: none"
                                        id="div-price">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="searchPatients" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                    @lang('messages.modal.form.precio')
                                                </label>
                                                <input maxlength="8" type="text"
                                                    class="form-control mask-input-price" id="price" name="price"
                                                    id="searchPatients" value="">
                                                <i class="bi bi-cash st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- btns --}}
                                    <div class="row text-center mt-2 mb-2">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4"
                                            style="margin-top: -4px" id="send">
                                            <input class="btn btnSave" id="registrer-pac" value="@lang('messages.botton.agendar_cita')"
                                                type="submit" />
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="btn-con"></div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="btn-cancell"></div>
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
