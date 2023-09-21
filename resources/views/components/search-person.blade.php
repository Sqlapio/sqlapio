<div>

    <div class="row mt-3" id="content-search-pat">

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <div class="form-check form-check-inline">
                <input onchange="handlerSearPerson(event)" class="form-check-input" type="radio" name="inlineRadioOptions"
                    id="inlineRadio1" value="0">
                <label style="margin-top: 7px;" class="form-check-label" for="inlineRadio1">Buscar por cedula</label>
            </div>
            <div class="form-check form-check-inline">
                <input onchange="handlerSearPerson(event)" class="form-check-input" type="radio"
                    name="inlineRadioOptions" id="inlineRadio2" value="1">
                <label style="margin-top: 7px;" class="form-check-label" for="inlineRadio2">Buscar por referencia</label>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3">
            <div class="form-group">
                <label for="search_person"
                    class="form-label"style="font-size: 13px; margin-bottom: 5px; margin-top: -23px">Buscar
                    paciente </label>
                <input maxlength="10" type="text" class="form-control mask-only-number" id="search_person"
                    name="search_person" disabled placeholder="Buscar paciente" value="">
            </div>
        </div>

        <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
            <button style="height: 65%;" onclick="searchPerson()" class="btn btnSecond">Buscar</button>
        </div>
    </div>
</div>


<script>

    let row = ""
    function handlerSearPerson(e) {
            if (Number(e.target.value) === 0) {
                row = 'ci';
            } else {
                row = 'code_ref';
            }
            $('#search_person').attr('disabled', false);
        }

    function searchPerson() {
        if ($('#search_person').val() != '') {      
                
            let route = '{{ route("search_person",[":row",":value"]) }}';
            route = route.replace(':row', row);
            route = route.replace(':value', $('#search_person').val());

            $.ajax({
                url: route,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Operacion exitosamente!',
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {                       

                    });
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: error.responseJSON.errors,
                        allowOutsideClick: false,
                        confirmButtonColor: '#42ABE2',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        $('#send').show();
                        $('#spinner').hide();
                        $(".holder").hide();
                    });
                }
            });
        }
    }  
</script>
