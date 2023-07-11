@extends('layouts.app-auth')
@section('title', 'Historia Clínica')
<script src="{{ asset('jquery-ui-1.13.2/external/jquery/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('jquery-validation-1.19.5/dist/jquery.validate.min.js') }}" type="text/javascript"></script>

@push('scripts')
    <script>
        let back_family = [];
        let allergies = [];
        let history_pathological = [];
        let history_non_pathological = [];
        let history_surgical = [];
        let history_gynecological = [];
        let medications_supplements = [];
        let countBackFamily = 0;
        let countAllergies = 0;
        let countDiagnosis = 0;
        let countSurgical = 0;
        let countNotPathological = 0;
        let countGynecological = 0;
        let countMedicationSupplements = 0;

        $(document).ready(() => {
            $("#alert").hide();
            $('#form-mecal-histroy').validate({
                rules: {
                    countBackFamily: {
                        required: true,
                    },
                    countAllergies: {
                        required: true,
                    },
                    countDiagnosis: {
                        required: true,
                    },
                    countSurgical: {
                        required: true,
                    },
                    countNotPathological: {
                        required: true,
                    },
                    countGynecological: {
                        required: true,
                    },
                    weight: {
                        required: true,
                        onlyNumber: true
                    },
                    height: {
                        required: true,
                        onlyNumber: true
                    },
                },
                messages: {
                    countBackFamily: {
                        required: "Debe seleccionar una opción",
                    },
                    countAllergies: {
                        required: "Debe seleccionar una opción",
                    },
                    countDiagnosis: {
                        required: "Debe seleccionar una opción",
                    },
                    countSurgical: {
                        required: "Debe seleccionar una opción",
                    },
                    countNotPathological: {
                        required: "Debe seleccionar una opción",
                    },
                    countGynecological: {
                        required: "Debe seleccionar una opción",
                    },
                    weight: {
                        required: "Peso es obligatorio",
                    },
                    height: {
                        required: "Altura es obligatoria",
                    },
                }
            });
            $.validator.addMethod("onlyNumber", function(value, element) {
                var pattern = /^\d+\.?\d*$/;
                return pattern.test(value);
            }, "Campo solo numero");

            //envio del formulario
            $("#form-mecal-histroy").submit(function(event) {
                event.preventDefault();
                $("#form-mecal-histroy").validate();
                if ($("#form-mecal-histroy").valid()) {
                    $('#send').hide();
                    $('#spinner').show();
                    var data = $('#form-mecal-histroy').serialize();
                    $.ajax({
                        url: '{{ route('ClinicalHistoryCreate') }}',
                        type: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#send').show();
                            $('#spinner').hide();
                            $("#alert").show()
                            $("#alert").text("Registro Exitioso");
                            $("#form-mecal-histroy").trigger("reset");
                            setTimeout(() => {
                                $("#alert").hide();
                            }, 3500);
                        },
                        error: function(error) {
                            $('#send').show();
                            $('#spinner').hide();
                            console.log(error.responseJSON.errors);

                        }
                    });
                }
            })
        })

        function eventeShow(event) {
            if (Number(event.target.value) === 1) {
                $("#div-hidden").show();
                $("#div-show").hide();
            } else {
                $("#div-hidden").hide();
                $("#div-show").show();
            }
        }

        function handlerBackFamiliy(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                countBackFamily = countBackFamily + 1;
                back_family.push(e.target.value);
                $('#back_family').val(back_family);
                $('#countBackFamily').val(countBackFamily);
            } else {
                back_family = back_family.filter(elem => elem !== e.target.value);
                $('#back_family').val(back_family);
                countBackFamily = countBackFamily - 1;
                $('#countBackFamily').val(countBackFamily);
            }
        }

        function handlerAllergies(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                allergies.push(e.target.value);
                $('#allergies').val(allergies);
                countAllergies = countAllergies + 1;
                $('#countAllergies').val(countAllergies);
            } else {
                allergies = allergies.filter(elem => elem !== e.target.value);
                $('#allergies').val(allergies);
                countAllergies = countAllergies - 1;
                $('#countAllergies').val(countAllergies);

            }
        }

        function handlerDiagnosis(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_pathological.push(e.target.value);
                $('#history_pathological').val(history_pathological);
                countDiagnosis = countDiagnosis + 1;
                $('#countDiagnosis').val(countDiagnosis);
            } else {
                history_pathological = history_pathological.filter(elem => elem !== e.target.value);
                $('#history_pathological').val(history_pathological);
                countDiagnosis = countDiagnosis - 1;
                $('#countDiagnosis').val(countDiagnosis);

            }
        }

        function handlerSurgical(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_surgical.push(e.target.value);
                $('#history_surgical').val(history_surgical);
                countSurgical = countSurgical + 1;
                $('#countSurgical').val(countSurgical);
            } else {
                history_surgical = history_surgical.filter(elem => elem !== e.target.value);
                $('#history_surgical').val(history_surgical);
                countSurgical = countSurgical - 1;
                $('#countSurgical').val(countSurgical);

            }
        }

        function handlerNotPathologica(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_non_pathological.push(e.target.value);
                $('#history_non_pathological').val(history_non_pathological);
                countNotPathological = countNotPathological + 1;
                $('#countNotPathological').val(countNotPathological);
            } else {
                history_non_pathological = history_non_pathological.filter(elem => elem !== e.target.value);
                $('#history_non_pathological').val(history_non_pathological);
                countNotPathological = countNotPathological - 1;
                $('#countNotPathological').val(countNotPathological);

            }
        }

        function handlerGynecological(e) {
            if ($(`#${e.target.id}`).is(':checked')) {
                history_gynecological.push(e.target.value);
                $('#history_gynecological').val(history_gynecological);
                countGynecological = countGynecological + 1;
                $('#countGynecological').val(countGynecological);
            } else {
                history_gynecological = history_gynecological.filter(elem => elem !== e.target.value);
                $('#history_gynecological').val(history_gynecological);
                countGynecological = countGynecological - 1;
                $('#countGynecological').val(countGynecological);
            }
        }
    </script>
