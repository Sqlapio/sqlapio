@extends('layouts.app-auth')
@section('title', 'Tablero')
{{-- @vite(['resources/js/graphic_laboratory_coun_study.js', 'resources/js/graphic_laboratory_coun_exam.js']) --}}
<style>
    .mt-gf {
        margin-top: 3rem !important;
    }

    @media screen and (max-width: 576px) {
        .mt-gf {
            margin-top: 0 !important;
        }
    }
</style>
@push('scripts')
    <script>
   
      
    </script>
@endpush
@section('content')
    <div>  
            <div class="container-fluid body" style="padding: 0 3% 3%">
                <div class="accordion" id="accordion">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                            <div class="accordion-item ">
                                <span class="accordion-header title" id="headingOne">
                                    <button class="accordion-button bg-1" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                        style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                        <i class="bi bi-graph-up"></i> Estadisticas
                                    </button>
                                </span>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
    </div>

@endsection
