<div>
    {{ Form::open(['url' => '#', 'method' => 'post', 'id' => 'form-login']) }}
    <div class="row">
        <div>
            <h5 class="collapseBtn">Datos de la Empresa</h5>
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
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                <div class="alert alert-info" role="alert">
                    <strong>ID de clínica: 20660</strong>
                </div>
            </div>
        </div>


        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Nombres"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-person-circle"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Eslogan"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-hand-thumbs-up"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Direccion"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-compass"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Geolocalizacion"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-geo-alt"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Latitud"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-compass"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Longitud"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-compass"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
            <div class="floating-label-group">
                <select placeholder="Seleccione"class="form-control @error('username') is-invalid @enderror"
                    class="form-control combo-textbox-input">
                    <option value="2">(UTC-12:00) Baker Island, Howland Island (both uninhabited)</option>
                    <option value="3">(UTC-11:00) American Samoa, Niue</option>
                    <option value="4">(UTC-10:00) United States (Hawaii)</option>
                    <option value="5">(UTC-09:30) Marquesas Islands </option>
                    <option value="6">(UTC-09:00) Gambier Islands </option>
                    <option value="7">(UTC-07:00) Canada (northeastern British Columbia), Mexico (Sonora),
                        United States (Arizona)</option>
                    <option value="8">(UTC-06:00) Canada (almost all of Saskatchewan), Costa Rica, El
                        Salvador, Ecuador (Galápagos Islands), Guatemala, Honduras, Mexico (most), Nicaragua
                    </option>
                    <option value="9">(UTC-05:00) Colombia, Cuba, Ecuador (continental), Jamaica, Panama, Peru
                    </option>
                    <option value="10">(UTC-04:30) Venezuela </option>
                    <option selected="selected" value="11">(UTC-04:00) Bolivia, Brazil (Amazonas), Chile
                        (continental), Dominican Republic, Canada (Nova Scotia), Puerto Rico, Barbados, Trinidad and
                        Tobago</option>
                    <option value="12">(UTC-03:00) Argentina, Paraguay</option>
                    <option value="13">(UTC-02:00) Brazil (Fernando de Noronha), South Georgia and the South
                        Sandwich Islands </option>
                    <option value="14">(UTC-01:00) Cape Verde</option>
                    <option value="15">(UTC±00:00) UK, Canary Islands, Côte dIvoire, Faroe Islands, Ghana,
                        Iceland, Senegal</option>
                    <option value="16">(UTC+01:00) Algeria, Angola, Benin, Cameroon, Gabon, Niger, Nigeria,
                        Democratic Republic of the Congo (west), Tunisia</option>
                    <option value="17">(UTC+01:00) Bruselas, Copenhague, Madrid, París</option>
                    <option value="18">(UTC+02:00) Egypt, Malawi, Mozambique, South Africa, Swaziland, Zambia,
                        Zimbabwe</option>
                    <option value="20">(UTC+04:00) Armenia, Azerbaijan, Georgia, Mauritius, Oman, Russia
                        (European), Seychelles, United Arab Emirates </option>
                    <option value="21">(UTC+04:30) Afghanistan </option>
                    <option value="22">(UTC+05:00) Kazakhstan (west), Maldives, Pakistan, Uzbekistan </option>
                    <option value="23">(UTC+05:30) India, Sri Lanka </option>
                    <option value="24">(UTC+05:45) Nepal </option>
                    <option value="25">(UTC+06:00) Kazakhstan (most), Bangladesh, Bhutan, Russia (Ural:
                        Sverdlovsk Oblast, Chelyabinsk Oblast) </option>
                    <option value="26">(UTC+06:30) Cocos Islands, Myanmar </option>
                    <option value="27">(UTC+07:00) Western Indonesia, Russia (Novosibirsk Oblast), Thailand,
                        Vietnam, Cambodia </option>
                    <option value="29">(UTC+08:45) Australia (Eucla) unofficial</option>
                    <option value="30">(UTC+09:00) Eastern Indonesia, East Timor, Russia (Irkutsk Oblast),
                        Japan, North Korea, South Korea </option>
                    <option value="31">(UTC+09:30) Australia (Northern Territory)</option>
                    <option value="32">(UTC+10:00) Russia (Zabaykalsky Krai), Papua New Guinea, Australia
                        (Queensland)</option>
                    <option value="33">(UTC+11:00) New Caledonia, Russia (Primorsky Krai), Solomon Islands
                    </option>
                    <option value="34">(UTC+11:30) Norfolk Island </option>
                    <option value="35">(UTC+12:00) Kiribati (Gilbert Islands), Fiji, Russia (Kamchatka Krai)
                    </option>
                    <option value="36">(UTC+13:00) Kiribati (Phoenix Islands), Tonga, Tokelau</option>
                    <option value="37">(UTC+14:00) Kiribati (Line Islands)</option>
                    <option value="39">(UTC+08:00) Hong Kong, Central Indonesia, China, Russia (Krasnoyarsk
                        Krai), Malaysia, Philippines, Singapore, Taiwan, most of Mongolia, Australia</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="NIF/CIF"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-telephone"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Telefono"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-telephone"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Email"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-envelope"></i>
                </div>
            </diV>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <div class="Icon-inside">
                    <input autocomplete="off" placeholder="Pagina Web"
                        class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        type="text" value="">
                    <i class="bi bi-browser-chrome"></i>
                </div>
            </diV>
        </div>

        <x-upload-image title="Cargar Logo" />
        <hr>

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
