@extends('layouts.app-auth')
@section('title', 'Planes')
<style></style>
@push('scripts')
    <script></script>
@endpush
@section('content')
    <div class="container-fluid" style="padding: 3%">
        <div class="accordion" id="accordion">
            <div>
                {{-- datos del paciente --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-8" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person"></i> Informacion de planes
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordion">
                                <div class="accordion-body">

                                    @if (auth()->user()->type_plane == 1)
                                        <div class="row justify-content-center">
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="card-title tile-planes-dos">Mi plan Free</h1>
                                                        <ol class="list-group list-group-numbered">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">10 Pacientes</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">20 Consultas</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">20 Examnenes</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">20 Estudios</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                        </ol>
                                                        <div class="row justify-content-center mt-3">
                                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                <button type="button" class="btn btnPrimary">pagar</button>

                                                            </div>
                                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                <button type="button"
                                                                    class="btn btnSecond">Actualizar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (auth()->user()->type_plane == 2)
                                        <div class="row justify-content-center">
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 class="card-title tile-planes-dos">Mi plan Profesional</h1>
                                                        <ol class="list-group list-group-numbered">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">20 Pacientes</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">80 Consultas</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">80 Examnenes</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold tile-planes">80 Estudios</div>
                                                                    Cupos consumidos:
                                                                </div>
                                                                <span
                                                                    class="badge bg-danger rounded-pill">{{ auth()->user()->patient_counter }}</span>
                                                            </li>
                                                        </ol>
                                                        <div class="row justify-content-center mt-3">
                                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                <button type="button" class="btn btnPrimary">pagar</button>

                                                            </div>
                                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                <button type="button"
                                                                    class="btn btnSecond">Actualizar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
