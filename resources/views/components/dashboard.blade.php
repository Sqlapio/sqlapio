<style>
    a {
        font-size: 10px;
    }
</style>
<div>
    <div class="{{ $classRow }} ">
        <div class="{{ $classText }}">
            <a href="{{ route('DashboardComponent') }}" title="Dashboard">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-dashboard.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Dashboard">
                    @if ($showItem === true)
                        <br>
                        <span>Dashboard</span>
                    @endif
                </p>
            </a>
        </div>
        <div class="{{ $classText }}">
            <a href="{{ route('Patients') }}" title="Pacientes">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-pacientes.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Pacientes">
                    @if ($showItem === true)
                        <br>
                        <span>Pacientes</span>
                    @endif
                </p>
            </a>
        </div>
        <div class="{{ $classText }}">
            <a href="{{route('Diary')}}" title="Agenda">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-agenda.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Agenda">
                    @if ($showItem === true)
                        <br>
                        <span>Agenda</span>
                    @endif
                </p>
            </a>
        </div>

        <div class="{{ $classText }}">
            <a href="#" title="Clínica">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-clinica.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Clínica">
                    @if ($showItem === true)
                        <br>
                        <span>Clínica</span>
                    @endif
                </p>
            </a>
        </div>

        <div class="{{ $classText }}">
            <a href="{{ route('Setting') }}" title="Configuración">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-configuracion.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Configuración">
                    @if ($showItem === true)
                        <br>
                        <span>Configuración</span>
                    @endif
                </p>
            </a>
        </div>
    </div>
    {{-- 
    <div class="{{ $classRow }}">

        <div class="{{ $classText }}">
            <a href="#" title="Telemedicina">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-comunicacion.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Telemedicina">
                    @if ($showItem === true)
                        <br>
                        <span>Telemedicina</span>
                    @endif
                </p>
            </a>
        </div>
        <div class="{{ $classText }}">
            <a href="#" title="Stock">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-stock.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Stock">
                    @if ($showItem === true)
                        <br>
                        <span>Stock</span>
                    @endif
                </p>
            </a>
        </div>

        <div class="{{ $classText }}">
            <a href="#" title="Cuentas">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-cuentas.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Cuentas">
                    @if ($showItem === true)
                        <br>
                        <span>Cuentas</span>
                    @endif
                </p>
            </a>
        </div>

        <div class="{{ $classText }}">
            <a href="#" title="Estadísticas">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-estadistica.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Estadísticas">
                    @if ($showItem === true)
                        <br>
                        <span>Estadísticas</span>
                    @endif
                </p>
            </a>
        </div>

        <div class="{{ $classText }}">
            <a href="#" title="Marketing">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-marketing.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Marketing">
                    @if ($showItem === true)
                        <br>
                        <span>Marketing</span>
                    @endif
                </p>
            </a>
        </div>

        <div class="{{ $classText }}">
            <a href="#" title="Sistemas">
                <p class="text-center">
                    <img src="{{ asset('img/icons_icono-sistemas.png') }}" width="{{ $width }}"
                        height="{{ $width }}" alt="Sistemas">
                    @if ($showItem === true)
                        <br>
                        <span>Sistemas</span>
                    @endif
                </p>
            </a>
        </div>
       
        @if ($showFormation === true)
            <div class="{{ $classText }}">
                <a href="#" title="Formación">
                    <p class="text-center">
                        <img src="{{ asset('img/Formacion.png') }}" width="{{ $width }}"
                            height="{{ $width }}" alt="Formación">
                        @if ($showItem === true)
                            <br>
                            <span>Formación</span>
                        @endif
                    </p>
                </a>
            </div>
        @endif
    </div> --}}
</div>
