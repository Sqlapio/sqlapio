@extends('layouts.app-auth')
@section('title', 'Sucripción')

<style>
    p {
        text-align: justify !important;
    }
</style>
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                    <div class="card">
                        <div class="card-body">
                            <x-sidebar :btns="config('sidebar_item.setting')" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10 col-xxl-10">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <span class="collapseBtn">Estado de su suscripción a DriCloud
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                            <p class="card-text">La suscripción activa a DriCloud permite acceder
                                                a la versión completa con todas las funcionalidades. En el desplegable de la
                                                derecha,
                                                puedes cambiar el plan cuando necesites aumentar el número de usuarios. Si
                                                tienes varias clínicas,
                                                contáctanos para conseguir un cupón de descuento.</p>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                            <div class="alert alert-success " role="alert">
                                                <strong>Suscripción activa: Factura activa hasta 11/07/2023
                                                    Plan actual: DriCloud. Plan Solo (1 usuario). Mensual</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Contactar a DriCloud</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Mas informacion y precios</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnSecond">Cancelar suscripción</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn-warning">Actualizar datos de pago</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <span class="collapseBtn">Estado de su suscripción al servicio de Inteligencia
                                        Artificial DriCloudAI
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                            <p class="card-text">La Inteligencia Artificial DriCloudAI ofrece una ayuda
                                                incomparable al profesional de la salud. Esté avanzado sistema permite al
                                                médico, dentista o fisioterapeuta, recibir ayuda instantánea para completar
                                                la Historia Clínica del paciente. Con tan solo 1 clic, se puede inferir los
                                                diagnósticos más probables, los tratamientos, medicaciones con nombre
                                                comercial y sus dosis, se analizan todas las posibles interacciones entre
                                                los medicamentos, entre los medicamentos y los antecedentes personales del
                                                paciente y se alerta de posibles alergias. El sistema también recomienda
                                                tratamientos, ejercicios e incluso tratamientos quirúrgicos.
                                                Toda esta información se escribe directamente en los campos de la historia
                                                clínica para evitar el trabajo del profesional.
                                                El sistema DriCloudAI es un sistema muy preciso, pero debe ser siempre
                                                supervisado por el profesional.
                                            </p>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                            <div class="alert alert-success " role="alert">
                                                <strong>Suscripción activa
                                                    Tokens restantes: 1192727</strong>
                                            </div>
                                        </div>

                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-3">
                                            <p class="card-text">
                                                Este servicio tiene un coste de 25US$ (23€) por aproximadamente 3 Millones
                                                de palabras escritas en historias clínicas:
                                                -Equivaldría entre 2.500-6.000 visitas de pacientes en consulta si el robot
                                                de IA escribe todos los campos de la Historia Clínica.
                                                Por lo tanto puedes esperar un costo de $25 al año si eres un profesional
                                                solo, y $25 cada mes o cada dos meses si eres una clínica grande.

                                                Funciona en todos los países e idiomas con el mismo precio. Al agotarse el
                                                crédito, se hará otra recarga de 25US$ (23€) automáticamente para recargar
                                                otras 3 millones de palabras. Así de fácil lo hemos hecho para ti, activar y
                                                olvidar.</p>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                            <div class="alert alert-info " role="alert">
                                                <strong>Los tokens se pueden considerar como piezas de palabras que son la
                                                    unidades de procesamiento de la IA. Antes de procesar las solicitudes,
                                                    la entrada se divide en tokens. Estos tokens no se cortan exactamente
                                                    donde comienzan o terminan las palabras; los tokens pueden incluir
                                                    espacios finales e incluso subpalabras. Aproximadamente 1.000 tokens
                                                    equivalen a 750 palabras.</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Contactar a DriCloud</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Mas informacion y precios</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnSecond">Cancelar suscripción</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn-warning">Actualizar datos de pago</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <span class="collapseBtn">Estado de su suscripción a la personalización de marca
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                            <p class="card-text">La compra de la personalización de la marca se realiza con
                                                un único pago de $2,500. Todas las referencias, nombre y logotipo del
                                                software dejaran de estar visibles para los usuarios del software y
                                                pacientes.

                                                Atención: no se transfiere la titularidad ni se ceden derechos de copyright,
                                                tan solo se oculta la marca.
                                                El software seguirá estando bajo la protección del copyright y ley de
                                                patentes, por lo que no se podrá copiar ni las funcionalidades, ni los
                                                estilos y ni el diseño.</p>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                            <div class="alert alert-danger " role="alert">
                                                <strong>Suscripción no activa
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Contactar a DriCloud</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Mas informacion y precios</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnSecond">Cancelar suscripción</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn-warning">Actualizar datos de pago</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <span class="collapseBtn">Estado de su suscripción al servicio de envío de SMS
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                            <p class="card-text">El envío de SMS permite comunicarse con los pacientes
                                                mediante el envío de mensajes a los teléfonos. Se enviará un mensaje
                                                recordatorio de cita de forma automática a los pacientes citados en la
                                                agenda. También puedes enviar un mensaje personalizado a un paciente, desde
                                                el menu agenda-dietario, menu pacientes o menu clínica. Y puedes programar
                                                el envío de un SMS en una fecha determinada desde menu comunicación-mensajes
                                                a pacientes.

                                                Este servicio tiene un coste de 0.10 US$ (0.087€) por mensaje. Funciona en
                                                todos los países del mundo con el mismo precio. Al activar este servicio se
                                                cobrará 30 US$ (300 SMS), al agotarse el crédito, se hará otra recarga de 30
                                                US$ automáticamente. Así de fácil lo hemos hecho para ti, activar y olvidar.

                                                Puedes personalizar el mensaje utilizando las variables indicadas abajo.
                                                Por ejemplo: Estimado [PAC_NOMBRE] tiene una cita el [FECHA_CITA] a las
                                                [HORA_INICIO] con [DOC_NOMBRE]></p>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                            <div class="alert alert-danger " role="alert">
                                                <strong>Suscripción no activa
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Contactar a DriCloud</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Mas informacion y precios</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnSecond">Cancelar suscripción</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn-warning">Actualizar datos de pago</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <span class="collapseBtn">Estado de su suscripción al servicio videollamadas
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                            <p class="card-text">Gracias a las videollamadas podrás comunicarte con tus
                                                pacientes mediante una llamada segura y encriptada, cumpliendo el RGPD.

                                                El funcionamiento es muy sencillo: elige un paciente en el menú Agenda, menú
                                                Pacientes o en la Historia Clínica y con un clic sobre la foto del paciente
                                                se enviará un mensaje por email y SMS al paciente. El paciente recibe el
                                                mensaje y pulsa un botón para comenzar la videollamada. No necesita
                                                descargar nada y puede conectarse desde su teléfono o computadora.

                                                Puedes elegir cobrar a tu paciente por la videollamada, en este caso el
                                                paciente tendrá que pagar con su tarjeta el coste que tu indiques antes de
                                                iniciar la videollamada. Sólo cuando el pago se procesa correctamente,
                                                permitimos iniciar la videollamada.

                                                Así de fácil lo hemos hecho para ti, activar y olvidar.
                                                Necesitas activar los SMS para utilizar las videollamadas.
                                                Al iniciar una videollamada el cliente recibe un email y un SMS con
                                                instrucciones y un link para conectarse.</p>
                                        </div>

                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 ">
                                            <div class="alert alert-success " role="alert">
                                                <strong>OFERTA ADJUDICADA: Sistema de videollamadas + minutos ilimitados,
                                                    sin coste adicional.</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Contactar a DriCloud</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnPrimary">Mas informacion y precios</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn btnSecond">Cancelar suscripción</button>

                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
                                            <button type="button" class="btn-warning">Actualizar datos de pago</button>

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
