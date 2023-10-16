<style>
    .logo-use {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #42abe2;
    }

    .nav-column {
        padding-left: 35px;
    }

    .isotipo-nav {
        width: 140px;
        height: auto;
        position: absolute;
        top: 0;
        left: 0;
    }

    .logo-navbar {
        width: 70%;
        height: auto;
    }

    .img-nav {
        width: 45px;
        height: auto;
        box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.71);
        -webkit-box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.71);
        -moz-box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.71);
        border-radius: 7px;
    }

    .nav-item img {
        opacity: 1;
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
    }

    .nav-item:hover img {
        opacity: .5;
    }

    .img-nav-logo {
        width: 6%;
        height: auto;
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 85px;
        text-decoration: none;
    }

    .nav-item a {
        text-align: center
    }

    /* .nav-item a:hover {s */
    .nav-item span {
        font-size: 12px;
        color: #fff !important;
    }

    .nav-text {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .dropdown-menu[data-bs-popper] {
        top: 33%;
        left: 70%;
        margin-top: var(--bs-dropdown-spacer);
    }


    .header-nav {
        border-bottom: 1px solid #5c6369;
        display: flex;
        justify-content: space-between;
        padding-bottom: 10px;
    }

    .icon-p {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .icon-logout {
        width: 20%;
        height: 20%;
        margin: 15% 0% 0% 10%;

    }

    .m-t-2 {
        margin-top: 2px;
    }

    .div-left {
        padding: 0px 0px;
        margin-left: 45%;
        margin-top: 15px;
    }

    .strong {
        color: white;
        font-size: 15px;
    }

    .banner {
        width: 95%;
        height: auto;
    }

    .div-bar {
        background-color: #47525E !important;
    }

    .navbar-text {
        color: #fff;
    }

    @media only screen and (max-width: 300px) {

        .div-dos {
            display: none !important;
        }

        .logo-navbar {
            width: 10%;
        }

        .div-left {
            display: none !important;
        }

        .strong {
            color: white;
            font-size: 10px;
        }

        .banner {
            width: 100% !important;
            height: auto;
        }

        .div-user {
            margin-top: auto !important;
            margin-bottom: auto !important;
            margin-left: 0px;
        }

        .logo-navbar {
            width: 13%;
            margin-top: 15px;
        }
    }

    @media only screen and (max-width: 390px) {

        .icon-p {
            justify-content: flex-start;
        }

        .nav-column {
            padding-top: 5px;
            width: 100%;
            padding-left: 0px;
        }

        .isotipo-nav {
            width: 63px;
            height: auto;
        }

        .img-nav {
            width: 31px;
            height: auto;
        }

        .nav-item {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .nav-item span {
            padding-left: 20px;
            font-size: 14px
        }

        .nav-mb {
            align-items: flex-start !important;
        }

        .logo-mb {
            width: 80%;
        }

        .dropdown-menu[data-bs-popper] {
            top: 87%;
            left: 0;
            margin-top: var(--bs-dropdown-spacer);
        }

        .div-left {
            display: none !important;
        }

        .icon-logout {
            width: 10%;
            height: 20%;
            margin: 15% 0% 0% 10%;

        }

        .strong {
            /* margin: 30px; */
            color: white;
            font-size: 14px;
        }

        .banner {
            width: 100% !important;
            height: auto;
        }

        .div-user {
            margin-top: auto !important;
            margin-bottom: auto !important;
            margin-left: 0px;
        }

        .margin-div {
            margin-right: -1% !important;
        }

        .div-dos {
            display: none !important;
        }

        .logo-navbar {
            width: 13%;
            margin-top: 15px;
        }
    }

    @media (min-width: 391px) and (max-width: 400px) {

        .isotipo-nav {
            width: 63px;
            margin-top: -9px;
        }

        .img-nav {
            width: 31px;
            height: auto;
        }

        .nav-item {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            margin-bottom: 15px
        }

        .nav-item span {
            padding-left: 20px;
            font-size: 14px;
        }

        .nav-mb {
            align-items: flex-start !important;
        }

        .nav-column {
            padding-top: 5px;
            width: 100%;
            padding-left: 0px;
        }

        .logo-mb {
            width: 80%;
        }

        .div-left {
            padding: 0px 0px;
            margin-left: 0%;
            margin-top: 0px;
        }

        .strong {
            color: white;
        }

        .logo-navbar {
            width: 13%;
            margin-top: 15px;
        }

    }

    @media (min-width: 401px) and (max-width: 600px) {

        .icon-p {
            justify-content: flex-start;
        }

        .isotipo-nav {
            width: 63px;
            height: auto;
        }

        .nav-column {
            padding-top: 5px;
            width: 100%;
            padding-left: 0px;
        }

        .img-nav {
            width: 31px;
            height: auto;
        }

        .nav-item {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .nav-item span {
            padding-left: 20px;
            font-size: 14px;
        }

        .nav-mb {
            align-items: flex-start !important;
        }

        .logo-mb {
            width: 80%;
        }

        .logo-navbar {
            width: 20%
        }

        .div-left {
            padding: 0px 0px;
            margin-left: 0%;
            margin-top: 0px;
        }

        .strong {
            color: white;
        }

        .logo-navbar {
            width: 22%;
            /* margin-top: 15px; */
        }
    }

    @media (min-width: 600px) and (max-width: 768px) {

        .icon-p {
            justify-content: flex-start;
        }

        .img-nav {
            width: 31px;
            height: auto;
        }


        .dropdown-menu[data-bs-popper] {
            top: 82%;
            left: 64%;
            margin-top: var(--bs-dropdown-spacer);
        }

        .nav-column {
            padding-top: 5px;
            width: 100%;
            padding-left: 0px;
        }

        .nav-item {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            margin-bottom: 15px
        }

        .nav-item span {
            padding-left: 20px
        }

        .div-left {
            padding: 0px 0px;
            margin-left: 0%;
            margin-top: 0px;
        }

        .strong {
            color: white;
        }

        .logo-navbar {
            width: 13%;
            margin-top: 15px;
        }

        .isotipo-nav {
            width: 63px;
            height: auto;
        }
    }

    @media (min-width: 768px) and (max-width: 992px) {

        .icon-p {
            justify-content: flex-start;
        }

        .img-nav {
            width: 31px;
            height: auto;
        }

        .dropdown-menu[data-bs-popper] {
            top: 82%;
            left: 64%;
            margin-top: var(--bs-dropdown-spacer);
        }

        .nav-column {
            padding-top: 5px;
            width: 100%;
            padding-left: 0px;
        }

        .nav-item {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
        }

        .nav-item span {
            padding-left: 20px
        }

        .div-left {
            padding: 0px 0px;
            margin-left: 0%;
            margin-top: 0px;
        }

        .strong {
            color: white;
        }

        .logo-navbar {
            width: 13%;
            margin-top: 15px;
        }

        .isotipo-nav {
            width: 63px;
            height: auto;
        }
    }


</style>
<div>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg div-bar navbar-dark bg-dark">
                <div class="container-fluid nav-mb">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1 logo-mb">
                        <img class="isotipo-nav" src="{{ asset('img/Isotipo.png') }}" alt="Logo">
                        {{-- <a class="navbar-brand" href="#">Navbar w/ text</a> --}}
                        {{-- Imagen del medico --}}

                    </div>
                    
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 col-xxl-11 flex-column nav-column">
                        <div class="row mb-3 header-nav">
                            <div class="col-xs-12 col-sm-12 col-md-12 nav-text">
                                {{-- Imagen del medico --}}
                                <a class="nav-link icon-p" href="#">
                                    @if (Auth::user()->user_img != null && Auth::user()->role == 'medico')
                                        <span class="strong" style="text-transform: capitalize; padding-right: 15px;"> Dr.
                                            {{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                                        <img class="logo-use" src="{{ asset('/imgs/' . Auth::user()->user_img) }}"
                                            class="avatar img-fluid rounded-circle me-1" alt="Chris Wood">
                                    @elseif(app('App\Http\Controllers\UtilsController')->exit_image_lab(Auth::user()->email) == null)
                                        <span class="strong" style="text-transform: capitalize; padding-right: 15px;"> {{ Auth::user()->business_name }} </span>
                                        <img class="logo-use" src="{{ asset('/img/avatar/avatar.png') }}"
                                            class="avatar img-fluid rounded-circle me-1" alt="Chris Wood">
                                    @elseif(app('App\Http\Controllers\UtilsController')->exit_image_lab(Auth::user()->email) != null)
                                        <span class="strong" style="text-transform: capitalize; padding-right: 15px;"> {{ Auth::user()->business_name }} </span>
                                        <img class="logo-use"
                                            src="{{ asset('/imgs/' . app('App\Http\Controllers\UtilsController')->get_image_lab(Auth::user()->email)) }}"
                                            class="avatar img-fluid rounded-circle me-1" alt="Chris Wood">
                                    @else
                                        <span class="strong" style="text-transform: capitalize; padding-right: 15px;"> Dr. {{ Auth::user()->last_name }},
                                            {{ Auth::user()->name }}</span>
                                        <img class="logo-use" src="{{ asset('/img/avatar/avatar.png') }}"
                                            class="avatar img-fluid rounded-circle me-1" alt="Chris Wood">
                                    @endif
                                </a>

                                <button onclick="logout()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cerrar sesión" data-bs-custom-class="custom-tooltip">
                                    <i class="bi bi-power" style="color: white; font-size: 30px;"></i>
                                </button>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse mt-3" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li>
                                    <a class="nav-item" href="{{ route('DashboardComponent') }}" title="Dashboard">
                                        <img class="img-nav" src="{{ asset('img/V2/Stocks.png') }}" alt="Dashboard">
                                        <span class="nav-link active" aria-current="page">Dashboard</span>
                                    </a>
                                </li>
                                @if (Auth::user()->role == 'medico')
                                    <li >
                                        <a class="nav-item" href="{{ route('Patients') }}" title="Pacientes">
                                            <img class="img-nav" src="{{ asset('img/V2/Contacts.png') }}" alt="Pacientes">
                                            <span class="nav-link active" aria-current="page" href="#">Pacientes</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->role == 'medico')
                                    <li >
                                        <a class="nav-item" href="{{ route('Diary') }}" title="Agenda">
                                            <img class="img-nav" src="{{ asset('img/V2/Calendar.png') }}" alt="Agenda">
                                            <span class="nav-link active" aria-current="page" href="#">Agenda</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->role == 'medico')
                                    <li >
                                        <a class="nav-item" href="{{ route('Centers') }}" title="Clínica">
                                            <img class="img-nav" src="{{ asset('img/V2/Maps.png') }}" alt="Clínica">
                                            <span class="nav-link active" aria-current="page" href="#">Centros</span>
                                        </a>
                                    </li>
                                    <li >
                                        <a class="nav-item" href="{{ route('Examen') }}" title="Exámenes">
                                            <img class="img-nav" src="{{ asset('img/V2/Reminders.png') }}" alt="Exámenes">
                                            <span class="nav-link active" aria-current="page" href="#">Exámenes</span>
                                        </a>
                                    </li>
                                      <li >
                                        <a class="nav-item" href="{{ route('Study') }}" title="Estudios">
                                            <img class="img-nav" src="{{ asset('img/V2/Books.png') }}" alt="Estudios">
                                            <span class="nav-link active" aria-current="page" href="#">Estudios</span>
                                        </a>
                                    </li>
                                @endif
                                <li >
                                    <a class="nav-item" href="{{ route('Profile') }}" title="Configuración">
                                        <img class="img-nav" src="{{ asset('img/V2/Settings.png') }}" alt="Configuración">
                                        <span class="nav-link active" aria-current="page" href="#">Configuración</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 col-xxl-2 nav-text">
                                <img class="logo-navbar" src="{{ asset('img/logo sqlapio-02.png') }}" alt="Logo">
                            </div>
                        </div>
                    </div>
                    
                </div>

            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="d-flex justify-content-center mt-2">
            <img class="banner" src="{{ asset('img/leaderboard-banner (1).gif') }}" alt="">
        </div>
    </div>
</div>

<script>
    function logout() {
        var url = "{{ route('logout') }}";
        location.href = url;
    }

    $(document).ready(() => {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        tooltipTriggerList.forEach(element => {
            new bootstrap.Tooltip(element)
        });
    });
</script>
