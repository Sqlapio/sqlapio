
<div>
    <script>
        const handleSelectPlan = () => {
            $("#exampleModal").modal("show");
        }

        const handleSelect = (section) => {

            switch (section) {
                case "medico":

                    $("#div-content-medico").hide();
                    $("#div-content-medico2").show();

                    break;
                case "laboratorio":

                    $("#div-content-laboratorio").hide();
                    $("#div-content-laboratorio2").show();


                    break;
                case "corporativo":

                    $("#div-content-corporativo").show();
                    $("#div-content-laboratorio").hide();
                    $("#div-content-medico").hide();

                    break;
            }
        }

    </script>

    <div class="container-fluid" style="padding: 0 3% 3%">
        <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div id="div-content">
                   {{-- medico --}}
                    @if (Auth::user()->type_plane == 2 || Auth::user()->type_plane == 3)
                        {{-- Planes --}}
                        <div class="row" style="display: flex; justify-items: center; justify-content: center;" id="div-content-medico" >
                            @if (Auth::user()->type_plane == 2)
                                {{-- profesional --}}
                                <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4 col-xxl-4 mt-2" id="div-plan-2">
                                    {{-- mensual --}}
                                    <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                        <div class="ag-courses_item_small" >
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_title">
                                                    <h4>
                                                        <span class="symbol">$</span> 19,<span class="cent">99</span>
                                                    </h4>
                                                    <span class="time">USD / @lang('messages.label.mes')</span>
                                                    <button class="btn btnSave"  wire:click="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- card --}}
                                    <div class="card-wrap card-header two">
                                        <div class="card-content">
                                            <h1 class="card-title">Plan @lang('messages.label.profesional')</h1>
                                            <p class="card-text">
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.paciente')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.consulta')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.examenes')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.estudios')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.estudios_video')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.consulta_ia')</b> </li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b> </li>
                                            </p>
                                        </div>
                                    </div>
                                    {{-- anual --}}
                                    <div class="ag-courses_item" style="margin-top: -100px;">
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                                <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                    @lang('messages.label.oferta_planes')
                                                </span>
                                                <h4>
                                                    <span class="symbol">$</span> 199,<span class="cent">99</span>
                                                    <span class="time">USD / @lang('messages.label.año')</span>
                                                </h4>
                                                <button class="btn btnSave" wire:click="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" wire:target="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" style="min-width: 70px; margin-top: 10px">
                                                    @lang('messages.botton.suscribirse')
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="spinner" wire:target="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                    <div id="spinner" wire:target="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                    <div id="spinner" wire:target=cancelSubscription" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                </div>
                            @else
                                {{-- ilimitado --}}
                                <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4 col-xxl-4 mt-2" id="div-plan-3">
                                    <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                        <div class="ag-courses_item_small" >
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_bg3"></div>
                                                <div class="ag-courses-item_title">
                                                    <h4>
                                                        <span class="symbol">$</span> 39,<span class="cent">99</span>
                                                    </h4>
                                                    <span class="time">USD / @lang('messages.label.mes')</span>
                                                    <button class="btn btnSave"  wire:click="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="card-wrap card-header three">
                                        <div class="card-content">
                                            <h1 class="card-title">Plan @lang('messages.label.ilimitado')</h1>
                                            <p class="card-text">
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.paciente')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.consulta')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.examenes')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.estudios')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.10 por Gb <b>@lang('messages.label.estudios_video')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>@lang('messages.label.consulta_ia')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ag-courses_item" style="margin-top: -100px;">
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_bg3"></div>
                                            <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                                <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                    @lang('messages.label.oferta_planes')
                                                </span>
                                                <h4>
                                                    <span class="symbol">$</span> 399,<span class="cent">99</span>
                                                    <span class="time" style="font-weight: 500">USD / @lang('messages.label.año')</span>
                                                </h4>
                                                <button class="btn btnSave" wire:click="newSubscription('price_1OyKN3LoqeBM9DtewtoXlP0H')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="spinner" wire:target="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                    <div id="spinner" wire:target="newSubscription('')" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row" style="display: flex; justify-items: center; justify-content: center; display: none" id="div-content-medico2" >

                            {{-- profesional --}}
                            <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4 col-xxl-4 mt-2" id="div-plan-2">
                                {{-- mensual --}}
                                <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                    <div class="ag-courses_item_small" >
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_title">
                                                <h4>
                                                    <span class="symbol">$</span> 19,<span class="cent">99</span>
                                                </h4>
                                                <span class="time">USD / @lang('messages.label.mes')</span>
                                                <button class="btn btnSave"  wire:click="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                {{-- card --}}
                                <div class="card-wrap card-header two">
                                    <div class="card-content">
                                        <h1 class="card-title">Plan @lang('messages.label.profesional')</h1>
                                        <p class="card-text">
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.paciente')</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.consulta')</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.examenes')</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.estudios')</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.estudios_video')</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.consulta_ia')</b> </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b> </li>
                                        </p>
                                    </div>
                                </div>
                                {{-- anual --}}
                                <div class="ag-courses_item" style="margin-top: -100px;">
                                    <a href="#" class="ag-courses-item_link">
                                        <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                            <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                @lang('messages.label.oferta_planes')
                                            </span>
                                            <h4>
                                                <span class="symbol">$</span> 199,<span class="cent">99</span>
                                                <span class="time">USD / @lang('messages.label.año')</span>
                                            </h4>
                                            <button class="btn btnSave" wire:click="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" wire:target="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" style="min-width: 70px; margin-top: 10px">
                                                @lang('messages.botton.suscribirse')
                                            </button>
                                        </div>
                                    </a>
                                </div>
                                <div id="spinner" wire:target="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" wire:loading >
                                    <x-load-spinner />
                                </div>
                                <div id="spinner" wire:target="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" wire:loading >
                                    <x-load-spinner />
                                </div>
                                <div id="spinner" wire:target=cancelSubscription" wire:loading >
                                    <x-load-spinner />
                                </div>
                            </div>

                            {{-- ilimitado --}}
                            <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4 col-xxl-4 mt-2" id="div-plan-3">
                                <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                    <div class="ag-courses_item_small" >
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_bg3"></div>
                                            <div class="ag-courses-item_title">
                                                <h4>
                                                    <span class="symbol">$</span> 39,<span class="cent">99</span>
                                                </h4>
                                                <span class="time">USD / @lang('messages.label.mes')</span>
                                                <button class="btn btnSave"  wire:click="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                                <div class="card-wrap card-header three">
                                    <div class="card-content">
                                        <h1 class="card-title">Plan @lang('messages.label.ilimitado')</h1>
                                        <p class="card-text">
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.paciente')</b> @lang('messages.label.ilimitado')</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.consulta')</b> @lang('messages.label.ilimitado')</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.examenes')</b> @lang('messages.label.ilimitado')</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.estudios')</b> @lang('messages.label.ilimitado')</li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.10 por Gb <b>@lang('messages.label.estudios_video')</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>@lang('messages.label.consulta_ia')</b></li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="ag-courses_item" style="margin-top: -100px;">
                                    <a href="#" class="ag-courses-item_link">
                                        <div class="ag-courses-item_bg3"></div>
                                        <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                            <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                @lang('messages.label.oferta_planes')
                                            </span>
                                            <h4>
                                                <span class="symbol">$</span> 399,<span class="cent">99</span>
                                                <span class="time" style="font-weight: 500">USD / @lang('messages.label.año')</span>
                                            </h4>
                                            <button class="btn btnSave" wire:click="newSubscription('price_1OyKN3LoqeBM9DtewtoXlP0H')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                        </div>
                                    </a>
                                </div>
                                <div id="spinner" wire:target="newSubscription('price_1OyKMhLoqeBM9DteVmOZwlrz')" wire:loading >
                                    <x-load-spinner />
                                </div>
                                <div id="spinner" wire:target="newSubscription('')" wire:loading >
                                    <x-load-spinner />
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: flex; justify-content: end;">
                            <button class="btn btnSave send " onclick="handleSelect('medico');" style="margin-left: 20px"> @lang('messages.botton.ver_otros_planes') </button>
                        </div>
                    @endif

                    {{-- Laboratiorio --}}
                    @if ( Auth::user()->type_plane == 5 || Auth::user()->type_plane == 6)
                        {{-- Planes --}}
                        <div class="row" style="display: flex; justify-items: center; justify-content: center;" id="div-content-laboratorio" >
                            @if (Auth::user()->type_plane == 5)

                            {{-- profesional --}}
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 mt-2" id="div-plan-5">
                                    {{-- mensual --}}
                                    <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                        <div class="ag-courses_item_small" style="width: 150px;">
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_title">
                                                    <h4>
                                                        <span class="symbol">$</span> 29,<span class="cent">99</span>
                                                    </h4>
                                                    <span class="time">USD / @lang('messages.label.mes')</span>
                                                    @if (auth()->user()->subscribedToPrice('price_1OvmISLoqeBM9DteyJr9GA34', 'Plan Ilimitado'))
                                                        Suscrito
                                                    {{-- <button class="btn btnSave" wire:click="cancelSubscription" wire:target="cancelSubscription" style="min-width: 70px; margin-top: 10px">
                                                        Cancelar
                                                    </button> --}}
                                                    @else
                                                        <button class="btn btnSave"  wire:click="newSubscription('price_1OvmISLoqeBM9DteyJr9GA34')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- card --}}
                                    <div class="card-wrap card-header two">
                                        <div class="card-content">
                                            <h1 class="card-title">Plan @lang('messages.label.profesional')</h1>
                                            <p class="card-text">
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.paciente')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.consulta')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.examenes')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.estudios')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.estudios_video')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.consulta_ia')</b> </li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b> </li>
                                            </p>
                                        </div>
                                    </div>
                                    {{-- anual --}}
                                    <div class="ag-courses_item" style="margin-top: -100px;">
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                                <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                    @lang('messages.label.oferta_planes')
                                                </span>
                                                <h4>
                                                    <span class="symbol">$</span> 399,<span class="cent">99</span>
                                                    <span class="time">USD / @lang('messages.label.año')</span>
                                                </h4>
                                                @if (auth()->user()->subscribedToPrice('price_1OfpQ4LoqeBM9DteIhOpQOh8', 'Plan Ilimitado'))
                                                    Suscrito
                                                    {{-- <button class="btn btnSave" wire:click="cancelSubscription" wire:target="cancelSubscription" style="min-width: 70px; margin-top: 10px">
                                                        Cancelar
                                                    </button> --}}
                                                @else
                                                    <div class="bnt-cons" id="bnt-cons"></div>
                                                    <button class="btn btnSave" wire:click="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" wire:target="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" style="min-width: 70px; margin-top: 10px">
                                                        @lang('messages.botton.suscribirse')
                                                </button>
                                                @endif


                                            </div>
                                        </a>
                                    </div>
                                    <div id="spinner" wire:target="newSubscription('price_1OfpJfLoqeBM9DtelZzLtCIe')" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                    <div id="spinner" wire:target=cancelSubscription" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                </div>
                            @else

                            {{-- ilimitado --}}
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 mt-2" id="div-plan-6">
                                    <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                        <div class="ag-courses_item" style="width: 150px;">
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_bg3"></div>
                                                <div class="ag-courses-item_title">
                                                    <h4>
                                                        <span class="symbol">$</span> 39,<span class="cent">99</span>
                                                    </h4>
                                                    <span class="time">USD / @lang('messages.label.mes')</span>
                                                    <button class="btn btnSave"  wire:click="newSubscription('')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="card-wrap card-header three">
                                        <div class="card-content">
                                            <h1 class="card-title">Plan @lang('messages.label.ilimitado')</h1>
                                            <p class="card-text">
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.paciente')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.consulta')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.examenes')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.estudios')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.10 por Gb <b>@lang('messages.label.estudios_video')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>@lang('messages.label.consulta_ia')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ag-courses_item" style="margin-top: -100px;">
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_bg3"></div>
                                            <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                                <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                    @lang('messages.label.oferta_planes')
                                                </span>
                                                <h4>
                                                    <span class="symbol">$</span> 399,<span class="cent">99</span>
                                                    <span class="time" style="font-weight: 500">USD / @lang('messages.label.año')</span>
                                                </h4>
                                                <button class="btn btnSave" wire:click="newSubscription('')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row" style="display: flex; justify-items: center; justify-content: center; display: none" id="div-content-laboratorio2" >

                            {{-- profesional --}}
                                <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4 col-xxl-4 mt-2" id="div-plan-5">
                                    {{-- mensual --}}
                                    <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                        <div class="ag-courses_item_small" style="width: 150px;">
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_title">
                                                    <h4>
                                                        <span class="symbol">$</span> 29,<span class="cent">99</span>
                                                    </h4>
                                                    <span class="time">USD / @lang('messages.label.mes')</span>
                                                    @if (auth()->user()->subscribedToPrice('price_1OvmISLoqeBM9DteyJr9GA34', 'Plan Ilimitado'))
                                                        Suscrito
                                                    {{-- <button class="btn btnSave" wire:click="cancelSubscription" wire:target="cancelSubscription" style="min-width: 70px; margin-top: 10px">
                                                        Cancelar
                                                    </button> --}}
                                                    @else
                                                        <button class="btn btnSave"  wire:click="newSubscription('price_1OvmISLoqeBM9DteyJr9GA34')" style="min-width: 70px; margin-top: 10px"> @lang('messages.botton.suscribirse') </button>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- card --}}
                                    <div class="card-wrap card-header two">
                                        <div class="card-content">
                                            <h1 class="card-title">Plan @lang('messages.label.profesional')</h1>
                                            <p class="card-text">
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.paciente')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 40 <b>@lang('messages.label.consulta')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.examenes')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 80 <b>@lang('messages.label.estudios')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.estudios_video')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.consulta_ia')</b> </li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b> </li>
                                            </p>
                                        </div>
                                    </div>
                                    {{-- anual --}}
                                    <div class="ag-courses_item" style="margin-top: -100px;">
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                                <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                    @lang('messages.label.oferta_planes')
                                                </span>
                                                <h4>
                                                    <span class="symbol">$</span> 399,<span class="cent">99</span>
                                                    <span class="time">USD / @lang('messages.label.año')</span>
                                                </h4>
                                                @if (auth()->user()->subscribedToPrice('price_1OfpQ4LoqeBM9DteIhOpQOh8', 'Plan Ilimitado'))
                                                    Suscrito
                                                    {{-- <button class="btn btnSave" wire:click="cancelSubscription" wire:target="cancelSubscription" style="min-width: 70px; margin-top: 10px">
                                                        Cancelar
                                                    </button> --}}
                                                @else
                                                    <div class="bnt-cons" id="bnt-cons"></div>
                                                    <button class="btn btnSave" wire:click="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" wire:target="newSubscription('price_1OfpQ4LoqeBM9DteIhOpQOh8')" style="min-width: 70px; margin-top: 10px">
                                                        @lang('messages.botton.suscribirse')
                                                </button>
                                                @endif


                                            </div>
                                        </a>
                                    </div>
                                    <div id="spinner" wire:target="newSubscription('price_1OfpJfLoqeBM9DtelZzLtCIe')" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                    <div id="spinner" wire:target=cancelSubscription" wire:loading >
                                        <x-load-spinner />
                                    </div>
                                </div>

                            {{-- ilimitado --}}
                                <div class="col-sm-12 col-md-8 col-lg-4 col-xl-4 col-xxl-4 mt-2" id="div-plan-6">
                                    <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                        <div class="ag-courses_item" style="width: 150px;">
                                            <a href="#" class="ag-courses-item_link">
                                                <div class="ag-courses-item_bg3"></div>
                                                <div class="ag-courses-item_title">
                                                    <h4>
                                                        <span class="symbol">$</span> 39,<span class="cent">99</span>
                                                    </h4>
                                                    <span class="time">USD / @lang('messages.label.mes')</span>
                                                    <button class="btn btnSave"  wire:click="newSubscription('')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="card-wrap card-header three">
                                        <div class="card-content">
                                            <h1 class="card-title">Plan @lang('messages.label.ilimitado')</h1>
                                            <p class="card-text">
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.paciente')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.consulta')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.examenes')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> <b>@lang('messages.label.estudios')</b> @lang('messages.label.ilimitado')</li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 0.10 por Gb <b>@lang('messages.label.estudios_video')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> 300 <b>@lang('messages.label.consulta_ia')</b></li>
                                                <li class="list-group-item text-capitalize"><i class="bi bi-x" style="color: red;"></i> <b style="text-decoration: line-through;">@lang('messages.label.publicidad')</b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ag-courses_item" style="margin-top: -100px;">
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_bg3"></div>
                                            <div class="ag-courses-item_title" style="display: flex; flex-direction: column; align-items: center;">
                                                <span class="text-center" style="font-size: 14px; color: red; text-transform: uppercase;">
                                                    @lang('messages.label.oferta_planes')
                                                </span>
                                                <h4>
                                                    <span class="symbol">$</span> 399,<span class="cent">99</span>
                                                    <span class="time" style="font-weight: 500">USD / @lang('messages.label.año')</span>
                                                </h4>
                                                <button class="btn btnSave" wire:click="newSubscription('')" style="min-width: 70px; margin-top: 10px">@lang('messages.botton.suscribirse')</button>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: flex; justify-content: end;">
                            <button class="btn btnSave send " onclick="handleSelect('laboratorio');" style="margin-left: 20px"> {{ $label_button }} </button>
                        </div>
                    @endif

                    {{-- Corporativo --}}
                    @if (Auth::user()->type_plane == 7) {
                        <div class="row" id="div-content-corporativo" style="display: none">
                            <div class="col-sm-10 col-md-10 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                <div style="height: 150px; display: flex; justify-content: flex-end; margin-top: 20px">
                                    <div class="ag-courses_item" style="width: 150px;">
                                        <a href="#" class="ag-courses-item_link">
                                            <div class="ag-courses-item_bg4"></div>
                                            <div class="ag-courses-item_title">
                                                <h4>
                                                    <span class="symbol">$</span> 29,<span
                                                        class="cent">99</span>
                                                    <span class="time">USD / mensual</span>
                                                </h4>
                                                <button class="btn btnSave" wire:click="newSubscription('')"  style="min-width: 70px; margin-top: 10px"> Suscribirse
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-wrap card-header four">
                                    <div class="card-content">
                                        <h1 class="card-title">Plan Corporativo</h1>
                                        <p class="card-text">
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> Pacientes, Consultas, Exámenes y Estudios </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> Licencia a los profesionales </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> Administrar centros y médicos </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> Controlar y gestionar el suministro de medicamentos </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> Monetizar las consultas realizadas </li>
                                            <li class="list-group-item text-capitalize"><i class="bi bi-check" style="color: green;"></i> Mostrar la información estadística en tiempo real </li>
                                        </p>
                                    </div>
                                </div>
                                <div class="ag-courses_item" style="margin-top: -100px;">
                                    <a href="#" class="ag-courses-item_link">
                                        <div class="ag-courses-item_bg4"></div>
                                        <div class="ag-courses-item_title">
                                            <h4>
                                                <span class="symbol">$</span> 100<span class="cent"></span>
                                                <span class="time">USD / Anual</span>
                                            </h4>
                                            <button class="btn btnSave" wire:click="newSubscription('')" style="min-width: 70px; margin-top: 10px"> Suscribirse </button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> }
                    @endif
                </div>
            </div>

            {{-- Metodos de pago --}}
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-cd">
                <div class="card mb-3" id="div-form">
                    <div class="card-body">
                        <h4>@lang('messages.label.metodos_de_pago')</h4>
                        <hr style="margin-bottom: 0; margin-top: 5px">
                        <div class="row">
                            @foreach ($paymentMethods as $paymentMethod)
                                <div id="spinner" wire:target="deletePaymentMethod('{{ $paymentMethod->id }}')" wire:loading >
                                    <x-load-spinner />
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xxl-3 mt-3" wire:key="{{ $paymentMethod->id }}">
                                    <div class="credit-card {{ $paymentMethod->card->brand }} selectable">
                                        <div class="credit-card-last4">
                                            {{ $paymentMethod->card->last4 }}
                                        </div>
                                        <span class="text-capitalize" style="color: #ffffff">{{ $paymentMethod->billing_details->name }}</span>
                                        <br>
                                        @if (@$this->defaultPaymentMethod->id != $paymentMethod->id)
                                            <Button wire:click="deletePaymentMethod('{{ $paymentMethod->id }}')"><i class="bi bi-trash mt-2"></i></Button>
                                            <Button wire:click="defaultPaymentMethod('{{ $paymentMethod->id }}')"><i class="bi bi-star mt-2"></i></Button>
                                        @endif
                                        <div class="credit-card-expiry">
                                            @lang('messages.label.expira'):
                                            {{ $paymentMethod->card->exp_month }} / {{ $paymentMethod->card->exp_year }}

                                            @if (@$this->defaultPaymentMethod->id == $paymentMethod->id)
                                                <span class="badge rounded-pill text-bg-secondary" style="margin-top: 10px">@lang('messages.label.predeterminado')</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 mb-3" style="display: flex; justify-content: end;">
                            <button class="btn btnSave send " onclick="handleSelectPlan();" style="margin-left: 20px"> @lang('messages.botton.agregar_tarjeta') </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px; justify-content: center"></button>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="text-center">
                            <img class="img" src="{{ asset('img/V2/stripe.png') }}" style="width: 110px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2" wire:ignore>
                            <label for="name" class="form-label mt-2" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.nombre_titular')</label>
                            <input class="form-control mt-2" id="card-holder-name" type="text">

                            <!-- Stripe Elements Placeholder -->
                            <label for="number-t" class="form-label mt-2" style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">@lang('messages.form.numero_tarjeta')</label>
                            <div class="form-control" id="card-element"></div>
                            <span id="card-error-message" style="color: red; font-size: 12px"></span>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-2 text-center">
                            <button class="btn btnPrimary mt-3 mb-3" id="card-button" data-secret="{{ $intent->client_secret }}">
                                @lang('messages.botton.guardar')
                            </button>
                            <p style="font-size: 11px"> @lang('messages.label.mensaje_pago')</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: center" >
                    <a href="https://stripe.com/" target="_blank" style="text-decoration: none; color: #1a1a1a80; font-size:13px;"><span>Powered by </span><img class="img" src="{{ asset('img/V2/stripe2.png') }}" style="width: 45px;"></a>
                    <a href="https://stripe.com/legal/end-users" target="_blank" style="text-decoration: none; color: #1a1a1a80; font-size:13px;"><span>Condiciones</span></a>
                    <a href="https://stripe.com/privacy" target="_blank" style="text-decoration: none; color: #1a1a1a80; font-size:13px;"><span>Privacidad</span></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe( 'pk_live_51OfoXBLoqeBM9DteVzaKA9F5LvICIU43EWtpHoVfhTV1uIXRgY22Id66FvzKkaZd6veVgxblZsXQv5HSleJaIfJc00nqiRXhgF' );
        // const stripe = Stripe( 'pk_test_51OfoXBLoqeBM9Dte6ScqGxhnNKv3vxMr6i6sa0NU9ps9zLzjgbxN3eibXcrHIhqLjDl8ulSJ83TGkKMKxSFsC0rN00J6ZLm5us' );
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
    </script>

    <script>
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {

            $('#spinner').show();

            const clientSecret = cardButton.dataset.secret;

            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            $('#spinner').hide();

            Swal.fire({
                icon: 'success',
                title: '@lang('messages.alert.operacion_exitosa')',
                allowOutsideClick: false,
                confirmButtonColor: '#42ABE2',
                confirmButtonText: '@lang('messages.botton.aceptar')'
            }).then((result) => {
                $('#exampleModal').modal('toggle');
                cardElemnt.clear();
                span.textContent = '';
            });

            if (error) {

                let span = document.getElementById('card-error-message');

                span.textContent = error.message;

            } else {


                @this.addPaymentMethod(setupIntent.payment_method);

                let span = document.getElementById('card-error-message');

                span.textContent = '';

            }
        });
    </script>


@push('js')
<script>
    Livewire.on('error', function (message) {
        Swal.fire({
            icon: 'error',
            title: message,
            allowOutsideClick: false,
            confirmButtonColor: '#42ABE2',
            confirmButtonText: '@lang('messages.botton.aceptar')'
        })
    });
    </script>

@endpush

</div>
