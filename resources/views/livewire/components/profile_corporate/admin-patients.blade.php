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

        const showModal = async (item) => {

            let url = "{{ route('get_medical_record_user', ':id') }}";
            url = url.replace(':id', item.id);

            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $(
                        'meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(res) {

                    let data = [];

                    res.map((elem) => {

                        elem.name_full = `${elem.get_doctor.name} ${elem.get_doctor.last_name}`;

                        let elemData = JSON.stringify(elem);

                        data.push(elem);
                    })

                    $('.table-corpo').dataTable( {
                        "aaData": data,
                        ordering: false,
                        bDestroy: true,
                        destroy: true,
                        "bLengthChange": false,
                        "columns": [
                            {
                                "data": "name_full",
                                title: '@lang('messages.tabla.medico_tratante')',
                                className: "text-center text-capitalize",
                            },
                            {
                                "data": "get_doctor.phone",
                                title: '@lang('messages.tabla.telefono')',
                                className: "text-center",
                            },
                            {
                                "data": "record_date",
                                title: '@lang('messages.form.fecha_consulta')',
                                className: "text-center",
                            },
                        ]
                    })
                }
            });


            $('#modalDetaly').modal('show');
            $("#email").text(item.email);
            $("#blood_type").text(item.blood_type);
            $("#age").text(item.age);
            $("#genere").text(item.genere);
            $("#name").text(item.name + ' ' + item.last_name);
            $("#phone").text(item.phone);
            $("#fecha_nac").text(item.birthdate);

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
                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.codigo_paciente')</th>
                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.nombre_apellido')</th>
                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.cedula')</th>
                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.fecha_nacimiento')</th>
                                                    <th class="text-center w-10" scope="col" data-orderable="false">@lang('messages.tabla.telefono')</th>
                                                    <th class="text-center w-30" scope="col" data-orderable="false">@lang('messages.tabla.centro_salud') </th>
                                                    <th class="text-center w-5" scope="col" data-orderable="false">@lang('messages.tabla.acciones')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($patients as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->patient_code }}</td>
                                                        <td class="text-center text-capitalize"> {{ $item->name }} {{ $item->last_name }}</td>
                                                        <td class="text-center"> {{ $item->is_minor === 'true' ? $item->re_ci . '  (Rep)' : $item->ci }} </td>
                                                        <td class="text-center"> {{ date('d-m-Y', strtotime($item->birthdate)) }} </td>
                                                        <td class="text-center"> {{ $item->is_minor === 'true' ? $item->phone . '  (Rep)' : $item->phone }} </td>
                                                        <td class="text-center"> {{ $item->get_center->description }}</td>
                                                        <td class="text-center">
                                                            <div class="d-flex" style="justify-content: center;">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                                    <button type="button" class="btn btn-iPrimary rounded-circle" onclick="showModal({{ $item }})"><i class="bi bi-info-circle-fill"></i></button>
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header title">
                    <i class="bi bi-calendar-week"></i>
                    <span style="padding-left: 5px">@lang('messages.label.consultas_medicas')</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="font-size: 12px;"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd" style="font-size: 14px">
                            <strong>@lang('messages.tabla.nombre_apellido'): </strong><span id="name"></span>
                            <br>
                            <strong>@lang('messages.tabla.tipo_sangre'): </strong><span id="blood_type"></span>
                            <br>
                            <strong>@lang('messages.ficha_paciente.genero'): </strong><span class="text-capitalize" id="genere"></span>
                            <br>
                            <strong>@lang('messages.ficha_paciente.edad'): </strong><span id="age"></span> @lang('messages.ficha_paciente.años')
                            <br>
                            <strong>@lang('messages.tabla.telefono'): </strong><span id="phone"></span>
                            <br>
                            <strong>@lang('messages.tabla.fecha_nacimiento'): </strong><span id="fecha_nac"></span>
                            <br>
                            <strong>@lang('messages.ficha_paciente.correo'): </strong><span id="email"></span>
                        </div>
                        <div class="row" >
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive" style="margin-top: 20px;" id="table-patient-corp">
                                <table id="table-patient-corp" class="table table-striped table-bordered table-corpo" style="width:100%; ">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
