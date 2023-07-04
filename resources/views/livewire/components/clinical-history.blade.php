@extends('layouts.app-auth')
@section('title', 'Historia Clinica')
<script src="{{ asset('jquery-ui-1.13.2/external/jquery/jquery.js') }}" type="text/javascript"></script>

@push('scripts')
    <script>
        $('#dateP').datePicker();
        $('#dateD').datePicker();

        function eventeShow(event) {
            if (Number(event.target.value) === 1) {
                $("#div-hidden").show();
                $("#div-show").hide();
            } else {
                $("#div-hidden").hide();
                $("#div-show").show();
            }
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row justify-content-md-start mt-3">
                <div class="col-sm-8 md-8 lg-8 xl-8 xxl-8">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <button class="" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                aria-expanded="false" aria-controls="collapseExample">
                               Historia clinica
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <span>Paciente:</span>
                                    <br>
                                    <span>Palencia, Wilfredo</span>
                                    <br>
                                    <span>Fecha de Nacimiento:</span>
                                    <br>
                                    <span>10/02/1982</span>
                                </div>

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <span>Atendido por:</span>
                                    <br>
                                    <span>MARTINEZ, JHONNY</span>
                                    <br>
                                    <span>Edad:</span>
                                    <br>
                                    <span>20 años</span>
                                </div>

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <span>Día:</span>
                                    <br>
                                    <span>12/06/2022</span>
                                    <br>
                                    <span>Aseguradora:</span>
                                    <br>
                                    <span>Matrix</span>
                                </div>

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <span>Hora de Cita:</span>
                                    <br>
                                    <span>10:15</span>
                                    <br>
                                    <span>Profesión:</span>
                                </div>

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <span>Inicio:</span>
                                    <br>
                                    <span>14:41</span>
                                    <br>
                                    <span>Referido:</span>
                                </div>
                            </div>
                            <div class="row mt-3">

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Precio</label>
                                        <input autocomplete="off" class="form-control @error('names') is-invalid @enderror"
                                            id="names" name="names" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Precio</label>
                                        <input autocomplete="off" class="form-control @error('names') is-invalid @enderror"
                                            id="names" name="names" type="text" value="">
                                    </div>
                                </div>

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Precio</label>
                                        <input autocomplete="off" class="form-control @error('names') is-invalid @enderror"
                                            id="names" name="names" type="text" value="">
                                    </div>
                                </div>

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Precio</label>
                                        <input autocomplete="off" class="form-control @error('names') is-invalid @enderror"
                                            id="names" name="names" type="text" value="">
                                    </div>
                                </div>

                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Precio</label>
                                        <input autocomplete="off" class="form-control @error('names') is-invalid @enderror"
                                            id="names" name="names" type="text" value="">
                                    </div>
                                </div>

                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">

                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Nota</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">

                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Nota</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                    <div class="card">
                        <img src="{{ asset('img/People-Patient-Male-icon.png') }}" width="150" height="150"
                            alt="Imagen del paciente">
                    </div>
                </div>
            </div>

            <div class="row  mt-3">
                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Antecedentes Personales
                                        y Familiares *</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Sin Interes</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">HTA</button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Diabete
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">Cardiacos
                                    </button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Coagulooia
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">Temblosis venenosa</button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Embolia pulmorar
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">Cancer</button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Tranfusiones sanguineas
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">COVID19
                                    </button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Hepatitis
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">VIH
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Alergias Conocidas
                                        *</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">NAMC
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">B-LACTAMICOS</button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">SULFAMIDAS
                                        Paciente</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">NOLOTIL
                                    </button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">IBUPROFENO
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">ANTOCOLBULCIVOS
                                    </button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">INSULINA
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">YODO
                                    </button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">LATEX
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">ALIMNETOS
                                    </button>

                                </div>
                            </div>
                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Diagnóstico *</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Sin determinar
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">Vision borrosa
                                    </button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Perdiida de peso inexplicada
                                    </button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn bnt2 btnPrimary">Fatiga
                                    </button>

                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">POLIDIPSIA-R631
                                    </button>
                                </div>
                                <div class="col-sm-5 md-5 lg-5 xl-5 xxl-5  mt-5">
                                    <button type="button" class="btn  bnt2 btnSecond">Citar
                                        DriCloudAI: Generar diagnóstico con Inteligencia Artificial</button>
                                </div>
                            </div>
                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Motivo de la
                                        visita</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Examen físico</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Diagnóstico de
                                        prueba</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnSecond">Citar
                                        DriCloudAI: Generar diagnóstico con Inteligencia Artificial</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row  mt-3">
                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                <div class="floating-label-group">
                                    <select onchange="eventeShow(event);" placeholder="Seleccione"class="form-control"
                                        class="form-control combo-textbox-input">
                                        <option value="1">prescripción de medicamentos</option>
                                        <option value="2">Prescripción de medicamentos con código de barras</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="div-hidden">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i>Añadir grupo
                                        medicación</button>
                                </div>
                            </div>

                            <div class="row" id="div-show" style="display: none">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Medicamento" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Dosis" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Posología" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Vía de administración" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Ud. por envase" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Num. de envases" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Frecuencia toma" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Duración tratamiento" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Fecha preescripción" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="dateP"
                                        name="names" type="date" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Fecha dispensación" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="dateD"
                                        name="names" type="date" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Nº Orden" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <div class="floating-label-group">
                                        <select placeholder="Seleccione" class="form-control"
                                            class="form-control combo-textbox-input">
                                            <option value="1">Seleccione..</option>
                                            <option value="2">Lactantes</option>
                                            <option value="2">Ninos</option>
                                            <option value="2">Adultos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <input placeholder="Medicamento" autocomplete="off"
                                        class="form-control @error('names') is-invalid @enderror" id="names"
                                        name="names" type="text" value="">
                                </div>
                            </div>

                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Medicacion (Introducir
                                        un medicamento en cada linea)</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnSecond">Citar
                                        DriCloudAI: Generar diagnóstico con Inteligencia Artificial</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <div class="floating-label-group">
                                        <label class="floating-label">Actuaciones en consulta</label>
                                        <select class="form-control form-textbox-input combo-textbox-input"
                                            id="ddlTratamientos" name="Lista Tratamientos">
                                            <option value="1">Seleccione..</option>
                                            <option value="2">Lactantes</option>
                                            <option value="2">Ninos</option>
                                            <option value="2">Adultos</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                    <button class="btn btn-outline-success"><i class="bi bi-plus-lg"></i>Añadir</button>
                                </div>

                            </div>

                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">historial
                                        médico</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnSecond">Citar
                                        DriCloudAI: Generar historial médico con Inteligencia Artificial</button>
                                </div>
                            </div>
                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6  mt-4">
                                <div class="alert alert-info alert-info2" role="alert"
                                    style="position: static; zoom: 1;">
                                    <input id="chkIntervencion" type="checkbox">
                                    <label style="display: contents;">
                                        Programar este paciente para una cirugía. El paciente aparecerá en
                                        Agenda-Quirófano-Lista de espera.
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                <div class="floating-label-group">
                                    <label class="floating-label">Documentos del paciente</label>
                                    <select class="form-control form-textbox-input combo-textbox-input"
                                        id="ddlTratamientos" name="Lista Tratamientos">
                                        <option value="2">Docuemmtos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                <div class="floating-label-group">
                                    <label class="floating-label">Consentimeiontos informados</label>
                                    <select class="form-control form-textbox-input combo-textbox-input"
                                        id="ddlTratamientos" name="Lista Tratamientos">
                                        <option value="1">Consentimeiontos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  bnt2 btnPrimary">Cancelar</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  btnSecond">Generar informe DriCloudAI</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  btnPrimary">Generar informe HC</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  btnSecond">Enviar informe Email</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  btnPrimary">Guardar y Finalizar</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  btnPrimary">Guardar</button>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                    <button type="button" class="btn  btnSecond">Guardar y Citar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
