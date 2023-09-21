<div>
    <div class="row justify-content-center">
        {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <div class="form-check form-check-inline">
                <input onchange="handlerSearPerson(event)" class="form-check-input" type="radio" name="inlineRadioOptions"
                    id="inlineRadio1" value="0">
                <label style="margin-top: 7px;" class="form-check-label" for="inlineRadio1">Documento de identidad</label>
            </div>
            <div class="form-check form-check-inline">
                <input onchange="handlerSearPerson(event)" class="form-check-input" type="radio"
                    name="inlineRadioOptions" id="inlineRadio2" value="1">
                <label style="margin-top: 7px;" class="form-check-label" for="inlineRadio2">Referencia médica</label>
            </div>
        </div> --}}
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-4">
            <div class="form-group">
                <label for="search_person"
                    class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: -23px">Buscar
                    paciente </label>
                <input maxlength="15" type="text" class="form-control mask-alfa-numeric" id="search_person"
                    name="search_person"  placeholder="Buscar paciente" value="">
            </div>
        </div>

        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1  mt-4">
            <button style="height: 65%;" onclick="searchPerson()" class="btn btnSecond">Buscar</button>
        </div>
    </div>
</div>
