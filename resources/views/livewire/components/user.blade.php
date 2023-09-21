@extends('layouts.app-auth')
@section('title', 'Usuarios')
<style>
    img {
        margin-left: 10px;
        margin-bottom: 15px;
    }
</style>
@push('scripts')    
<script>
    function ShowformUser(item) {
     
        console.log(item);
        $("#names").val(item.names);
        $("#lastname").val(item.lastName);
        $("#phone").val(item.phone);
        $("#email").val(item.email);
        $("#province").val(item.province);
        $("#country").val(item.country);
        $("#dataNac").val(item.dateNac);
        $("#nif").val(item.nif);
        $("#adress").val(item.adress);
        $("#languaje").val(item.languaje);



        $('.Form-edit-user').show();

    }

    function showModal() {
        $('#modal-info').show();
    }
</script>
@endpush
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
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                    <div class="card">
                        <div class="card-body">
                            <div id="table-patients" class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                style="margin-top: 20px; width: 100%;">
                                <h6 class="collapseBtn">Crear / Editar usuarios en DriCloud Soporte</h6>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Apellido</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Nombre de Usuario</th>
                                            <th scope="col">Perfiles</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listUser as $key => $item)
                                            <tr onclick="ShowformUser({{json_encode($item)}});">
                                                <td>{{ $item['names'] }}</td>
                                                <td>{{ $item['lastName'] }}</td>
                                                <td>{{ $item['phone'] }}</td>
                                                <td>{{ $item['user'] }}</td>
                                                <td>{{ $item['rol'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
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
                            {{-- form-user-edit --}}
                            <div class="row mt-3 Form-edit-user" style="display: none">

                                {{ Form::open(['url' => '#', 'method' => 'post', 'id' => 'form-login']) }}
                                <div class="row">
                                    <hr>
                                    <div>
                                        <h5 class="collapseBtn">Datos personales </h5>
                                    </div>
                                    <hr>
                                    {{ csrf_field() }}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $message)
                                                <span class="text-danger error-span">
                                                    {{ $message }}</span><br />
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Nombres"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Apellidos"
                                                    class="form-control @error('lastname') is-invalid @enderror"
                                                    id="lastname" name="lastname" type="text" value="">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Telefono"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    id="phone" name="phone" type="text" value="">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email" type="text" value="">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Direccion"
                                                    class="form-control @error('adress') is-invalid @enderror"
                                                    id="adress" name="adress" type="text" value="">
                                                <i class="bi bi-compass"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Provincia"
                                                    class="form-control @error('province') is-invalid @enderror"
                                                    id="province" name="province" type="text" value="">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Pais"
                                                    class="form-control @error('country') is-invalid @enderror"
                                                    id="country" name="country" type="text" value="">
                                                <i class="bi bi-compass"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="NIF/CIF"
                                                    class="form-control @error('nif') is-invalid @enderror"
                                                    id="nif" name="nif" type="text" value="">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="floating-label-group">
                                            <input placeholder="Fecha de Nacimiento" class="form-control"
                                                id="dataNac" name="dataNac" type="date" value="">
                                        </div>
                                    </diV>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Idioma para esta plataforma"
                                                    class="form-control @error('languaje') is-invalid @enderror"
                                                    id="languaje" name="languaje" type="text" value="">
                                                <i class="bi bi-flag"></i>
                                            </div>
                                        </diV>
                                    </div>

                                    <x-upload-image />

                                    <hr>
                                    <div style="display: flex">
                                        <div>
                                            <h5 class="collapseBtn">Especialidades</h5>
                                        </div>
                                        <div>
                                            <button type="button" class="" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="bi bi-question-diamond-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" checked="checked" name="checked"
                                                        type="checkbox" id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Anestesiología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Cardiología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Dermatología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Endocrinología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Gastroenterología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Geriatría
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Ginecología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Gynecology
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Hematología
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Infectología </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Medicina familiar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Medicina intensiva
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Medicina interna
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Odontology
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Traumatology
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input class="form-check" name="checked" type="checkbox"
                                                        id="checked">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Traumatology
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3 justify-content-md-end">
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <button type="button" class="btn btnPrimary btn5">Guardar</button>

                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Usuarios - Especialidades</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Selecciona la especialidad del profesional. Es muy recomendable que solo tenga una especialidad,
                            para simplificar la gestión de la agenda. Si el profesional tiene varias subespecialidades como
                            odontología general, odontólogo infantil, etc, utilizar una especialidad que englobe a todas,
                            como odontología.
                            Si no quieres mostrar el icono dentro del software puedes desactivarlo pulsando la Soporte
                            arriba a la derecha.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
