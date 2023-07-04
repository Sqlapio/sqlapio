@extends('layouts.app-auth')
@section('title', 'Agenda')
<link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.min.css') }}">
<style>
    .Icon-inside i {
        top: 30% !important
    }

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

    .div-img {
        font-size: 15px;
        text-align: start;
    }
</style>
@push('scripts')
    <script src="{{ asset('jquery-ui-1.13.2/external/jquery/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('jquery-ui-1.13.2/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script  type="module" src="{{ mix('resources/js/dairy.js') }}"></script>
    <script>
        $(document).ready(() => {
            $("#dateNacNew").datepicker({
                language: 'es'
            });

            $("#datepicker").datepicker({
                language: 'es'
            });
            $("#dateCita").datepicker({
                language: 'es'
            });
        })
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <div id="datepicker"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 md-10 lg-10 xl-10 xxl-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="d-flex">
                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12" id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-md-start" id="row-check" style="display: none">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <div class="form-check form-switch">
                                        <input onchange="changeCheck(event)" class="form-check-input input-check"
                                            value="" type="checkbox" id="activePacient">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Paciente
                                            existente</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="row-form-paciente" style="display: none;   margin-bottom: -27%;">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Nombre</label>
                                            <input autocomplete="off" class="form-control inputChange" id="nameNew"
                                                name="nameNew" type="text" value="">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1"
                                                class="floating-label">Apellidos</label>
                                            <input autocomplete="off" class="form-control inputChange" id="lastNameNew"
                                                name="lastNameNew" type="text" value="">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Fecha de
                                                nacimiento</label>
                                            <input class="form-control inputChange" id="dateNacNew" name="dateNacNew"
                                                type="text" value="">
                                            <i class="bi bi-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Sexo</label>
                                            <select class="form-control form-textbox-input combo-textbox-input valid"
                                                data-val="true" data-val-number="The field Genero must be a number."
                                                data-val-required="Género es requerido" id="SEX_ID"
                                                name="PACIENTE.SEX_ID" title="Sexo">
                                                <option value="1">Femenino</option>
                                                <option value="2">;Masculino</option>
                                                <option value="0">Sin determinar</option>
                                            </select>
                                            <i class="bi bi-gender-ambiguous"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1"
                                                class="floating-label">Teléfono/sms</label>
                                            <input autocomplete="off" class="form-control inputChange" id="phoneNew"
                                                name="phoneNew" type="text" value="">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Email</label>
                                            <input autocomplete="off" class="form-control inputChange" id="emailNew"
                                                name="emailNew" type="text" value="">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Aseguradora</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                data-val="true" data-val-number="The field Aseguradora must be a number."
                                                data-val-required="Aseguradora es requerido" id="asegNew"
                                                name="PACIENTE.SOC_ID">
                                                <option value="">Seleccione</option>
                                                <option value="2">Matrix</option>
                                                <option value="1">Seguros Mercantil</option>
                                                <option value="1">Seguros Horizontes</option>
                                            </select>
                                            <i class="bi bi-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1"
                                                class="floating-label">NIF/CIF</label>
                                            <input autocomplete="off" class="form-control inputChange" id=""
                                                name="" type="text" value="">
                                            <i class="bi bi-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Estado</label>
                                            <select class="form-control form-textbox-input combo-textbox-input valid"
                                                data-val="true"
                                                data-val-number="The field PAC_CRM_EST_ID must be a number."
                                                id="PAC_CRM_EST_ID" name="PACIENTE.PAC_CRM_EST_ID">
                                                <option value="1">Paciente</option>
                                                <option value="2">Lead</option>
                                                <option value="3">Contacto</option>
                                                <option value="4">Acuerdo</option>
                                                <option value="5">Cliente</option>
                                                <option value="6">No interesado</option>
                                            </select>
                                            <i class="bi bi-list"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input input-check" value="tratamiento" name=""
                                            type="checkbox" id="tratamiento">
                                        <label class="form-check-label text-danger" for="tratamiento"> Acepta
                                            tratamiento de datos *</label>
                                    </div>
                                </div>


                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                    <div class="img" id="img-hide">
                                        <img src="{{ asset('img/People-Patient-Male-icon.png') }}" width="150"
                                            height="150" alt="Imagen del paciente">
                                    </div>
                                </div>

                                <div class="col-sm-5 md-5 lg-5 xl-5 xxl-5 mt-2">
                                    <div class="div-img">
                                        <strong id="name"></strong>
                                        <br>
                                        <strong id="aseg"></strong>
                                        <br>
                                        <strong id="email"></strong>
                                        <br>
                                        <strong id="phone"></strong>
                                        <br>
                                        <strong id="Private">CRM Estado: Paciente</strong>
                                        <br>
                                        <button id="Videollamada" type="button"
                                            class="btn btn-outline-secondary">Videollamada</button>
                                    </div>
                                </div>

                                <input type="hidden" value="0" id="activaCreate">

                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Fecha</label>
                                            <input autocomplete="off" class="form-control inputChange" id="dateCita"
                                                name="dateCita" type="text" value="">
                                            <i class="bi bi-calendar"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Hora
                                                Ini.</label>
                                            <input autocomplete="off" class="form-control inputChange" id="hrInit"
                                                name="hrInit" type="text" value="">
                                            <i class="bi bi-stopwatch"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Min
                                                Ini.</label>
                                            <input autocomplete="off" class="form-control inputChange" id="minInit"
                                                name="minInit" type="text" value="">
                                            <i class="bi bi-stopwatch"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Hora
                                                Fin.</label>
                                            <input autocomplete="off" class="form-control inputChange" id="hrIEnd"
                                                name="hrIEnd" type="text" value="">
                                            <i class="bi bi-stopwatch"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Min
                                                Fin.</label>
                                            <input autocomplete="off" class="form-control inputChange" id="MinEnd"
                                                name="MinEnd" type="text" value="">
                                            <i class="bi bi-stopwatch"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1"
                                                class="floating-label">Minutos</label>
                                            <input autocomplete="off" class="form-control inputChange" id="minutos"
                                                name="minutos" type="text" value="">
                                            <i class="bi bi-stopwatch"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Tipo de cita</label>
                                            <select class="form-control form-textbox-input combo-textbox-input valid"
                                                data-val="true" data-val-number="The field Tipo de cita must be a number."
                                                id="ddlTipoCitaNewEvent" name="TCI_ID">
                                                <option selected="selected" value="6">Control</option>
                                                <option value="3">Emergencia</option>
                                                <option value="1">Primera Visita</option>
                                                <option value="2">Hacer un seguimiento</option>
                                            </select>
                                            <i class="bi bi-calendar2-day"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Estado cita</label>
                                            <select class="form-control form-textbox-input combo-textbox-input valid"
                                                data-val="true" data-val-number="The field Estado cita must be a number."
                                                data-val-required="The Estado cita field is required."
                                                id="CITA_PACIENTE_CONSULTA_EST_ID" name="CITA_PACIENTE_CONSULTA.EST_ID">
                                                <option value="1">Llegar</option>
                                                <option value="3">Esperando</option>
                                                <option selected="selected" value="6">En Clinica</option>
                                                <option value="5">Finalizada</option>
                                                <option value="6">No presentarse</option>
                                            </select>
                                            <i class="bi bi-aspect-ratio"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12 mt-2">
                                    <div class="floating-label-group">
                                        {{-- <div class="Icon-inside"> --}}
                                        <label id="lbl_TitleDoctor" class="floating-label">Doctor</label>
                                        <select class="form-control form-textbox-input combo-textbox-input valid"
                                            data-val="true" data-val-number="The field TCO_ID must be a number."
                                            data-val-required="TCO_ID es requerido" id="ddlTurno" name="TCO_ID"
                                            title="Turnos">
                                            <option value="">Seleccione</option>
                                            <option selected="selected" value="16">Dr./Dra. MARTINEZ, JHONNY
                                                (13/06/2023 10:15 a 10:25) - (JHONNY MARTINEZ - Room 1)</option>
                                        </select>
                                        {{-- <i class="bi bi-person-circle"></i>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label id="lbl_TitleDoctor" class="floating-label">Como nas ha
                                                conocido</label>
                                            <select class="form-control form-textbox-input combo-textbox-input valid"
                                                data-val="true" data-val-number="The field TCO_ID must be a number."
                                                data-val-required="TCO_ID es requerido" id="ddlTurno" name="TCO_ID"
                                                title="Turnos">
                                                <option value="">Seleccione</option>
                                                <option selected="selected" value="16">Recomedacion</option>
                                                <option selected="selected" value="16">Un Amigo</option>
                                            </select>
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label for="exampleFormControlTextarea1" class="floating-label">Precio</label>
                                            <input autocomplete="off" class="form-control inputChange" id="precio"
                                                name="precio" type="text" value="">
                                            <i class="bi bi-cash-coin"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">Copiar dato de la
                                        cita</button>
                                </div>
                                <div class="form-group col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <input type="checkbox" checked="" id="chkEnviarMailRecordatorio"> Recordar por
                                    Mail
                                </div>
                                <div class="form-group col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                    <input type="checkbox" checked="" id="chkEnviarMailRecordatorio"> Recordar por
                                    SMS

                                </div>
                                <div class="modal-footer" id="footer-button">
                                    <div class="row">
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                            <a href="{{ route('MedicalRecord') }}"> <button type="button"
                                                    class="btn btn-secondary">Paciente</button> </a>

                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                            <a href="{{ route('ClinicalHistory') }}">
                                                <button type="button" class="btn btnPrimary">H.clinica</button>
                                            </a>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                            <button type="button" class="btn btnPrimary">Cambiar
                                                cita</button>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                            <button type="button" class="btn btnPrimary">Forzar</button>
                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-2">
                                            <button type="button" class="btn btn-danger">Eliminar
                                                cita</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btn-guardar" class="btn btn-secondary"
                                        onclick="addCita();">Guardar</button>
                                    <button type="button" id="btn-imprimir" class="btn btn-secondary">Guardar e
                                        Imprimir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
