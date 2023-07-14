@extends('layouts.app-auth')
@section('title', 'Configuración')
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <x-sidebar :btns="config('sidebar_item.setting')" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 md-10 lg-10 xl-10 xxl-10">
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
