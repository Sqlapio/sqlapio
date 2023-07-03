@extends('layouts.app-auth')
@section('title', 'Detalle Médico')
<script src="{{ asset('jquery-ui-1.13.2/external/jquery/jquery.js') }}" type="text/javascript"></script>

<style>
    .ditaily-patients {
        font-size: 15px;
        text-align: justify
    }

    .btns {
        font-size: 10px;
    }

    .button-patients-padre {
            text-align: left !important;
            display: flex;
        }

        .button-patients-hijo {
            width: 100% !important;
        }

        .hijo2 {
            margin-top: 0% !important;
        }
    @media screen and (max-width: 600px) {
        .btn {
            margin: 10px 10px 10px 10px !important;
        }

        .button-patients-padre {
            text-align: left !important;
            display: flex;
        }

        .button-patients-hijo {
            width: 100% !important;
        }

        .hijo2 {
            margin-top: 0% !important;
        }

    }
</style>
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-md-center" style="margin-top: 0">
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                <button type="" class="btn btnPrimary">Visita
                                    rapida</button>
                            </div>
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                <button type="" class="btn btnSecond ">Portal
                                    pacientes</button>
                            </div>
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                <button type="" class="btn btnSecond ">Enviar
                                    SMS</button>
                            </div>
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                <button type="" class="btn btnPrimary">Email</button>
                            </div>
                        </div>

                        <div class="row justify-content-md-center mt-1">
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                <button type="" class="btn btnPrimary">Editar</button>
                            </div>
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                <button type="" class="btn btnPrimary">Bloques de
                                    citas</button>
                            </div>
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                <button type="" class="btn btnPrimary">Citas de
                                    pacientes</button>
                            </div>
                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2"><button type="" class="btn btnPrimary">Borrar
                                    Paciente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                <div class="card">
                    <div class="card-body">
                        <x-sidebar :btns="config('sidebar_item.patients')" />
                    </div>
                </div>
            </div>
            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <div>
                                <div class="patients-div">
                                    <div class="img">
                                        <img src="{{ asset('img/People-Client-Male-icon.png') }}" alt="Imagen del paciente"
                                            class="" style="width:85px; height:64px;">
                                    </div>
                                    <div class="button-patients-padre margin-global">
                                        <div class="button-patients-hijo">
                                            <button type="button" class="btn  bnt2 btnPrimary">Nueva</button>
                                        </div>
                                        <div class="button-patients-hijo  hijo2 margin-global">
                                            <button type="button" class="btn bnt2 btnPrimary">Subir</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="ditaily-patients">
                                        <strong>Nombre y Apellidos:</strong>
                                        <br>
                                        <span>Gloriany Perez</span>
                                        <br>
                                        <strong>Fecha de registro:</strong>
                                        <br>
                                        <span>06/06/2023</span>
                                        <br>
                                        <strong>Nº Historial:</strong>
                                        <br>
                                        <span>5</span>
                                        <br>
                                        <strong>CPN/Usuario Portal de Paciente:</strong>
                                        <br>
                                        <span>0002066000000005</span>
                                        <br>
                                        <strong>Password portal:</strong>
                                        <br>
                                        <span> 0412-123-4561</span>
                                        <br>
                                        <strong>Fecha nacimiento:</strong>
                                        <br>
                                        <span>martes, 6 de junio de 1989 (34 años)</span>
                                        <br>
                                        <strong>Profesión:</strong>
                                        <br>
                                        <span>Arquitecto</span>
                                        <br>
                                        <strong>Teléfono/SMS:</strong>
                                        <br>
                                        <span>0412-123-4561</span>
                                        <br>
                                        <strong>Email:</strong>
                                        <br>
                                        <span>Emial.@gmail.com</span>
                                        <br>
                                        <strong>Dirección:</strong>
                                        <br>
                                        <span>Dirección colinas de palo grande</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 md-8 lg-8 xl-8 xxl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <x-graphic />

                            </div>
                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Aseguradora</label>
                                    <input autocomplete="off" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" type="text" value="" disabled>
                                </diV>
                            </div>
                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Referido</label>
                                    <input autocomplete="off" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" type="text" value="" disabled>
                                </diV>
                            </div>
                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">

                                <div class="floating-label-group">
                                    <label for="exampleFormControlTextarea1" class="floating-label">Nota</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" disabled></textarea>
                                </div>
                            </div>
                            <div id="table-patients" class="col-sm-12 md-12 lg-12 xl-12 xxl-12"
                                style="margin-top: 20px; width: 100%;">
                                <h6>Próximas visitas</h6>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Profesional</th>
                                            <th scope="col">Tipo de visita</th>
                                            <th scope="col">Tipo de cita</th>
                                            <th scope="col">Estado de Cita</th>
                                            <th scope="col">Eliminar </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>04/04/2000</td>
                                            <td>Jhonny Martinez</td>
                                            <td>Consulta</td>
                                            <td>Control</td>
                                            <td>On Clinics</td>
                                            <td class="text-center"><i class="bi bi-trash3-fill"></i></td>
                                        </tr>
                                    </tbody>
                                </table>                                
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <p style="color: black" class="page-link" href="#"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </p>
                                            </li>
                                            <li class="page-item"><p style="color: black" class="page-link"
                                                    href="">1</p></li>
                                            <li class="page-item"><p style="color: black" class="page-link"
                                                    href="">2</p></li>
                                            <li class="page-item"><p style="color: black" class="page-link"
                                                    href="">3</p></li>
                                            <li class="page-item">
                                                <p style="color: black" class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </p>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                
                            </div>
                            <div id="table-patients" class="col-sm-12 md-12 lg-12 xl-12 xxl-12"
                                style="margin-top: 20px; width: 100%;">
                                <h6>Últimas visitas</h6>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Profesional</th>
                                            <th scope="col">Tipo de visita</th>
                                            <th scope="col">Tipo de cita</th>
                                            <th scope="col">Estado de Cita</th>
                                            <th scope="col">Eliminar </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>04/04/2000</td>
                                            <td>Jhonny Martinez</td>
                                            <td>Consulta</td>
                                            <td>Control</td>
                                            <td>On Clinics</td>
                                            <td class="text-center"><i class="bi bi-trash3-fill"></i></td>
                                        </tr>
                                    </tbody>
                                </table>                      
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <p style="color: black" class="page-link" href="#"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </p>
                                            </li>
                                            <li class="page-item"><p style="color: black" class="page-link"
                                                    href="">1</p></li>
                                            <li class="page-item"><p style="color: black" class="page-link"
                                                    href="">2</p></li>
                                            <li class="page-item"><p style="color: black" class="page-link"
                                                    href="">3</p></li>
                                            <li class="page-item">
                                                <p style="color: black" class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </p>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                
                            </div>
                            <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                                <button type="" class="btn btnPrimary"><span
                                        class="">Guardar</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
