@extends('layouts.app-auth')
@section('title', 'Historial Médico')
<style>
    .ditaily-patients {
        font-size: 15px;
        text-align: justify;
    }

    .btns {
        font-size: 10px;
    }

    .alert {
        font-size: 15px;
        text-align: justify;
    }

    .button-patients-padre {
            text-align: left !important;
            display: flex;
        }

        .button-patients-hijo {
            width: 100% !important;
        }

        .hijo2 {
            margin-top: 0% !important;
        } 
    .color-p {
        background-color: #D9F4FF;
        font-size: 15px;
        text-align: justify;
        border-radius: 0 !important;

    }

    .class-icon {
        margin: 10px 10px 10px 10px;
    }

    .collapseBtn {
        color: #428bca;
    }

    @media screen and (max-width: 600px) {
        .btn {
            margin: 10px 10px 10px 10px !important;
        }



        .button-patients-padre {
            text-align: left !important;
            display: flex;
        }

        .button-patients-hijo {
            width: 100% !important;
        }

        .hijo2 {
            margin-top: 0% !important;
        }         

    }
</style>
@push('scripts')    
<script>
    $(document).ready(() => {
        const collapseElementList = document.querySelectorAll('.collapse');
        const collapseList = [...collapseElementList].map(collapseEl => {
            if (collapseEl.id !== "navbarToggleExternalContent") {
                new bootstrap.Collapse(collapseEl)
            }
        })
    })
