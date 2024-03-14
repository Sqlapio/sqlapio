
<div>

    <div class="container-fluid">
        <div id="spinner" style="display: none">
            <x-load-spinner />
        </div>
        <div class="row form-sq form-sq-mv">
            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 col-xxl-10">
                <div class="card mb-3 mt-m3" id="div-form">
                    <div class="card-body">
                        <div id="div-content">
                            <div class="container">
                                <div class="row" style="display: grid; justify-items: center;">
                                    <img class="logoSq" src="{{ asset('img/logo sqlapio variaciones-03.png') }}" alt="">
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2 mb-3" onclick="handleSelect('medico')">
                                        <img class="img-icon-select-rol ico-check medico" src="{{ asset('img/V2/Boton-Med.png') }}" alt="">
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2 mb-3" onclick="handleSelect('laboratorio')">
                                        <img class="img-icon-select-rol laboratorio" src="{{ asset('img/V2/Boton-Lab.png') }}" alt="">
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2 mb-3" onclick="handleSelect('corporativo')">
                                        <img class="img-icon-select-rol corporativo" src="{{ asset('img/V2/Boton-Cor.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="div-content-medico">
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                            <h5>Plan Free</h5></b>
                                        </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 10 <b>Pacientes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Consultas</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Exámenes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Estudios</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Estudios con videos</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Consultas en IA</b> </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Publicidad</b> </li>
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 mb-3" style="display: flex; justify-content: center;">
                                            <input class="btn btnSave" value="Adquiere tu plan" onclick="" style="margin-left: 20px" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                    {{--
                                            <button class="btn btnSave" style="margin-left: 20px" wire:click="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')"> Adquiere tu plan mensual </button>
                                            <button class="btn btnSave" style="margin-left: 20px" >  Adquiere tu plan anual   </button>>
                                            --}}
                                    <div style="height: 150px; display: flex; justify-content: flex-end;">
                                        <div class="ag-courses_item" style="width: 130px;">
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_bg"></div>
                                                <div class="ag-courses-item_title">
                                                    29,99 $
                                                    <button class="btn btnSave" onclick="handleSubscrition()" style="min-width: 70px; margin-top: 20px"> Suscribirse </button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="ag-courses_item">
                                            <a href="#" class="ag-courses-item_link">
                                                  <div class="ag-courses-item_bg"></div>
                                                  <div class="ag-courses-item_title">
                                                      100 $
                                                      <button class="btn btnSave" onclick="handleSubscrition()" style="min-width: 70px; margin-top: 20px"> Suscribirse </button>
                                                  </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-content">
                                          <h1 class="card-title">Plan Profesional</h1>
                                          <p class="card-text">

                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>Pacientes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>Consultas</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>Exámenes</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>Estudios</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Estudios con videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Consultas en IA</b> </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i><b>Publicidad</b> </li>
                                          </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                    <div style="height: 150px; display: flex; justify-content: flex-end;">
                                        <div class="ag-courses_item">
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_bg"></div>
                                                <div class="ag-courses-item_title">
                                                    29,99 $
                                                    <button class="btn btnSave" onclick="handleSubscrition()" style="min-width: 70px; margin-top: 20px"> Suscribirse </button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="ag-courses_item">
                                            <a href="#" class="ag-courses-item_link">
                                                  <div class="ag-courses-item_bg"></div>
                                                  <div class="ag-courses-item_title">
                                                      100 $
                                                      <button  class="btn btnSave" wire:click="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" style="min-width: 70px; margin-top: 20px"> Suscribirse </button>
                                                  </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-content">
                                          <h1 class="card-title">Plan Ilimitado</h1>
                                          <p class="card-text">

                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Pacientes</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Consultas</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Exámenes</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Estudios</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.1$ por Gb <b>Estudios con videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>Consultas en IA</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i><b>Publicidad</b> </li>
                                          </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="div-content-laboratorio" style="display: none">
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                            <h5>Plan Free</h5></b>
                                        </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 10 <b>Pacientes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Consultas</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Exámenes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Estudios</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Estudios con videos</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Consultas en IA</b> </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Publicidad</b> </li>
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 mb-3" style="display: flex; justify-content: center;">
                                            <input class="btn btnSave send " value="Adquiere tu plan" onclick="handleSelectPlan(4);" style="margin-left: 20px" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                            <h5>Plan Profesional</h5></b>
                                        </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 10 <b>Pacientes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Consultas</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Exámenes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 20 <b>Estudios</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Estudios con videos</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">Consultas en IA</b> </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Publicidad</b> </li>
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 mb-3" style="display: flex; justify-content: center;">
                                            <input class="btn btnSave send " value="Adquiere tu plan" onclick="handleSelectPlan(5);" style="margin-left: 20px" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                    <ul class="list-group">
                                        <li class="list-group-item" style="background-color: #6f6f6e; color: white;">
                                            <h5>Plan Ilimitado</h5></b>
                                        </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                style="color: green;"></i> 10 <b>Pacientes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                style="color: green;"></i> 20 <b>Consultas</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                style="color: green;"></i> 20 <b>Exámenes</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                style="color: green;"></i> 20 <b>Estudios</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                style="color: red;"></i> <b
                                                style="text-decoration: line-through;">Estudios con
                                                videos</b></li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-x"
                                                style="color: red;"></i> <b
                                                style="text-decoration: line-through;">Consultas en IA</b>
                                        </li>
                                        <li class="list-group-item text-capitalize"><i class="bi bi-check"
                                                style="color: green;"></i><b>Publicidad</b>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 mb-3"
                                            style="display: flex; justify-content: center;">
                                            <input class="btn btnSave send " value="Adquiere tu plan"
                                                onclick="handleSelectPlan(6);" style="margin-left: 20px" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="div-content-corporativo" style="display: none">
                                <div class="col-sm-10 col-md-10 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                    <div style="height: 150px; display: flex; justify-content: flex-end;">
                                        <div class="ag-courses_item">
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_bg"></div>
                                                <div class="ag-courses-item_title">
                                                    29,99 $
                                                    <button class="btn btnSave" onclick="handleSubscrition()" style="min-width: 70px; margin-top: 20px"> Suscribirse </button>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="ag-courses_item">
                                            <a href="#" class="ag-courses-item_link">
                                                  <div class="ag-courses-item_bg"></div>
                                                  <div class="ag-courses-item_title">
                                                    <h4>
                                                        <span class="symbol">$</span>
                                                        100<span class="cent"></span>
                                                      </h4>
                                                      <span class="time">USD / anual</span>
                                                      <button  class="btn btnSave" wire:click="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" style="min-width: 70px; margin-top: 20px"> Suscribirse </button>
                                                  </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-content">
                                          <h1 class="card-title">Plan corporativo</h1>
                                          <p class="card-text">

                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Pacientes</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Consultas</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Exámenes</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i><b>Estudios</b> Ilimitados</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.1$ por Gb <b>Estudios con videos</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>Consultas en IA</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i><b>Publicidad</b> </li>
                                          </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 col-xxl-10">
                <div class="card mb-3 mt-m3" id="div-form">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-2 mb-3" style="display: flex; justify-content: center;">
                                <button class="btn btnSave send " onclick="handleSelectPlan();" style="margin-left: 20px"> agregar metodo de pago </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title">
                    <i class="bi bi-calendar-week"></i>
                    <span style="padding-left: 5px">
                        Pago
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px;"></button>
                </div>
                <div class="modal-body">

                    <div class="row" >

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" >

                            {{-- <input id="card-holder-name" type="text" wire:model="name"> --}}

                            <!-- Stripe Elements Placeholder -->
                            <label for="name" class="form-label" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Numero de tarjeta</label>
                            <div class="form-control mt-2" id="card-element"></div>
                            <span id="card-error-message" style="color: red; font-size: 12px"></span>

                            <button class="btn btnSave mt-3" id="card-button" data-secret="{{ $intent->client_secret }}">
                                Update Payment Method
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        // const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        // billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...

                let span = document.getElementById('card-error-message')

                span.textContent = error.message;

            } else {
                // The card has been verified successfully...

                @this.addPaymentMethod(setupIntent.payment_method);
            }
        });

    </script>

    <script>
        const stripe = Stripe('pk_test_51OfoXBLoqeBM9Dte6ScqGxhnNKv3vxMr6i6sa0NU9ps9zLzjgbxN3eibXcrHIhqLjDl8ulSJ83TGkKMKxSFsC0rN00J6ZLm5us');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
    </script>

