@extends('layouts.app-auth')
@section('title', 'Perfil')
<style>
    .sel {
        margin-top: -10px !important;
    }

    .collapseBtn {
        color: #428bca;
    }
</style>
@push('scripts')
    <script>
        let link = ''
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
                    state: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    zip_code: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    cod_mpps: {
                        required: true,
                    },
                    specialty: {
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
                    state: {
                        required: "Estado es obligatoria",
                    },
                    city: {
                        required: "Ciudad es obligatoria",
                    },
                    address: {
                        required: "Dirección es obligatoria",
                    },
                    zip_code: {
                        required: "Código de area es obligatorio",
                    },
                    phone: {
                        required: "Teléfono de area es obligatorio",
                    },
                    business_name: {
                        required: "Nombre del laboratorio es obligatorio",
                    },
                    rif: {
                        required: "Rif es obligatorio",
                    },
                    type_laboratory: {
                        required: "Tipo de laboratorio es obligatorio",
                    },
                    responsible: {
                        required: "Responsable es obligatorio",
                    },
                    license: {
                        required: "Número de lincencia es obligatorio",
                    },
                    website: {
                        url: "Debe colocar una url valida"
                    },
                    cod_mpps: {
                        required: "MPPS es obligatorio"
                    },
                    specialty: {
                        required: "Especialidad es obligatoria"
                    }
                },


            });
            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
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
                        required: "campo es obligatorio",
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
                $('#state').val(user.state).change();
                $('#city').val(user.city).change();
                $('#address').val(user.address).change();
                $('#genere').val(user.genere).change();
                $('#specialty').val(user.specialty).change();
                if (seal_img != null) {
                    $(".holder_seal").show();
                    let ulr_seal_img = `{{ URL::asset('/imgs/seal/${seal_img}') }}`;
                    $(".holder_seal").find('#seal_img_preview').attr('src', ulr_seal_img);
                    $(".seal_img").val(seal_img);
                }



            } else {

                $("#business_name").rules('add', {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                });

                $("#rif").rules('add', {
                    required: true,
                    minlength: 5,
                    maxlength: 17,
                    // onlyNumber: true
                });

                $("#license").rules('add', {
                    required: true,
                    minlength: 5,
                    maxlength: 8,
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
                    $('#type_laboratory').val(user.get_laboratorio.type_laboratory).change();
                    $('#type_rif').val(user.get_laboratorio.rif[0] + "-").change();
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
                                title: 'Perfil actualizado exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                window.location.href =(user.role =="corporativo")? "{{ route('Dashboard') }}": "{{ route('DashboardComponent') }}";
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
                                    confirmButtonText: 'Aceptar'
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
                                title: 'Operacion exitosa!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
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
                    title: 'Esta seguro de realizar esta acción?',
                    text: "Se enviara un código de verifcación al correo ingresado!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#42ABE2',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {

                    $('#spinner').show();

                    if (result.isConfirmed) {
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
                                    title: 'Ingrese el código',
                                    input: 'number',
                                    inputAttributes: {
                                        autocorrect: 'on',
                                        max: 6,
                                        maxlength: 6
                                    },
                                    showCancelButton: true,
                                    confirmButtonText: 'Enviar',
                                    showLoaderOnConfirm: true,
                                    inputValidator: (value) => {
                                        console.log(value.length);
                                        if (value === '') {
                                            return "Campo obligatorio"
                                        } else if (value.length > 6) {
                                            return "Campo debe ser de 6 caracteres"

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
                                                email: $('#act-email').val(),
                                                action: "up",
                                            },
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                        'meta[name="csrf-token"]')
                                                    .attr(
                                                        'content')
                                            },
                                            success: function(response) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: response.msj,
                                                    allowOutsideClick: false,
                                                    confirmButtonColor: '#42ABE2',
                                                    confirmButtonText: 'Aceptar'
                                                }).then((result) => {
                                                    window.location
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
                                                    confirmButtonText: 'Aceptar'
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
                $("#icon-copy").css("color", "#04AA6D");

            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }
    </script>
@endpush
@section('content')
    <div class="container-fluid" style="padding: 0 3% 3%">
        <div class="accordion" id="accordion">

            {{-- datos del paciente --}}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                    @if ($user->email_verified_at === null)
                        <div class="alert alert-warning" role="alert">
                            Debe verificar su correo!
                        </div>
                    @endif
                    @if ($user->digital_cello === null && Auth::user()->role == 'medico')
                        <div class="alert alert-warning" role="alert" id="div-seal-content">
                            Debe cargar su sello digital!
                        </div>
                    @endif

                    <div class="accordion-item">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button bg-8" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-person"></i> Datos personales
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <form id="form-profile" method="post" action="/">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="rol" name="rol" value="{{ Auth::user()->role }}">
                                    <div class="row Form-edit-user">
                                        @if (Auth::user()->role == 'medico')
                                            {{-- rol medico --}}
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-text @error('name') is-invalid @enderror"
                                                            id="name" name="name" type="text"
                                                            value="{!! !empty($user) ? $user->name : '' !!}">
                                                        <i class="bi bi-person-circle" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="last_name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-text @error('last_name') is-invalid @enderror"
                                                            id="last_name" name="last_name" type="text"
                                                            value="{!! !empty($user) ? $user->last_name : '' !!}">
                                                        <i class="bi bi-person-circle" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="ci" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Cédula
                                                            de identidad</label>
                                                        <input autocomplete="off" placeholder="" type="number"
                                                            class="form-control @error('ci') is-invalid @enderror"
                                                            id="ci" name="ci" type="text"
                                                            value="{!! !empty($user) ? $user->ci : '' !!}">
                                                        <i class="bi bi-person-vcard" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <label for="birthdate" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha
                                                        de Nacimiento</label>
                                                    <input autocomplete="off" placeholder=""
                                                        class="form-control date-bd @error('birthdate') is-invalid @enderror"
                                                        id="birthdate" name="birthdate" type="date" value=""
                                                        onchange="calculateAge(event,'age')">
                                                </div>
                                            </div>
                                            <input id="age" name="age" type="hidden" value="">

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="genere" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Género</label>
                                                        <select name="genere" id="genere"
                                                            placeholder="Seleccione"class="form-control @error('genere') is-invalid @enderror"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">Seleccione</option>
                                                            <option value="femenino"> Femenino</option>
                                                            <option value="masculino">Masculino</option>
                                                        </select>
                                                        <i class="bi bi-gender-ambiguous st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="username" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                            electrónico</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            id="username" name="username" type="text" readonly
                                                            value="{!! !empty($user) ? $user->email : '' !!}">
                                                        <i class="bi bi-envelope-at" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Teléfono</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control phone @error('phone') is-invalid @enderror"
                                                            id="phone" name="phone" type="text"
                                                            value="{!! !empty($user) ? $user->phone : '' !!}">
                                                        <i class="bi bi-telephone-forward" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="specialty" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Especialidad</label>
                                                        <select name="specialty" id="specialty"
                                                            placeholder="Seleccione"class="form-control @error('specialty') is-invalid @enderror"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($speciality as $item)
                                                                <option value="{{ $item->description }}">
                                                                    {{ $item->description }}</option>
                                                            @endforeach

                                                        </select>
                                                        <i class="bi bi-layers st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Dirección</label>
                                                        <textarea id="address" rows="3" id="address" name="address"
                                                            class="form-control @error('address') is-invalid @enderror" value="{!! !empty($user) ? $user->address : '' !!}"></textarea>
                                                        <i class="bi bi-geo st-icon"></i>
                                                    </div>

                                                </diV>
                                            </div>

                                            <x-ubigeo class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3" />

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="zip_code" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">Código
                                                            Postal</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-only-text @error('zip_code') is-invalid @enderror"
                                                            id="zip_code" name="zip_code" type="text"
                                                            value="{!! !empty($user) ? $user->zip_code : '' !!}">
                                                        <i class="bi bi-geo" style="top: 30px"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="cod_mpps" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">MPPS</label>
                                                        <input autocomplete="off" placeholder="MPPS"
                                                            class="form-control mask-only-number @error('cod_mpps') is-invalid @enderror"
                                                            id="cod_mpps" name="cod_mpps" type="text"
                                                            value="{!! !empty($user) ? $user->cod_mpps : '' !!}">
                                                        <i class="bi bi-geo" style="top: 30px"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-upload-image />
                                        @else
                                            @if (Auth::user()->role == 'corporativo')
                                                <div class="row">
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                                        <small id=""><a id="Link-medicos"
                                                                href="{{ Auth::user()->token_corporate }}"
                                                                target="_blank">Asociación de medicos</a></small>
                                                    </div>
                                                    <div style="margin-left: -17%;"
                                                        class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4  mt-2">
                                                        <i id="icon-copy" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="Copiar enlace"
                                                            onclick="triggerExample('{{ Auth::user()->token_corporate }}');"
                                                            class="bi bi-clipboard2-plus"></i>
                                                    </div>
                                                </div>
                                            @endif


                                            {{-- rol laboratorio --}}
                                            <input type="hidden" id="id" name="id"
                                                value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->id : '' !!}">
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Razon
                                                            social</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-text  @error('business_name') is-invalid @enderror"
                                                            id="business_name" name="business_name" type="text"
                                                            value="{!! !empty($user->get_laboratorio != null)
                                                                ? ($user->role == 'corporativo'
                                                                    ? $user->get_center->description
                                                                    : $user->get_laboratorio->business_name)
                                                                : '' !!}">
                                                        <i class="bi bi-person-vcard" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 mt-3">
                                                <div class="form-group">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 2px">Tipo
                                                        de documento</label>
                                                    <select onchange="handlerTypeDoc(event)" name="type_rif"
                                                        id="type_rif" class="form-control">
                                                        <option value="">Seleccione</option>
                                                        <option value="F-">Firma personal</option>
                                                        <option value="J-">Jurídico</option>
                                                        <option value="C-">Comuna</option>
                                                        <option value="G-">Gubernamental</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                            de Identificación o RIF</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-rif @error('rif') is-invalid @enderror"
                                                            id="rif" name="rif" type="text" maxlength="17"
                                                            value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->rif : '' !!}">
                                                        <i class="bi bi-person-vcard" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                            electrónico</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email" type="text" readonly
                                                            value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->email : '' !!}">
                                                        <i class="bi bi-envelope-at" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                            de Licencia salud</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-only-text @error('license') is-invalid @enderror"
                                                            id="license" name="license" type="text"
                                                            value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->license : '' !!}">
                                                        <i class="bi bi-hash" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Teléfono</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control phone @error('phone') is-invalid @enderror"
                                                            id="phone" name="phone" type="text"
                                                            value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->phone_1 : '' !!}">
                                                        <i class="bi bi-telephone-forward" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <x-ubigeo class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3" />

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Dirección</label>
                                                        <textarea id="address" rows="2" id="address" name="address"
                                                            class="form-control @error('address') is-invalid @enderror" value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->address : '' !!}"></textarea>
                                                        <i class="bi bi-geo" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Tipo
                                                            de empresa</label>
                                                        <select name="type_laboratory" id="type_laboratory"
                                                            class="form-control">
                                                            <option value="">Seleccione</option>
                                                            <option value="clinico">Laboratorio clínico</option>
                                                            <option value="investigacion">Laboratorio investigación
                                                            </option>
                                                            <option value="microbiológico">Laboratorio microbiológico
                                                            <option value="centro_clinico">Centro clinico</option>
                                                            <option value="hospital">Hospital</option>
                                                            <option value="etc">etc</option>
                                                        </select>
                                                        <i class="bi bi-flag" style="top: 30px"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Responsable
                                                            o Director</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control mask-only-text @error('responsible') is-invalid @enderror"
                                                            id="responsible" name="responsible" type="text"
                                                            value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->responsible : '' !!}">
                                                        <i class="bi bi-geo" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div>

                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Sitio
                                                            web</label>
                                                        <input autocomplete="off" placeholder=""
                                                            class="form-control @error('website') is-invalid @enderror"
                                                            id="website" name="website" type="text"
                                                            value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->website : '' !!}">
                                                        <i class="bi bi-globe2" style="top: 30px"></i>
                                                    </div>
                                                    <small style="font-size: 12px"
                                                        class="collapseBtn">https://www.sitioweb.com</small>
                                                </diV>
                                            </div>

                                            {{-- <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Descripción</label>
                                                        <input autocomplete="off" placeholder="Descripción"
                                                            class="form-control mask-only-text @error('description') is-invalid @enderror"
                                                            id="description" name="description" type="text"
                                                            value="{!! !empty($user->get_laboratorio != null) ? $user->get_laboratorio->description : '' !!}">
                                                        <i class="bi bi-geo" style="top: 30px"></i>
                                                    </div>
                                                </diV>
                                            </div> --}}
                                            @php
                                                $title = 'Cargar imagen';
                                                if (Auth::user()->role == 'corporativo') {
                                                    $title = 'Cargar logo de empresa';
                                                }
                                            @endphp

                                            <x-upload-image :title="$title" />
                                        @endif
                                        <div class="row mt-3 justify-content-md-end">
                                            <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                style="display: flex; justify-content: flex-end; align-items: flex-end;">
                                                <input class="btn btnSave send " value="Guardar" type="submit"
                                                    style="margin-left: 20px" />
                                                {{-- <button type="button" class="btn btnSecond btn6"
                                                    style="margin-left: 20px">Cancelar</button> --}}
                                            </div>
                                            <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div id="spinner" style="display: none">
                                                    <x-load-spinner />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($user->email_verified_at !== null)
                {{-- actualizacion de correo Electronico --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item ">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button collapsed bg-8" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-envelope-at st-icon"></i> Actualización de Correo Electrónico
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3" id="email-div">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="phone" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nuevo
                                                    Correo
                                                    Electrónico</label>
                                                <input autocomplete="off" class="form-control alpha-no-spaces"
                                                    id="act-email" name="act-email" type="text" value="">
                                                <i class="bi bi-envelope-at st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 justify-content-md-end">
                                        <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                            style="display: flex; justify-content: flex-end; align-items: flex-end;">
                                            <input class="btn btnSave send " onclick="handlerEmial()" value="Guardar"
                                                type="submit" style="margin-left: 20px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @if (Auth::user()->role == 'medico')
                    {{-- firma Digital --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px; ">
                            <div class="accordion-item">
                                <span class="accordion-header title" id="headingThree">
                                    <button class="accordion-button collapsed bg-8" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-file-earmark-text"></i> Sello Digital
                                    </button>
                                </span>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <form id="form-seal" method="post" action="/">
                                            {{ csrf_field() }}
                                            <x-seal-component />
                                            <div class="row mt-3 justify-content-md-end">
                                                <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                    style="display: flex; justify-content: flex-end; align-items: flex-end;">
                                                    <input class="btn btnSave send" value="Guardar" type="submit"
                                                        style="margin-left: 20px" />
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
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3 mb-cd" style="margin-top: 20px;">
                    <div class="accordion-item">
                        <span class="accordion-header title" id="headingPlanes">
                            <button class="accordion-button bg-8" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePlanes" aria-expanded="true" aria-controls="collapsePlanes"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-info-lg"></i> Información del plan
                            </button>
                        </span>
                        <div id="collapsePlanes" class="accordion-collapse collapse show" aria-labelledby="headingPlanes"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <x-view-planes />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
