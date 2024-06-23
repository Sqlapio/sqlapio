@extends('layouts.app-auth')
@section('title', 'Perfil')
@push('scripts')
    <script>
        $(document).ready(() => {

            let user = @json(auth()->user());


            $('#address').val(user.address).change();

            $('#genere').val(user.genere).change();

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });
            $('#form-secretary').validate({
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
                    },
                    genere: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    center_id: {
                        required: true,
                    },
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
                    address: {
                        required: "@lang('messages.alert.direccion_obligatoria')",
                    },
                    phone: {
                        required: "@lang('messages.alert.telefono_obligatorio')",
                    },
                    center_id: {
                        required: "@lang('messages.alert.telefono_obligatorio')",
                    }
                },


            });
            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^[0-9-]*$/;
                return pattern.test(value);
            }, "Campo numérico");

            //envio del formulario
            $("#form-secretary").submit(function(event) {
                event.preventDefault();
                $("#form-secretary").validate();
                if ($("#form-secretary").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    var data = $('#form-secretary').serialize();
                    $.ajax({
                        url: '{{ route('profile-secretary-update') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#secretary").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: '@lang('messages.alert.perfil_actualizado')',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: '@lang('messages.botton.aceptar')'
                            }).then((result) => {
                                window.location.href =
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
        });
    </script>
@endpush
@section('content')
    <div class="container-fluid body" style="padding: 0 3% 3%">
        <div class="accordion" id="accordion">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                    <div class="accordion-item ">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button bg-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-person"></i> @lang('messages.acordion.datos_personales')
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">

                                <form id="form-secretary" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="row Form-edit-user">


                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre')</label>
                                                    <input autocomplete="off" placeholder="" class="form-control mask-text"
                                                        id="name" name="name" type="text" {{-- value="{!! !empty($user) ? $user->name : '' !!}"> --}}
                                                        value="{{ Auth::user()->name }}">
                                                    <i class="bi bi-person-circle" style="top: 30px"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="last_name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.apellido')</label>
                                                    <input autocomplete="off" placeholder="" class="form-control mask-text"
                                                        id="last_name" name="last_name" type="text"
                                                        value="{{ Auth::user()->last_name }}">
                                                    <i class="bi bi-person-circle" style="top: 30px"></i>
                                                </div>
                                            </diV>
                                        </div>


                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    @if (Auth::user()->contrie == '81')
                                                        <label for="ci" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.CIE')</label>
                                                    @else
                                                        <label for="ci" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.cedula_identidad')</label>
                                                    @endif
                                                    <input autocomplete="off" placeholder="" type="number"
                                                        class="form-control" id="ci" name="ci" type="text"
                                                        value="{{ Auth::user()->ci }}">
                                                    <i class="bi bi-person-vcard" style="top: 30px"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="genere" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.genero')</label>
                                                    <select name="genere" id="genere"
                                                        placeholder="Seleccione"class="form-control"
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
                                                    <label for="center_id" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.label.centros_doctor')</label>
                                                    <select name="center_id" id="center_id"
                                                        placeholder="Seleccione"class="form-control"
                                                        class="form-control combo-textbox-input">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($centerDoctor as $item)
                                                            <option value="{{ $item->center_id }}">{{ $item->address }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <i class="bi bi-gender-ambiguous st-icon"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="username" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.email')</label>
                                                    <input autocomplete="off" placeholder="" class="form-control"
                                                        id="username" name="username" type="text" readonly
                                                        value="{{ Auth::user()->email }}">
                                                    <i class="bi bi-envelope-at" style="top: 30px"></i>
                                                </div>
                                            </diV>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <x-phone_component :phone="auth()->user()->phone" />
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.direccion')</label>
                                                    <textarea id="address" rows="3" name="address" class="form-control" value="{{ Auth::user()->address }}"></textarea>
                                                    <i class="bi bi-geo st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>


                                    </div>
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
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