<script>
    const handleSelect = (section) => {

        switch (section) {
            case "medico":

                $("#div-content-medico").show();
                $("#div-content-laboratorio").hide();
                $("#div-content-corporativo").hide();

                $(".corporativo").prop("class", "img-icon-select-rol corporativo");
                $(".laboratorio").prop("class", "img-icon-select-rol laboratorio");
                $(".medico").prop("class", "img-icon-select-rol medico ico-check");

                break;
            case "laboratorio":

                $("#div-content-laboratorio").show();
                $("#div-content-medico").hide();
                $("#div-content-corporativo").hide();

                $(".medico").prop("class", "img-icon-select-rol medico");
                $(".corporativo").prop("class", "img-icon-select-rol corporativo");
                $(".laboratorio").prop("class", "img-icon-select-rol laboratorio ico-check");


                break;
            case "corporativo":

                $("#div-content-corporativo").show();
                $("#div-content-laboratorio").hide();
                $("#div-content-medico").hide();

                $(".medico").prop("class", "img-icon-select-rol medico");
                $(".laboratorio").prop("class", "img-icon-select-rol laboratorio");
                $(".corporativo").prop("class", "img-icon-select-rol corporativo ico-check");


                break;
        }
    }

    const handleSelectPlan = () => {

        $("#exampleModal").modal("show");
    }

    const handleSubscrition = () => {

        console.log('prueba')
    }
</script>
</div>
