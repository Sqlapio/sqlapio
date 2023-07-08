@extends('layouts.app-auth')
@section('title', 'Historia Clinica')
<script src="{{ asset('jquery-ui-1.13.2/external/jquery/jquery.js') }}" type="text/javascript"></script>

@push('scripts')
    <script>
        let backFamiliy = [];
        let allergies = [];
        let diagnosis = [];

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

        function handlerBackFamiliy(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                backFamiliy.push(e.target.value);
                $('#backFamiliy').val(backFamiliy);
            } else {
                backFamiliy = backFamiliy.filter(elem => elem !== e.target.value);
                $('#pathologies').val(backFamiliy);
            }
        }

        function handlerAllergies(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                allergies.push(e.target.value);
                $('#allergies').val(allergies);
            } else {
                allergies = allergies.filter(elem => elem !== e.target.value);
                $('#allergies').val(allergies);
            }
        }

        function handlerAllergies(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                allergies.push(e.target.value);
                $('#allergies').val(allergies);
            } else {
                allergies = allergies.filter(elem => elem !== e.target.value);
                $('#allergies').val(allergies);
            }
        }

        function handlerDiagnosis(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                diagnosis.push(e.target.value);
                $('#diagnosis').val(diagnosis);
            } else {
                diagnosis = diagnosis.filter(elem => elem !== e.target.value);
                $('#diagnosis').val(diagnosis);
            }
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <h3>Historia clinica</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <div class="card">
                                        <img src="{{ asset('img/People-Patient-Male-icon.png') }}" width="150"
                                            height="150" alt="Imagen del paciente">
                                    </div>
                                </div>
                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                    <span>Paciente:</span>
                                    <br>
                                    <span>{{ $Patient->name . ',' . $Patient->last_name }}</span>
                                    <br>
                                    <span>Fecha de Nacimiento:</span>
                                    <br>
                                    <span>{{ $Patient->birthdate }}</span>
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
            </div>
            {{-- antecedentes falimilares --}}
            <div class="row  mt-3">
                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <h3>Antecedentes Personales y Familiares</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="backFamiliy[]" id="backFamiliy" value="">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <div class="floating-label-group">
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" class="form-check"
                                                    name="sin_interes" type="checkbox" id="sin_interes"
                                                    value="Sin Interes">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Sin Interes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="HTA"
                                                    class="form-check" name="HTA" type="checkbox" id="HTA">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    HTA
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="Diabete"
                                                    class="form-check" name="Diabete" type="checkbox" id="Diabete">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Diabete
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="Cardiacos"
                                                    class="form-check" name="Cardiacos" type="checkbox" id="Cardiacos">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Cardiacos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="Coagulooia"
                                                    class="form-check" name="Coagulooia" type="checkbox"
                                                    id="Coagulooia">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Coagulooia
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <div class="floating-label-group">
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" class="form-check"
                                                    name="Temblosis" type="checkbox" id="Temblosis" value="Temblosis">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Temblosis venenosa</label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="Embolia"
                                                    class="form-check" name="Embolia" type="checkbox" id="Embolia">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Embolia pulmorar
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="Cancer"
                                                    class="form-check" name="Cancer" type="checkbox" id="Cancer">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Cancer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="Tranfusiones"
                                                    class="form-check" name="Tranfusiones" type="checkbox"
                                                    id="Tranfusiones">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Tranfusiones sanguineas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerBackFamiliy(event);" value="COVID19"
                                                    class="form-check" name="COVID19" type="checkbox" id="COVID19">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    COVID19
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- alergias --}}
            <div class="row  mt-3">
                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <h3>Alergias Conocidas</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="allergies[]" id="allergies" value="">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <div class="floating-label-group">
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Diabete');" class="form-check"
                                                    name="checked" type="checkbox" id="Diabete" value="Diabete">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    NAMC
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Himpertencion');"
                                                    value="Himpertencion" class="form-check" name="checked"
                                                    type="checkbox" id="Himpertencion">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    B-LACTAMICOS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Dermatología');"
                                                    value="Dermatología" class="form-check" name="checked"
                                                    type="checkbox" id="Dermatología">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    SULFAMIDAS Paciente
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Osteoporozis');"
                                                    value="Osteoporozis" class="form-check" name="checked"
                                                    type="checkbox" id="Osteoporozis">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    NOLOTIL
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Fiebre_Amarilla');"
                                                    value="Fiebre_Amarilla" class="form-check" name="checked"
                                                    type="checkbox" id="Fiebre_Amarilla">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    IBUPROFENO
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <div class="floating-label-group">
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Diabete');" class="form-check"
                                                    name="checked" type="checkbox" id="Diabete" value="Diabete">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    ANTOCOLBULCIVOS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Himpertencion');"
                                                    value="Himpertencion" class="form-check" name="checked"
                                                    type="checkbox" id="Himpertencion">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    INSULINA
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Dermatología');"
                                                    value="Dermatología" class="form-check" name="checked"
                                                    type="checkbox" id="Dermatología">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    YODO
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Osteoporozis');"
                                                    value="Osteoporozis" class="form-check" name="checked"
                                                    type="checkbox" id="Osteoporozis">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    LATEX
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerAllergies(event,'Fiebre_Amarilla');"
                                                    value="Fiebre_Amarilla" class="form-check" name="checked"
                                                    type="checkbox" id="Fiebre_Amarilla">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    AINES
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Diagnóstico --}}
            <div class="row  mt-3">
                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <h3>Diagnóstico</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="pathologies[]" id="pathologies" value="">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <div class="floating-label-group">
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerDiagnosis(event);"
                                                    class="form-check" name="sin_diagnostico" type="checkbox" id="sin_diagnostico"
                                                    value="sin_diagnostico">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Sin determinar
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerDiagnosis(event);"
                                                    value="vision_borrosa" class="form-check" name="vision_borrosa"
                                                    type="checkbox" id="vision_borrosa">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Vision borrosa
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerDiagnosis(event);"
                                                    value="perdida_peso" class="form-check" name="perdida_peso"
                                                    type="checkbox" id="perdida_peso">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Perdida de peso inexplicada
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerDiagnosis(event);"
                                                    value="fatiga" class="form-check" name="fatiga"
                                                    type="checkbox" id="fatiga">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    Fatiga
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check" style="display: flex; ">
                                            <div style="margin-right: 30px;">
                                                <input onclick="handlerDiagnosis(event);"
                                                    value="POLIDIPSIA" class="form-check" name="POLIDIPSIA"
                                                    type="checkbox" id="POLIDIPSIA">
                                            </div>
                                            <div>
                                                <label style="font-size: 15px;" class="form-check-label"
                                                    for="flexCheckDefault">
                                                    POLIDIPSIA-R631
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- otra seccion --}}
            <div class="row  mt-3">
                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <h3>Medicacion</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Motivo de la
                                            visita</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Examen
                                            físico</label>
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
                            </div>

                            <div class="row  mt-3">
                                <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                                <div class="floating-label-group">
                                                    <select onchange="eventeShow(event);"
                                                        placeholder="Seleccione"class="form-control"
                                                        class="form-control combo-textbox-input">
                                                        <option value="1">prescripción de medicamentos</option>
                                                        <option value="2">Prescripción de medicamentos con código de
                                                            barras</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row" id="div-hidden">
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                    <button class="btn btn-outline-secondary"><i
                                                            class="bi bi-plus-lg"></i>Añadir grupo
                                                        medicación</button>
                                                </div>
                                            </div>

                                            <div class="row" id="div-show" style="display: none">
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Medicamento" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Dosis" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Posología" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Vía de administración" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Ud. por envase" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Num. de envases" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Frecuencia toma" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Duración tratamiento" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Fecha preescripción" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="dateP" name="names" type="date" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Fecha dispensación" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="dateD" name="names" type="date" value="">
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                    <input placeholder="Nº Orden" autocomplete="off"
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
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
                                                        class="form-control @error('names') is-invalid @enderror"
                                                        id="names" name="names" type="text" value="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                                <div class="floating-label-group">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="floating-label">Medicacion (Introducir
                                                        un medicamento en cada linea)</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                                                    <button class="btn btn-outline-success"><i
                                                            class="bi bi-plus-lg"></i>Añadir</button>
                                                </div>

                                            </div>

                                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                                <div class="floating-label-group">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="floating-label">historial
                                                        médico</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                                                    <button type="button" class="btn  btnSecond">Generar informe
                                                        DriCloudAI</button>
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                                    <button type="button" class="btn  btnPrimary">Generar informe
                                                        HC</button>
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                                    <button type="button" class="btn  btnSecond">Enviar informe
                                                        Email</button>
                                                </div>
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                                    <button type="button" class="btn  btnPrimary">Guardar y
                                                        Finalizar</button>
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
                </div>
            </div>
        </div>
    </div>
@endsection
