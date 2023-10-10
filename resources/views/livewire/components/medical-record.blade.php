@extends('layouts.app-auth')
@section('title', 'Detalle Médico')
<style>
    ul {
        list-style-type: none;
    }

    .img-medical {
        border-radius: 20px;
        border: 3px solid #47525e;
    }
</style>
@push('scripts')
    <script>
        let valExams = '';
        let valStudy = '';
        let id = @json($id);
        let exams_array = [];
        let studies_array = [];
        let medications_supplements = [];
        let countMedicationAdd = 0;

        $(document).ready(() => {

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltipTriggerList.forEach(element => {
                new bootstrap.Tooltip(element)
            });

            let doctor_centers = @json($doctor_centers);
            let validate_histroy = @json($validate_histroy);

            if (doctor_centers.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debe asociar  un centro!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    window.location.href = "{{ route('Centers') }}";
                });
            } else if (validate_histroy === null) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debe crear una historia clinica para este paciente!',
                    allowOutsideClick: false,
                    confirmButtonColor: '#42ABE2',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    let url = "{{ route('ClinicalHistoryDetail', ':id') }}";
                    url = url.replace(':id', id);
                    window.location.href = url;
                });
            }

            $('#form-consulta').validate({
                rules: {
                    background: {
                        required: true,
                    },
                    razon: {
                        required: true,
                    },
                    diagnosis: {
                        required: true,
                    },
                    treatment: {
                        required: true,
                    },
                    exams: {
                        required: true,
                    },
                    studies: {
                        required: true,
                    },
                    center_id: {
                        required: true,
                    },
                    countMedicationAdd: {
                        required: true,
                    }
                },
                messages: {
                    background: {
                        required: "Antecedentes es obligatorio",
                    },
                    razon: {
                        required: "Razon de la visita es obligatoria",
                    },

                    diagnosis: {
                        required: "Diagnostico es obligatorio",
                    },
                    treatment: {
                        required: "Tratamiento es obligatorio",
                    },
                    exams: {
                        required: "Examenes es obligatorio",
                    },
                    studies: {
                        required: "Estudios es obligatorio",
                    },
                    center_id: {
                        required: "Centro es obligatorio",
                    },
                    countMedicationAdd: {
                        required: "debe agregar un tratamiento",
                    }
                }
            });
            $.validator.addMethod("onlyText", function(value, element) {
                let pattern = /^[a-zA-ZñÑáéíóúü0-9\s]+$/g;
                return pattern.test(value);
            }, "No se permiten caracteres especiales");

            //envio del formulario
            $("#form-consulta").submit(function(event) {
                event.preventDefault();
                $("#form-consulta").validate();
                if ($("#form-consulta").valid()) {
                    $('#send').hide();
                    $('#spinner').show();

                    let exams = $('#exams').val().split(',');

                    exams.map((element) => exams_array.push({
                        code_exams: element.slice(0, 14)
                    }));

                    let studies = $('#studies').val().split(',');

                    studies.map((element) => studies_array.push({
                        code_studies: element.slice(0, 14)
                    }));

                    //preparar la data para el envio
                    let formData = $('#form-consulta').serializeArray();
                    let data = {};
                    formData.map((item) => data[item.name] = item.value);
                    data["exams_array"] = JSON.stringify(exams_array);
                    data["studies_array"] = JSON.stringify(studies_array);
                    data["medications_supplements"] = JSON.stringify(medications_supplements);

                    ////end
                    $.ajax({
                        url: '{{ route('MedicalRecordCreate') }}',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data": JSON.stringify(data),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#form-consulta").trigger("reset");
                            $('#table-medicamento > tbody').empty();
                            Swal.fire({
                                icon: 'success',
                                title: 'Consulta registrada exitosamente!',
                                allowOutsideClick: false,
                                confirmButtonColor: '#42ABE2',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                let url =
                                    "{{ route('get_medical_record_user', ':id') }}";
                                url = url.replace(':id', id);
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    headers: {
                                        'X-CSRF-TOKEN': $(
                                                'meta[name="csrf-token"]')
                                            .attr(
                                                'content')
                                    },
                                    success: function(res) {
                                        let data = [];
                                        res.map((elem) => {
                                            let route =
                                                "{{ route('PDF_medical_record', ':id') }}";
                                            route = route
                                                .replace(
                                                    ':id', elem
                                                    .id);
                                            elem.btn = `
                                                    <a target="_blank"
                                                    href=${route}>
                                                    <button type="button"
                                                    class="btn-2 refresf btnSecond"><i
                                                    class="bi bi-file-earmark-pdf"></i></button>
                                                    </a>                               `;
                                            data.push(elem);
                                        });

                                        new DataTable(
                                            '#table-medical-record', {
                                                language: {
                                                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                                                },
                                                // reponsive: true,
                                                bDestroy: true,
                                                data: data,
                                                columns: [{
                                                        data: 'data.record_code',
                                                        title: 'Código de la consulta',
                                                        className: "text-center td-pad",
                                                    },
                                                    {
                                                        data: 'date',
                                                        title: 'Fecha de la consulta',
                                                        className: "text-center td-pad",
                                                    },
                                                    {
                                                        data: 'name_patient',
                                                        title: 'Nombre del paciente',
                                                        className: "text-center td-pad",
                                                    },
                                                    {
                                                        data: 'genere',
                                                        title: 'Género',
                                                        className: "text-center td-pad",
                                                    },
                                                    {
                                                        data: 'center',
                                                        title: 'Centro',
                                                        className: "text-center td-pad",
                                                    },
                                                    {
                                                        data: 'full_name_doc',
                                                        title: 'Médico',
                                                        className: "text-center td-pad",
                                                    },
                                                    {
                                                        data: 'btn',
                                                        title: 'Ver',
                                                        className: "text-center td-pad",
                                                    }
                                                ],
                                            });
                                        $('#table-medical-record').on(
                                            'click', 'td',
                                            function() {
                                                let table =
                                                    new DataTable(
                                                        '.table'
                                                    );
                                                let row = table.row(
                                                    this).data();
                                                showDataEdit(row);
                                            })

                                    }
                                });
                            });
                        },
                        error: function(error) {
                            $('#send').show();
                            $('#spinner').hide();
                            console.log(error);

                        }
                    });
                }
            });
        });

        function resetForm() {
            $("#medical_record_id").val('');
            $("#form-consulta").trigger("reset");
            $('#table-medicamento > tbody').empty();
            $('.send').attr('disabled', false);
        }

        function showDataEdit(item) {
            $("#medical_record_id").val(item.id);
            $("#center_id").val(item.data.center_id).change();
            $("#background").val(item.data.background);
            $("#razon").val(item.data.razon);
            $("#diagnosis").val(item.data.diagnosis);
            $("#treatment").val(item.data.treatment);
            $("#exams").val(item.data.exams);
            $("#studies").val(item.data.studies);
            $('.send').attr('disabled', true);
            $('#table-medicamento > tbody').empty();
            item.data.medications_supplements.map((element, key) => {
                countMedicationAdd = countMedicationAdd + 1;
                var row = `
                        <tr id="${countMedicationAdd}">
                        <td class="text-center">${element.medicine}</td>
                        <td class="text-center">${element.indication}</td>
                        <td class="text-center">${element.treatmentDuration}</td>                  
                        <td class="text-center"><span onclick="deleteMedication(${countMedicationAdd})" ><i class="bi bi-archive"></i></span></td>                    
                        </tr>`;
                $('#table-medicamento').find('tbody').append(row);

            });
        }

        function search(e, id) {
            var value = e.target.value.toLowerCase();
            $(`#${id} li`).filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(e.target.value) > -1);
            });
        }

        function setExams(e) {

            if ($(`#${e.target.id}`).is(':checked')) {
                valExams = (valExams == "") ? e.target.value : valExams + "," + e.target.value;
                valExams = valExams.replace(',,', ',');
                $("#exams").val(valExams);
            } else {
                valExams = valExams.replace(e.target.value, '');
                valExams = valExams.replace(',,', ',');
                if (valExams == ",") valExams = valExams.replace(',', '');
                $("#exams").val(valExams);
            }
        }

        function setStudy(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                valStudy = (valStudy == "") ? e.target.value : valStudy + "," + e.target.value;
                valStudy = valStudy.replace(',,', ',');
                $("#studies").val(valStudy);
            } else {
                valStudy = valStudy.replace(e.target.value, '');
                valStudy = valStudy.replace(',,', ',');
                if (valStudy == ",") valStudy = valStudy.replace(',', '');
                $("#studies").val(valStudy);
            }
        }

        //agregar medicamento
        function addMedacition(e) {
            // validaciones para agragar medicacion
            if ($('#medicine').val() === "") {
                $("#medicine_span").text('Campo obligatorio');
            } else if ($('#indication').val() === "") {
                $("#indication_span").text('Campo obligatorio');
            } else if ($('#treatmentDuration').val() === "") {
                $("#treatmentDuration_span").text('Campo obligatorio');
            } else {
                $("#medicine_span").text('');
                $("#indication_span").text('');
                $("#treatmentDuration_span").text('');
                var row = `
                    <tr id="${countMedicationAdd}">
                    <td class="text-center">${$('#medicine').val()}</td>
                    <td class="text-center">${$('#indication').val()}</td>
                    <td class="text-center">${$('#treatmentDuration').val()}</td>                  
                    <td class="text-center"><span onclick="deleteMedication(${countMedicationAdd})" ><i class="bi bi-archive"></i></span></td>                    
                    </tr>`;
                $('#table-medicamento').find('tbody').append(row);

                medications_supplements.push({
                    medicine: $('#medicine').val(),
                    indication: $('#indication').val(),
                    treatmentDuration: $('#treatmentDuration').val()
                });

                countMedicationAdd = countMedicationAdd + 1;
                $('#countMedicationAdd').val(countMedicationAdd);
                // limpiar campos
                $('#medicine').val("");
                $('#indication').val("");
                $('#treatmentDuration').val("");
            }
        }

        //borrar medicamento
        function deleteMedication(count) {
            $('#table-medicamento tr#' + count).remove();
            medications_supplements.splice(count, 1);
            countMedicationAdd = countMedicationAdd - 1;
            $('#countMedicationAdd').val(countMedicationAdd);
            if (countMedicationAdd === 0) $('#countMedicationAdd').val('');
        }
    </script>
