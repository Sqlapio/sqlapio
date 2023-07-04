@extends('layouts.app-auth')
@section('title', 'Perfil')
<script src="{{ asset('assets/jquery.js') }}"></script>
<style>
    .collapseBtn {
        color: #428bca;
    }

    img {
        margin-left: 10px;
        margin-bottom: 15px;
    }
</style>
<script> 
</script>

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
                        <div class="card-header">
                            <h5 class="collapseBtn">Datos personales </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3 Form-edit-user">

                                {{ Form::open(['url' => '#', 'method' => 'post', 'id' => 'form-login']) }}
                                <div class="row">
                                    {{ csrf_field() }}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $message)
                                                <span class="text-danger error-span">
                                                    {{ $message }}</span><br />
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Nombres"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Apellidos"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Telefono"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Email"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Direccion"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-compass"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Provincia"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Pais"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-compass"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="NIF/CIF"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Idioma para esta plataforma"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-flag"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Nombre de usuario"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username" type="text" value="">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <x-upload-image />

                                    <hr>
                                    <div class="row mt-3 justify-content-md-end">
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <button type="button" class="btn btnPrimary btn5">Guardar</button>

                                        </div>
                                        <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                            <button type="button" class="btn btnSecond btn6">Cancelar</button>

                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
