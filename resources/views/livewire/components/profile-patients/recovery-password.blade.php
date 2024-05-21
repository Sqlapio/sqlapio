@extends('layouts.app')
@section('title', 'Recuperación de contraseña')
<style>
    .mt {
        margin-top: 10rem !important;
    }

    .logoSq {
        width: 50% !important;
        height: auto;
        margin-top: -15% !important;
        margin-bottom: -15% !important;
    }

    @media only screen and (max-width: 390px) {
        .btn2 {
            margin-left: 20px;
        }

        .logoSq {
            width: 30%;
            height: auto;
            margin-top: -14% !important;
        }
    }

    @media only screen and (max-width: 768px) {

        .btn2 {
            margin-left: 20px;
        }

    }
</style>
@push('scripts')
    <script>
        let opt = '';
        $(document).ready(function() {

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            $('#form-recovery-pat').validate({
                rules: {
                    document_number: {
                        required: true,
                    },
                },
                messages: {

                    document_number: {
                        required: "@lang('messages.alert.cedula_obligatoria')",
                    }

                }
            });
        });

        const handlerSubmit = () => {

            $("#form-recovery-pat").validate();

            if ($("#form-recovery-pat").valid()) {

                $('#btnPrimary').attr("disabled",true);

                $('#spinner').show();

                $.ajax({
                    url: '{{ route('handleRecoveryPass') }}',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "document_number": $("#document_number").val(),
                    },
                    success: function(response) {
                        $('#spinner').hide();

                        Swal.fire({
                            icon: 'success',
                            title: '@lang('messages.alert.recuperar_contraseña')',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        }).then((result) => {
                            window
                                .location =
                                '{{ route('query-detaly-patient') }}';
                        });
                    },
                    error: function(error) {
                        $('#spinner').hide();


                        Swal.fire({
                            icon: 'error',
                            title: error
                                .responseJSON
                                .msj,
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: '@lang('messages.botton.aceptar')'
                        })
                    }
                });
            }
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <div id="spinner" style="display: none">
                <x-load-spinner />
            </div>
            <div class="row form-sq" style="position: relative">
                <div class="col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl loginDric">
                    <div class="">
                        <div class="row mt-2" style="display: grid; justify-items: center;">
                            <img class="img" src="{{ asset('img/recuperar.png') }}" style="width: 355px;">
                        </div>
                    </div>
                    {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-recovery-pat']) }}
                    <div class="row" id="content-recovery-email">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="form-group">
                                <div class="Icon-inside">
                                    <input autocomplete="off" class="form-control alpha-no-spaces" id="document_number"
                                        name="document_number" type="text" value=""
                                        placeholder="@lang('messages.form.cedula_identidad')">
                                    <i class="bi bi-envelope" style="top: 2px !important;"></i>
                                </div>
                            </diV>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3 mb-3"
                            style="display: flex; justify-content: space-around;">
                            <div class="d-flex justify-content-center">
                                <input class="btn btnPrimary" value="@lang('messages.botton.recuperar')" onclick="handlerSubmit()"
                                    type="text" style="margin-top: 0px; margin-right: 20px; " />
                                <a href="{{ route('query-detaly-patient') }}"><button type="button"
                                        class="btn btnSecond btn2">@lang('messages.botton.cancelar')</button></a>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection
