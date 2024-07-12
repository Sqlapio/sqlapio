@extends('layouts.app-auth')
@section('title', 'Perfil')
<style>
    .sel {
        margin-top: -10px !important;
    }

    .collapseBtn {
        color: #428bca;
    }

    .mb-btn {
        margin-top: 0.5rem;
    }

    .mb-btnSve {
        margin-bottom: 15px;
    }

    @media only screen and (max-width: 992px) {
        .mb-btn {
            margin-top: 18px !important;
            /* margin-left: 12px; */
        }
    }

    @media (min-width: 391px) and (max-width: 576px) {
        .mb-btnSve {
            width: 40% !important;
        }

        .mb-btnRtr {
            width: 60% !important;
        }

    }
</style>
@push('scripts')
    <script>
        let link = '';
        $(document).ready(() => {

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            $('#form-profile').validate({
                rules: {
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
                        email: true
                    },
                    ci: {
                        required: true,
                        minlength: 5,
                        maxlength: 15,
                        // onlyNumber: true
                    },
                    genere: {
                        required: true,
                    },
                    birthdate: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    // address: {
                    //     required: true,
                    // },
                    // zip_code: {
                    //     required: true,
                    // },
                    phone: {
                        required: true,
                    },
                    cod_mpps: {
                        required: true,
                    },
                    specialty: {
                        required: true,
                    },
                    number_consulting_phone: {
                        required: true,
                    },
                    number_floor: {
                        required: true,
                    },
                    number_consulting_room: {
                        required: true,
                    },
                    contrie: {
                        required: true,
                    },
                    state_contrie: {
                        required: true,
                    },
                    city_contrie: {
                        required: true,
                    },
                    specialty_new: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "@lang('messages.alert.nombre_obligatorio')",
                        minlength: "@lang('messages.alert.nombre_3_caracteres')",
                        maxlength: "@lang('messages.alert.nombre_50_caracteres')",
                    },
                    last_name: {
                        required: "@lang('messages.alert.apellido_obligatorio')",
                        minlength: "@lang('messages.alert.apellido_6_caracteres')",
                        maxlength: "@lang('messages.alert.apellido_8_caracteres')",
                    },

                    email: {
                        required: "@lang('messages.alert.correo_obligatorio')",
                        email: "@lang('messages.alert.correo_incorrecto')"
                    },
                    ci: {
                        required: "@lang('messages.alert.cedula_obligatoria')",
                        minlength: "@lang('messages.alert.cedula_5_caracteres')",
                        maxlength: "@lang('messages.alert.cedula_15_caracteres')",
                    },
                    genere: {
                        required: "@lang('messages.alert.genero_obligatorio')",
                    },
                    birthdate: {
                        required: "@lang('messages.alert.fecha_obligatorio')",
                    },
                    state: {
                        required: "@lang('messages.alert.estado_obligatorio')",
                    },
                    city: {
                        required: "@lang('messages.alert.ciudad_obligatorio')",
                    },
                    // address: {
                    //     required: "@lang('messages.alert.direccion_obligatoria')",
                    // },
                    // zip_code: {
                    //     required: "@lang('messages.alert.codigo_area_obligatorio')",
                    // },
                    phone: {
                        required: "@lang('messages.alert.telefono_obligatorio')",
                    },
                    business_name: {
                        required: "@lang('messages.alert.nombre_lab_obligatorio')",
                    },
                    rif: {
                        required: "@lang('messages.alert.rif_obligatorio')",
                    },
                    type_laboratory: {
                        required: "@lang('messages.alert.tipo_lab_obligatorio')",
                    },
                    responsible: {
                        required: "@lang('messages.alert.responsable_obligatorio')",
                    },
                    license: {
                        required: "@lang('messages.alert.num_licencia_obligatorio')",
                    },
                    website: {
                        url: "@lang('messages.alert.url_valida')"
                    },
                    cod_mpps: {
                        required: "@lang('messages.alert.mpps_obligatorio')"
                    },
                    specialty: {
                        required: "@lang('messages.alert.especialidad_obligatorio')"
                    },
                    number_consulting_phone: {
                        required: "@lang('messages.alert.num_tlf_obligatorio')"
                    },
                    number_floor: {
                        required: "@lang('messages.alert.num_piso_obligatorio')"
                    },
                    number_consulting_room: {
                        required: "@lang('messages.alert.num_cons_obligatorio')"
                    },
                    contrie: {
                        required: "@lang('messages.alert.pais_obligatorio')",
                    },
                    state_contrie: {
                        required: "@lang('messages.alert.estado_obligatorio')",
                    },
                    city_contrie: {
                        required: "@lang('messages.alert.ciudad_obligatorio')",
                    },
                    specialty_new: {
                        required: "@lang('messages.alert.campo_obligatorio')",
                    },
                },


            });
            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^[0-9-]*$/;
                return pattern.test(value);
            }, "Campo numérico");

            $('#form-seal').validate({
                rules: {
                    seal: {
                        required: true,
                    }
                },
                messages: {
                    seal: {
                        required: "@lang('messages.alert.campo_obligatorio')",
                    }
                }
            });

            let img;
            let seal_img;
            let user = @json($user);

            if (user.role == 'medico') {
                img = user.user_img;
                seal_img = user.digital_cello;

                $('#birthdate').val(user.birthdate).change();
                $('#contrie').val(user.contrie).change();
                $('#state_contrie').val(user.state).change();
                $('#city_contrie').val(user.city).change();
                $('#address').val(user.address).change();
                $('#genere').val(user.genere).change();
                $('#specialty').val(user.specialty).change();
                $(".holder").find('img').attr('src', img);

                if (seal_img != null) {
                    $(".holder_seal").show();
                    let ulr_seal_img = `{{ URL::asset('/imgs/seal/${seal_img}') }}`;
                    $(".holder_seal").find('#seal_img_preview').attr('src', ulr_seal_img);
                    $(".seal_img").val(seal_img);
                }

            } else {

                $("#business_name").attr('readonly', true).rules('add', {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                });

                $("#rif").attr('readonly', true).rules('add', {
                    required: true,
                    minlength: 5,
                    maxlength: 17,
                    // onlyNumber: true
                });

                $("#license").rules('add', {
                    required: true,
                    minlength: 5,
                    maxlength: 15,
                    onlyNumber: true
                });

                $("#website").rules('add', {
                    url: true,
                });

                $("#type_laboratory").rules('add', {
                    required: true
                });

                $("#responsible").rules('add', {
                    required: true
                });
                if (user.get_laboratorio) {
                    img = user.get_laboratorio.lab_img;
                    $('#state').val(user.get_laboratorio.state).change();
                    $('#city').val(user.get_laboratorio.city).change();
                    $('#address').val(user.get_laboratorio.address).change();
                    $('#type_laboratory').val(user.get_laboratorio.type_laboratory).change();
                    $('#type_rif').attr('disabled', true).val(user.get_laboratorio.rif[0] + "-").change();
                    setTimeout(() => {
                        $('#rif').val(user.get_laboratorio.rif);
                    }, 10);
                }
            }

            if (img != null) {
                $(".holder").show();
                let ulrImge = `{{ URL::asset('/imgs/${img}') }}`;
                $(".holder").find('img').attr('src', ulrImge);
                $("#img").val(img);
            } else {
                let img2 = '{{ URL::asset('/img/V2/combinado.png') }}';
                $(".holder").find('img').attr('src', img2);
                // $("#img").val(img2);
            }

            //envio del formulario
            $("#form-profile").submit(function(event) {
                event.preventDefault();
                $("#form-profile").validate();
                if ($("#form-profile").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    var data = $('#form-profile').serialize();
                    $.ajax({
                        url: '{{ route('update-profile') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-profile").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: '@lang('messages.alert.perfil_actualizado')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {
                                window.location.href = (user.role ==
                                        "corporativo") ?
                                    "{{ route('Dashboard-corporate') }}" :
                                    "{{ route('DashboardComponent') }}";
                            });
                        },
                        error: function(error) {
                            $('#send').show();
                            $('#spinner').hide();
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                }).then((result) => {
                                    $('#btn-save').attr('disabled', false);
                                    $('#spinner2').hide();
                                    $(".holder").hide();
                                });
                            });

                        }
                    });
                }
            });

            //envio del formulario para la firma digital
            $("#form-seal").submit(function(event) {
                event.preventDefault();
                $("#form-seal").validate();
                if ($("#form-seal").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    var data = $('#form-seal').serialize();
                    $.ajax({
                        url: '{{ route('create_seal') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-seal").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: '@lang('messages.alert.operacion_exitosa')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {
                                $('#div-seal-content').hide();
                            });
                        },
                        error: function(error) {
                            $('#send').show();
                            $('#spinner').hide();
                            console.log(error.responseJSON.errors);

                        }
                    });
                }
            })
        });

        function handlerTypeDoc(e) {
            $('#rif').val(e.target.value);
        }

        function handlerEmial() {
            if ($('#act-email').val() != "" && /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#act-email')
                    .val())) {
                Swal.fire({
                    title: '@lang('messages.alert.accion')',
                    text: "@lang('messages.alert.envio_codigo')",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: '@lang('messages.botton.cancelar')',
                    confirmButtonColor: '#42ABE2',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '@lang('messages.botton.aceptar')'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $('#spinner').show();
                        ///solicitar otp
                        $.ajax({
                            url: '{{ route('send_otp') }}',
                            type: 'POST',
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                email: $('#act-email').val(),
                                action: "up"
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                $('#spinner').hide();

                                Swal.fire({
                                    title: '@lang('messages.alert.ingrese_codigo')',
                                    input: 'number',
                                    inputAttributes: {
                                        autocorrect: 'on',
                                        max: 6,
                                        maxlength: 6
                                    },
                                    showCancelButton: true,
                                    cancelButtonText: '@lang('messages.botton.cancelar')',
                                    confirmButtonText: '@lang('messages.botton.enviar')',
                                    showLoaderOnConfirm: true,
                                    inputValidator: (value) => {
                                        console.log(value.length);
                                        if (value === '') {
                                            return "@lang('messages.alert.campo_obligatorio')"
                                        } else if (value.length > 6) {
                                            return "@lang('messages.alert.campo_6_caracteres')"

                                        }
                                    },
                                    preConfirm: (login) => {
                                        $.ajax({
                                            url: '{{ route('verify_otp') }}',
                                            type: 'POST',
                                            dataType: "json",
                                            data: {
                                                "_token": "{{ csrf_token() }}",
                                                cod_update_email: login,
                                                email: $('#act-email')
                                                    .val(),
                                                action: "up",
                                            },
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                    .attr(
                                                        'content')
                                            },
                                            success: function(response) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: response
                                                        .msj,
                                                    allowOutsideClick: false,
                                                    confirmButtonColor: '#42ABE2',
                                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                                }).then((
                                                    result) => {
                                                    window
                                                        .location
                                                        .href =
                                                        "{{ route('Profile') }}";
                                                });
                                            },
                                            error: function(error) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: error
                                                        .responseJSON
                                                        .msj,
                                                    allowOutsideClick: false,
                                                    confirmButtonColor: '#42ABE2',
                                                    confirmButtonText: '@lang('messages.botton.aceptar')'
                                                })
                                            }
                                        });

                                    },
                                    allowOutsideClick: () => !Swal.isLoading()
                                });
                            },
                            error: function(error) {
                                $('#spinner').hide();
                                console.log(error.responseJSON.errors);

                            }
                        });
                        //end
                    }
                })
            }
        }

        $(document).ready(function() {
            var today = new Date();
            var day = today.getDate() > 9 ? today.getDate() : "0" + today
                .getDate();
            var month = (today.getMonth() + 1) > 9 ? (today.getMonth() + 1) : "0" + (today.getMonth() + 1);
            var year = today.getFullYear();

            $(".date-bd").attr('max', year + "-" + month + "-" + day);
        });

        const triggerExample = async (token) => {
            link = `${token}`;
            try {
                await navigator.clipboard.writeText(link);
                $("#icon-copy").css("background", "#04AA6D");
                setTimeout(function() {
                    $('#copied').hide();
                }, 2000);
                $("#copied").text('@lang('messages.alert.enlace_copiado')');

            } catch (err) {
                console.error('Failed to copy: ', err);
                $("#copied").text('@lang('messages.alert.error_copiar_enlace')');
            }
        }


        const refresh = () => {

            $('#specialty').val('').change();
            $('#specialty-div').show();
            $('#div-otros').hide();
            $('#specialty_new').val('')

        }

        const handleSpeciality = (e) => {

            if (e.target.value === "Otros") {
                $('#specialty-div').hide();
                $('#div-otros').show();
            }
        }
    </script>
