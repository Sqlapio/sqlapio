<style>
    @media screen and (max-width: 768px) {
        .mt-mb {
            margin-top: 0.25rem !important;
        }
    }
</style>

<div>
    <div class="row mt-2">     
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-4">
            <div class="form-group">
                <label for="search_person" class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: -23px">
                    Ingresar número de Identificación
                </label>
                <input maxlength="15" type="text" class="form-control mask-alfa-numeric" id="search_person" name="search_person"  placeholder="Buscar paciente" value="">
            </div>
        </div> 
        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1 mt-3 mt-mb">
            <button style="margin-top: 12px;" onclick="searchPerson()" class="btn btnSecond">Buscar</button>
        </div>
    </div>
</div>
