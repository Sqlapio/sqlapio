
<style>
    .card-plans {
        /* background-color: #ffffff !important; */
        -webkit-background-size: cover !important;
        -moz-background-size: cover !important;
        -o-background-size: cover !important;
        background-size: cover !important;
        background: url('/img/bg1.jpg') no-repeat center center;
        box-shadow: 0px 0px 11px 0px rgba(120, 116, 116, 0.7);
        border-radius: 20px !important;
        font-size: 13px;
        width: 100%;;
    }

    .count-plan-0 {
        color: red
    }

    .count-plan {
        color: #459594
    }

    .custom-popover {
        --bs-popover-max-width: 200px;
        --bs-popover-border-color: var(--bd-violet-bg);
        --bs-popover-header-bg: var(--bd-violet-bg);
        --bs-popover-header-color: var(--bs-white);
        --bs-popover-body-padding-x: 1rem;
        --bs-popover-body-padding-y: .5rem;
    }

    .title-card {
        font-size: 20px;
        color: #133837;
        text-align: start;
        font-weight: normal;
    }

</style>
<script>
    $(document).ready(() => {

        let user = @json(Auth::user());

        switch_type_plane(user.type_plane);
        $('#form-payment-renew').validate({
            ignore: [],
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                amount: {
                    required: true,
                },
                number_id: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                number_card: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,

                },
                code_card: {
                    required: true,
                    maxlength: 3,
                },
                methodo_payment: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: {
                    required: "Nombres es obligatorio",
                },
                last_name: {
                    required: "Apellidos es obligatorio",
                },
                amount: {
                    required: "Monto es obligatorio",
                },
                number_id: {
                    required: "Numero de cedula es obligatorio",
                },
                number_card: {
                    required: "Numero de tarjeta es obligatorio",
                },
                code_card: {
                    required: "Codigo de tarjeta es obligatorio",
                },
                methodo_payment: {
                    required: "Debe Selecciones un metodo de pago",
                },
                email: {
                    required: "Correo electronico es obligatorio",
                },
            }
        });



        $.validator.addMethod("onlyNumber", function(value, element) {
            var pattern = /^\d+\.?\d*$/;
            return pattern.test(value);
        }, "Campo solo numero");

        //envio del formulario
        $("#form-payment-renew").submit(function(event) {
            event.preventDefault();
            $("#form-payment-renew").validate();
            if ($("#form-payment-renew").valid()) {
                $('#send').hide();
                $('#spinner2').show();
                var data = $('#form-payment-renew').serialize();
                $.ajax({
                    url: "{{ route('pay-plan-renew') }}",
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#send').show();
                        $('#spinner2').hide();
                        // $("#form-payment-renew").trigger("reset");
                        $(".holder").hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Operacion exitosa!',
                            allowOutsideClick: false,
                            confirmButtonColor: '#42ABE2',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            let url =
                                "{{ route('Register', ':id') }}";
                            url = url.replace(':id', response.data);
                            window.location.href = url;

                        });
                    },
                    error: function(error) {
                        error.responseJSON.errors.map((elm) => {
                            Swal.fire({
                                icon: 'error',
                                title: elm,
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                $('#send').show().attr('disabled', true);;
                                $('#spinner2').hide();
                                $(".holder").hide();
                            });
                        });
                    }
                });
            }
        });

    })

    function renew_plan(action) {
        $('#planes-content-revew').hide();
        $('#planes-content-revew-select').hide();
        $('#ModalRenewPlanes').modal('show');
        if (action == 1) {
            $('#planes-content-revew').show();
        } else {
            $('#planes-content-revew-select').show();
        }
    }

    function handler_renew_plan(type_plan) {
        $('#planes-content-revew').show();
        switch_type_plane(type_plan);
    }

    function switch_type_plane(type_plane) {

        switch (Number(type_plane)) {
            case 1:

                $("#amount").val('0');
                $("#code_card").attr('disabled', true)
                $("#number_card").attr('disabled', true)
                $("#methodo_payment").attr('disabled', true)
                $('#free').show();
                $('#profesional').hide();
                $('#ilimitado').hide();

                break;
            case 2:
                $("#amount").val('$19.99');
                $("#code_card").attr('disabled', false);
                $("#number_card").attr('disabled', false);
                $("#methodo_payment").attr('disabled', false);
                $('#free').hide();
                $('#profesional').show();
                $('#ilimitado').hide();


                break;
            case 3:
                $("#amount").val('$39.99');
                $("#code_card").attr('disabled', false);
                $("#number_card").attr('disabled', false);
                $("#methodo_payment").attr('disabled', false);
                $('#free').hide();
                $('#profesional').hide();
                $('#ilimitado').show();

                break;

            default:
                break;
        }
    }

    document.querySelectorAll('[data-bs-toggle="popover"]')
        .forEach(popover => {
            new bootstrap.Popover(popover)
        })

        const popover = new bootstrap.Popover('.popover-dismiss', {
    trigger: 'focus'
})
</script>
<div>
    @if (auth()->user()->type_plane == 1)
        <div class="row">
            <h2 class="title-card fw-bold tile-planes-dos">Plan - Free</h2>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Pacientes</h5>
                                        <h3 class="{{ auth()->user()->patient_counter >= 10 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->patient_counter }}/10</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Consultas</h5>
                                        <h3 class="{{ auth()->user()->medical_record_counter >= 20 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->medical_record_counter }}/20</h3>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Exámenes</h5>
                                        <h3 class="{{ auth()->user()->ref_counter >= 20 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->ref_counter }}/20</h3>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Estudios </h5>
                                        <h3 class="{{ auth()->user()->ref_counter >= 20 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->ref_counter }}/20</h3>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl--12 mt-3 mb-3"
                style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btnPrimary">Pagar</button>
                <button type="button" class="btn btnSecond" style='margin-left: 20px'>Cambiar de plan</button>
            </div>
        </div>
    @endif
    @if (auth()->user()->type_plane == 2)
        <div class="row">
            <h2 class="title-card fw-bold tile-planes-dos">Plan - Profesional</h2>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Pacientes</h5>
                                        <h3 class="{{ auth()->user()->patient_counter >= 40 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->patient_counter }}/40</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Consultas</h5>
                                        <h3 class="{{ auth()->user()->medical_record_counter >= 40 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->medical_record_counter }}/40</h3>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Exámenes</h5>
                                        <h3 class="{{ auth()->user()->ref_counter >= 80 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->ref_counter }}/80</h3>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3" style="display: flex; justify-content: center;">
                        <div class="card mt-3 card-plans">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h5 class="fw-bold" style="color: #133837">Estudios</h5>
                                        <h3 class="{{ auth()->user()->ref_counter >= 80 ? 'count-plan-0' : 'count-plan' }}">{{ auth()->user()->ref_counter }}/80</h3>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl--12 mt-3 mb-3"
                style="display: flex; justify-content: flex-end;">
                <button type="button" onclick="renew_plan(1)" class="btn btnPrimary">Renovar</button>
                <button type="button" onclick="renew_plan(2)"class="btn btnSecond" style='margin-left: 20px'>Cambiar de plan</button>
            </div>
            {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title tile-planes-dos">Mi plan Profesional</h1>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold tile-planes">40 Pacientes</div>
                                    Cupos consumidos:
                                </div>
                                <span
                                    class="{{ auth()->user()->patient_counter >= 40 ? 'badge bg-danger rounded-pill' : 'badge bg-success rounded-pill' }}">{{ auth()->user()->patient_counter }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold tile-planes">40 Consultas</div>
                                    Cupos consumidos:
                                </div>
                                <span
                                    class="{{ auth()->user()->medical_record_counter >= 40 ? 'badge bg-danger rounded-pill' : 'badge bg-success rounded-pill' }}">{{ auth()->user()->medical_record_counter }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold tile-planes">80 Examnenes</div>
                                    Cupos consumidos:
                                </div>
                                <span
                                    class="{{ auth()->user()->ref_counter >= 80 ? 'badge bg-danger rounded-pill' : 'badge bg-success rounded-pill' }}">{{ auth()->user()->ref_counter }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold tile-planes">80 Estudios</div>
                                    Cupos consumidos:
                                </div>
                                <span
                                    class="{{ auth()->user()->ref_counter >= 80 ? 'badge bg-danger rounded-pill' : 'badge bg-success rounded-pill' }}">{{ auth()->user()->ref_counter }}</span>
                            </li>
                        </ol>
                        <div class="row justify-content-center mt-3">
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <button type="button" onclick="renew_plan(1)" class="btn btnPrimary">Renovar</button>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <button type="button" onclick="renew_plan(2)"class="btn btnSecond">Cambiar de
                                    plan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    @endif

    <!-- Modal para renover el plan-->
    <div class="modal fade" id="ModalRenewPlanes" tabindex="-1" aria-labelledby="ModalRenewPlanesLabel"
        aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div id="spinner" style="display: none">
            <x-load-spinner show="true" />
        </div>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header title">
                        <i class="bi bi-repeat"></i>
                        <span style="padding-left: 5px">Renovar plan</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="font-size: 12px;"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-sq">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3 mt-m3" id="div-form">
                                {{-- <div class="card mb-3 mt-m3" >
                                    <div class="card-body"> --}}
                                        <div id="div-content">
                                            <div class="container">
                                                <div class="row" style="display: grid; justify-items: center;">
                                                    <img class="logoSq"
                                                        src="{{ asset('img/logo sqlapio variaciones-03.png') }}"
                                                        alt="">
                                                </div>
                                            </div>
                                            {{-- seleccionar planes --}}
                                            <div class="row justify-content-center mt-3"
                                                id="planes-content-revew-select">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="display: flex; justify-content: space-around;">
                                                    <button type="button" onclick="handler_renew_plan(1)" class="btn btnPrimary">FREE</button>
                                                    <button type="button" onclick="handler_renew_plan(2)"class="btn btnPrimary">PROFESIONAL</button>
                                                    <button type="button" onclick="handler_renew_plan(3)"class="btn btnPrimary">ILIMITADO</button>
                                                </div>
                                            </div>
                                            {{-- formulario de pago --}}
                                            <div id="planes-content-revew" style="display: none">
                                                {{ Form::open(['url' => '', 'method' => 'post', 'id' => 'form-payment-renew']) }}
                                                <div class="row">
                                                    <input type="hidden" name="type_plan" id="type_plan">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                        <div id="free" style="display: none">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 10 <b>Pacientes</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Consultas</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Exámenes</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Estudios</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i>  <b style="text-decoration: line-through;">Estudios con videos</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Consultas en IA</b> </li>
                                                            </ul>
                                                        </diV>
                                                        <div id="profesional" style="display: none">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>Pacientes</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>Consultas</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>Exámenes</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>Estudios</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i>  <b style="text-decoration: line-through;">Estudios con videos</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Consultas en IA</b> </li>
                                                            </ul>
                                                        </diV>
                                                        <div id="ilimitado" style="display: none">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>Pacientes</b> Ilimitados</li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>Consultas</b> Ilimitados</li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>Exámenes</b> Ilimitados</li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>Estudios</b> Ilimitados</li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.10 por Gb <b>Estudios con videos</b></li>
                                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>Consultas en IA</b></li>
                                                            </ul>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Nombres</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-text @error('name') is-invalid @enderror"
                                                                    id="name" name="name" type="text"
                                                                    value="">
                                                                <i class="bi bi-person-circle st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3"
                                                        id="apellidos">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Apellidos</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-text @error('last_name') is-invalid @enderror"
                                                                    id="last_name" name="last_name" type="text"
                                                                    value="">
                                                                <i class="bi bi-person-circle st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">C.I</label>
                                                                <input autocomplete="off" class="form-control"
                                                                    id="number_id" name="number_id" type="text"
                                                                    value="">
                                                                <i class="bi bi-person-vcard-fill st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Correo
                                                                    eléctronico</label>
                                                                <input autocomplete="off" class="form-control"
                                                                    id="email" name="email" type="text"
                                                                    value="">
                                                                    <i class="bi bi-envelope-at st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>

                                                    <div
                                                        class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="methodo_payment" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Método
                                                                    de pago</label>
                                                                <select name="methodo_payment" id="methodo_payment"
                                                                    placeholder="Seleccione"class="form-control"
                                                                    class="form-control combo-textbox-input">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="1">Banco de Venezuela</option>
                                                                    <option value="2">Banco Mercantil</option>
                                                                    <option value="3">Banco Banesco</option>
                                                                    <option value="4">Bancamiga</option>
                                                                    <option value="5">Zelle</option>
                                                                </select>
                                                                <i class="bi bi-credit-card st-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3" style="padding-right: 0">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                            style="display: flex; align-items: center;
                                                     justify-content: flex-end; text-align: end; padding-right: 0">
                                                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                                <img class="logo-bank"
                                                                    src="{{ asset('img/mercantil-icon.jpg') }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                                <img class="logo-bank"
                                                                    src="{{ asset('img/banesco-icon.png') }}"
                                                                    alt="">
                                                            </div>


                                                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                                <img class="logo-bank"
                                                                    src="{{ asset('img/zelle-icon.png') }}"
                                                                    alt="">
                                                            </div>

                                                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                                <img class="logo-bank"
                                                                    src="{{ asset('img/bdv-icon.png') }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
                                                                <img class="logo-bank"
                                                                    src="{{ asset('img/bancamiga-icon.png') }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Número
                                                                    de
                                                                    tarjeta</label>
                                                                <input autocomplete="off" class="form-control"
                                                                    id="number_card" name="number_card"
                                                                    type="text" value="">
                                                                <i class="bi bi-credit-card st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Código
                                                                    de
                                                                    tarjeta</label>
                                                                <input autocomplete="off" class="form-control"
                                                                    id="code_card" name="code_card" type="text"
                                                                    value="">
                                                                <i class="bi bi-credit-card st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>
                                                    <div
                                                        class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="name" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Monto</label>
                                                                <input readonly autocomplete="off"
                                                                    class="form-control" id="amount"
                                                                    name="amount" type="text" value="">
                                                                <i class="bi bi-currency-dollar st-icon"></i>
                                                            </div>
                                                        </diV>
                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl--8 mt-3 mb-3"
                                                        style="display: flex; justify-content: center;">
                                                        <input class="btn btnSave send " value="Adquiere tu plan"
                                                            type="submit" style="margin-left: 20px" />
                                                    </div>
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    {{-- </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
