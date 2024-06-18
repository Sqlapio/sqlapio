@extends('layouts.app-auth')
@section('title', 'Gestión Pacientes')
<style>
    . #img-pat {
        border-radius: 27px;
        border: 2px solid #44525F;
        height: 150px;
        margin: 5px 23px;
        object-fit: cover;
    }

    body {
        /* font-family: 'Roboto', 'Inter', "Helvetica Neue", Helvetica, 'Source Sans Pro' !important; */
        letter-spacing: -.022em;
        color: #1d1d1f;
    }

    .list-group-item.active {

        background-color: #415467 !important;
        border-color: #415467 !important;
    }

    .avatar {
        border-radius: 50%;
        width: 45px !important;
        height: 45px !important;
        border: 2px solid #44525f;
        object-fit: cover;
    }

    .table-avatar {
        text-align: center;
        vertical-align: middle;
    }

    .img img {
        max-height: 220px;
        text-align: left;
        margin-right: 70%;
    }


    .modal.show .modal-dialog {
        width: 200% !important;
    }


    @media screen and (max-width: 390px) {

        #img-pat {
            margin: 23px 20px 0 0;
        }

    }

    @media (min-width: 391px) and (max-width: 576px) {
        .modal-d {
            max-width: 165px;
        }

        #img-pat {
            margin: 7px 20px 0 0;
        }
    }
</style>
@push('scripts')
    <script>
        const hendlerModal = async (id) => {
            let url = "{{ route('get_medical_record_user', ':id') }}";
            url = url.replace(':id', id);
            // ajax para refrescar la tabla s
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $(
                        'meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(res) {
                    $('.list-group').empty();
                    if (res.length > 0) {
                        res.map((e, key) => {
                            let element = '';
                            if ((key % 2) == 0) {
                                element =
                                        `<li class="list-group-item mb-3 active ${key}" aria-current="true" style="border-radius: 8px;">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb- text-capitalize">@lang('messages.form.medico'): ${e.full_name_doc} </h5>
                                                <br>
                                            </div>
                                            <small>@lang('messages.form.codigo_consulta'):</small> <strong>${e.data.record_code}</strong>
                                            <br>
                                            <small>@lang('messages.form.fecha_consulta'):</small> <strong>${e.date}</strong>
                                        </li>`
                            } else {
                                element =
                                        `<li class="list-group-item mb-3 ${key}" aria-current="true" style="border-radius: 8px;">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1 text-capitalize">@lang('messages.form.medico'): ${e.full_name_doc} </h5><br>
                                            </div>
                                            <small>@lang('messages.form.codigo_consulta'):</small> <strong>${e.data.record_code}</strong>
                                            <br>
                                            <small>@lang('messages.form.fecha_consulta'):</small> <strong>${e.date}</strong>
                                        </li>`
                            }
                            $('.list-group').append(element);
                        })

                        $('#modalDetaly').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: '@lang('messages.pacientes.paciente_sin_cons')',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        });
                    }
                }
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
                                <i class="bi bi-hospital"></i>@lang('messages.acordion.gestion_pacientes')
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">
                                {{-- Lista de pacientes con consultas  --}}
                                <div class="row" id="table-patients">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive" style="margin-top: 20px;">
                                        <table id="table-patient" class="table table-striped table-bordered" style="width:100%; ">
                                            <thead>
                                                <tr>
                                                    <th class="text-center w-image" scope="col">@lang('messages.tabla.foto')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.codigo_paciente')</th>
                                                    <th class="text-center" scope="col">@lang('messages.tabla.nombre_apellido')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.cedula')</th>
                                                    <th class="text-center w-10" scope="col">@lang('messages.tabla.fecha_nacimiento')</th>
                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.telefono')</th>
                                                    <th class="text-center" scope="col">@lang('messages.tabla.centro_salud')</th>
                                                    <th class="text-center w-5" scope="col" data-orderable="false">@lang('messages.tabla.acciones')</th>

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
                                                        <td class="text-center">{{ $item->patient_code }}</td>
                                                        <td class="text-center text-capitalize"> {{ $item->name }} {{ $item->last_name }}</td>
                                                        <td class="text-center"> {{ $item->is_minor === 'true' ? $item->get_reprensetative->re_ci . '  (Rep)' : $item->ci }} </td>
                                                        <td class="text-center"> {{ date('d-m-Y', strtotime($item->birthdate)) }} </td>
                                                        <td class="text-center"> {{ $item->is_minor === 'true' ? $item->get_reprensetative->re_phone . '  (Rep)' : $item->phone }} </td>
                                                        <td class="text-center"> {{ $item->get_center->description }}</td>
                                                        <td class="text-center">
                                                            <div class="d-flex" style="justify-content: center;">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                    <button type="button"
                                                                        onclick="hendlerModal({{ $item->id }})"
                                                                        class="btn btn-iPrimary rounded-circle"
                                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                        title="Detalles del paciente" style="margin-right: 0px;">
                                                                        <i class="bi bi-info-circle-fill"></i>
                                                                    </button>
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
    <!-- Modal -->
    <div class="modal fade" id="modalDetaly" tabindex="-1" aria-labelledby="modalDetalyLabel" aria-hidden="true"
        id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header title">
                        <i class="bi bi-calendar-week"></i>
                        <span style="padding-left: 5px">@lang('messages.label.consultas_medicas')</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd">
                                <div class="list-group"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
