@extends('layouts.app-auth')
@section('title', 'Agenda')
<style>
    .datepicker-switch {
        background-color: #44525F !important;
    }

    .inputChange {
        height: 80% !important;
        padding: 28px 10px 10px 25px !important;
    }

    .form-switch {
        padding-left: 1.5em !important;
    }

    .input-check {
        padding: 2% !important;
        margin: 4px !important;
        box-sizing: border-box !important;
        padding-left: 8% !important;
    }

    .fc-day-today {
        background-color: #ffffff !important;
    }

    #img-pat {
        border-radius: 27px;
        border: 2px solid #44525F;
        height: 125px;
        margin: 5px 15px;
        object-fit: cover;
    }

    .fc .fc-daygrid-day-number {
        text-decoration: none !important;
        color: #44525F !important;
    }

    .fc .fc-col-header-cell-cushion {
        color: #42abe2;
        text-transform: capitalize;
        text-decoration: none !important;
    }

    .fc-direction-ltr .fc-list-day-text,
    .fc-direction-rtl .fc-list-day-side-text {
        text-decoration: none;
        text-transform: capitalize;
        color: #42abe2;
    }

    .fc-direction-ltr .fc-list-day-side-text,
    .fc-direction-rtl .fc-list-day-text {
        text-decoration: none;
        text-transform: capitalize;
        color: #42abe2;
    }

    .fc .fc-toolbar-title {
        text-transform: capitalize;
    }

    .modal-d {
        max-width: 200px;
    }

    .modal-dialog {
        max-width: 500px !important;
    }

    body {
        padding-right: 0px !important;
    }

    @media screen and (max-width: 390px) {
        #img-pat {
            margin: 4px 20px 0 0;
        }

        .m-xs {
            margin: 0 10px;
        }

        .fc .fc-daygrid-day-top {
            height: 20px;
        }

        .fc .fc-toolbar {
            flex-direction: column-reverse;
        }

        .fc .fc-toolbar-title {
            margin: 10px 0;
        }

        .modal-d {
            max-width: 133px;
        }

        .modal-text {
            max-width: 190px;
        }

    }

    @media (min-width: 391px) and (max-width: 576px) {
        .m-xs {
            margin: 0 10px;
        }

        .fc .fc-daygrid-day-top {
            height: 20px;
        }

        .fc .fc-toolbar {
            flex-direction: column-reverse;
        }

        .fc .fc-toolbar-title {
            margin: 10px 0;
        }

        .modal-d {
            max-width: 165px;
        }

        #img-pat {
            margin: 4px 20px 0 0;
        }
    }
</style>
@push('scripts')
    @vite(['resources/js/dairy.js'])
    <script>


        $(document).ready(() => {
            let route = "{{ route('MedicalRecord', ':id') }}";
            let routeCancelled = "{{ route('cancelled_appointments', ':id') }}";
            let url2 = "{{ route('Diary') }}";
            let update_appointments = "{{ route('update_appointments') }}";
            let appointments = @json($appointments);
            let ulrImge = "{{ URL::asset('/imgs/') }}";
            let imge_avatar = "{{ URL::asset('/img/avatar/') }}";
            let ulrPaciente = "{{ route('Patients', ':id_patient') }}";
            let user = @json(Auth::user());
            let centers = @json($centers);



            let urlPostCreateAppointment = '{{ route('CreateAppointment') }}';
            getUrl(urlPostCreateAppointment, url2);
            getAppointments(appointments, route, routeCancelled, url2, ulrImge, update_appointments, imge_avatar,ulrPaciente, user);

            if (user.type_plane != '7' && centers.length === 0 && user.role == 'medico') {
                    Swal.fire({
                        icon: 'warning',
                        title: '@lang('messages.alert.asociar_centro')',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: '@lang('messages.botton.aceptar')'
                    }).then((result) => {
                    window.location.href = "{{ route('Profile') }}";
                });
            }

            if (user.role == 'secretary' && user.center_id == null ) {
                    Swal.fire({
                        icon: 'warning',
                        title: '@lang('messages.alert.asociar_centro')',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: '@lang('messages.botton.aceptar')'
                    }).then((result) => {
                    window.location.href = "{{ route('profile-user-secretary') }}";
                });
            }

        });

        const handlerPetientRegister = (e) => {

            if ($(`#${e.target.id}`).is(':checked')) {

                $(".form-patient-register").show();
                $("#search-patients-show").hide();
                $("#div-pat").hide();
                $("#patient_new").val(true);

            } else {

                $("#name_patient").val('');
                $("#last_name_patient").val('');
                $("#phone_patient").val('');
                $("#email_patient").val('');
                // $("#birthdate_patient").val('');
                $("#patient_new").val(false);
                $("#search-patients-show").show();
                $(".form-patient-register").hide();

            }
        }
    </script>
