@extends('layouts.app-auth')
@section('title', 'Gestión de Medicos')
<style>

</style>
@push('scripts')
    <script>
        const handlerDoctor = async (e) =>  {
            if ($(`#${e.target.id}`).is(':checked')) {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Está seguro que desea habilitar este medico?',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    handlerStatus("{{ route('center_enabled', ':id') }}", e.target.value);
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Está seguro que desea deshabilitar este medico?',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    handlerStatus("{{ route('center_disabled', ':id') }}", e.target.value);
                });
            }

        }

        function handlerStatus(route, id) {
            route = route.replace(':id', id);
            console.log(route);
            // $.ajax({
            //     url: route,
            //     type: 'GET',
            //     headers: {
            //         'X-CSRF-TOKEN': $(
            //             'meta[name="csrf-token"]').attr(
            //             'content')
            //     },
            //     success: function(res) {
            //         refreshTable();
            //     }
            // });

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

                                <div class="table-responsive" id="table-patients" style="margin-top: 20px; width: 100%;">
                                    <table id="table-centers" class="table table-striped table-bordered"
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
                                                            <input 
                                                                onchange="handlerDoctor(event);"
                                                                style="width: 5em"
                                                                class="form-check-input" type="checkbox" role="switch"
                                                                id="flexSwitchCheckChecked" value="{{ $item->id }}"
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

@endsection
