@extends('layouts.app-auth')
@section('title', 'Estadistica')
@vite(['resources/js/mychartGrafica.js','resources/js/mychartGraficaFac.js'])
<style>
    .Icon-inside i {
        top: 20% !important
    }

    .inputChange {
        height: 60px;
    }
</style>
@push('scripts')
    <script>
        function showResulTable() {
            $('#result-table').show();
        }

        function showResulGraphic() {
            $('#result-grafica').show();
        }

        function showResulGraphicFac() {
            $('#result-grafica-fac').show();
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <x-sidebar :btns="config('sidebar_item.statistics')" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 col-xxl-10 mt-2">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-list-task"></i>
                            <span>Formulario de busqueda</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Tipo *</label>
                                            <select id="ddlTipo"
                                                class="form-control form-textbox-input combo-textbox-input">
                                                <option value="">Seleccione</option>
                                                <option value="1">Todas las visitas</option>
                                                <option value="6">Videollamadas</option>
                                                <option value="0">Facturas + Presupuestos + Albaranes + Devoluciones
                                                </option>
                                                <option value="2">Facturas</option>
                                                <option value="3">Presupuestos</option>
                                                <option value="4">Albaranes</option>
                                                <option value="5">Devoluciones</option>
                                            </select>
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Profesionales</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                id="ddlDoctor" name="ddlDoctor">
                                                <option value="">Todos</option>
                                                <option value="2">MARTINEZ, JHONNY</option>
                                            </select>
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Tipos de cita</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                id="ddlTipoCita" name="ddlTipoCita">
                                                <option value="">Todos</option>
                                                <option value="4">Control</option>
                                                <option value="3">Emergencia</option>
                                                <option value="1">Primera Visita</option>
                                                <option value="-1">Asistencia</option>
                                                <option value="-2">Cita presencial</option>
                                            </select>
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Despachos</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                id="ddlDespachos" name="ddlDespachos">
                                                <option value="">Todos</option>
                                                <option value="3">Caracas</option>
                                                <option value="1">Room 1</option>
                                                <option value="2">Room 2</option>
                                            </select>
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Aseguradoras</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                id="ddlSociedades" name="ddlSociedades">
                                                <option value="">Todos</option>
                                                <option value="2">Matrix</option>
                                                <option value="1">Private patient</option>
                                            </select>
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Sexo</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                id="ddlPacienteGenero" name="ddlPacienteGenero">
                                                <option value="">Todos</option>
                                                <option value="2">Masculino</option>
                                                <option value="1">Femenino</option>
                                                <option value="0">Sin determinar</option>
                                            </select>
                                            <i class="bi bi-gender-ambiguous"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                        <label class="floating-label">Estado Civil</label>
                                        <select class="form-control form-textbox-input combo-textbox-input"
                                            id="ddlPacienteEstado" name="ddlPacienteEstado">
                                            <option value="">Todos</option>
                                            <option value="1">Soltero/a</option>
                                            <option value="2">Casado/a</option>
                                            <option value="3">Divorciado/a</option>
                                            <option value="4">Viudo/a</option>
                                        </select>
                                        <i class="bi bi-blockquote-left"></i>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                        <label class="floating-label">Referidos</label>
                                        <select class="form-control form-textbox-input combo-textbox-input"
                                            id="ddlReferidosPaciente" name="ddlReferidosPaciente">
                                            <option value="">Todos
                                            </option>
                                            <option value="-1">
                                                Doctores Clínica</option>
                                            <option value="d-2">JHONNY
                                                MARTINEZ</option>
                                            <option value="-2">
                                                Doctores Paciente</option>
                                            <option value="-1">
                                                Clínica</option>
                                            <option value="c-Sqlapios">
                                                Sqlapios</option>
                                            <option value="-2">
                                                Clínicas Paciente</option>
                                        </select>
                                        <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Paciente referido</label>
                                            <input
                                                class="input-append form-control form-textbox-input ui-autocomplete-input"
                                                id="txtPacienteReferido" name="txtPacienteReferido" type="text"
                                                value="" autocomplete="off">
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Edad desde</label>
                                            <input
                                                class="input-append form-control form-textbox-input ui-autocomplete-input"
                                                id="txtPacienteReferido" name="txtPacienteReferido" type="text"
                                                value="" autocomplete="off">
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Edad hasta</label>
                                            <input
                                                class="input-append form-control form-textbox-input ui-autocomplete-input"
                                                id="txtPacienteReferido" name="txtPacienteReferido" type="text"
                                                value="" autocomplete="off">
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <div class="Icon-inside">
                                            <label class="floating-label">Paciente referido</label>
                                            <input
                                                class="input-append form-control form-textbox-input ui-autocomplete-input"
                                                id="txtPacienteReferido" name="txtPacienteReferido" type="text"
                                                value="" autocomplete="off">
                                            <i class="bi bi-blockquote-left"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Fecha de
                                            dasde</label>
                                        <input class="form-control inputChange" id="dateNacNew" name="dateNacNew"
                                            type="date" value="">
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                    <div class="floating-label-group">
                                        <label for="exampleFormControlTextarea1" class="floating-label">Fecha de
                                            hasta</label>
                                        <input class="form-control inputChange" id="dateNacNew" name="dateNacNew"
                                            type="date" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                <button type="button" onclick="showResulTable()" class="btn btnSecond">Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <i class="bi bi-list-task"></i>
                                <span>Gráfica</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-2">
                                        <div class="floating-label-group">
                                            <label class="floating-label">Rango</label>
                                            <select class="form-control form-textbox-input combo-textbox-input valid"
                                                data-val="true" data-val-number="The field Genero must be a number."
                                                data-val-required="Género es requerido" id="SEX_ID"
                                                name="PACIENTE.SEX_ID" title="Sexo">
                                                <option value="1">Diario</option>
                                                <option value="2">Semanal</option>
                                                <option value="3">Mensual</option>
                                                <option value="4">Anual</option>
                                            </select>
                                            <span class="text-danger msgError field-validation-valid"
                                                data-valmsg-for="PACIENTE.SEX_ID" data-valmsg-replace="true"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                        <button type="" onclick="showResulGraphic()"
                                            class="btn btnPrimary">Grafica Paciente</button>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 mt-3">
                                        <button type="" onclick="showResulGraphicFac()"
                                            class="btn btnPrimary">Grafica Facturacion</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="result-table" style="display: none" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <i class="bi bi-list-task"></i>
                                <span>Resultado de la consulta:</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div id="table-patients" style="margin-top: 20px; width: 100%;">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N-Historia</th>
                                                    <th scope="col">Apellidos</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Profesional</th>
                                                    <th scope="col">Tipo de cita</th>
                                                    <th scope="col">Compania</th>
                                                    <th scope="col">Diagnostico</th>
                                                    <th scope="col">Importe</th>
                                                    <th scope="col">pagado</th>
                                                    <th scope="col">Forma de pago</th>
                                                    <th scope="col">Cuenta bancaria</th>
                                                    <th scope="col">Quien cobra</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listUser as $key => $item)
                                                    <tr>
                                                        <td>{{ $item['nunHistory'] }}</td>
                                                        <td>{{ $item['lastName'] }} </td>
                                                        <td>{{ $item['names'] }}</td>
                                                        <td>{{ $item['profesional'] }}</td>
                                                        <td>{{ $item['typeCita'] }}</td>
                                                        <td>{{ $item['company'] }}</td>
                                                        <td>{{ $item['diagnostico'] }}</td>
                                                        <td>{{ $item['import'] }}</td>
                                                        <td>{{ $item['pagado'] }}</td>
                                                        <td>{{ $item['typePayment'] }}</td>
                                                        <td>{{ $item['ctaBank'] }}</td>
                                                        <td>{{ $item['cobra'] }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <li class="page-item">
                                                        <p style="color: black" class="page-link" href="#"
                                                            aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </p>
                                                    </li>
                                                    <li class="page-item">
                                                        <p style="color: black" class="page-link" href="">1</p>
                                                    </li>
                                                    <li class="page-item">
                                                        <p style="color: black" class="page-link" href="">2</p>
                                                    </li>
                                                    <li class="page-item">
                                                        <p style="color: black" class="page-link" href="#"
                                                            aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="result-grafica" style="display: none" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <i class="bi bi-list-task"></i>
                                <span>Gráfica de pacientes:</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div id="grafica" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                        <x-graphic-result />

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="result-grafica-fac" style="display: none" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <i class="bi bi-list-task"></i>
                                <span>Gráfica de facturación</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div id="grafica" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                        <x-graphic-facture />

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