@endpush
@section('content')
    <div id="spinner" style="display: none" class="spinner-md">
        <x-load-spinner show="true" />
    </div>
    <div class="container-fluid" style="padding: 0 3% 3%">
        <div class="accordion" id="accordion">
            {{-- datos del medico --}}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                    @if ($user->email_verified_at === null)
                        <div class="alert alert-warning" role="alert">
                            @lang('messages.label.verificar_correo')
                        </div>
                    @endif
                    @if ($user->digital_cello === null && Auth::user()->role == 'medico')
                        <div class="alert alert-warning" role="alert" id="div-seal-content">
                            @lang('messages.label.firma_digital')
                        </div>
                    @endif

                    <div class="accordion-item">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button bg-8" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-person"></i> @lang('messages.acordion.datos_personales')
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                            <div class="accordion-body" style="{{ Auth::user()->role == 'corporativo' ? 'padding: 0px 16px' : '' }}">
                                <form id="form-profile" method="post" action="/">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="rol" name="rol" value="{{ Auth::user()->role }}">
                                    <div class="row Form-edit-user">
                                        @if (Auth::user()->role == 'medico')
                                            {{-- rol medico --}}
                                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 col-xxl-2 ">
                                                <x-upload-image />
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-10">
                                                <div class="row">
                                                    {{-- nombre --}}
                                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control mask-text @error('name') is-invalid @enderror"
                                                                    id="name" name="name" type="text"
                                                                    value="{!! !empty($user) ? $user->name : '' !!}">
                                                                <i class="bi bi-person-circle st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- apellido --}}
                                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="last_name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.apellido')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control mask-text @error('last_name') is-invalid @enderror"
                                                                    id="last_name" name="last_name" type="text"
                                                                    value="{!! !empty($user) ? $user->last_name : '' !!}">
                                                                <i class="bi bi-person-circle st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- Doc. idetidad --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                @if (Auth::user()->contrie == '81')
                                                                    <label for="ci" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.CIE')</label>
                                                                @else
                                                                    <label for="ci" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.cedula_identidad')</label>
                                                                @endif
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control @error('ci') is-invalid @enderror"
                                                                    id="ci" name="ci" type="text"
                                                                    value="{!! !empty($user) ? $user->ci : '' !!}">
                                                                <i class="bi bi-person-vcard st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- fecha nacimiento --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <label for="birthdate" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.fecha_nacimiento')</label>
                                                            <input autocomplete="off" placeholder=""
                                                                class="form-control date-bd @error('birthdate') is-invalid @enderror"
                                                                id="birthdate" name="birthdate" type="date"
                                                                value="" onchange="calculateAge(event,'age')">
                                                        </div>
                                                    </div>
                                                    {{-- genero --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="genere" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.genero')</label>
                                                                <select name="genere" id="genere"
                                                                    placeholder="Seleccione"class="form-control @error('genere') is-invalid @enderror"
                                                                    class="form-control combo-textbox-input">
                                                                    <option value="">@lang('messages.placeholder.seleccione')</option>
                                                                    <option value="femenino">@lang('messages.select.Femenino')</option>
                                                                    <option value="masculino">@lang('messages.select.Masculino')</option>
                                                                </select>
                                                                <i class="bi bi-gender-ambiguous st-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--  correo --}}
                                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="username" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control @error('username') is-invalid @enderror"
                                                                    id="username" name="username" type="text"
                                                                    readonly value="{!! !empty($user) ? $user->email : '' !!}">
                                                                <i class="bi bi-envelope-at st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- telefono --}}
                                                    <div class="col-sm-6 col-md-6 col-lg-5 col-xl-4 col-xxl-4 mt-2">
                                                        <x-phone_component :phone="$user->phone" />
                                                        {{-- <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.telefono')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control phone @error('phone') is-invalid @enderror"
                                                                    id="phone" name="phone" type="text"
                                                                    value="{!! !empty($user) ? $user->phone : '' !!}">
                                                                <i class="bi bi-telephone-forward st-icon"></i>
                                                            </div>
                                                        </diV> --}}
                                                    </div>
                                                    {{-- especialidad --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2"
                                                        id="specialty-div">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="specialty" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.especialidad')</label>
                                                                <select onchange="handleSpeciality(event)"
                                                                    name="specialty" id="specialty"
                                                                    placeholder="Seleccione"class="form-control @error('specialty') is-invalid @enderror"
                                                                    class="form-control combo-textbox-input">
                                                                    <option value="">@lang('messages.placeholder.seleccione')</option>
                                                                    @foreach ($speciality as $item)
                                                                        <option value="{{ $item->description }}">
                                                                            {{ $item->description }}</option>
                                                                    @endforeach
                                                                    <option value='Otros'>@lang('messages.label.otros')</option>
                                                                </select>
                                                                <i class="bi bi-layers st-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2" id='div-otros' style="display: none">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="specialty" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">
                                                                    @lang('messages.label.nueva_especialidad')
                                                                </label>
                                                                <input autocomplete="off" class="form-control mask-text"
                                                                    id="specialty_new" name="specialty_new"
                                                                    type="text" value="">
                                                                <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    data-bs-custom-class="custom-tooltip" data-html="true"
                                                                    title="Refrescar"
                                                                    class="bi bi-arrow-clockwise st-icon"
                                                                    onclick="refresh();"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- mpps --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                @if (Auth::user()->contrie == '81')
                                                                    <label for="cod_mpps" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">@lang('messages.form.mpps_rp')</label>
                                                                @else
                                                                    <label for="cod_mpps" class="form-label"
                                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">@lang('messages.form.mpps')</label>
                                                                @endif
                                                                <input autocomplete="off" placeholder="MPPS"
                                                                    class="form-control mask-only-number @error('cod_mpps') is-invalid @enderror"
                                                                    id="cod_mpps" name="cod_mpps" type="text"
                                                                    value="{!! !empty($user) ? $user->cod_mpps : '' !!}">
                                                                <i class="bi bi-geo st-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->type_plane == '7')
                                                        {{-- piso --}}
                                                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="number_floor" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.piso_consultorio')</label>
                                                                    <input autocomplete="off"
                                                                        class="form-control mask-alfa-numeric @error('number_floor') is-invalid @enderror"
                                                                        id="number_floor" maxlength="10" name="number_floor"
                                                                        type="text" value="{!! !empty($user != null) ? $user->number_floor : '' !!}">
                                                                    <i class="bi bi-geo st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        {{-- consultorio --}}
                                                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="number_consulting_room" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.num_consultorio')</label>
                                                                    <input autocomplete="off" maxlength="10"
                                                                        class="form-control mask-alfa-numeric @error('number_consulting_room') is-invalid @enderror"
                                                                        id="number_consulting_room" name="number_consulting_room"
                                                                        type="text" value="{!! !empty($user != null) ? $user->number_consulting_room : '' !!}">
                                                                    <i class="bi bi-geo st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                        {{-- telefono --}}
                                                        <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 mt-2">
                                                            <div class="form-group">
                                                                <div class="Icon-inside">
                                                                    <label for="number_consulting_phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.num_tel_consultorio')</label>
                                                                    <input autocomplete="off"
                                                                        class="form-control phone @error('number_consulting_phone') is-invalid @enderror"
                                                                        id="number_consulting_phone"
                                                                        name="number_consulting_phone" type="text"
                                                                        value="{!! !empty($user != null) ? $user->number_consulting_phone : '' !!}">
                                                                    <i class="bi bi-geo st-icon"></i>
                                                                </div>
                                                            </diV>
                                                        </div>
                                                    @endif
                                                    {{-- ubicacion --}}
                                                    <x-ubigeo_contries class="{{ Auth::user()->role == 'medico' && Auth::user()->type_plane === '7' ? 'col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2' : 'col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2' }}  mt-2" />
                                                        <div class="col-sm-3 col-md-4 col-lg-3 col-xl-3 col-xxl-2 mb-btn {{ Auth::user()->role == 'corporativo' ? 'mb-btnSve' : '' }}" style="display: flex; align-items: flex-end;">
                                                            <input class="btn btnSave send" value="@lang('messages.botton.guardar')" type="submit" style="margin-bottom: 1px; width: 100%;" />
                                                        </div>
                                                </div>
                                                <div class="row">
                                                </div>

                                            </div>
                                            <input id="age" name="age" type="hidden" value="">
                                            {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="address" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.direccion')</label>
                                                        <textarea id="address" rows="1" name="address" class="form-control @error('address') is-invalid @enderror"
                                                            value="{!! !empty($user) ? $user->address : '' !!}"></textarea>
                                                        <i class="bi bi-geo st-icon"></i>
                                                    </div>
                                                </diV>
                                            </div> --}}
                                            {{-- <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="zip_code" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">@lang('messages.form.codigo_postal')</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-only-text @error('zip_code') is-invalid @enderror"
                                                            id="zip_code" name="zip_code" type="text"
                                                            value="{!! !empty($user) ? $user->zip_code : '' !!}">
                                                        <i class="bi bi-geo st-icon"></i>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 col-xxl-2">
                                                @php
                                                    $title = 'Cargar imagen';
                                                    if (Auth::user()->role == 'corporativo') {
                                                        $title = 'Cargar logo de empresa';
                                                    }
                                                @endphp
                                                <x-upload-image :title="$title" />
                                            </div>
                                            {{-- rol laboratorio --}}
                                            <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-10">
                                                <div class="row">
                                                    <input type="hidden" id="id" name="id" value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->id : '' !!}">
                                                    {{-- razon social --}}
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.razon_social')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control mask-text  @error('business_name') is-invalid @enderror"
                                                                    id="business_name" name="business_name"
                                                                    type="text" value="{!! !empty($user->get_laboratorio != null)
                                                                        ? ($user->role == 'corporativo'
                                                                            ? $user->get_laboratorio->business_name
                                                                            : $user->get_laboratorio->business_name)
                                                                        : '' !!}">
                                                                <i class="bi bi-person-vcard st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- tipo doc --}}
                                                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <label for="name" class="form-label"
                                                                style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">@lang('messages.form.tipo_documento')</label>
                                                            <select onchange="handlerTypeDoc(event)" name="type_rif"
                                                                id="type_rif" class="form-control">
                                                                <option value="">@lang('messages.placeholder.seleccione')</option>
                                                                <option value="F-">@lang('messages.select.firma_personal')</option>
                                                                <option value="J-">@lang('messages.select.juridico')</option>
                                                                <option value="C-">@lang('messages.select.comuna')</option>
                                                                <option value="G-">@lang('messages.select.gubernamental')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    {{-- rif --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nro_identificacion_rif')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control mask-rif @error('rif') is-invalid @enderror"
                                                                    id="rif" name="rif" type="text"
                                                                    maxlength="17" value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->rif : '' !!}">
                                                                <i class="bi bi-person-vcard st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- email --}}
                                                    <div class="col-sm-12 col-md-5 col-lg-5 col-xl-3 col-xxl-3 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    id="email" name="email" type="text" readonly
                                                                    value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->email : '' !!}">
                                                                <i class="bi bi-envelope-at st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- lic. Salud --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nro_licencia_salud')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control mask-only-text @error('license') is-invalid @enderror"
                                                                    id="license" name="license" type="text"
                                                                    value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->license : '' !!}">
                                                                <i class="bi bi-hash st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- telefono --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                        <x-phone_component :phone="$user->get_laboratorio->phone_1" />
                                                        {{-- <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.telefono')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control phone @error('phone') is-invalid @enderror"
                                                                    id="phone" name="phone" type="text"
                                                                    value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->phone_1 : '' !!}">
                                                                <i class="bi bi-telephone-forward st-icon"></i>
                                                            </div>
                                                        </diV> --}}
                                                    </div>
                                                    {{-- ubicacion --}}
                                                    <x-ubigeo class="col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 mt-2" />
                                                    {{-- tipo de empresa --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.tipo_empresa')</label>
                                                                <select name="type_laboratory" id="type_laboratory"
                                                                    class="form-control">
                                                                    <option value="">@lang('messages.placeholder.seleccione')</option>
                                                                    <option value="clinico">@lang('messages.select.lab_clinico')</option>
                                                                    <option value="investigacion">@lang('messages.select.lab_inves')</option>
                                                                    <option value="microbiológico">@lang('messages.select.lab_micro')</option>
                                                                    <option value="centro_clinico">@lang('messages.select.centro_clinico')</option>
                                                                    <option value="hospital">@lang('messages.select.hospital')</option>
                                                                    <option value="etc">@lang('messages.select.etc')</option>
                                                                </select>
                                                                <i class="bi bi-flag st-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- director --}}
                                                    <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.responsable_director')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control mask-only-text @error('responsible') is-invalid @enderror"
                                                                    id="responsible" name="responsible" type="text"
                                                                    value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->responsible : '' !!}">
                                                                <i class="bi bi-geo st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    {{-- sitio web --}}
                                                    <div class="col-sm-12 col-md-4 col-lg-2 col-xl-2 col-xxl-2 mt-2">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.web')</label>
                                                                <input autocomplete="off" placeholder=""
                                                                    class="form-control @error('website') is-invalid @enderror"
                                                                    id="website" name="website" type="text" style=""
                                                                    value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->website : '' !!}">
                                                                <i class="bi bi-globe2 st-icon"></i>
                                                            </div>
                                                            <small style="font-size: 12px" class="collapseBtn">https://www.sitioweb.com</small>
                                                        </diV>
                                                    </div>
                                                    {{-- direccion --}}
                                                    <div class="{{ Auth::user()->role == 'corporativo' ? 'col-sm-12 col-md-8 col-lg-4 col-xl-4 col-xxl-4 mt-2' : 'col-sm-12 col-md-12 col-lg-10 col-xl-10 col-xxl-10' }}">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.direccion')</label>
                                                                <textarea id="address" rows="1" id="address" name="address"
                                                                    class="form-control @error('address') is-invalid @enderror" value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->address : '' !!}"></textarea>
                                                                <i class="bi bi-geo st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-xxl-2 mb-btn {{ Auth::user()->role == 'corporativo' ? 'mb-btnSve' : '' }}" style="display: flex; align-items: flex-end;">
                                                        <input class="btn btnSave send" value="@lang('messages.botton.guardar')" type="submit" style="margin-bottom: 1px; width: 100%;" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div id="spinner" style="display: none">
                                                <x-load-spinner />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ((Auth::user()->role == 'medico' && Auth::user()->type_plane != '7'))
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3 mb-cd">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingCentros">
                                <button class="accordion-button bg-8" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCentros" aria-expanded="true" aria-controls="collapseCentros"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-hospital"></i> @lang('messages.modal.titulo.asociar_centro')
                                </button>
                            </span>
                            <div id="collapseCentros" class="accordion-collapse collapse"
                                aria-labelledby="headingCentros" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    @livewire('components.centers')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role == 'corporativo')
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item ">
                            <span class="accordion-header title" id="headingRegister">
                                <button class="accordion-button collapsed bg-8" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseRegister" aria-expanded="false" aria-controls="collapseRegister"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person st-icon"></i> @lang('messages.acordion.registar_medico')
                                </button>
                            </span>
                            <div id="collapseRegister" class="accordion-collapse collapse" aria-labelledby="headingRegister" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3 mb-btn mb-btnRtr" style="display: flex; justify-content: space-around; align-items: flex-end; margin-bottom: 1px;">
                                        <a id="Link-medicos" href="{{ Auth::user()->token_corporate }}"target="_blank" style="text-decoration: none;">
                                            <button type="button" class="btn btnPrimary" style="padding: 7px 20px">@lang('messages.botton.registrar_medico')</button>
                                        </a>
                                        <button type="button" id="icon-copy"
                                            class="btn btn-iSecond rounded-circle" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="@lang('messages.botton.copiar_enlace')"
                                            onclick="triggerExample('{{ Auth::user()->token_corporate }}');"
                                            style="margin-left: 5%;">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </button> <span style="padding-left: 5px" id="copied"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($user->email_verified_at !== null)
                {{-- actualizacion de correo Electronico --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 {{ Auth::user()->role === 'corporativo' ? 'mb-cd mb-2' : '' }}">
                        <div class="accordion-item ">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button collapsed bg-8" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-envelope-at st-icon"></i> @lang('messages.acordion.actualizacion_correo')
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 col-xxl-3" id="email-div">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label>
                                                <input autocomplete="off" class="form-control alpha-no-spaces" id="act-email" name="act-email" type="text" value="">
                                                <i class="bi bi-envelope-at st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2 justify-content-md-end">
                                        <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: flex-end; align-items: flex-end;">
                                            <input class="btn btnSave send " onclick="handlerEmial()" value="@lang('messages.botton.guardar')" type="submit" style="margin-left: 20px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role == 'medico')
                {{-- Registro de Secretaria --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingFour">
                                <button class="accordion-button collapsed bg-8" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> @lang('messages.acordion.registrar_secretaria')
                                </button>
                            </span>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                        <a id="Link-medicos" href="{{ auth()->user()->token_corporate }}"target="_blank" style="text-decoration: none;">
                                            <button type="button" class="btn btnPrimary" style="padding: 7px 20px">@lang('messages.botton.registrar_secretaria')</button>
                                        </a>
                                        <button type="button" id="icon-copy" class="btn btn-iSecond rounded-circle"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="@lang('messages.botton.copiar_enlace')"
                                            onclick="triggerExample('{{ Auth::user()->token_corporate }}');"
                                            style="margin-left: 5%;">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </button> <span style="padding-left: 5px" id="copied"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    {{-- firma Digital --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 {{ Auth::user()->role == 'medico' && Auth::user()->type_plane === '7' ? 'mb-cd mb-2' : '' }}">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingThree">
                                    <button class="accordion-button collapsed bg-8" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> @lang('messages.acordion.firma_sello_digital')
                                    </button>
                                </span>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <form id="form-seal" method="post" action="/">
                                            {{ csrf_field() }}
                                            <x-seal-component />
                                            <div class="row mt-2 justify-content-md-end">
                                                <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: flex-end; align-items: flex-end;">
                                                    <input class="btn btnSave send" value="@lang('messages.botton.guardar')" type="submit" style="margin-left: 20px" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            @endif
            {{-- @if ((Auth::user()->role == 'medico' && Auth::user()->type_plane != '7') || Auth::user()->role == 'laboratorio')
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3 mb-cd">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingPlanes">
                                <button class="accordion-button bg-8" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePlanes" aria-expanded="true" aria-controls="collapsePlanes"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-info-lg"></i> @lang('messages.acordion.informacion_plan')
                                </button>
                            </span>
                            <div id="collapsePlanes" class="accordion-collapse collapse show"
                                aria-labelledby="headingPlanes" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    @livewire('components.view-planes')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
        </div>
    </div>

@endsection
