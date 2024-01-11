<style>
    .sel {
        margin-top: -10px !important;
    }

    .collapseBtn {
        color: #428bca;
    }
</style>
<script>
    $(document).ready(() => {

        let user = @json(Auth::user());

        $('#state').val(user.state).change();
        $('#genere').val(user.genere).change();

        $('#form-profile-force-sale').validate({
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
                state: {
                    required: true,
                },
                address: {
                    required: true,
                },
                phone: {
                    required: true,
                },

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
                state: {
                    required: "Estado es obligatoria",
                },

                phone: {
                    required: "Teléfono de area es obligatorio",
                },
                address:{
                    required: "Dirección es obligatoria",
                }
            },


        });
        $.validator.addMethod("onlyNumber", function(value, element) {
            var pattern = /^\d+\.?\d*$/;
            return pattern.test(value);
        }, "Campo numérico");

        //envio del formulario
        $("#form-profile-force-sale").submit(function(event) {
            event.preventDefault();
            $("#form-profile-force-sale").validate();
            if ($("#form-profile-force-sale").valid()) {
                $('#send').hide();
                $('#spinner').show();
                var data = $('#form-profile-force-sale').serialize();
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
                        $("#form-profile-force-sale").trigger("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Perfil actualizado exitosamente!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            window.location.href = (user.role == "gerente_general") ?
                                "{{ route('dashboard-general-manager') }}" :
                                "{{ route('dashboard-general-zone') }}";
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
    });
</script>
@php
    use App\Models\State;
    $states = State::all();
@endphp
<div>
    <form id="form-profile-force-sale" method="post" action="">
        {{ csrf_field() }}
        <div class="row Form-edit-user">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                <div class="form-group">
                    <div class="Icon-inside">
                        <label for="name" class="form-label"
                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                        <input autocomplete="off" placeholder="" class="form-control mask-text" id="name"
                            name="name" type="text" {{-- value="{!! !empty($user) ? $user->name : '' !!}"> --}} value="{{ Auth::user()->name }}">

                        <i class="bi bi-person-circle" style="top: 30px"></i>
                    </div>
                </diV>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                <div class="form-group">
                    <div class="Icon-inside">
                        <label for="last_name" class="form-label"
                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                        <input autocomplete="off" placeholder="" class="form-control mask-text" id="last_name"
                            name="last_name" type="text" value="{{ Auth::user()->last_name }}">
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
                        <input autocomplete="off" placeholder="" type="number" class="form-control" id="ci"
                            name="ci" type="text" value="{{ Auth::user()->ci }}">
                        <i class="bi bi-person-vcard" style="top: 30px"></i>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                <div class="form-group">
                    <div class="Icon-inside">
                        <label for="genere" class="form-label"
                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Género</label>
                        <select name="genere" id="genere" placeholder="Seleccione"class="form-control"
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
                        <input autocomplete="off" placeholder="" class="form-control" id="username" name="username"
                            type="text" readonly value="{{ Auth::user()->email }}">
                        <i class="bi bi-envelope-at" style="top: 30px"></i>
                    </div>
                </diV>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                <div class="form-group">
                    <div class="Icon-inside">
                        <label for="state" class="form-label" style="font-size: 13px; margin-bottom: 7px">Seleccione
                            el
                            estado</label>
                        <select name="state" id="state" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach ($states as $item)
                                <option value={{ $item->id }}>{{ $item->description }}
                                </option>
                            @endforeach
                        </select>
                        <i class="bi bi-flag" style="top: 30px"></i>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                <div class="form-group">
                    <div class="Icon-inside">
                        <label for="phone" class="form-label"
                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Teléfono</label>
                        <input autocomplete="off" placeholder="" class="form-control phone" id="phone"
                            name="phone" type="text" value="{{ Auth::user()->phone }}">
                        <i class="bi bi-telephone-forward" style="top: 30px"></i>
                    </div>
                </diV>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                <div class="form-group">
                    <div class="Icon-inside">
                        <label for="phone" class="form-label"
                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Dirección</label>
                        <textarea id="address" rows="3" name="address" class="form-control" value="{!! !empty($user) ? $user->address : '' !!}"></textarea>
                        <i class="bi bi-geo st-icon"></i>
                    </div>
                </diV>
            </div>


        </div>
        <div class="row mt-3 justify-content-md-end">
            <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                style="display: flex; justify-content: flex-end; align-items: flex-end;">
                <input class="btn btnSave send " value="Guardar" type="submit" style="margin-left: 20px" />
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
