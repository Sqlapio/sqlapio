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
        let exams_array =  [];
        let studies_array =  [];
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
                    }
                }
            });
            $.validator.addMethod("onlyText", function(value, element) {
                let pattern = /^[a-zA-ZñÑáéíóúü0-9\s]+$/g;
                return pattern.test(value);
            }, "No se permiten caracteres especiales");

            try {
                //envio del formulario
                $("#form-consulta").submit(function(event) {
                    event.preventDefault();
                    $("#form-consulta").validate();
                    if ($("#form-consulta").valid()) {
                        $('#send').hide();
                        $('#spinner').show();

                        let exams = $('#exams').val().split(',');

                        exams.map((element) => exams_array.push({code_exams: element.slice(0, 14)}));

                        let studies = $('#studies').val().split(',');

                        studies.map((element) => studies_array.push({code_studies: element.slice(0, 14)}));

                        //preparar la data para el envio
                        let formData = $('#form-consulta').serializeArray();
                        let data = {};
                        formData.map((item) => data[item.name] = item.value);
                        data["exams_array"] = JSON.stringify(exams_array);
                        data["studies_array"] = JSON.stringify(studies_array);
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
                                                elem.btn =`
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
                                                    columns: [
                                                        {
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

            } catch (error) {
                console.log(error);

            }


        });

        function resetForm() {
            $("#medical_record_id").val('');
            $("#form-consulta").trigger("reset");
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
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
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
                                            <span >
                                                {{ $Patient->is_minor === 'true' ? $Patient->get_reprensetative->re_ci : $Patient->ci }}</span>
                                            <br>
                                            <strong>Genero:</strong> <span class="text-capitalize"> {{ $Patient->genere }}</span>
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
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

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Diagnóstico</label>
                                                    <textarea id="diagnosis" rows="8" name="diagnosis" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label"
                                                        style="font-size: 13px; margin-bottom: 5px; margin-top: 4px">Tratamiento</label>
                                                    <textarea id="treatment" rows="8" name="treatment" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-3">
                                                <div class="form-floating mb-3">
                                                    <input onkeyup="search(event,'exam')" type="text"
                                                        class="form-control" id="floatingInput" placeholder="">
                                                    <label for="floatingInput">Buscar Examen</label>
                                                </div>
                                                <div class="overflow-auto p-3 bg-light"
                                                    style="max-width: 100%; max-height: 200px;">
                                                    @foreach ($exam as $key => $item)
                                                        <ul id="exam">
                                                            <li> <label><input type="checkbox" onclick="setExams(event)"
                                                                        name="chk{{ $key }}"
                                                                        id="{{ $key }}"
                                                                        value="{{ $item->cod_exam . '|' . $item->description }}"> {{ $item->description }}</label><br>
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
                                                <div class="form-floating mb-3">
                                                    <input onkeyup="search(event,'studie')" type="text"
                                                        class="form-control" placeholder="" id="floatingInputt">
                                                    <label for="floatingInputt">Buscar Estudio</label>
                                                </div>
                                                <div class="overflow-auto p-3 bg-light"
                                                    style="max-width: 100%; max-height: 200px;">
                                                    @foreach ($study as $key => $item)
                                                        <ul id="studie">
                                                            <li> <label><input type="checkbox"
                                                                        name="chk{{ $key }}"
                                                                        id="chectt{{ $key }}"
                                                                        onclick="setStudy(event)"
                                                                        value="{{ $item->cod_study . '|' . $item->description }}"> {{ $item->description }}</label><br>
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
                                                <input class="btn btnPrimary send" value="Guardar Consulta" type="submit"/>
                                                <button style="margin-left: 20px; padding: 8px;" type="button"
                                                    onclick="resetForm();" class="btn btnSecond" data-bs-toggle="tooltip" data-bs-placement="bottom" data-html="true"
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
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" style="margin-top: 20px;">
                        <div class="accordion-item">
                            <span class="accordion-header title" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
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
                                            <table class="table table-striped table-bordered" id="table-medical-record" style="width: 100%;">
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
                                                            <td class="text-center td-pad">{{ $item['data']['record_code'] }}</td>
                                                            <td class="text-center td-pad">{{ $item['date'] }}</td>
                                                            <td class="text-center td-pad text-capitalize">{{ $item['name_patient'] }}
                                                            </td>
                                                            <td class="text-center td-pad">{{ $item['genere'] }}
                                                            </td>
                                                            <td class="text-center td-pad">{{ $item['center'] }}</td>
                                                            <td class="text-center td-pad">{{ $item['full_name_doc'] }}</td>
                                                            <td class="text-center td-pad"><a target="_blank"
                                                                    href="{{ route('PDF_medical_record', $item['id']) }}">
                                                                    <button type="button"
                                                                        class="btn refresf btn-iSecond rounded-circle"><i
                                                                            class="bi bi-file-earmark-pdf" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                            data-bs-custom-class="custom-tooltip" data-html="true"
                                                                            title="ver PDF"></i>
                                                                    </button>
                                                                </a></td>
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
