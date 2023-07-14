@extends('layouts.app-auth')
@section('title', 'Centros')
<style>
    .datepicker-switch {
        background-color: #44525F !important;
    }
</style>
@push('scripts')
@vite(['resources/js/centers.js']);
    <script>
        $(document).ready(() => {
            $("#datepicker").datepicker({
                language: 'es',
                startDate: '-3d'

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
                        <div class="card-header">
                            <h5>Centros</h5>
                        </div>
                        <div class="card-header">
                            <h5>Dr./Dra. MARTINEZ, JHONNY</h5>
                        </div>
                        <div class="card-body">
                            <div id="table-patients"
                                style="margin-top: 20px; width: 100%;">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Horas</th>
                                            <th scope="col">Paciente</th>
                                            <th scope="col">Aseguradora</th>
                                            <th scope="col">Tipo de visitia</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Contactar</th>
                                            <th scope="col">Ultima Visita</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listUser as $key => $item)
                                            <tr>
                                                <td>{{ $item['hr'] }}</td>
                                                <td>{{ $item['patient'] }} <i class="bi bi-pencil-fill p-2"></i><i class="bi bi-eye-fill"></i></td>
                                                <td>{{ $item['aseguradora'] }}</td>
                                                <td>{{ $item['typeVisit'] }}</td>
                                                <td><select id="" style="    height: 40px; background-color:#44525F !important;color:white" class="editable" title="En consulta: 12/06/2023 14:41"><option value="1" style="background-color:#cbf8cc !important;color:black">Por llegar</option><option value="3" style="background-color:#fffece !important;color:black">En espera</option><option selected="selected" value="4" style="background-color:#44525F !important;color:black">En consulta a las 14:41</option><option value="5" style="background-color:#5f9dca !important;color:black">Finalizada</option><option value="6" style="background-color:#c9c9c9 !important;color:black">No asistencia</option></select></td>
                                                <td>{{ $item['phone'] }}</td>
                                                <td><i class="bi bi-phone-vibrate-fill  p-2"></i><i class="bi bi-envelope-fill"></i></td>
                                                <td>{{ $item['lastVisit'] }}</td>
                                                <td> <a href="{{route('ClinicalHistory')}}"><button type="button" class="btn btnPrimary">Clinica</button></a></td>
                                            </tr>
                                        @endforeach
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
                                            <li class="page-item">
                                                <p style="color: black" class="page-link" href="">1</p>
                                            </li>
                                            <li class="page-item">
                                                <p style="color: black" class="page-link" href="">2</p>
                                            </li>                                           
                                            <li class="page-item">
                                                <p style="color: black" class="page-link" href="#" aria-label="Next">
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

        </div>
    </div>
@endsection