</script>
@endpush
@section('content') 
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-md-center" style="margin-top: 0">                           
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                <button type="" class="btn btnPrimary">Visita
                                    rapida</button>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                <button type="" class="btn btnSecond ">Portal
                                    pacientes</button>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                <button type="" class="btn btnSecond ">Enviar
                                    SMS</button>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                <button type="" class="btn btnPrimary">Email</button>
                            </div>
                        </div>

                        <div class="row justify-content-md-center mt-1">
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                <button type="" class="btn btnPrimary">Editar</button>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                <button type="" class="btn btnPrimary">Bloques de
                                    citas</button>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                <button type="" class="btn btnPrimary">Citas de
                                    pacientes</button>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2"><button type="" class="btn btnPrimary">Borrar
                                    Paciente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <x-sidebar :btns="config('sidebar_item.patients')" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <div>
                                    <div class="patients-div">
                                        <div class="img">
                                            <img id="imgPaciente2" src="{{ asset('img/People-Client-Male-icon.png') }}"
                                                alt="Imagen del paciente" class="img-responsive"
                                                style="width:85px; height:64px;">
                                        </div>
                                        <div class="button-patients-padre margin-global">
                                            <div class="button-patients-hijo">
                                                <button type="button" class="btn  bnt2 btnPrimary">Nueva</button>
                                            </div>
                                            <div class="button-patients-hijo hijo2 margin-global">
                                                <button type="button" class="btn bnt2 btnPrimary">Subir</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="ditaily-patients">
                                            <strong>Nombre y Apellidos:</strong>
                                            <br>
                                            <span>Gloriany Perez</span>
                                            <br>
                                            <strong>Fecha de registro:</strong>
                                            <br>
                                            <span>06/06/2023</span>
                                            <br>
                                            <strong>Nº Historial:</strong>
                                            <br>
                                            <span>5</span>
                                            <br>
                                            <strong>CPN/Usuario Portal de Paciente:</strong>
                                            <br>
                                            <span>0002066000000005</span>
                                            <br>
                                            <strong>Password portal:</strong>
                                            <br>
                                            <span> 0412-123-4561</span>
                                            <br>
                                            <strong>Fecha nacimiento:</strong>
                                            <br>
                                            <span>martes, 6 de junio de 1989 (34 años)</span>
                                            <br>
                                            <strong>Profesión:</strong>
                                            <br>
                                            <span>Arquitecto</span>
                                            <br>
                                            <strong>Teléfono/SMS:</strong>
                                            <br>
                                            <span>0412-123-4561</span>
                                            <br>
                                            <strong>Email:</strong>
                                            <br>
                                            <span>Emial.@gmail.com</span>
                                            <br>
                                            <strong>Dirección:</strong>
                                            <br>
                                            <span>Dirección colinas de palo grande</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="alert alert-info" role="alert">
                                        <p>Atención:
                                            <br>
                                            Este menú sirve para revisar el historial de un paciente. Si pulsas en el icono
                                            lapiz y haces cambios en el historial pasado, los LOGs guardarán el comentario
                                            previo y el nuevo, quien y cuando se hicieron los cambios.
                                            Recuerda:
                                            Para escribir una visita nueva, acceda al menú CLÍNICA.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group noPaddingLeft noPaddingRight">
                                        <div class="floating-label-group">
                                            <label class="floating-label">Profesionales</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                id="ddlUsuarios" name="ddlUsuarios">
                                                <option value="">Seleccione</option>
                                                <option value="2">MARTINEZ, JHONNY</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group noPaddingLeft noPaddingRight" style="display: ">
                                        <div class="floating-label-group">
                                            <label class="floating-label">Especialidades</label>
                                            <select class="form-control form-textbox-input combo-textbox-input"
                                                id="ddlEspecialidades" name="ddlEspecialidades">
                                                <option value="">Seleccione</option>
                                                <option value="5">Anestesiología</option>
                                                <option value="6">Cardiología</option>
                                                <option value="7">Dermatología</option>
                                                <option value="2">Dermatology</option>
                                                <option value="8">Endocrinología</option>
                                                <option value="9">Gastroenterología</option>
                                                <option value="10">Geriatría</option>
                                                <option value="11">Ginecología</option>
                                                <option value="4">Gynecology</option>
                                                <option value="12">Hematología</option>
                                                <option value="13">Infectología</option>
                                                <option value="14">Medicina familiar y comunitaria</option>
                                                <option value="15">Medicina intensiva</option>
                                                <option value="16">Medicina interna</option>
                                                <option value="1">Odontology</option>
                                                <option value="3">Traumatology</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group noPaddingLeft noPaddingRight">
                                        <div class="floating-label-group">
                                            <label class="floating-label">Citas futuras</label>
                                            <select id="ddlCargarCitasFuturas"
                                                class="form-control form-textbox-input combo-textbox-input">
                                                <option value="false">Omitir citas futuras</option>
                                                <option value="true">Cargar citas futuras</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <button type="" class="btn btnPrimary"><span class="">Informe
                                            Completo</span></button>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <button type="" class="btn btnPrimary"><span class="">Expandir
                                            Todo</span></button>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                    <button type="" class="btn btnPrimary"><span class="">Contraer
                                            Todo</span></button>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="collapseBtn" data-bs-toggle="collapse"
                                                data-bs-target="#collapseExample1" aria-expanded="true"
                                                aria-controls="collapseExample1">
                                                Consulta realizada por el Doctor MARTINEZ, JHONNY (Caracas) Fecha:
                                                22/05/2023
                                            </button>
                                        </div>

                                        <div class="collapse" id="collapseExample1">
                                            <div class="card card-body color-p">
                                                <div>
                                                    <p>DIAGNÓSTICO: AFECCIONES RESPIRATORIAS DEBIDAS A OTROS
                                                        AGENTES EXTERNOS:J70
                                                        COMENTARIO: Citado por: JHONNY MARTINEZ
                                                        ANTECEDENTES: persona con problemas para respirar , Depresión,
                                                        Cardiacos
                                                        ALERGIA: El paciente es alegórico a la ampicilina</p>
                                                </div>

                                            </div>

                                            <div class="mt-3 class-icon">
                                                <i class="bi bi-file-earmark-fill"></i>
                                                <i class="bi bi-camera-fill"></i>
                                                <i class="bi bi-list-columns-reverse"></i>
                                                <i class="bi bi-pencil-fill"></i>
                                            </div>

                                            <div class="mt-3 class-icon">
                                                <i class="bi bi-plus-square-fill"></i>
                                                <i class="bi bi-plus-square-fill"></i>
                                                <i class="bi bi-plus-square-fill"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="collapseBtn" data-bs-toggle="collapse"
                                                data-bs-target="#collapseExample2" aria-expanded="false"
                                                aria-controls="collapseExample2">
                                                Consulta realizada por el Doctor MARTINEZ, JHONNY (Caracas) Fecha:
                                                22/05/2023
                                            </button>
                                        </div>

                                        <div class="collapse" id="collapseExample2">
                                            <div class="card card-body color-p">
                                                <div>
                                                    <p>DIAGNÓSTICO: AFECCIONES RESPIRATORIAS DEBIDAS A OTROS
                                                        AGENTES EXTERNOS:J70
                                                        COMENTARIO: Citado por: JHONNY MARTINEZ
                                                        ANTECEDENTES: persona con problemas para respirar , Depresión,
                                                        Cardiacos
                                                        ALERGIA: El paciente es alegórico a la ampicilina</p>
                                                </div>

                                            </div>

                                            <div class="mt-3 class-icon">
                                                <i class="bi bi-file-earmark-fill"></i>
                                                <i class="bi bi-camera-fill"></i>
                                                <i class="bi bi-list-columns-reverse"></i>
                                                <i class="bi bi-pencil-fill"></i>
                                            </div>

                                            <div class="mt-3 class-icon">
                                                <i class="bi bi-plus-square-fill"></i>
                                                <i class="bi bi-plus-square-fill"></i>
                                                <i class="bi bi-plus-square-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="collapseBtn" data-bs-toggle="collapse"
                                                data-bs-target="#collapseExample3" aria-expanded="false"
                                                aria-controls="collapseExample3">
                                                Consulta realizada por el Doctor MARTINEZ, JHONNY (Caracas) Fecha:
                                                22/05/2023
                                            </button>
                                        </div>

                                        <div class="collapse" id="collapseExample3">
                                            <div class="card card-body color-p">
                                                <div>
                                                    <p>DIAGNÓSTICO: AFECCIONES RESPIRATORIAS DEBIDAS A OTROS
                                                        AGENTES EXTERNOS:J70
                                                        COMENTARIO: Citado por: JHONNY MARTINEZ
                                                        ANTECEDENTES: persona con problemas para respirar , Depresión,
                                                        Cardiacos
                                                        ALERGIA: El paciente es alegórico a la ampicilina
                                                        REASON FOR VISIT: problemas para respirar
                                                        PHYSICAL EXAMINATION: se observa lentitud al respirar
                                                        DIAGNOSTIC TEST: 1. Radiografía de tórax: para evaluar la presencia
                                                        de
                                                        anomalías en los pulmones como infecciones, tumores o enfermedades
                                                        pulmonares obstructivas crónicas.
                                                        2. Pruebas de función pulmonar: para medir la capacidad pulmonar y
                                                        la
                                                        eficacia de la respiración.
                                                        7. Broncoscopia: para examinar las vías respiratorias y detectar
                                                        cualquier anormalidad o bloqueo.
                                                        MEDICATION: 1. Albuterol (ProAir HFA) 2 puffs cada 4-6 horas
                                                        (Salbutamol) para tratar problemas respiratorios.
                                                        2. Sertraline (Zoloft) 50mg una vez al día (Sertralina) para tratar
                                                        la
                                                        depresión.
                                                        3. Metoprolol (Lopressor) 25mg dos veces al día (Metoprolol) para
                                                        tratar
                                                        problemas cardíacos.

                                                        No se encontraron interacciones entre estos medicamentos.

                                                        El paciente es alérgico a la ampicilina, pero ninguno de los
                                                        medicamentos recomendados contiene este principio activo.
                                                        MEDICAL RECORD: 1. Continuar con el uso de Albuterol (ProAir HFA) 2
                                                        puffs cada 4-6 horas para tratar problemas respiratorios.
                                                        2. Continuar con el uso de Sertraline (Zoloft) 50mg una vez al día
                                                        para
                                                        tratar la depresión.
                                                        3. Continuar con el uso de Metoprolol (Lopressor) 25mg dos veces al
                                                        día
                                                        para tratar problemas cardíacos.
                                                        Se recomienda al paciente evitar cualquier tipo de exposición a
                                                        agentes
                                                        externos que puedan empeorar su problema respiratorio. Se sugiere
                                                        realizar una evaluación más detallada para determinar la causa
                                                        exacta de
                                                        su problema respiratorio y ajustar el tratamiento en consecuencia.
                                                        El diagnóstico más probable es AFECCIONES RESPIRATORIAS DEBIDAS A
                                                        OTROS
                                                        AGENTES EXTERNOS:J70, pero también se consideran como posibles
                                                        diagnósticos:
                                                        - Enfermedad pulmonar obstructiva crónica (EPOC)
                                                        - Asma
                                                        - Neumonía
                                                        - Bronquitis crónica.</p>
                                                </div>
                                            </div>
                                            <div class="mt-3 class-icon">
                                                <i class="bi bi-file-earmark-fill"></i>
                                                <i class="bi bi-camera-fill"></i>
                                                <i class="bi bi-list-columns-reverse"></i>
                                                <i class="bi bi-pencil-fill"></i>
                                            </div>

                                            <div class="mt-3 class-icon">
                                                <i class="bi bi-plus-square-fill"></i>
                                                <i class="bi bi-plus-square-fill"></i>
                                                <i class="bi bi-plus-square-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
