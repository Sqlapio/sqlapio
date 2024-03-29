@extends('layouts.app-auth')
@section('title', 'Gestión de Medicos')
<style>
    .form-switch .form-check-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e") !important;
        background-color: #d70c0cb5 !important;
        border-color: #d70c0cb5 !important;
    }
    
    .form-switch .form-check-input:checked {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .form-check-input:checked {
        background-color: #42abe2 !important;
        border-color: #42abe2 !important;
        transform: scale(0.6);
    }

    .table-check {
        text-align: center; 
        vertical-align: middle;
        height: 50px; 
        width: 50px;
    }

    .w-5 {
        width: 5%
    }

</style>
@push('scripts')
    <script>
        const handlerDoctor = async (e) => {
            if ($(`#${e.target.id}`).is(':checked')) {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Está seguro que desea habilitar este medico?',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    handlerStatus("{{ route('enabled-doctor', ':id') }}", e.target.value);
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Está seguro que desea deshabilitar este medico?',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    handlerStatus("{{ route('disabled-doctor', ':id') }}", e.target.value);
                });
            }

        }

        const handlerStatus = async (route, id) => {
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

                    Swal.fire({
                        icon: 'success',
                        title: 'Operacion Exitosa',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        refreshTable(res);
                    });

                }
            });
        }

        function refreshTable(res) {

            let data = [];
            let checked = ''
            let classC = ''

            res.map((elem) => {
                if (elem.tipo_status ==
                    "1") {
                    checked = "checked";
                    classC = "form-check-input"

                } else {
                    checked = '';
                    classC = "form-check-input ci"
                }
                elem.btn =
                    `<div class="form-check form-switch" style="display: flex; justify-content: center;">
                        <input onchange="handlerDoctor(event);" style="width: 5em"
                            class="${classC}" type="checkbox" role="switch"
                            id="flexSwitchCheckChecked" value="${elem.id}"
                        ${checked}>
                    </div>`;

                data.push(elem);

                elem.name = `${elem.name} ${elem.last_name}`
            });
            new DataTable('#table-patients-corp', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                },
                reponsive: true,
                bDestroy: true,
                data: data,
                "searching": false,
                "bLengthChange": false,
                columns: [{
                        data: 'name',
                        title: 'Nombre y Apellido',
                        className: "text-center text-capitalize",
                    },
                    {
                        data: 'ci',
                        title: 'Número de Cédula',
                        className: "text-center",
                    },
                    {
                        data: 'email',
                        title: 'Correo',
                        className: "text-center",
                    },
                    {
                        data: 'specialty',
                        title: 'Especialidad',
                        className: "text-center",
                    },

                    {
                        data: 'phone',
                        title: 'Teléfono del consultorio',
                        className: "text-center",
                    },
                    {
                        data: 'btn',
                        title: 'Habilitar/Desahabilitar',
                        className: "text-center table-check w-5",
                    }
                ],
            });


        }
    </script>
@endpush
@section('content')
    <div class="container-fluid" style="padding: 0 3% 3%">
        <div class="row mt-2">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd">
                <div class="accordion" id="accordion">
                    <div class="accordion-item">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button bg-4" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-hospital"></i>Gestión de médicos
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">

                                <div class="table-responsive" id="div-patients-corp" style="margin-top: 20px; width: 100%;">
                                    <table id="table-patients-corp" class="table table-striped table-bordered"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nombre y Apellido</th>
                                                <th class="text-center">Número de Cédula</th>
                                                <th class="text-center">Correo</th>
                                                <th class="text-center">Especialidad</th>
                                                <th class="text-center">Teléfono del consultorio</th>
                                                <th class="text-center">Habilitar/Deshabilitar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dortors as $key => $item)
                                                <tr>
                                                    <td class="text-center text-capitalize">{{ $item->name . ' ' . $item->last_name }}</td>
                                                    <td class="text-center">{{ $item->ci }}</td>
                                                    <td class="text-center">{{ $item->email }}</td>
                                                    <td class="text-center">{{ $item->specialty }}</td>
                                                    <td class="text-center">{{ $item->phone }}</td>
                                                    <td class="text-center table-check w-5">
                                                        <div class="form-check form-switch" style="display: flex; justify-content: center;">
                                                            <input onchange="handlerDoctor(event);" style="width: 5em"
                                                                class="{{$item->tipo_status == '1' ? 'form-check-input': 'form-check-input ci' }}" type="checkbox" role="switch"
                                                                id="flexSwitchCheckChecked" value="{{ $item->id }}"
                                                                {{ $item->tipo_status!= '1' ? '' : 'checked' }}>
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

@endsection