@endpush
@section('content')
    <div>
        <div class="container-fluid">
            <form id="form-mecal-histroy" method="post" action="/">
                {{ csrf_field() }}
                <div class="row mt-3">
                    <input type="hidden" name="id" value="{{$Patient->id}}">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Historia clínica</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <div class="card">
                                            <img src="{{ asset('img/People-Patient-Male-icon.png') }}" width="150"
                                                height="150" alt="Imagen del paciente">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <span>Paciente:</span>
                                        <br>
                                        <span>{{ $Patient->name . ',' . $Patient->last_name }}</span>
                                        <br>
                                        <span>Fecha de Nacimiento:</span>
                                        <br>
                                        <span>{{ $Patient->birthdate }}</span>
                                    </div>

                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <span>Atendido por:</span>
                                        <br>
                                        <span>MARTINEZ, JHONNY</span>
                                        <br>
                                        <span>Edad:</span>
                                        <br>
                                        <span>20 años</span>
                                    </div>

                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <span>Día:</span>
                                        <br>
                                        <span>12/06/2022</span>
                                        <br>
                                        <span>Aseguradora:</span>
                                        <br>
                                        <span>Matrix</span>
                                    </div>

                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <span>Hora de Cita:</span>
                                        <br>
                                        <span>10:15</span>
                                        <br>
                                        <span>Profesión:</span>
                                    </div>

                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <span>Inicio:</span>
                                        <br>
                                        <span>14:41</span>
                                        <br>
                                        <span>Referido:</span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Peso"
                                                    class="form-control @error('weight') is-invalid @enderror"
                                                    id="weight" name="weight" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                        <div class="form-group">
                                            <div class="Icon-inside">
                                                <input autocomplete="off" placeholder="Altura"
                                                    class="form-control @error('height') is-invalid @enderror"
                                                    id="height" name="height" type="text" value="">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </diV>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- antecedentes falimilares --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Antecedentes Personales y Familiares</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="back_family[]" id="back_family" value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" class="form-check"
                                                        name="sin_interes" type="checkbox" id="sin_interes"
                                                        value="Sin Interes">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Sin Interes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="HTA"
                                                        class="form-check" name="HTA" type="checkbox" id="HTA">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        HTA
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Diabete"
                                                        class="form-check" name="Diabete" type="checkbox" id="Diabete">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Diabete
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Cardiacos"
                                                        class="form-check" name="Cardiacos" type="checkbox" id="Cardiacos">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Cardiacos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Coagulooia"
                                                        class="form-check" name="Coagulooia" type="checkbox"
                                                        id="Coagulooia">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Coagulooia
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" class="form-check"
                                                        name="Temblosis" type="checkbox" id="Temblosis"
                                                        value="Temblosis">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Temblosis venenosa</label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Embolia"
                                                        class="form-check" name="Embolia" type="checkbox"
                                                        id="Embolia">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Embolia pulmorar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Cancer"
                                                        class="form-check" name="Cancer" type="checkbox"
                                                        id="Cancer">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Cancer
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="Tranfusiones"
                                                        class="form-check" name="Tranfusiones" type="checkbox"
                                                        id="Tranfusiones">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Tranfusiones sanguineas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerBackFamiliy(event);" value="COVID19"
                                                        class="form-check" name="COVID19" type="checkbox"
                                                        id="COVID19">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        COVID19
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="">Total Antecedentes</span>
                                            <input type="text" id="countBackFamily" name="countBackFamily"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- alergias --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Alergias Conocidas</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="allergies[]" id="allergies" value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" class="form-check"
                                                        name="NAMC" type="checkbox" id="NAMC" value="NAMC">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        NAMC
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="LACTAMICOS"
                                                        class="form-check" name="LACTAMICOS" type="checkbox"
                                                        id="LACTAMICOS">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        B-LACTAMICOS
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="SULFAMIDAS"
                                                        class="form-check" name="SULFAMIDAS" type="checkbox"
                                                        id="SULFAMIDAS">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        SULFAMIDAS Paciente
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="NOLOTIL"
                                                        class="form-check" name="NOLOTIL" type="checkbox"
                                                        id="NOLOTIL">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        NOLOTIL
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="IBUPROFENO"
                                                        class="form-check" name="IBUPROFENO" type="checkbox"
                                                        id="IBUPROFENO">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        IBUPROFENO
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" class="form-check"
                                                        name="ANTOCOLBULCIVOS" type="checkbox" id="ANTOCOLBULCIVOS"
                                                        value="ANTOCOLBULCIVOS">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        ANTOCOLBULCIVOS
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="INSULINA"
                                                        class="form-check" name="INSULINA" type="checkbox"
                                                        id="INSULINA">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        INSULINA
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="YODO"
                                                        class="form-check" name="YODO" type="checkbox"
                                                        id="YODO">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        YODO
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="LATEX"
                                                        class="form-check" name="LATEX" type="checkbox"
                                                        id="LATEX">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        LATEX
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerAllergies(event);" value="AINES"
                                                        class="form-check" name="AINES" type="checkbox"
                                                        id="AINES">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        AINES
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="">Total alergias</span>
                                            <input type="text" id="countAllergies" name="countAllergies"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Diagnóstico --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Diagnóstico</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="history_pathological[]" id="history_pathological"
                                        value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" class="form-check"
                                                        name="sin_diagnostico" type="checkbox" id="sin_diagnostico"
                                                        value="sin_diagnostico">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Sin determinar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="vision_borrosa"
                                                        class="form-check" name="vision_borrosa" type="checkbox"
                                                        id="vision_borrosa">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Vision borrosa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="perdida_peso"
                                                        class="form-check" name="perdida_peso" type="checkbox"
                                                        id="perdida_peso">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Perdida de peso inexplicada
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="fatiga"
                                                        class="form-check" name="fatiga" type="checkbox"
                                                        id="fatiga">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Fatiga
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerDiagnosis(event);" value="POLIDIPSIA"
                                                        class="form-check" name="POLIDIPSIA" type="checkbox"
                                                        id="POLIDIPSIA">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        POLIDIPSIA-R631
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total Diagnóstico
                                            </span>
                                            <input type="text" id="countDiagnosis" name="countDiagnosis"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia quirúrgica --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Historia quirúrgica</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="history_surgical[]" id="history_surgical"
                                        value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerSurgical(event);" class="form-check"
                                                        name="sin_quirúrgica" type="checkbox" id="sin_quirúrgica"
                                                        value="sin_quirúrgica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Sin determinar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerSurgical(event);"
                                                        value="vision_borrosa_quirúrgica" class="form-check"
                                                        name="vision_borrosa_quirúrgica" type="checkbox"
                                                        id="vision_borrosa_quirúrgica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Vision borrosa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerSurgical(event);"
                                                        value="perdida_peso_quirúrgica" class="form-check"
                                                        name="perdida_peso_quirúrgica" type="checkbox"
                                                        id="perdida_peso_quirúrgica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Perdida de peso inexplicada
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerSurgical(event);" value="fatiga_quirúrgica"
                                                        class="form-check" name="fatiga_quirúrgica" type="checkbox"
                                                        id="fatiga_quirúrgica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Fatiga
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerSurgical(event);" value="POLIDIPSIA_quirúrgica"
                                                        class="form-check" name="POLIDIPSIA_quirúrgica" type="checkbox"
                                                        id="POLIDIPSIA_quirúrgica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        POLIDIPSIA-R631
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total historia quirúrgica
                                            </span>
                                            <input type="text" id="countSurgical" name="countSurgical"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia ginecológica --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Historia ginecológica</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="history_gynecological[]" id="history_gynecological"
                                        value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);" class="form-check"
                                                        name="sin_diagnostico_Pathologica" type="checkbox"
                                                        id="sin_diagnostico_gynecological"
                                                        value="sin_diagnostico_gynecological">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Sin determinar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value="vision_borrosa_gynecological" class="form-check"
                                                        name="vision_borrosa_gynecological" type="checkbox"
                                                        id="vision_borrosa_gynecological">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Vision borrosa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value="perdida_peso_gynecological" class="form-check"
                                                        name="perdida_peso_gynecological" type="checkbox"
                                                        id="perdida_peso_gynecological">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Perdida de peso inexplicada
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value="fatiga_gynecological" class="form-check"
                                                        name="fatiga_gynecological" type="checkbox"
                                                        id="fatiga_gynecological">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Fatiga
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerGynecological(event);"
                                                        value="POLIDIPSIA_gynecological" class="form-check"
                                                        name="POLIDIPSIA_gynecological" type="checkbox"
                                                        id="POLIDIPSIA_gynecological">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        POLIDIPSIA-R631
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total historia ginecológica
                                            </span>
                                            <input type="text" id="countGynecological" name="countGynecological"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- historia no patologica --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Historia no patológica</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="history_non_pathological[]" id="history_non_pathological"
                                        value="">
                                    <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4">
                                        <div class="floating-label-group">
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);" class="form-check"
                                                        name="sin_diagnostico_no_patologica" type="checkbox"
                                                        id="sin_diagnostico_no_patologica"
                                                        value="sin_diagnostico_no_patologica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Sin determinar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);"
                                                        value="vision_borrosa_no_patologica" class="form-check"
                                                        name="vision_borrosa_no_patologica" type="checkbox"
                                                        id="vision_borrosa_no_patologica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Vision borrosa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);"
                                                        value="perdida_peso_no_patologica" class="form-check"
                                                        name="perdida_peso_no_patologica" type="checkbox"
                                                        id="perdida_peso_no_patologica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Perdida de peso inexplicada
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);"
                                                        value="fatiga_no_patologica" class="form-check"
                                                        name="fatiga_no_patologica" type="checkbox"
                                                        id="fatiga_no_patologica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        Fatiga
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check" style="display: flex; ">
                                                <div style="margin-right: 30px;">
                                                    <input onclick="handlerNotPathologica(event);"
                                                        value="POLIDIPSIA_no_patologica" class="form-check"
                                                        name="POLIDIPSIA_no_patologica" type="checkbox"
                                                        id="POLIDIPSIA_no_patologica">
                                                </div>
                                                <div>
                                                    <label style="font-size: 15px;" class="form-check-label"
                                                        for="flexCheckDefault">
                                                        POLIDIPSIA-R631
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3 md-3 lg-3 xl-3 xxl-3">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Total historia no patológica
                                            </span>
                                            <input type="text" id="countNotPathological" name="countNotPathological"
                                                class="form-control" readonly value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Medicacion --}}
                <div class="row  mt-3">
                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">
                        <div class="card">
                            <div class="card-header collapseBtn">
                                <h3>Medicación</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="medications_supplements[]" id="medications_supplements"
                                    value="">
                                <div class="row  mt-3">
                                    <div class="col-sm-12 md-12 lg-12 xl-12 xxl-12">                                     

                                        {{-- <div class="row" id="div-hidden">
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                            <div class="col-sm-4 md-4 lg-4 xl-4 xxl-4 mt-3">
                                                <button class="btn btn-outline-secondary"><i
                                                        class="bi bi-plus-lg"></i>Añadir grupo
                                                    medicación</button>
                                            </div>
                                        </div> --}}

                                        <div class="row" id="div-show">
                                            <h1 class="text-center">Anadir Medicamento</h1>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Medicamento" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Dosis" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Posología" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Vía de administración" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Ud. por envase" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Num. de envases" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Frecuencia toma" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Duración tratamiento" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Fecha preescripción" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="dateP" name="names" type="date" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Fecha dispensación" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="dateD" name="names" type="date" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Nº Orden" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <div class="floating-label-group">
                                                    <select placeholder="Seleccione" class="form-control"
                                                        class="form-control combo-textbox-input">
                                                        <option value="1">Seleccione..</option>
                                                        <option value="2">Lactantes</option>
                                                        <option value="2">Ninos</option>
                                                        <option value="2">Adultos</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2">
                                                <input placeholder="Medicamento" autocomplete="off"
                                                    class="form-control @error('names') is-invalid @enderror"
                                                    id="names" name="names" type="text" value="">
                                            </div>
                                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                                <div class="floating-label-group">
                                                    <label class="floating-label">Documentos del paciente</label>
                                                    <select class="form-control form-textbox-input combo-textbox-input"
                                                        id="ddlTratamientos" name="Lista Tratamientos">
                                                        <option value="2">Docuemmtos</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6">
                                                <div class="floating-label-group">
                                                    <label class="floating-label">Consentimeiontos informados</label>
                                                    <select class="form-control form-textbox-input combo-textbox-input"
                                                        id="ddlTratamientos" name="Lista Tratamientos">
                                                        <option value="1">Consentimeiontos</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-2 md-2 lg-2 xl-2 xxl-2  mt-2">
                                                    <input class="btn btnPrimary send " value="Guardar" type="submit" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