@endpush
@section('content')
<div>
    <div id="spinner2" style="display: none" class="spinner-md">
        <x-load-spinner show="true" />
    </div>
    <div class="container-fluid" style="padding: 3%">
            <div class="row mt-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3">
                    <div class="card accordion-diary">
                        <div class="card-body" style="position: sticky">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header title">
                            <i class="bi bi-calendar-week"></i>
                            <span style="padding-left: 5px" id="title-modal"></span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id="date-lb">
                                <strong>@lang('messages.modal.form.fecha'): </strong><span id="date"></span>
                            </div>

                            <div id="handlerPetientRegister" class="col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 mb-3 mt-3" style="width: 318px;">
                                <div class="form-check form-switch ">
                                    <input onchange="handlerPetientRegister(event);" style="width: 5em"
                                        class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" value="">
                                    <label style="margin-top: 9px; font-size: 15px" class="form-check-label" for="inlineRadio1">
                                        @lang('messages.label.register_paciente')
                                    </label>
                                </div>
                            </div>

                            {{-- datos del paciente --}}
                            <div class="row mt-2">
                                <div id="div-pat" style="display: none">
                                    <div class="d-flex" style="align-items: center;">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 modal-d">
                                            <div class="img">
                                                <img id="img-pat" src="" width="125" height="125" alt="Imagen del paciente">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-8 modal-text" style="font-size: 13px;">
                                            <div>
                                                <strong>@lang('messages.ficha_paciente.nombre'): </strong><span class="text-capitalize" id="name"></span>
                                                <br>
                                                @if (Auth::user()->contrie == '81')
                                                    <strong>@lang('messages.ficha_paciente.ci_rd'): </strong><span id="ci"></span>
                                                @else
                                                    <strong>@lang('messages.ficha_paciente.ci'): </strong><span id="ci"></span>
                                                @endif
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.edad'): </strong><span id="age"></span> @lang('messages.ficha_paciente.años')
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.genero'): </strong><span class="text-capitalize" id="genere"></span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.correo'): </strong><span id="email"></span>
                                                <br>
                                                <strong>@lang('messages.ficha_paciente.telefono'): </strong><span id="phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-1" id="appointment-data" style="font-size: 13px;">
                                    <div>
                                        <hr>
                                        <h5>@lang('messages.modal.titulo.info')</h5>
                                        <strong>@lang('messages.modal.form.fecha'): </strong><span id="fecha"></span>
                                        <br>
                                        <strong>@lang('messages.modal.tabla.hora'): </strong><span id="hour"></span>
                                        <br>
                                        <strong>@lang('messages.modal.tabla.centro'): </strong><span id="center"></span>
                                        <br>
                                        <strong>@lang('messages.modal.form.precio'): </strong><span id="price"></span>
                                        <br>
                                        <div style="margin-top: 5px" id="status"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            </div>

                            <form action="" id="form-appointment">
                                {{ csrf_field() }}

                                <x-patient-create />

                                <input type="hidden" name="patient_new" id="patient_new" value="">

                                <x-select-dos :data="$patient" />

                                <div class="row mt-1">
                                    <input type="hidden" id="patient_id" name="patient_id" value="">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id="FC">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="date" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.fecha')</label>
                                                <input autocomplete="off" placeholder="" class="form-control"
                                                    id="date_start" readonly name="date_start" type="text"
                                                    value="">
                                                <i class="bi bi-calendar-check st-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" id="TH">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.tiempo_horario')</label>
                                                <select id="timeIni" name="timeIni" onchange="handlerTime(event)" class="form-control valid">
                                                    <option value="">@lang('messages.placeholder.seleccione')</option>
                                                    <option value="am">@lang('messages.select.am')</option>
                                                    <option value="pm">@lang('messages.select.pm')</option>
                                                </select>
                                                <i class="bi bi-stopwatch st-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2" id="HS">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="phone" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.horarios_cita')</label>
                                                <select id="hour_start" name="hour_start" class="form-control valid"></select>
                                                <i class="bi bi-stopwatch st-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    @if (Auth::user()->type_plane != '7')
                                        <x-centers_user class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" id="CM" />
                                    @endif

                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 text-center" id="check-price">
                                        <div class="form-check form-switch">
                                            <input onchange="handlerPrice(event);" style="width: 5em" class="form-check-input" type="checkbox" role="switch" id="showPrice" value="">
                                            <label style="margin-left: -146px;margin-top: 8px; font-size: 13px" for="showPrice">@lang('messages.modal.form.precio')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                        style="display: none" id="div-price">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <label for="searchPatients" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.modal.form.precio')($)</label>
                                                <input maxlength="8" type="text"
                                                    class="form-control mask-input-price" id="price"
                                                    name="price" id="searchPatients" value="">
                                                <i class="bi bi-cash st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="spinner" style="display: none">
                                    <x-load-spinner show="true" />
                                </div>
                                <div class="row text-center mt-2">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" style="display: flex; justify-content: center; align-items: center;">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 " id="send">
                                            <input class="btn btnSave" id="registrer-pac" value="@lang('messages.botton.agendar_cita')" disabled  type="submit" />
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 m-xs" id="btn-con"></div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="btn-cancell"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
