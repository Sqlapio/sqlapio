@extends('layouts.app-auth')
@section('title', 'Plan')

@section('content')
    <div>
        <div class="container-fluid" style="padding: 0 3% 3%">
            <div class="row mt-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="accordion" id="accordion">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingPlanes">
                                <button class="accordion-button bg-8" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePlanes" aria-expanded="true" aria-controls="collapsePlanes"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-info-lg"></i> @lang('messages.acordion.informacion_plan')
                                </button>
                            </span>
                            <div id="collapsePlanes" class="accordion-collapse collapse show" aria-labelledby="headingPlanes" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    @livewire('components.view-planes')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <div>
@endsection

