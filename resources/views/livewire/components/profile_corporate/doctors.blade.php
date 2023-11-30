@extends('layouts.app-auth')
@section('title', 'Gestión de Medicos')
<style>

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
            res.map((elem) => {
                if (elem.tipo_status ==
                    "1") {
                    checked = "checked";

                } else {
                    checked = '';
                }
                elem.btn =
                    ` <div class="form-check form-switch">
                            <input onchange="handlerCenter(event);" style="width: 5em"
                            class="form-check-input" type="checkbox" role="switch"
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
                        title: 'Nombre y apellidos',
                        className: "text-center",
                    },
                    {
                        data: 'ci',
                        title: 'documento de identidad',
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
                                <i class="bi bi-hospital"></i>Gestión de medicos
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">

                                <div class="table-responsive" id="div-patients-corp" style="margin-top: 20px; width: 100%;">
                                    <table id="table-patients-corp" class="table table-striped table-bordered"
                                        style="width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">Nombre y apellidos</th>
                                                <th class="text-center">documento de identidad</th>
                                                <th class="text-center">Correo</th>
                                                <th class="text-center">Especialidad</th>
                                                <th class="text-center">Teléfono del consultorio</th>
                                                <th class="text-center">Habilitar/Desahabilitar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dortors as $key => $item)
                                                <tr>
                                                    <td class="text-center">{{ $item->name . ' ' . $item->last_name }}</td>
                                                    <td class="text-center">{{ $item->ci }}</td>
                                                    <td class="text-center">{{ $item->email }}</td>
                                                    <td class="text-center">{{ $item->specialty }}</td>
                                                    <td class="text-center">{{ $item->phone }}</td>
                                                    <td class="text-center table-check w-5">
                                                        <div class="form-check form-switch ">
                                                            <input onchange="handlerDoctor(event);" style="width: 5em"
                                                                class="form-check-input" type="checkbox" role="switch"
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
