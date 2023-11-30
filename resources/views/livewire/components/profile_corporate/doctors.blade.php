@extends('layouts.app-auth')
@section('title', 'Gestión de Medicos')
<style>
  
</style>
@push('scripts')
    <script>   
    </script>
@endpush
@section('content')
<div class="container-fluid" style="padding: 0 3% 3%">
    <div class="row mt-2">
     
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-cd">
            <div class="accordion" id="accordion">
                <div class="accordion-item">
                    <span class="accordion-header title" id="headingOne">
                        <button class="accordion-button bg-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                            <i class="bi bi-hospital"></i>Gestión de medicos
                        </button>
                    </span>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                        <div class="accordion-body">
                         
                            <div class="table-responsive" id="table-patients" style="margin-top: 20px; width: 100%;">
                                <table id="table-centers" class="table table-striped table-bordered" style="width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">Nombre y apellidos</th>
                                            <th class="text-center">documento de identidad</th>
                                            <th class="text-center">Correo</th>
                                            <th class="text-center">Especialidad</th>
                                            <th class="text-center">Teléfono del consultorio</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dortors as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $item->name." ".$item->last_name }}</td>
                                                <td class="text-center">{{ $item->ci }}</td>
                                                <td class="text-center">{{ $item->email }}</td>
                                                <td class="text-center">{{ $item->specialty }}</td>
                                                <td class="text-center">{{ $item->phone}}</td>       
                                                <td class="text-center">
                                                    <div class="d-flex">
                                                        <div
                                                            class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                            <button
                                                                {{-- onclick="editPatien({{ json_encode($item->if) }},true); " --}}
                                                                type="button"
                                                                class="btn btn-iSecond rounded-circle"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="bottom" title="Editar">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                        </div>
                                                        {{-- <div
                                                            class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                            <a
                                                                href="{{ route('MedicalRecord', $item->get_paciente->id) }}">
                                                                <button type="button"
                                                                    class="btn btn-iPrimary rounded-circle"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="bottom"
                                                                    title="Consulta médica">
                                                                    <i class="bi bi-file-earmark-text"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div
                                                            class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                            <a
                                                                href="{{ route('ClinicalHistoryDetail', $item->get_paciente->id) }}">
                                                                <button type="button"
                                                                    class="btn btn-iSecond rounded-circle"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-placement="bottom"
                                                                    title="Historia Clínica">
                                                                    <i class="bi bi-file-earmark-text"></i>
                                                                </button>
                                                            </a>
                                                        </div> --}}
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

@endsection
