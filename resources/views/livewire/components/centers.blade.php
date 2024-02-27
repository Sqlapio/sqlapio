@extends('layouts.app-auth')
@section('title', 'Centros')
<style>
    .datepicker-switch {
        background-color: #44525F !important;
    }

    .check {
        display: flex;
        justify-content: center;
    }

    .table-check {
        width: 50px;
        height: 50px;
        text-align: center;
        vertical-align: middle;
    }

    .w-5 {
        width: 5% !important;
    }

    .w-30 {
        width: 30% !important;
    }

    .w-45 {
        width: 45% !important;
    }

    .w-10 {
        width: 10% !important;
    }

    form {
        margin-block-end: 0;
    }
</style>
@push('scripts')
    @vite(['resources/js/centers.js'])
    <script>
        let user = @json(Auth::user());
        $(document).ready(() => {
            if (user.status_register === '1') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debe completar su registro inicial!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    window.location.href = "{{ route('Profile') }}";
                });
            }
            $('#form-centers').validate({
                rules: {
                    address: {
                        required: true,
                        minlength: 3,
                    },
                    number_floor: {
                        required: true,
                    },
                    number_consulting_room: {
                        required: true,
                    },
                    center_id: {
                        required: true,
                    }
                },
                messages: {
                    center_id: {
                        required: 'Centro es obligatorio',
                    },
                    address: {
                        required: "Dirección es obligatorio",
                        minlength: "Dirección debe ser mayor a 3 caracteres",
                    },
                    number_floor: {
                        required: "Número de piso es obligatorio",
                    },

                    number_consulting_room: {
                        required: "Número del consultorio es obligatorio",
                    }
                }
            });

            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo numérico");

            //envio del formulario
            $("#form-centers").submit(function(event) {
                event.preventDefault();
                $("#form-centers").validate();
                if ($("#form-centers").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    var data = $('#form-centers').serialize();
                    $.ajax({
                        url: '{{ route('register-centers') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // let route = "{{ route('ClinicalHistoryDetail', ':id') }}";
                            // route = route.replace(':id', response.id);
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-centers").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: 'Centro registrado exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                $('#modalCenter').modal('toggle');
                                refreshTable();
                            });
                        },
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Click para salir'
                                }).then((result) => {
                                    $('#send').show();
                                    $('#spinner').hide();
                                });
                            });
                        }
                    });
                }
            });

            ///formulario de nuevos centros
            $('#form-create-new-center').validate({
                rules: {
                    address: {
                        required: true,
                        minlength: 3,
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
                    full_name: {
                        required: true,
                    },
                    number_floor_new: {
                        required: true,
                    },
                    number_consulting_room_new: {
                        required: true,
                    },
                },
                messages: {
                    contrie: {
                        required: 'País es obligatorio',
                    },
                    address: {
                        required: "Dirección es obligatorio",
                        minlength: "Dirección debe ser mayor a 3 caracteres",
                    },
                    state_contrie: {
                        required: "Estado es obligatorio",
                    },
                    city_contrie: {
                        required: "Ciudad es obligatorio",
                    },
                    full_name: {
                        required: "Nombre del centro es obligatorio",
                    },
                    number_floor_new: {
                        required: "Número de piso es obligatorio",
                    },
                    number_consulting_room_new: {
                        required: "Número del consultorio es obligatorio",
                    }
                }
            });

            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo numérico");

            $("#form-create-new-center").submit(function(event) {
                event.preventDefault();
                $("#form-create-new-center").validate();
                if ($("#form-create-new-center").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    var data = $('#form-create-new-center').serialize();
                    $.ajax({
                        url: '{{ route('register-new-centers') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-create-new-center").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: 'Centro registrado exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                window.location = '{{ route('Centers') }}'
                            });
                        },
                        error: function(error) {
                            error.responseJSON.errors.map((elm) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: elm,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#42ABE2',
                                    confirmButtonText: 'Click para salir'
                                }).then((result) => {
                                    $('#send').show();
                                    $('#spinner').hide();
                                });
                            });
                        }
                    });
                }
            })
        });

        function showModal() {
            $('#modalCenter').modal('show');
        }

        function handlerCenter(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Está seguro que desea habilitar este centro?',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    handlerStatus("{{ route('center_enabled', ':id') }}", e.target.value);
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Está seguro que desea deshabilitar este centro?',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    handlerStatus("{{ route('center_disabled', ':id') }}", e.target.value);
                });
            }
        }

        function refreshTable() {
            // ajax para refrezcar la tabla
            $.ajax({
                url: '{{ route('get_doctor_centers') }}',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $(
                        'meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(res) {
                    let data = [];
                    let checked = ''
                    res.map((elem) => {
                        if (elem.status ==
                            "1") {
                            checked = "checked";

                        } else {
                            checked = '';
                        }
                        elem.btn =
                            ` <div class="form-check form-switch">
                                <input onchange="handlerCenter(event);" style="width: 5em" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" value="${elem.id}" ${checked}>
                            </div>`;

                        data.push(elem);
                    });
                    new DataTable('#table-centers', {
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                        },
                        reponsive: true,
                        bDestroy: true,
                        data: data,
                        "searching": false,
                        "bLengthChange": false,
                        columns: [{
                                data: 'center',
                                title: 'Centro de Salud',
                                className: "text-center",
                            },
                            {
                                data: 'address',
                                title: 'Dirección',
                                className: "text-center w-50",
                            },
                            {
                                data: 'number_floor',
                                title: 'Piso',
                                className: "text-center w-5",
                            },
                            {
                                data: 'number_consulting_room',
                                title: 'Consultorio',
                                className: "text-center w-5",
                            },

                            {
                                data: 'phone_consulting_room',
                                title: 'Teléfono',
                                className: "text-center w-10",
                            },
                            {
                                data: 'btn',
                                title: 'Estatus',
                                className: "text-center table-check w-5",
                            }
                        ],
                    });
                }
            });

        }

        function handlerStatus(route, id) {
            route = route.replace(':id', id);
            $.ajax({
                url: route,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $(
                        'meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(res) {
                    refreshTable();
                }
            });

        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid" style="padding: 0 3% 3%">
            <div class="row mt-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd">
                    <div class="accordion" id="accordion">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-4" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseDos" aria-expanded="true" aria-controls="collapseDos"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-hospital"></i> @lang('messages.acordion.nuevo_centro')
                                </button>
                            </span>
                            <div id="collapseDos" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <form id="form-create-new-center" method="post" action="">
                                        {{ csrf_field() }}

                                        <div class="row mt-2">

                                            <x-ubigeo_contries class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" />

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre_centro')</label>
                                                        <input autocomplete="off" class="mask-alfa-numeric form-control"
                                                            id="full_name" name="full_name" type="text" value=""
                                                            maxlength="100">
                                                        <i class="bi bi-hash" style="top: 30px"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="name" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.direccion')</label>
                                                        <textarea id="address" rows="2" name="address" class="form-control"></textarea>
                                                        <i class="bi bi-geo" style="top: 30px"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="number_floor_new" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.piso')</label>
                                                        <input autocomplete="off" class="mask-alfa-numeric form-control"
                                                            id="number_floor_new" name="number_floor_new" type="text"
                                                            value="" maxlength="2">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="number_consulting_room_new" class="form-label"
                                                            style="font-size: 12px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.consultorio')</label>
                                                        <input autocomplete="off" class="form-control mask-alfa-numeric"
                                                            id="number_consulting_room_new"
                                                            name="number_consulting_room_new" type="text" value=""
                                                            maxlength="5">
                                                        <i class="bi bi-hash st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone_consulting_room_new" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.telefono_consultorio')</label>
                                                        <input autocomplete="off" class="form-control phone"
                                                            id="phone_consulting_room_new" name="phone_consulting_room_new"
                                                            type="text" value="">
                                                        <i class="bi bi-telephone-forward st-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row text-center">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <input class="btn btnSave send mt-3" value="@lang('messages.botton.guardar')"
                                                    type="submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: flex-end;">
                    <h5 class="text-capitalize">Dr. {{ Auth::user()->name }} {{ Auth::user()->last_name }}</h5>
                </div> --}}
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="accordion" id="accordion">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-4" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-hospital"></i> @lang('messages.acordion.centros')
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row mt-2">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8"
                                            style="font-size:10px;">
                                            <button type="button" id="btnShow" class="btn btnPrimary"
                                                onclick="showModal()">@lang('messages.botton.asociar_centro')</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive" id="table-patients"
                                        style="margin-top: 20px; width: 100%;">
                                        <table id="table-centers" class="table table-striped table-bordered" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center w-30">@lang('messages.tabla.centro_salud')</th>
                                                    <th class="text-center w-45" data-orderable="false">@lang('messages.tabla.direccion')
                                                    </th>
                                                    <th class="text-center w-5" data-orderable="false">@lang('messages.tabla.piso')
                                                    </th>
                                                    <th class="text-center w-5" data-orderable="false">@lang('messages.tabla.consultorio')
                                                    </th>
                                                    <th class="text-center w-10" data-orderable="false">@lang('messages.tabla.telefono')
                                                    </th>
                                                    <th class="text-center w-5" data-orderable="false">@lang('messages.tabla.estatus')
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($doctor_centers as $key => $item)
                                                    <tr>
                                                        <td class="text-center pt-2">{{ $item['center'] }}</td>
                                                        <td class="text-center">{{ $item['address'] }}</td>
                                                        <td class="text-center">{{ $item['number_floor'] }}</td>
                                                        <td class="text-center">{{ $item['number_consulting_room'] }}</td>
                                                        <td class="text-center">{{ $item['phone_consulting_room'] }}</td>
                                                        <td class="text-center table-check ">
                                                            <div class="form-check form-switch ">
                                                                <input onchange="handlerCenter(event);" style="width: 5em"
                                                                    class="form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckChecked"
                                                                    value="{{ $item['id'] }}"
                                                                    {{ $item['status'] != '1' ? '' : 'checked' }}>
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

        <!-- Modal -->
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-labelledby="modalCenterLabel" aria-hidden="true">
            <div id="spinner" style="display: none">
                <x-load-spinner show="true" />
            </div>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header title">
                            <i class="bi bi-hospital"></i>
                            <span style="padding-left: 5px">@lang('messages.modal.titulo.asociar_centro')</span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="font-size: 12px;"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-centers" method="post" action="/">
                                {{ csrf_field() }}
                                <div class="row">
                                    @if (Auth::user()->status_register != 1)
                                        <x-centers_doctors class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" />
                                    @endif
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.direccion')</label>
                                                <textarea id="address" rows="2" name="address" class="form-control"></textarea>
                                                <i class="bi bi-geo st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.piso')</label>
                                                <input autocomplete="off" class="mask-alfa-numeric form-control"
                                                    id="number_floor" name="number_floor" type="text" value=""
                                                    maxlength="2">
                                                <i class="bi bi-hash st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 12px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.consultorio')</label>
                                                <input autocomplete="off" class="form-control mask-alfa-numeric"
                                                    id="number_consulting_room" name="number_consulting_room"
                                                    type="text" value="" maxlength="5">
                                                <i class="bi bi-hash st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.telefono_consultorio')</label>
                                                <input autocomplete="off" class="form-control phone"
                                                    id="phone_consulting_room" name="phone_consulting_room"
                                                    type="text" value="">
                                                <i class="bi bi-telephone-forward st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <input class="btn btnSave send mt-3" value="@lang('messages.botton.asociar')" type="submit" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
