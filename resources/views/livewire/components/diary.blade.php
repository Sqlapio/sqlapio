@extends('layouts.app-auth')
@section('title', 'Agenda')
<style>
    .spinnner {
        top: 94% !important;
    }

    /* .Icon-inside i {
        top: 30% !important
    } */

    .datepicker-switch {
        background-color: #44525F !important;
    }

    .inputChange {
        height: 80% !important;
        padding: 28px 10px 10px 25px !important;
    }

    .form-switch {
        padding-left: 0% !important;
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
        border-radius: 43px;
        /* padding: 10px 0px 0px 6px;
        width: 100%; */
        height: auto;
        margin: 23px;
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
            let urlPostCreateAppointment = '{{ route('CreateAppointment') }}';
            getUrl(urlPostCreateAppointment, url2);
            getAppointments(appointments, route, routeCancelled, url2, ulrImge, update_appointments);
        });
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid" style="padding: 3%">
            <div class="row mt-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header title">
                                <i class="bi bi-house"></i>
                                <span style="padding-left: 5px">Agendar Cita</span>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="div-pat" style="display: none">
                                    <div class="d-flex mt-3">
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="img">
                                                <img id="img-pat" src="" width="150" height="150"
                                                    alt="Imagen del paciente">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                            <div>
                                                <strong>Nombre: </strong><span class="text-capitalize"
                                                    id="name"></span>
                                                <br>
                                                <strong>Cédula: </strong><span id="ci"></span>
                                                <br>
                                                <strong>Edad: </strong><span id="age"></span> años
                                                <br>
                                                <strong>Genero: </strong><span class="text-capitalize"
                                                    id="genere"></span>
                                                <br>
                                                <strong>Correo: </strong><span id="email"></span>
                                                <br>
                                                <strong>Telefono: </strong><span id="phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="d-flex">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                        id="search-patients-show">
                                        <div class="floating-label-group">
                                            <div class="Icon-inside">
                                                <label for="name" class="form-label"
                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Buscar
                                                    paciente</label>
                                                <input autocomplete="off" placeholder="" class="form-control"
                                                    id="searchPatients" name="email" type="email" value="">
                                                <i onclick="searchPatients('{{ route('search_patients', ':value') }}')"
                                                    class="bi bi-search st-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <form action="" id="form-appointment">
                                    {{ csrf_field() }}


                                    <div class="row mt-3">
                                        <input type="hidden" id="patient_id" name="patient_id" value="">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                                            <div class="floating-label-group">
                                                <div class="Icon-inside">
                                                    <label for="date" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Fecha</label>
                                                    <input autocomplete="off" placeholder="" class="form-control"
                                                        id="date_start" readonly name="date_start" type="text" value="">
                                                    <i class="bi bi-calendar-check st-icon"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                            <div class="floating-label-group">
                                                <div class="Icon-inside">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Tiempo
                                                        Horario</label>
                                                    <select id="timeIni" name="timeIni" onchange="handlerTime(event)"
                                                        class="form-control valid">
                                                        <option value="">Seleccione</option>
                                                        <option value="am">AM</option>
                                                        <option value="pm">PM</option>
                                                    </select>
                                                    <i class="bi bi-stopwatch st-icon"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-2">
                                            <div class="floating-label-group">
                                                <div class="Icon-inside">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Horarios
                                                        de cita</label>
                                                    <select id="hour_start" name="hour_start"
                                                        class="form-control valid"></select>
                                                    <i class="bi bi-stopwatch st-icon"></i>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <div class="floating-label-group">
                                            <div class="Icon-inside">
                                                <label class="floating-label">Minutos Inicio</label>
                                                <select class="form-control form-textbox-input combo-textbox-input valid"
                                                    id="minIni" name="minIni">
                                                    <option value="">Seleccione</option>
                                                    <option value="00">00</option>
                                                    <option value="30">30</option>
                                                </select>
                                                <i class="bi bi-stopwatch"></i>
                                            </div>
                                        </div>
                                    </div> --}}


                                        {{-- fecha fin --}}
                                        {{-- <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <div class="floating-label-group">
                                            <div class="Icon-inside">
                                                <label class="floating-label">Tiempo Horario</label>
                                                <select onchange="handlerTimeTwo(event)"
                                                    class="form-control form-textbox-input combo-textbox-input valid"
                                                    id="timeFin" name="timeFin">
                                                    <option value="">Seleccione</option>
                                                    <option value="am">AM</option>
                                                    <option value="pm">PM</option>
                                                </select>
                                                <i class="bi bi-stopwatch"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <div class="floating-label-group">
                                            <div class="Icon-inside">
                                                <label class="floating-label">Hora de Fin</label>
                                                <select class="form-control form-textbox-input combo-textbox-input valid"
                                                    id="hour_end" name="hour_end">
                                                </select>
                                                <i class="bi bi-stopwatch"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <div class="floating-label-group">
                                            <div class="Icon-inside">
                                                <label class="floating-label">Minutos Fin</label>
                                                <select class="form-control form-textbox-input combo-textbox-input valid"
                                                    id="minFin" name="minFin">
                                                    <option value="">Seleccione</option>
                                                    <option value="00">00</option>
                                                    <option value="30">30</option>
                                                </select>
                                                <i class="bi bi-stopwatch"></i>
                                            </div>
                                        </div>
                                    </div> --}}

                                        <x-centers_user class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" />

                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 text-center">
                                            <div class="form-check form-switch" style="padding-left: 13% !important;">
                                                <input onchange="handlerPrice(event);" style="width: 5em"
                                                    class="form-check-input" type="checkbox" role="switch"
                                                    id="showPrice" value="">
                                                <label style="margin-left: -88px;margin-top: 6px;" for="showPrice">Precio
                                                    de
                                                    la cita</label>
                                            </div>
                                        </div>


                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2"
                                            style="display: none" id="div-price">
                                            <div class="form-floating mb-3">
                                                <input maxlength="8" type="text"
                                                    class="form-control mask-input-price" id="price" name="price"
                                                    placeholder="Precio">
                                                <label for="searchPatients">Precio</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row text-center mt-3">
                                        <div id="spinner" style="display: none">
                                            <x-load-spinner show="true" />
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4"
                                            style="margin-top: -4px" id="send">
                                            <input class="btn btnPrimary" id="registrer-pac" value="Registrar" disabled
                                                type="submit" />
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="btn-con"></div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="btn-cancell"></div>
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