@endpush
@section('content')
    <div class="container-fluid" style="padding: 3%">
        @if ($validate_histroy != null)
            <div class="accordion" id="accordionExample">
                {{-- datos del paciente --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingOne">
                                <button class="accordion-button bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-person"></i></i> Datos del paciente
                                </button>
                            </span>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-sm-2 col-md-3 col-lg-2 col-xl-2 col-xxl-2" style="width: 180px;">
                                            <img src="{{ asset('/imgs/' . $Patient->patient_img) }}" width="150"
                                                height="150" alt="Imagen del paciente" class="img-medical">
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <strong>Nombre:</strong><span class="text-capitalize">
                                                {{ $Patient->last_name . ', ' . $Patient->name }}</span>
                                            <br>
                                            <strong>Fecha de Nacimiento:</strong><span>
                                                {{ date('d-m-Y', strtotime($Patient->birthdate)) }}</span>
                                            <br>
                                            <strong>Edad:</strong><span> {{ $Patient->age }} años</span>
                                            <br>
                                            <strong>{{ $Patient->is_minor === 'true' ? 'Cédula de identidad del representante:' : 'Cédula de identidad:' }}</strong>
                                            <span>
                                                {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                            <br>
                                            <strong>Genero:</strong> <span class="text-capitalize">
                                                {{ $Patient->genere }}</span>
                                            <br>
                                            <strong>Nº Historial:</strong><span> {{ $Patient->get_history->cod_history }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- consulta médica --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingTwo">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> Consulta médica
                                </button>
                            </span>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form id="form-consulta" method="post" action="/">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="medical_record_id" id="medical_record_id"
                                            value="">
                                        <input type="hidden" name="id" id="id" value="{{ $Patient->id }}">
                                        <div id="input-array"></div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <div class="Icon-inside">
                                                        <label for="phone" class="form-label"
                                                            style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Centro
                                                            de salud</label>
                                                        <select name="center_id" id="center_id"
                                                            placeholder="Seleccione"class="form-control"
                                                            class="form-control combo-textbox-input">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($doctor_centers as $item)
                                                                <option value="{{ $item->center_id }}">
                                                                    {{ $item->get_center->description }}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="bi bi-three-dots-vertical st-icon"></i>
                                                        <span id="type_alergia_span" class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Antecedentes</label>
                                                    <textarea id="background" rows="8" name="background" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Razon
                                                        de la visita</label>
                                                    <textarea id="razon" rows="8" name="razon" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Diagnóstico</label>
                                                    <textarea id="diagnosis" rows="8" name="diagnosis" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Tratamiento</label>
                                                    <textarea id="treatment" rows="8" name="treatment" class="form-control"></textarea>
                                                </div>
                                            </div> --}}

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="search_patient"
                                                        class="form-label"style="font-size: 13px; margin-bottom: 5px;">Buscar
                                                        Examen</label>
                                                    <input onkeyup="search(event,'exam')" type="text"
                                                        class="form-control" id="floatingInput" placeholder="">
                                                </div>
                                                <div class="overflow-auto p-3 bg-light mt-3"
                                                    style="max-width: 100%; max-height: 200px;">
                                                    @foreach ($exam as $key => $item)
                                                        <ul id="exam">
                                                            <li> <label><input type="checkbox" onclick="setExams(event)"
                                                                        name="chk{{ $key }}"
                                                                        id="{{ $key }}"
                                                                        value="{{ $item->cod_exam . '|' . $item->description }}">
                                                                    {{ $item->description }}</label><br>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Examenes</label>
                                                    <textarea readonly id="exams" rows="8" name="exams" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="search_patient"
                                                        class="form-label"style="font-size: 13px; margin-bottom: 5px;">Buscar
                                                        Estudio</label>
                                                    <input onkeyup="search(event,'studie')" type="text"
                                                        class="form-control" placeholder="" id="floatingInputt">
                                                </div>
                                                <div class="overflow-auto p-3 bg-light mt-3"
                                                    style="max-width: 100%; max-height: 200px;">
                                                    @foreach ($study as $key => $item)
                                                        <ul id="studie">
                                                            <li> <label><input type="checkbox"
                                                                        name="chk{{ $key }}"
                                                                        id="chectt{{ $key }}"
                                                                        onclick="setStudy(event)"
                                                                        value="{{ $item->cod_study . '|' . $item->description }}">
                                                                    {{ $item->description }}</label><br>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Estudios</label>
                                                    <textarea readonly id="studies" rows="8" name="studies" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Medicacion --}}
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="row mt-3">
                                                    <hr>
                                                    <h5 class="text-center collapseBtn">Tratamiento</h5>
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">Medicamento</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-only-text" id="medicine"
                                                                    name="medicine" type="text" value="">
                                                                <i class="bi bi-three-dots-vertical st-icon"></i>
                                                            </div>
                                                            <span id="medicine_span" class="text-danger"></span>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 14px; margin-bottom: 5px; margin-top: 4px">Indicaciones</label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-only-text" id="indication"
                                                                    name="indication" type="text" value="">
                                                                <i class="bi bi-three-dots-vertical st-icon"></i>
                                                            </div>
                                                            <span id="indication_span" class="text-danger"></span>
                                                        </diV>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                        <div class="form-group">
                                                            <div class="Icon-inside">
                                                                <label for="phone" class="form-label"
                                                                    style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Duración
                                                                    de tratamiento
                                                                </label>
                                                                <input autocomplete="off"
                                                                    class="form-control mask-only-text"
                                                                    id="treatmentDuration" name="treatmentDuration"
                                                                    type="text" value="">
                                                                <i class="bi bi-three-dots-vertical st-icon"></i>
                                                            </div>
                                                            <span id="treatmentDuration_span" class="text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 mt-3 offset-md-5">
                                                        <span type="" onclick="addMedacition(event)"
                                                            class="btn btn-outline-secondary" id="btn"><i
                                                                class="bi bi-plus-lg"></i>Añadir
                                                            Tratamiento</span>
                                                    </div>
                                                </div>
                                                {{-- tabla --}}
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-responsive"
                                                        style="margin-top: 20px; width: 100%;">
                                                        <hr>
                                                        <h5>Lista de Tratamiento</h5>
                                                        <hr>
                                                        <table class="table table-striped table-bordered"
                                                            id="table-medicamento">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" scope="col">
                                                                        Medicamento</th>
                                                                    <th class="text-center" scope="col">
                                                                        Indicaciones</th>
                                                                    <th class="text-center" scope="col">
                                                                        Duración de tratamiento
                                                                    </th>
                                                                    <th class="text-center" scope="col">
                                                                        Eliminar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {{-- @if ($validateHistory)
                                                                                @if ($validateHistory->medications_supplements != 'null')
                                                                                    @php
                                                                                        $medications_supplements = json_decode($validateHistory->medications_supplements, true);
                                                                                    @endphp
                                                                                    @foreach ($medications_supplements as $key => $item)
                                                                                        <tr id="{{ $key }}">
                                                                                            <td class="text-center">
                                                                                                {{ $item['indication'] }}</td>
                                                                                            <td class="text-center">
                                                                                                {{ $item['medicine'] }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $item['treatmentDuration'] }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $item['viaAdmin'] }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $item['NUmberOrder'] }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $item['dateEndTreatment'] }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $item['dateIniTreatment'] }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $item['treatmentDuration'] }}
                                                                                            </td>
                                                                                            <td class="text-center"><span
                                                                                                    onclick="deleteMedication({{ $key }})"><i
                                                                                                        class="bi bi-archive"></i></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @endif
                                                                            @endif --}}
                                                            </tbody>
                                                        </table>
                                                        <tfoot>
                                                            <div class="row mt-3">
                                                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                                    <div class="input-group flex-nowrap">
                                                                        <span class="input-group-text">Total de
                                                                            medicamentos
                                                                        </span>
                                                                        <input type="text" id="countMedicationAdd"
                                                                            name="countMedicationAdd" class="form-control"
                                                                            readonly value="{!! !empty($validateHistory)
                                                                                ? ($validateHistory->medications_supplements != 'null'
                                                                                    ? count($medications_supplements)
                                                                                    : 0)
                                                                                : '' !!}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tfoot>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div id="spinner" style="display: none">
                                                    <x-load-spinner show="true" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 justify-content-md-end">
                                            <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12"
                                                id="send" style="display: flex; justify-content: flex-end;">
                                                <input class="btn btnSave send" value="Guardar Consulta"
                                                    type="submit" />
                                                <button style="margin-left: 20px; padding: 8px;" type="button"
                                                    onclick="resetForm();" class="btn btnSecond" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" data-html="true"
                                                    title="Limpiar Formulario">
                                                    <i class="bi bi-eraser"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- tabla --}}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-3 mb-cd" style="margin-top: 20px;">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingThree">
                                <button class="accordion-button collapsed bg-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                    style="width: -webkit-fill-available; width: -moz-available; width: fill-available;">
                                    <i class="bi bi-file-earmark-text"></i> Ultimas Consultas
                                </button>
                            </span>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row" id="table-one">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 table-resposive"
                                            style="margin-top: 20px; width: 100%;">
                                            <table class="table table-striped table-bordered" id="table-medical-record"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">Código de la consulta</th>
                                                        <th class="text-center" scope="col">Fecha de la consulta</th>
                                                        <th class="text-center" scope="col">Nombre del paciente</th>
                                                        <th class="text-center" scope="col">Género</th>
                                                        <th class="text-center" scope="col">Centro</th>
                                                        <th class="text-center" scope="col">Médico</th>
                                                        <th class="text-center" scope="col">Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medical_record_user as $item)
                                                        <tr onclick="showDataEdit({{ json_encode($item) }});">
                                                            <td class="text-center td-pad">
                                                                {{ $item['data']['record_code'] }}</td>
                                                            <td class="text-center td-pad">{{ $item['date'] }}</td>
                                                            <td class="text-center td-pad text-capitalize">
                                                                {{ $item['name_patient'] }}
                                                            </td>
                                                            <td class="text-center td-pad">{{ $item['genere'] }}
                                                            </td>
                                                            <td class="text-center td-pad">{{ $item['center'] }}</td>
                                                            <td class="text-center td-pad">{{ $item['full_name_doc'] }}
                                                            </td>
                                                            <td class="text-center td-pad">
                                                                <div class="d-flex">
                                                                    @if ($item['data']['status_exam'])
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <a href="{{ route('mr_exam', $item['id']) }}">
                                                                                <button type="button" class="btn refresf btn-iSecond rounded-circle"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="bottom"
                                                                                        data-bs-custom-class="custom-tooltip"
                                                                                        data-html="true"
                                                                                        title="ver examenes">
                                                                                    <i class="i bi-card-heading" ></i>
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; align-items: center;
                                                                        justify-content: center;">
                                                                            <i class="bi bi-exclamation-circle" data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom"
                                                                            data-bs-custom-class="custom-tooltip"
                                                                            data-html="true"
                                                                            title="No hay examenes cargados" style="font-size: 23px; color: #ff7b0d"></i>
                                                                        </div>
                                                                    @endif
                                                                    @if ($item['data']['status_study'])
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                                                            <a href="{{ route('mr_study', $item['id']) }}">
                                                                                <button type="button" class="btn refresf btn-iSecond rounded-circle" 
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true"
                                                                                    title="ver estudios">
                                                                                    <i class="i bi-card-heading"></i>
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4" style="display: flex; align-items: center;
                                                                        justify-content: center;">
                                                                            <i class="bi bi-exclamation-circle" data-bs-toggle="tooltip"
                                                                            data-bs-placement="bottom"
                                                                            data-bs-custom-class="custom-tooltip"
                                                                            data-html="true"
                                                                            title="No hay estudios cargados" style="font-size: 23px; color: #ff7b0d"></i>
                                                                        </div>
                                                                    @endif
                                                                    <div
                                                                        class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">

                                                                        <a target="_blank"
                                                                            href="{{ route('PDF_medical_record', $item['id']) }}">
                                                                            <button type="button"
                                                                                class="btn refresf btn-iSecond rounded-circle"><i
                                                                                    class="bi bi-file-earmark-pdf"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    data-bs-custom-class="custom-tooltip"
                                                                                    data-html="true" title="ver PDF"></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
