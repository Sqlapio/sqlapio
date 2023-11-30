@extends('layouts.app-auth')
@section('title', 'Gestión Pacientes')
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
                            <i class="bi bi-hospital"></i>Gestión Pacientes
                        </button>
                    </span>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                        <div class="accordion-body">
                         
                            <div class="table-responsive" id="table-patients" style="margin-top: 20px; width: 100%;">
                                <table id="table-centers" class="table table-striped table-bordered" style="width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">Nombre de centro</th>
                                            <th class="text-center">Dirección</th>
                                            <th class="text-center">Piso</th>
                                            <th class="text-center">Número de consultorio</th>
                                            <th class="text-center">Teléfono del consultorio</th>
                                            <th class="text-center">Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($doctor_centers as $key => $item)
                                            <tr>
                                                <td class="text-center pt-2">{{ $item['center'] }}</td>
                                                <td class="text-center">{{ $item['address'] }}</td>
                                                <td class="text-center">{{ $item['number_floor'] }}</td>
                                                <td class="text-center">{{ $item['number_consulting_room'] }}</td>
                                                <td class="text-center">{{ $item['phone_consulting_room'] }}</td>
                                                <td class="text-center table-check w-5">
                                                    <div class="form-check form-switch ">
                                                        <input onchange="handlerCenter(event);" style="width: 5em"
                                                            class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked" value="{{ $item['id'] }}"
                                                            {{ $item['status'] != '1' ? '' : 'checked' }}>
                                                    </div>
                                            </tr>
                                        @endforeach --}}
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
