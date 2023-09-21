@extends('layouts.app-auth')
@section('title', 'Configuración')
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <x-sidebar :btns="config('sidebar_item.setting')" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 col-xxl-10">
                    <div class="card">
                        <div class="card-body">
                            <x-data-company/>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
