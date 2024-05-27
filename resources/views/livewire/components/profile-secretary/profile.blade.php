@extends('layouts.app-auth')
@section('title', 'Perfil')
@section('content')
    <div class="container-fluid body" style="padding: 0 3% 3%">
        <div class="accordion" id="accordion">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                    <div class="accordion-item ">
                        <span class="accordion-header title" id="headingOne">
                            <button class="accordion-button bg-1" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                <i class="bi bi-graph-up"></i> Datos del usuario
                            </button>
                        </span>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="accordion-body">

                                <form id="form-profile-force-sale" method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="row Form-edit-user">
                            
                            
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                    <input autocomplete="off" placeholder="" class="form-control mask-text" id="name"
                                                        name="name" type="text" {{-- value="{!! !empty($user) ? $user->name : '' !!}"> --}} value="{{ Auth::user()->name }}">
                            
                                                    <i class="bi bi-person-circle" style="top: 30px"></i>
                                                </div>
                                            </diV>
                                        </div>
                            
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="last_name" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                    <input autocomplete="off" placeholder="" class="form-control mask-text" id="last_name"
                                                        name="last_name" type="text" value="{{ Auth::user()->last_name }}">
                                                    <i class="bi bi-person-circle" style="top: 30px"></i>
                                                </div>
                                            </diV>
                                        </div>
                            
                            
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="ci" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Cédula
                                                        de identidad</label>
                                                    <input autocomplete="off" placeholder="" type="number" class="form-control" id="ci"
                                                        name="ci" type="text" value="{{ Auth::user()->ci }}">
                                                    <i class="bi bi-person-vcard" style="top: 30px"></i>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="genere" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Género</label>
                                                    <select name="genere" id="genere" placeholder="Seleccione"class="form-control"
                                                        class="form-control combo-textbox-input">
                                                        <option value="">Seleccione</option>
                                                        <option value="femenino"> Femenino</option>
                                                        <option value="masculino">Masculino</option>
                                                    </select>
                                                    <i class="bi bi-gender-ambiguous st-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="username" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                        electrónico</label>
                                                    <input autocomplete="off" placeholder="" class="form-control" id="username" name="username"
                                                        type="text" readonly value="{{ Auth::user()->email }}">
                                                    <i class="bi bi-envelope-at" style="top: 30px"></i>
                                                </div>
                                            </diV>
                                        </div>
                            
                           
                            
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Teléfono</label>
                                                    <input autocomplete="off" placeholder="" class="form-control phone" id="phone"
                                                        name="phone" type="text" value="{{ Auth::user()->phone }}">
                                                    <i class="bi bi-telephone-forward" style="top: 30px"></i>
                                                </div>
                                            </diV>
                                        </div>
                            
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                            <div class="form-group">
                                                <div class="Icon-inside">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Dirección</label>
                                                    <textarea id="address" rows="3" name="address" class="form-control" value="{{ Auth::user()->address }}"></textarea>
                                                    <i class="bi bi-geo st-icon"></i>
                                                </div>
                                            </diV>
                                        </div>
                            
                            
                                        <x-upload-image :title="'Cargar imagen'" />
                            
                                    </div>
                                    <div class="row mt-3 justify-content-md-end">
                                        <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                            style="display: flex; justify-content: flex-end; align-items: flex-end;">
                                            <input class="btn btnSave send " value="Guardar" type="submit" style="margin-left: 20px" />
                                            {{-- <button type="button" class="btn btnSecond btn6"
                                                style="margin-left: 20px">Cancelar</button> --}}
                                        </div>
                                        <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <div id="spinner" style="display: none">
                                                <x-load-spinner />
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
