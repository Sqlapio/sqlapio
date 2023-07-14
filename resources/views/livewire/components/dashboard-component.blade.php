@extends('layouts.app-auth')
@section('title', 'Tablero')
@vite(['resources/js/mychart.js']);
<style>
    body {
        font-size: 15px !important;

    }

    .overflow {
        width: auto;
        height: 200px;
        margin-bottom: 12px;
        overflow-y: scroll;
    }

    @media only screen and (max-width: 660px) {
        .title {
            font-size: 14px;
            margin: 20px 20px 20px 20px;
            align-content: center;
            margin-left: 40px;
        }

    }
</style>
@section('content')
    <div>
        <div class="container-fluid text-center">
            <div class="row justify-content-md-center">
                <div class="" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-card-list"></i>
                            <span>Tiempos de espera (en minutos) vs Meta</span>
                        </div>
                        <div class="card-body">
                            <div class="container text-center">
                                <div class="chart-container" style="height:auto; width:80vw">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-list-task"></i>
                            <span>Tareas por hacer</span>
                            <button type="button" class="btn btnPrimary">Nueva tarea </button>
                            <button type="button" class="btn btnPrimary">Opciones</button>
                        </div>
                        <div class="card-body">
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-bell-fill"></i>
                            <span>Notificacion</span>
                        </div>
                        <div class="card-body">
                            <p style="text-align: justify; font-size:13px !important; " class="card-text overflow">4 ABRIL
                                2023. NUEVA VERSIÓN DriCloud 15.3
                                Menú Cuentas-Liqidación de % a profesionales V2. Se ha mejorado esta sección con nuevas
                                funcionalidades, ayudas y una distribución más intuitiva.
                                Inteligencia Artificial en la Historia Clínica V2. Hemos hecho ajustes para aumentar la
                                precisión y capacidad de la IA de hacer diagnósticos y pautar tratamientos.
                                Ahora la I.A es mucho más precisa y tiene capacidad de escribir el historial para ahorrar
                                trabajo al profesional.
                                Más información aquí.
                                Facturación Electrónica Paraguay. Nuestros clientes de Paraguay ya disponen de un módulo
                                completo de Facturación Electrónica conforme a las normas de Paraguay. Para más información
                                y configuracion contacta con soporte@dricloud.com

                                06 ABRIL 2023. NUEVA VERSIÓN DriCloud 15.2
                                Nuevo módulo de Remarketing de DriCloud permite automatizar el envío de mensajes por correo
                                electrónico o SMS a los pacientes de una clínica en función de ciertos eventos
                                desencadenantes, como citas canceladas o agendadas. Los mensajes son personalizados y se
                                pueden crear ilimitados. Esto ayuda a mejorar la relación con los pacientes, aumentar la
                                satisfacción y reducir las cancelaciones, lo que se traduce en un aumento de la facturación
                                de la clínica. El sistema también permite analizar los resultados de las campañas de
                                marketing y ajustarlas en consecuencia. ¡Con el módulo de Remarketing de DriCloud, tus
                                pacientes recibirán la atención personalizada que merecen! Más información clic aquí.

                                10 MARZO 2023. NUEVA VERSIÓN DriCloud 15.1
                                YA DISPONIBLE. DriCloud es el primer Software Médico en integrar inteligencia artificial
                                dentro de las historias clínicas.
                                Como funciona: https://www.youtube.com/watch?v=kViokVe_Wjk
                                La Inteligencia Artificial "DriCloudAI" ofrece una ayuda incomparable al profesional de la
                                salud. Nuestro avanzado sistema permitirá al médico, dentista o fisioterapeuta, recibir
                                ayuda instantánea y completar la Historia Clínica del paciente con un clic, sin escribir.
                                Con tan solo 1 clic, podrá inferir los diagnósticos más probables, los tratamientos,
                                medicaciones con su nombre comercial y su dosis, se analizan todas las posibles
                                interacciones entre los medicamentos, entre los medicamentos y los antecedentes personales
                                del paciente y se alerta de posibles alergias. El sistema también recomienda tratamientos,
                                ejercicios e incluso tratamientos quirúrgicos con todo detalle.
                                Toda esta información se puede escribir directamente en los campos de la historia clínica
                                para evitar el trabajo del profesional, aumentar la velocidad de trabajo y reducir la carga
                                laboral.
                                El sistema DriCloudAI es un sistema muy preciso, pero debe ser siempre supervisado por el
                                profesional."

                                23 FEBRERO 2023. NUEVA VERSIÓN DriCloud 15
                                Integrado el terminal de pagos de SquareUp https://squareup.com/es/es
                                Al crear una factura/albaran/presupuesto/ podrás enviar el pago al terminal de Square. El
                                cliente podrá pagar con su tarjeta sobre lector de Square, se cobrará y la
                                factura/albaran/presupuesto/ se marcará como pagada automaticamente.
                                Este procedimiento va a simplificar los cobros, ahorrará tiempo y mejorará control de pagos
                                en vuestra clínica.
                                Puedes adquirir el terminal de Square en la página web de Square. Para integrarlo con
                                DriCloud, tan solo introducir los datos en menú Configuración-Datos de Empresa.
                                Ajuste horario en menú de Configuración. Ahora puedes ajustar el cambio de hora dentro del
                                menú de configuración. Ocurre que en algunos países hay varias franjas horarias, o los
                                cambios de horario se realizan en diferente fecha.
                                IVA separado por conceptos en la descarga de .CSV para Excel.
                                Facturas con prefijo obligatorio. Si tienes varios prefijos para las facturas, ahora no
                                mostramos una por defecto, sino que obligamos a que elijas el prefijo para evitar errores.
                                Modificaciones en los PDF Factura/Presupuesto. Hemos mejorado la estética de las facturas
                                que haces a tus pacientes, y detallado todos los descuentos en caso de existir.
                                Recetas REMPe en España. Ahora se pueden hacer recetas a menores que no tienen DNI, sólo con
                                la identificación del padre o tutor.
                                Factura Electrónica
                                DIGIFACT México. Actualización de la facturación electrónica para México DIGIFACT.

                                1 FEBRERO 2023. NUEVA VERSIÓN DriCloud 14.91
                                Nuevas opciones de búsqueda en Estadísticas. *Días sin acudir a la clínica. *Sexo. *Estado
                                Civil. *Edad.
                                Mejoras en el diseño PDF de la factura. Mejor visualización de los descuentos por cada
                                concepto y ahora también mostramos el total de los descuentos aplicados.

                                5 DICIEMBRE 2022. NUEVA VERSIÓN DriCloud 14.9
                                Seguimiento de conversiones cuando un paciente hace una cita online. Nuevo campo en
                                Telemedicina-Cita online, donde se puede especificar una URL donde se va a redireccionar al
                                paciente después de hacer una cita online. De esta forma puedes incluir el código de Google
                                Analytics, Google Adwrods, Facebook o Instagram en esta página y medir las conversiones de
                                clientes tras una acción de pubilidad.

                                29 NOVIEMBRE 2022. NUEVA VERSIÓN DriCloud 14.8
                                Política de privacidad en los Formularios para tu página web. Ajuste del texto para cumplir
                                con la actualización del RGPD.
                                Menú de receta más intuitivo. La creación de recetas es ahora más fácil e intuitivo.
                                Tags Tutor en Consentimientos informados. Añadidos TAGs de padres/tutor para pacientes
                                menores, dentro del menú de creación de consentimientos informados personalizados.
                                Varias mejoras en la exportación a SAGE 50.
                                Contraseña para Top Doctors. Ahora puedes tener una contraseña específica para Top Doctors
                                dentro de tu "menú de perfil".

                                09 NOVIEMBRE 2022. NUEVA VERSIÓN DriCloud 14.7
                                Formularios CRM para tu página web. Ahora dispones de un formulario que puedes poner en tu
                                página web, Wordpress, Revolution o Facebook para que tus potenciales clientes se registren
                                y os pidan información. Los datos del formulario aparecerán dentro de DriCloud en el menú
                                Marketing-CRM-Leads
                                Color de la cita online. Dentro del menú de personalización de la cita online, ahora puedes
                                elegir el color que tendrá la ventana de la cita online, para integrarla con los colores
                                corporativos de tu página web.
                                Nuevo campo de nacionalidad en el menú de filiación.
                                Recalls personalizables. Ahora puedes personalizar el mensaje de Recall con TAGs, html,
                                estilos etc.
                                Contraseña específica para TopDoctors. Si tienes una cuenta en TopDoctors y la tienes
                                sincronizada con DriCloud, ahora puedes añadir una contraseña específica para TopDoctors y
                                aumentar la seguridad en esta conexión. En el menú de tu perfil personal.
                                Rediseño completo de los LOGs. Nuevo menú sistemas-LOGs donde se registra lo que hace cada
                                usuario. Cuando consulta o modifica información de algún paciente, la IP, el dispositivo, la
                                información leída o medificada, fecha y hora, etc.
                                Encuestas de satisfaccion al paciente. Se ha mejorado las encuestas de satisfacción a los
                                clientes.
                                Nuevas columnas en la tabla de pagos online. Dentro del menú de pagos online, hemos añadido
                                nuevas columnas en la tabla de los pagos realizados mostrando nueva información.
                                Citas online. Hemos realizado una modificación para ocultar las clínicas en las cuales no
                                hay turnos abiertos y no mostrarlas a los pacientes. De esta forma el proceso de cita online
                                es más simple para tus pacientes.
                                Mejoras en la integración con el sistema de recetas electrónicas REMPe que permite un
                                trabajo mas fluido.

                                14 SEPTIEMBRE 2022. NUEVA VERSIÓN DriCloud 14.6
                                CRM Completo. Menú Marketing-CRM. Módulo completo de CRM que te ayudará a captar nuevos
                                leads y trabajarlos hasta convertirlos a clientes.
                                El CRM te ayudará en la captación y gestión de nuevos Leads, contactos, y conversión de
                                leads a acuerdos. Podrás programar llamadas. Y gestionar la conversión de presupuestos a
                                ventas. Disponible sin coste adicional. Y como hacemos siempre, nosotros actualizaremos tu
                                plataforma para que no pierdas ni un minuto.
                                Manual de uso del CRM: https://dricloud.com/wp-content/uploads/2022/09/CRM-en-DriCloud.pdf

                                Gestión de Presupuestos en el CRM. Dentro del CRM tienes un sub-menú para poder trabajar con
                                los presupuestos desde que se emiten hasta que sean aceptados.
                                Este sistema te ayudará a aumentar la conversión de un presupuesto a una factura pagada.
                                Gestor de llamadas en el CRM. También dentro del CRM tienes un sub-menú que te permite
                                programar llamadas a leads y potenciales clientes y trabajar con ellos hasta convertirlos en
                                clientes.
                                Gestor de Recalls en CRM. Y finalmente dentro del CRM también hemos incluido un sub-menú que
                                te permite programar mensajes de e-mail y/o SMS a leads y potenciales clientes.
                                Encuestas de satisfacción al terminar una consulta. Nuevo menú Marketing-Encuestas de
                                satisfacción personalizadas. Puedes indicar si quieres que sean anónimas o que el paciente
                                registre su nombre. Y si quieres que se envíen despues de cada consulta automaticamente y
                                por email y/o SMS. Podrás ver los resultados en el menú Estadísticas-Encuesta de
                                Satisfacción.
                                Estado y fecha de aceptación en presupuestos. Los Presupuestos ahora permiten recoger estos
                                datos y en el menú Cuentas-Presupuestos, ahora puedes hacer una búsqueda de Presupuestos por
                                estado del presupuesto (Emitido, Aceptado, En curso, Terminado o Rechazado) y por la fecha
                                de aceptación de un presupuesto.
                                Listado y fecha de vencimiento en facturas. Nuevos campos permite recoger esta información
                                en las Facturas.
                                Mail de envío de factura: Ahora se puede ver el nombre del documento en cuerpo del email.
                                Ajuste en Contabilidad: Eliminamos de la contabiliad los tipos de cita cuando no están
                                asociadas en Sistemas a la especialidad y el precio es 0 o vacío.
                                Historia clínica-Dashboard: Ajustamos el ancho de los botones en la receta según vista para
                                un buen responsive.
                                Pagos online: Ahora se puede hacer una exportación a CSV de los pagos online recibidos.
                                SMS aviso pasar paciente a consulta. Añadida una opción en el menu Telemedicina-Envío
                                emails/sms, para enviar un mensaje SMS al paciente en el momento en el que el profesional
                                pasa el paciente a su consulta. Ahora los pacientes son llamados a través del "Monitor de la
                                Sala de Espera" y a través de "SMS a su teléfono".

                                15 AGOSTO 2022. NUEVA VERSIÓN DriCloud 14.51
                                1. Nuevo menú Dashboard en Historia Clínica. En este nuevo menú Dashboard se muestra toda la
                                informacion del paciente junta, para que puedas trabajar más rápido y sin cambiar de
                                ventanas. Es responsive y se adapta a todos los tamaños de dispositivos.
                                Tendrás a mano: los formularios de historia clínica para escribir la visita del paciente, el
                                historial previo, imágenes, pruebas diagnósticas y recalls.

                                _____________________

                                30 JULIO 2022. NUEVA VERSIÓN DriCloud 14.4
                                1. SMS aviso pasar paciente a consulta. Añadida una opción en el menu Telemedicina-Envío
                                emails/sms, para enviar un mensaje SMS al paciente en el momento en el que el profesional
                                pasa el paciente a su consulta. Ahora los pacientes son llamados a través del "Monitor de la
                                Sala de Espera" y a través de "SMS a su teléfono".
                                2. Personalización de la marca. Opción de comprar la personalización de la marca en el
                                software. Menú Sistemas-Suscripción.
                                3. Menu de seguimiento al paciente mejorado. Se ha mejorado el menú Seguimiento dentro de la
                                Historia Clínica. Nuevo diseño y mejoras que permiten al profesional programar el envío de
                                un SMS o Email al paciente en una determinada fecha futura.

                                20 JUNIO 2022. NUEVA VERSIÓN DriCloud 14.3
                                1. Receta Electrónica REMPe para España. Añadimos la integración de la receta electrónica
                                con la empresa REMPe. Nuestros clientes de España podrán enviar recetas electrónicas de
                                medicamentos directamente a las farmacias. Acceso al manual.
                                2. Integración con SAGE 50. Actualmente DriCloud y XDentalCloud se conectan con SAGE
                                CONTAPLUS. En breve estaremos integrados con el software contable SAGE 50.
                                3. Integración con ZOHO CRM. Los archivos .CSV que puedes generar a partir de las búsquedas
                                en Menú Estadísticas y en el menú Pacientes-Vista Listado, se pueden abrir con Excel para
                                explotar los datos según tu necesidad. Ahora también podrás abrirlos con ZOHO CRM para
                                migrar todos tus pacientes a ZOHO y potenciar las herramientas de marketing de ZOHO, la más
                                avanzada plataforma de CRM.
                                4. Gestión de Padres/Tutores para pacientes menores. En el menú Filiación de un paciente
                                menor de edad, ahora se muestran nuevos campos que permiten añadir un Padre/Tutor como
                                responsable del menor. Estos datos se utilizan también al generar una factura o
                                consentimiento firmado.
                                5. Asociación de un paciente menor de edad a su padre/tutor. El campo apellidos del
                                padre/tutor permite buscar un paciente que ya existe y crear la asociación.

                                05 JUNIO 2022. NUEVA VERSIÓN DriCloud 14.2
                                1. Mercado Pago para clientes en latinoamérica. Incorporamos una nueva pasarela de pago
                                online que se une a PayPal y Stripe. Mercado-Pago permite cobrar online a tus pacientes de
                                latinoamerica. Funciona de la misma forma que PayPal y Stripe: se configura en el Menú
                                Telemedicina-Pagos online y permite cobrar a los pacientes por servicios online como
                                videollamadas, tienda online, pago de facturas en Portal del Paciente y cobrar facturas por
                                Email, consulta online, etc.
                                2. App Android: Actualizamos la App de Android para pacientes "Vitales DriCloud".
                                3. SMS: En campos de clínica dentro de Comunicaciones, se añaden dos variables más:
                                TELEFONO_CLINICA y EMAIL_CLINICA, de tal manera que en los SMS y correos de confirmación
                                aparezcan los datos de contacto de la clínica en la que es citado el paciente.
                                4. Top Doctors. Actualización de la cita online de Top Doctors.

                                05 ABRIL 2022. NUEVA VERSIÓN DriCloud 14.1
                                1. Módulo de consultas online personalizable. Nueva v.2 del módulo de "Consutas Online"
                                (Telemedicina-Consultas Online). La v.2 ahora permite añadir múltiples campos al
                                cuestionario, puedes configurar todos los campos a tu medida y puedes elegir solicitar los
                                datos de filiación al paciente. Ahora, los datos de filiación que introduce el paciente se
                                actualizan automáticamente en la ficha del paciente, y los datos introducidos por el
                                paciente en los formularios médicos van a crear un nuevo episodio en el Historial Clínico
                                del paciente automáticamente. La plataforma permite cobrar al paciente por esta consulta
                                online, puedes elegir utilizar las plataformas de PayPal (pagos con PayPal y tarjetas) y
                                Stripe (pagos con tarjetas, domiciliación en cuenta bancaria y pagos ACH).

                                2. Importación de datos mejorada. Nueva versión de importar datos (Menú Sistemas-Importar
                                Datos) que permite importar muchísima más información: clínicas, despachos, tipos de cita,
                                especialidades, cirugías, aseguradoras, actuaciones en consulta, contabilidad, usuarios,
                                pacientes y citas. Ademas de todos los datos médicos de las vistias.

                                3. Facturación Electrónica Colombia. Ajustes finales y generación del QR en las facturas
                                electrónicas para Colombia.

                                01 MARZO 2022. NUEVA VERSIÓN DriCloud 14.07
                                1. Modelos de Facturas/Presupuestos. En el menú de Sistemas-Facturas, ahora puedes crear
                                "modelos" de facturas/presupuestos, con todos los campos y conceptos ya predefinidos. Cuando
                                realices una nueva factura/presupuesto podrás elegir el título de uno de los modelos creados
                                y todos los datos/conceptos/forma de pago, etc... se carga en la factura en un solo clic.
                                2. Texto legal en las facturas. Ahora se puede personalizar el texto legal en el pie de las
                                facturas. Y también se muestra automáticamente según el facturador.
                                3. Justificante de asistencia personalizado. *Nuevo sub-menú en el menú de Configuración
                                donde se puede personalizar y añadir TAGs a los justificantes de visita médica para el
                                trabajo y para la aseguradora.
                                4. Estados de cita para quirófano. Hemos creado un nuevo sistema de gestión con "Estados de
                                Cita" para la agenda del quirófano. Muy parecido a los Estados de cita de la consulta. Ahora
                                puedes conocer si el paciente esta esperando, en quirófano, si ha terminado la operación,
                                etc. También permite crear estados de cita personalizados.
                                5. Modo Franquicia. Hemos perfeccionado compartir pacientes, sus datos de filiación y sus
                                historias clínicas entre diferentes plataformas de DriCloud y XDental. Ahora también puedes
                                elegir si quieres duplicar pacientes entre plataformas de una misma franquicia o grupo de
                                clinicas.
                                6. Mejora de Situación Contable. El nuevo botón de "Situación Contable", que se muestra al
                                realizar búsquedas en el Menú de Estadisticas- Total/Consultas/Cirugías/Tratamientos ,
                                muestra mucho mejor la información. Se han añadido nuevas columnas en el Excel generado para
                                cumplir con las peticiones de nuestros clientes.
                                7. Idiomas. Ahora cada usuario puede elgir trabajar en un idioma diferente dentro de una
                                misma plataformas. Previamente el idioma estaba asociado a una plataformas, ahora está
                                asociado al usuario. Menu Sistemas-usuarios.
                                8. Varios. *Se añade la dirección de la clínica en la impresión de la cita. *Añadimos un
                                botón para mostrar las últimas citas en menú Dietario. *Campo Cómo nos ha conocido se
                                modifica a campo predictivo. *Nuevo texto actualizado en el pie de las recetas. *Ajuste en
                                la visualización responsive del monitor de llamada al paciente. *Ampliamos los botones de
                                compartir escritorio en la ventana de las videollamadas. *Ahora se puede confirmar y borrar
                                las "Citas Rápidas". El menú de Pacientes-Filiación muestra los Referidores que se han
                                añadido previamente en el menú de sistemas-referidos.

                                22 DICIEMBRE 2021. NUEVA VERSIÓN DriCloud 14.06
                                1. Monitor de llamada. Cuando abres el monitor de llamada a los pacientes de la sala de
                                espera, puedes elegir que consultas y pruebas se van a visualizar en el Monitor. Tambien
                                puedes añadir una URL de YouTube para mostrar un video de YouTube en los monitores de la
                                sala de espera.

                                10 DICIEMBRE 2021. NUEVA VERSIÓN DriCloud 14.05
                                DriCloud se ha actualizado a una nueva versión y viene muchas de las mejoras que nos habiais
                                solicitado.

                                1. Actos médicos por linea
                                Nuevo botón para generar un Excel dentro de los menús de Estadísticas (Total
                                asistencias/consultas/ cirugias/Tratamientos/Pruebas/bonos), que recoge la información de
                                todos los actos médicos realizados en consulta, sean privados o de compañía, visitas o
                                tratamientos, presupuestos realizados, bonos, etc. Donde cada acto médico está en una línea
                                y no agrupados
                                Se muestran: FACTURAS, ALBARAN, PRESUPUESTOS, citas y actos medicos y ventas on line.
                                Después de hacer una búsqueda, en la parte inferior puedes encontrar el botón: “Situación
                                Contable”

                                2. Ajuste en el Excel de importación para separar la fecha de la hora en dos columnas
                                diferentes.

                                3. Poder bloquear o desbloquear un turno desde dietario, con el icono de "candado" igual que
                                se puede hacer desde planning.

                                4. Cuando un turno está bloqueado desde planning ahora no se permite dar la opción a citar
                                un paciente desde dietario o agenda.

                                5. Nuevas opciones en el menú Agenda-Dietario-Desplegable de la derecha: “Añadir Cita" para
                                hacer una nueva cita del paciente. También la opción "Acceso a Clínica", solo para perfil
                                doctor y solo para pacientes citados para su consulta.

                                6. Lista de espera quirúrgica: ahora se puede seleccionar las columnas que quieres que sean
                                visibles y además ahora puedes exportarla en excel. Las columnas elegidas se graban por
                                usuario, para que la próxima vez se muestren solo tus columnas preferidas.

                                7. En el historial clínico ahora se muestra en qué Clínica/Despacho se ha realizado cada
                                consulta y cirugia.

                                8. Usuarios con perfil secretaria se restringe el acceso a algunos submenús del Menu
                                Marketing.

                                9. LOGs contabilidad:
                                Se han añadido en los logs lineas relacionadas con la facturacion, para mantener una
                                trazabilidad de los cambios hechos en facturas y contabilidad:
                                -Creacion de una factura/presupuesto/albaran. Fecha, hora, IP, usuario, paciente, total de
                                la factura, estado de pago
                                -Modificacion de una factura/presupuesto/albaran. Fecha, hora, IP, usuario, paciente, total
                                de la factura, estado de pago
                                -Borrado de una factura/presupuesto/albaran. Fecha, hora, IP, usuario, paciente, total de la
                                factura, estado de pago

                                10. Nuevo permiso en menu sistemas-permisos. Crear Facturas
                                Afecta a crear nuevas facturas desde varios menus. Tambien crear factura rapida en menu de
                                cuentas. Y tambien cuando crean un albaran o presupuesto y lo quieren cambiar a factura,
                                desde dentro del menu de creación de facturas.

                                11. Cierre de la Historia Clínica más rápida:
                                Se ha quitado la fila en color morado para cerrar o no cerrar la visita. Se añade un nuevo
                                boton que se llama "Guardar y Finalizar"

                                12. Facturacion Electronica para Colombia.
                                DriCloud firma un acuerdo de colaboración el Gobierno de Colombia para emitir timbrados
                                electrónicos para la facturación electrónica. Si deseas activar la facturación electrónica
                                en Colombia, contacta con soporte@dricloud.com

                                13. DriCloud ya genera RIPS para el Sistema de Salud de Colombia (Registros Individuales de
                                Prestación de Servicio de Salud). Si deseas activar los RIPS contacta con
                                soporte@dricloud.com

                                02 NOVIEMBRE 2021. NUEVA VERSIÓN DriCloud 14.04

                                -Impuestos personalizables para los pagos online (cita online, pagos online, videollamadas,
                                consulta online, tienda online). En el menú Telemedicina-Pagos online, Consultas online y
                                Cita Online, ahora puedes elegir el tipo de impuesto y su porcentaje. Cuando un paciente
                                realice un pago online a través de algunos de estos servicios, recibirá automáticamente una
                                factura con los impuestos desglosados.

                                27 OCTUBRE 2021. NUEVA VERSIÓN DriCloud 14.03

                                -Modo Franquicia. DriCloud ahora permite compartir en tiempo real el historial clínico de
                                pacientes que son asistidos en varios centros médicos. Avísanos si quieres compartir
                                pacientes entre dos o más plataformas de tu grupo y hacemos el ajuste en pocos minutos, sin
                                coste.

                                -Precarga de medicamentos. En el menú Sistemas ahora hay un nuevo submenú "Medicamentos",
                                donde se puede cargar un archivo de Excel con hasta 1.000 medicamentos. Se puede usar varias
                                veces, en este caso, si van a cargar uno que ya existe se "sobreescribe" para que no se
                                duplique.
                                Los medicamentos precargados se pueden buscar de forma "predictiva" en el campo Medicación,
                                dentro de la historia clínica. Añadir medicamentos y crear recetas es ahora mucho más
                                rápido.
                                -App VITALES para iPhone. Hemos actualizado la App VITALES DRICLOUD para iPhone, ahora tus
                                pacientes puedan recibir notificaciones cada vez que se hace una nueva cita o se le solicita
                                sus constantes vitales.
                                -Fecha realizado en el Odontograma. En el menú realizado ahora se muestra la fecha en que se
                                ha pulsado el boton de REALIZADO en el Plan de tratamiento.

                                -Menu cuentas-facturas/albaran/presupuesto, nuevo campo desplegable para elegir un
                                profesional y asi mostrar todas las facturas asociadas solo a ese profesional
                                29 SEPTIEBRE 2021. NUEVA VERSIÓN DriCloud 14.02

                                -Limitar acceso de usuarios por IP. DriCloud es un software que funciona 100% en la Nube y
                                aunque permite el acceso desde cualquier dispositivo y desde cualquier lugar, es también el
                                único sistema que te permite delimitar desde que IP puede acceder cada usuario. Y puedes
                                establecer esta limitación en función de un horario para cada uno de los usuarios. Ajústalo
                                en el menú Sistemas-Usuarios.

                                -Limitar citas a algunas aseguradoras o solo privados. Cuando creas un nuevo turno en el
                                menú Agenda-Turnos, ahora puedes indicar que solo se puedan citar determinadas aseguradora o
                                solo pacientes privados.

                                -Impuestos pre-asignados en cada Acto Medico. Ya puedes dejar pre-asignado un impuesto a
                                cada "tipo de cita", "acto medico", "tratamiento", "cirugia" y "tratamiento en odontograma",
                                de tal forma que cuando hagas una factura te ofrezca automaticamente el % del impuesto
                                automaticamente para cada concepto. Accede al menú sistemas-contabilidad para añadir los %
                                de impuestos.

                                -Carga de pacientes mejorada. Hemos mejorado el sistema de importación de datos (menú
                                sistemas-importar datos) para convertirlo en un sistema que permite hacer múltiples
                                importaciones. De esta manera puedes importar constantemente pacientes con sus citas que,
                                por ejemplo, han sido citados en un programa diferente. Algo muy frecuente cuando un doctor
                                trabaja en un hospital que utiliza un sistema de citas diferente a DriCloud. Los pacientes y
                                citas importadas se visualizan en la agenda.

                                -Remitente en los SMS. Ahora puedes indicar un número de teléfono movil como remitente de
                                los SMS que envias o indicar un nombre, como el nombre de tu centro médico.

                                -Google Calendar. Se ha adaptado la integracion de DriCloud y Google Calendar para cumplir
                                con las nuevas y más restrictivas políticas de Google. La integración con Google Calendar
                                vuelve a estar 100% operativa y ahora es mucho más segura y privada.

                                ----------

                                Ya tienes disponible la nueva versión de DriCloud 14.0. La más potente hasta la fecha,
                                todavía más rápida y rediseñada con los últimos estándares y un estilo minimalista y
                                tranquilo.

                                *Las actualizaciones son gratuitas y las realiza nuestro equipo técnico para que, sin
                                esfuerzo ni complicaciones, siempre tengas disponible la última versión.

                                -Videollamadas gratuitas. Hemos desarrollado un nuevo sistema propio de videollamadas para
                                telemedicina que podemos ofrecer de forma gratuita (ya no dependemos de terceros). Cumple
                                los protocolos de seguridad y privacidad de la información RGPD y funciona de la misma
                                manera que antes. Instrucciones

                                NUEVA VERSIÓN DriCloud 12.53

                                -Añadir días festivos por clínica. Esta nueva funcionalidad permite cerrar un día completo
                                festivo para la clínica. Impide abrir turnos o hacer citas. Menu de
                                Configuración-Vacaciones/Días Festivos.

                                -Control de horas de trabajo de los usuarios. Nuevo sistema para fichar/controlar la hora de
                                llegada y salida de los trabajadores de la clínica. Funciona de forma automatizada
                                registrando el primer log-in y el último log-out de día de los trabajadores. Este nuevo menú
                                permite hacer búsquedas y estadísticas de cada trabajador. Menu de Configuración-Control de
                                horas de trabajo.

                                -Varios: 1. Añadir un campo en el que se muestre qué cantidad de la factura ha sido pagada
                                entre esas fechas, en Cuentas / Facturas. 2. Al enviar un Consentimiento informado para
                                firma electrónica desde el menú de Pacientes/Información paciente, donde está el tag de
                                [FECHA_VISITA] se pondrá la fecha actual del envío.

                                NUEVA VERSIÓN DriCloud 12.52

                                -Nuevo filtro "Estado de Cita" en el menú Agenda-Dietario. Este nuevo filtro permite mostrar
                                únicamente los pacientes con el estado de cita que selecciones. Además es combinable con el
                                resto de filtros.

                                -El Tipo de Cita se puede asociar a una duración y a un color predeterminados. Menú
                                Sistemas-Tipos de cita.

                                -Diferentes sistemas de envío de emails. Para evitar que los email (recordatorios de cita,
                                emails publicitarios, videollamadas, etc) puedan terminar en Spam del cliente, hemos creado
                                3 diferentes sistemas de envío. Recomendamos que cambies al envío por Gmail o por "SMTP otro
                                proveedor". Menú Marketing-Configuración de correo.

                                -Hemos mejorado el sistema de envío de emails masivos, creando ciertas reglas de envío para
                                disminuir la tasa de Spam.

                                -Nuevo Registro de emails y SMS enviados. Menú Marketing-Envíos email/SMS.

                                -Nuevo menú Estadísticas-Total de asistencias, donde puedes ver de forma conjunta las
                                consultas, pruebas diagnósticas y cirugías.

                                -Citación online multi-idioma. El paciente puede elegir el idioma del módulo de Citas
                                On-Line.

                                -Aumento de pagos financiados hasta 30 plazos de pago.

                                NUEVA VERSIÓN DriCloud 12.51

                                -Informe de quirófano a medida. Menú Configuración-Informe Consulta/Cirugías.

                                NUEVA VERSIÓN DriCloud 12.50

                                VARIAS MEJORAS:

                                -Cita online ya no ofrece una opción al paciente si no hay una cita disponible en los
                                siguientes pasos.

                                -Ahora puedes enviar por email y con 1 solo clic los Consentimientos informados, documentos
                                informativos, recetas, informes médicos en PDF y facturas/presupuestos.

                                -Ahora puedes seleccionar varios Consentimientos Informados desde el menu de Clínica e
                                imprimirlos o enviarlos por email con 1 solo clic.

                                -Tipo de pago se ajusta automáticamente a Stripe/PayPal cuando el paciente utiliza la
                                pasarela de pago online de DriCloud.

                                -Elegir cómo enviar los recordatorios de cita. Elige el envío mediante email, sms o ambos.
                                Menu Marketing-Envío recor. email.

                                -Se ha mejorado el aspecto de las web donde llega el paciente despues de confirmar o
                                cancelar una cita.

                                CITAR EN AGENDA SIN TURNO ABIERTO: Ya puedes citar un paciente en la agenda sin necesidad de
                                tener un turno abierto previamente.

                                VENTANA "VISOR DE IMÁGENES": con instrumentos de trabajo: lupa, permite dibujar y guardar el
                                dibujo, botón descargar, etc.

                                MEJORA EN MENÚ SISTEMAS- PERMISOS: Se añaden nuevas lineas de personalización en
                                Sistemas-permisos:

                                "Cuentas - Facturas: Editar". (limita la edición de una factura ya creada)

                                "Cuentas - Facturas: Borrar". (limita el borrado de una factura ya creada)

                                "Cuentas - Albaranes: Editar". (limita la edición de un albarán ya creado)

                                "Cuentas - Albaranes: Borrar". (limita el borrado de un albarán ya creada)

                                "Cuentas - Presupuestos: Editar". (limita la edición de un presupuesto ya creado)

                                "Cuentas - Presupuestos: Borrar". (limita el borrado de un presupuesto ya creado)

                                "Pacientes: Borrar Paciente". (limita el borrado de un paciente)

                                "Pacientes: Borrar Cita Realizada". (limita el borrado de una cita pasada o realizada)

                                "Cuentas - Caja: Ver". (limita visualizar el menú de Cuentas-Caja)

                                "Cuentas - Gastos: Ver Cuentas". (limita visualizar gastos en el menú de Cuentas)

                                "Cuentas - Ingresos: Ver Cuentas". (limita visualizar ingresos en el menú de Cuentas)

                                -Dos columnas nuevas en sistemas-permisos, "Comodín1" y "Comodín2", con las que se puedes
                                personalziar aún más los permisos y diferenciar, por ejemplo niveles diferentes de acceso
                                para el perfil de Secretaria (por ejemplo secretaria con acceso a contabilidad y secretaria
                                sin acceso a contabilidad). Tener dos niveles de perfil diferentes para Profesionales
                                (profesional con acceso a agenda y profesional sin acceso a agenda).

                                CONTROL DE HORAS: Cada cambio de estado en el menu de agenda, se registra con su hora de
                                cambio. Esto permite controlar cuanto tiempo ha estado el paciente en Espera, en consulta, a
                                que hora se finalizó la visita, cambio de estados personalziados, etc.

                                ASIGNACIÓN DE PROFESIONAL EN ALBARÁN Y FACTURA: Nuevo combo en el menú de creación de
                                facturas para seleccionar que doctor ha prestado el servicio. Afecta a Estadísticas:
                                Consultas/ Cirugías/ Pruebas/ Tratamientos. También afecta a Cuentas/ Liquidación a
                                Profesionales. Ahora puedes diferenciar el profesional a quien se asigna el servicio (a
                                efectos estadísticos y contables), y el profesional a quien está citado un paciente. Por
                                ejemplo, ahora un paciente puede estar citado a un profesional, pero cobrar esa visita otro
                                profesional distinto.

                                NUEVO MENÚ ESTADÍSTICAS-TOTAL ASISTENCIAS: Sección de estadísticas ampliada con un nuevo
                                menú que muestra el total de Consultas Tratamientos Cirugias Pruebas.

                                PRECIO DE CONTABILIDAD EN LA VENTANA DE CITAS: Ahora se muestra el precio asignado a un tipo
                                de cita y se permite modificarlo "en la ventana de la cita" (Agenda-Cita). Afecta a
                                Estadísticas, donde el nuevo precio sustituye al indicado en Menú Sistemas-Contabilidad.
                                Para citas de Consulta reemplaza al precio correspondiente al tipo de cita. Para citas de
                                Pruebas reemplaza al precio correspondiente al tipo de prueba. Para citas de Quirófano
                                reemplaza al precio correspondiente al tipo de cirugía.



                                NUEVA VERSIÓN DriCloud 12.31

                                VARIAS MEJORAS:

                                -Nuevo campo para escribir información de cada pago parcial en el menú de
                                facturas/presupuestos.

                                -Cita online mejorada. Ahora no se muestra una opción si no esta disponible para hacer una
                                cita.

                                -Se añaden nuevos TAGs en los consentimientos informados y documentos informativos
                                personalizados. Menú sistemas.

                                -Envío email al paciente (1 clic) con datos de acceso al portal del paciente. Menu
                                Pacientes-Buscar paciente-Botón Portal del Paciente.

                                NUEVA VERSIÓN DriCloud 12.3

                                FIRMA DIGITAL DE FACTURAS Y DOCUMENTOS, ilimitadas & Gratis: El nuevo sistema de Firma
                                Remota DriCloud ya permite firmar facturas y presupuestos, además de documentos y
                                consentimientos informados, con el paciente en la clínica o en remoto.

                                Firma de Facturas/presupuestos: En el menú de creación de facturas/presupuestos, en la parte
                                inferior puedes marcar el check de Firma Remota DriCloud y el paciente recibirá en su
                                teléfono un mensaje con las instrucciones y el documento a firmar.

                                Firma de Documentos RGPD y Consentimientos: En <Menú Pacientes-Inf. paciente-símbolo nube> y
                                    en <Menú Clínica-Historia Clínica-parte inferior> están los consentimientos. Haz clic en
                                        Firma Remota DriCloud para enviar un SMS a los teléfonos del paciente y del
                                        profesional con un acceso al documento para la firma. La firma se realiza en los
                                        teléfonos del paciente y del profesional.

                                        Menú Pacientes-Documentos: aquí encontrarás el documento firmado con el archivo de
                                        validación legal.

                                        BLOQUEO ACCESO POR IP: Ahora puedes bloquear el acceso de los usuarios por su IP.
                                        Menu Sistemas-Usuarios-Acceder al usuario e indicar las IP autorizadas.

                                        TIEMPOS POR TIPO DE CITA: Ya puedes elegir la duración de una cita según el Tipo de
                                        Cita. Ajústalo en el menu Sistemas-Tipo de Cita.

                                        CONSENTIMIENTOS CON FORMATO: Los consentimientos informados y documentos
                                        informativos "personalizados" pueden contener todo tipo de estilos, tipo de letra,
                                        negrita, cursiva, espaciados... incluso imágenes. Menú Sistemas consentimientos
                                        informados y documentos informativos.

                                        VER HISTORAL: Ya puedes elegir que un profesional solo vea sólo su historial, sólo
                                        el de su especialidad o el de todos los profesionales. Menu Sistemas-Usuarios.

                                        ODONTOGRAMA nuevo "REALIZADO HOY": Nueva pestaña en el odontograma para crear un
                                        presupuesto o factura de los "Realizado hoy". En esta nueva pestaña se muestran solo
                                        los tratamientos donde se ha pulsado en el boton de Realizado en un plan de
                                        tratamiento. Al crear presupeusto/factura se abre el menu de facturas pero solo con
                                        lo que esta en la pestaña de realizado hoy.

                                        VARIOS:

                                        -Enviar acceso al portal del paciente en 1 Clic desde el menú Pacientes-Boton Portal
                                        del Paciente.

                                        -Al cerrar horas en la agenda, ahora se muestra el motivo en la agenda.

                                        -Permitir elegir las columnas visibles en Agenda-Dietario y en Clinica.

                                        -Botón para citar un paciente desde el menu de Pacientes.

                                        -Historial previo, al imprimir se muestra en orden creciente por fecha.

                                        -Total cobrado: en estadísticas-consultas, tratamientos, cirugías, etc.

                                        -Menu Cuentas-Facturas, presupuestos y albaranes se muestran 500 filas por defecto.

                                        -Campo baremo en cirugía ahora es predictivo y desplegable.

                                        VIDEOLLAMADAS. COMPARTIR ESCRITORIO: Ya puedes compartir tu escritorio con los
                                        pacientes durante una videollamada.

                                        --------------------------

                                        FORMULARIOS OFTALMOLOGÍA: Los nuevos formularios para oftalmología pueden ser
                                        añadidos al Formulario de Historia Clínica Personalizada en el menu
                                        Configuración-Formularios HC.

                                        HISTORIA CLINICA. ETIQUETAS INTELIGENTES: Dentro de la Historia Clínica encontrarás
                                        un nuevo sistema inteligente de "etiquetas" para añadir datos a los campos sin tener
                                        que escribir nada. DriCloud te ofrece las etiquetas que vas a necesitar en ese
                                        momento. Un solo clic en ellas para añadirlas a cada uno de los campos sin tener que
                                        escribir.

                                        MARKETING. CUMPLEAÑOS: En el menú marketing-envío de recor por email, ya puedes
                                        programar el envío de emails y SMS personalizados para felicitar el cumpleaños a tus
                                        pacientes y a los tabajadores de tu consultorio, y quizá incluir una oferta o
                                        regalo.

                                        PASARELA DE PAGO VIRTUAL EN LA FACTURA: Si tienes configurada una de las pasarelas
                                        de pago que ofrecemos (menu Configuracion: Stripe y PayPal), ya puedes cobrar a tus
                                        clientes en el momento de hacer una factura en la clínica. Esto se une a las otras
                                        posibilidades de cobro online, como: solicitar el pago de una factura a través de
                                        email (enviando la factura por email), desde el portal del paciente, pago online por
                                        citas online, videollamadas, teleconsultas y la tienda online. Todo un mundo de
                                        nuevas posibilidades gracias a la más avanzada telemedicina de DriCloud. (*todos los
                                        pagos online de tus pacientes van directamente a tu cuenta de banco. DriCloud no
                                        intermedia ni recibe comisión por tus ventas online).

                                        AJUSTAR DIVISIONES EN LA AGENDA: Ahora puedes ajustar las divisiones del tiempo en
                                        la agenda-vista agenda.

                                        COPIAR Y PEGAR CITAS: Nueva funcionalidad que te permitirá "copiar" una cita y
                                        "pegar" esta cita múltiples veces en diferentes turnos, días, profesionales, etc. Es
                                        super rápido, pruebalo en la agenda: clic en una cita, pulsa en copiar y luego haz
                                        clic en un hueco vacio y pulsa en pegar.

                                        NUEVO PORTAL DEL PACIENTE: Hemos rediseñado el portal del paciente para hacerlo
                                        todavía más funcional. Ahora en el portal del paciente se puede personalizar el
                                        cuestionario de salud, se ofrece la posibilidad de pedir cita a los pacientes y los
                                        más increible: los pacientes pueden acceder para pagar las facturas pendiente de
                                        pago. Más información: https://youtu.be/XFM-QO6UN38

                                        ENVÍA FACTURAS Y SOLICITA EL PAGO POR EMAIL CON UN CLIC: Ahora puedes crear una
                                        factura y a la vez, enviar la factura por email al paciente y solicitar al paciente
                                        el pago en el mismo email. Más información: https://youtu.be/BqWIHVZKOd8

                                        -----------

                                        VERSIÓN 11

                                        NUEVA ÁREA DE FORMACIÓN. NUEVOS VIDEOS: Accede ahora al área de formación para
                                        encontrar nuevos videos, descubrir nuevas funcionarlidades y aclarar dudas.
                                        https://dricloud.com/formacion

                                        NUEVA PÁGINA WEB GRATUITA "REVOLUTION": DriCloud lanza un sistema exclusivo para la
                                        creación de tu propia Página Web. El modelo de página web que te ofrecemos es 100%
                                        responsive, preparado para Google y sobre todo muy fácil de utilizar. Ya viene con
                                        una plantilla médica para que puedas cambiar textos e imágenes y tener tu Página Web
                                        en pocos minutos, sin conocimientos específicos. Accede al menu Marketing-Página Web
                                        Revolution y activa tu web sin coste adicional.

                                        CONCEPTOS EN FACTURAS: Ahora los conceptos de las facturas pueden cargar los
                                        tratamientos, tipos de cita, cirugias, stock y odontograma. El material de stock
                                        además se descuenta automaticamente del menú de stock. Tan solo escribe 3 letras en
                                        el campo de concepto en la factura/presupuesto.

                                        -----------

                                        ESTADÍSTICAS: Ya puedes buscar estadísticas de videollamadas y citas online en el
                                        menú de Estadísticas.

                                        ODONTOGRAMA: Se permiten combinaciones de tratamientos en el Odontograma.

                                        -----------

                                        TELEMEDICINA CON PAYPAL Y STRIPE: Ya puedes cobrar a tus pacientes por las citas
                                        online, videollamadas, consultas online y venta en tu tienda online, con una nueva
                                        pasarela de pago de PayPal. Ahora puedes elegir utilizar la pasarela de pago de
                                        Stripe o PayPal. Ambas soportan todo tipo de tarjetas de crédito y débito. PayPal
                                        además permite pagos con PayPal. Accede al menú Configuración-Datos de empresa para
                                        seleccionar pasarela de pago.

                                        -----------

                                        Gracias a DriCloud puedes consultar la información de tus pacientes desde casa y
                                        continuar sus tratamientos con los servicios de Telemedicina que os ofrecemos sin
                                        coste.

                                        COMUNICADO. 23 MARZO 2020

                                        ¡¡¡ATENCIÓN!!!. A partir del día 24 de Marzo, DriCloud ofrecerá todos los servicios
                                        de telemedicina, incluidas las videollamadas sin coste adicional para el cliente*.
                                        Nuestra empresa asume este gasto para ayudar durante esta crisis. Estamos todos
                                        juntos contra el Covid19. (*política de uso racional).

                                        PANDEMIA CORONAVIRUS. Las autoridades recomiendan minimizar el uso de las visitas
                                        presenciales e incluso cierre de consultorios. Así mismo, recomiendan utilizar
                                        sistemas de Telemedicina para asistir a los pacientes.
                                        Os recordamos que DriCloud dispone de todos los servicios de telemedicina y
                                        video-llamadas y que cumplen con el nuevo RGPD.
                                        En DriCloud hemos recibido más de 200 altas en los servicios de Telemedicina en 3
                                        días. Todos los servicios funcionan bien. Nuestro equipo de soporte está trabajando
                                        muchísimo para ayudar con la configuración. Por favor, revisen los manuales para
                                        comprender bien la diferencia entre los distintos servicios de Telemedicina y
                                        configurarlos correctamente. ESTAMOS TODOS JUNTOS CONTRA EL COVID 19. GRACIAS por
                                        vuestro esfuerzo.
                                        -DIFERENTES SERVICIOS EN TELEMEDICINA OFERTADOS:
                                        https://dricloud.com/software-telemedicina

                                        MANUALES DE TELEMEDICINA
                                        Videollamadas
                                        https://dricloud.com/wp-content/uploads/2020/03/Telemedicina-formacion.pdf
                                        Consultas online
                                        https://dricloud.com/wp-content/uploads/2020/03/DriCloud.-Consulta-Online.-.pdf
                                        Citas online
                                        https://dricloud.com/wp-content/uploads/2020/03/DriCloud.-Cita-Online.pdf
                                        Pagos online. Pasarela de pago Stripe
                                        https://dricloud.com/wp-content/uploads/2020/03/Cobros-online.-Pasarela-de-pago.pdf
                                        Conexión con Google Calendar:
                                        https://dricloud.com/wp-content/uploads/2020/03/DriCloud-Google-Calendar.pdf
                                        Manual de Recetas de medicamentos. AQUÍ.
                                        12 Febrero 2020. NUEVA VERSIÓN DriCloud 11.5

                                        Formularios Oftalmología. Ya esta disponible el nuevo formulario de Historia Clinica
                                        oftalmológica. Puedes activarlo en el menu Configuracion-Formularios HC- Acceder al
                                        formulario y marcar SI en Oftalmología.
                                        Manual de Recetas de medicamentos. Encuentra como hacer recetas AQUÍ.
                                        Gráficas Evolutivas . Ya puedes crear todo tipo de gráficas evolutivas en la
                                        Historia Clínica y en los informes imprimibles para tus pacientes. Controla
                                        percentiles en niños, peso, contantes vitales... Elige gráficas de barras o
                                        lineales. Menú Configuración-Formularios H.C.-Campos a medida (gráficas evolutivas).
                                        Google Calendar. Ya tienes activada la nueva versión con múltiples novedades, entre
                                        ellas la conexión con GOOGLE CALENDAR. Accede al menú MARKETING-GOOGLE CALENDAR para
                                        activar la sincronización con las agendas de Google para cada profesional que lo
                                        necesite.


                                        REGALO AÑO NUEVO. En agradecimiento a vuestro apoyo durante el año 2019, os hemos
                                        DUPLICADO la capacidad de almacenamiento. Esto os proporciona un gran ahorro y
                                        tranquilidad a la hora de almacenar datos casi sin límite sin tener que pagar nada
                                        por ello. Feliz año 2020.



                                        VIDEOCONSULTAS. Accede al menú SISTEMAS-SUSCRIPCIÓN para activar las videollamadas.

                                        Muchos clientes nos habían solicitado la posibilidad de realizar videollamadas con
                                        sus pacientes. Nuestro equipo técnico lo ha desarrollado de forma extraordinaria,
                                        como nunca lo habías visto antes: Videollamadas encriptadas de punto a punto, máxima
                                        calidad, desde cualquier dispositivo, 1 clic para enviar un email o SMS al paciente,
                                        el paciente tan solo tiene que pulsar un botón para conectarse, sin descargar nada.
                                        Y lo mejor de todo, con pasarela de pago incluida para que, si quieres, puedas
                                        cobrar al paciente antes de la videoconsulta.

                                        _________________

                                        Balance año 2019: Esta última actualización concluye un año excelente para DriCloud:

                                        Durante el año 2019 hemos realizado 42 actualizaciones, con un total de 283 mejoras
                                        y funcionaliades nuevas. Las actualizaciones las realizamos por la noche, sin
                                        afectar a tu trabajo, sin que tengas que descargar ni instalar nada. Por la mañana,
                                        al acceder a DriCloud ya tienes la última versión lista para utilizar. Todos
                                        nuestros clientes manejan siempre la última versión.
                                        DriCloud aumentó su red de partners, hasta estar integrados con un total de 14
                                        empresas.
                                        El tiempo online en 2019 fue del 99.97%.
                                        En el año 2020 DriCloud cumplirá 10 años, y sigue siendo el software médico con
                                        mayor crecimiento y el mejor valorado.
                                        La presencia internacional creció notablemente en el mundo anglosajón a través de la
                                        marca DrinCloud, llegando a estar presentes en 21 países.
                                        En el año 2019 DriCloud se ha expandido comprando dos empresas: XDental y LexNube.
                                        DriCloud mantiene su posición como empresa sólida y rentable.
                                        Gracias una vez más por vuestra confianza.
                                        _______________

                                        Carga multiple de documentos. Este cambio facilita la carga de documentos. Ahora
                                        puedes subir muchos documentos a la vez tan solo arrastrasdolos o buscarlos como
                                        antes. DriCloud automáticamente lo cataloga en documentos o fotos, por lo que evitas
                                        tener que hacerlo manualmente.
                                        Odontograma. Se han realizado múltiples mejoras en el odontograma y añadido nuevos
                                        conceptos. Se permite introducir conceptos libres con su precio en el odontograma.
                                        Multiclínica. Hemos realizado ajustes en la agenda y cita online para facilitar la
                                        gestión multi-clínica. Ahora puedes añadir varias clínicas en el menu
                                        Sistemas-Clínicas, cada clínica tiene su localización. Nuevo selector en la agenda
                                        para cambiar de clínica.
                                        Facturación con más opciones. Ahora cada concepto a facturar puede tener su propio
                                        impuesto. Puedes indicar si el impuesto esta incluido en la cantidad introducida. Se
                                        permite anadir un segundo impuesto o una retención en la factura.
                                        DRICLOUD APUESTA FUERTE POR LA TELEMEDICINA

                                        Telemedicina-Turnos de "solo citas online". Cuando creas un turno nuevo, menú
                                        Agenda-Turnos, ahora hay una opción para elegir si los pacientes que se van a citar
                                        son: todos, solo desde la clínica, solo citas online.
                                        Telemedicina-Citas online. Nueva versión V5 de cita online. Todavía más
                                        personalizable y con la posibilidad de cobrar por adelantado la cita online. Más
                                        información.
                                        Telemedicina-Consultas online. Nuevo sistema de consulta online con pago asociado.
                                        Los pacientes pueden enviar su caso con una descripción y fotografías, desde tu
                                        pagina web, Facebook, etc. Puedes elegir asociar un cobro a esta consulta-online.
                                        Menu Marketing-Consultas online. Más información.
                                        Telemedicina-Tienda Online. Crea tu propia tienda online pra vender productos o
                                        servicios desde tu página web, Facebook, etc. Super fácil. Incluido, sin coste
                                        adicional. 1. Menu Configuración-Datos de empresa, introduce los datos de tu cuenta
                                        de Stripe.com. 2a. Menú Marketing-Pagos Online, crea productos/servicios y copia el
                                        código en tu Página Web/Blog/Facebook. 2b. Menú Marketing-Cita Online, decide si
                                        quieres cobrar la cita online a tus pacientes y los precios. 3. Menú
                                        Cuentas-Ingresos Online, controla los ingresos de tus ventas online. Más
                                        información.
                                        Telemedicina-Peticiones a laboratorios. Nuevo módulo para gestionar las peticiones y
                                        comunicaciones con laboratorio externos, casas comerciales, etc. Más información.
                                        Telemedicina-Portal del paciente V3. Versión definitiva y completa. Accede al manual
                                        del Portal del Paciente para conocer todas las nuevas funcionalidades. Más
                                        información.
                                        Telemedicina-App Gratuita para pacientes (iPhone y Android). Ofrece tu App a tus
                                        pacientes y aumenta su fidelidad. Imprime este PDF, colócalo en un sitio visible
                                        para que tus pacientes descarguen la App y se conecten con tu clínica. Innovador
                                        sistema de envío de mensajes al teléfono del paciente, totalmente gratuito e
                                        ilimitado. Recordatorios de citas automáticos. Mensajes promocionales. Mapa GPS para
                                        llegar a la clínica. Más información.
                                        Telemedicina-Apple Salud, DriCloud elegido para trabajar con Apple Salud. Este
                                        innovador sistema de Apple, te permite sincronizar más de 70 parametros de salud del
                                        paciente en tiempo real. La información del paciente se recoge por wearables, Apple
                                        Watch y el iPhone, y se envía directamente a la ficha del paciente más información.
                                        Telemedicina-integración con SANITAS-BUPA. Tus pacientes de Sanitas pueden pedir
                                        hora en la página web de Sanitas y la cita se sincroniza automáticamente con tu
                                        agenda. Si estás interesado, contacta con SANITAS; Cristina: calvarez@sanitas.es.
                                        Telemedicina-integración con TOP DOCTORS. Tus pacientes pueden pedir cita desde la
                                        página web de Top Doctors.
                                        _________________
                                        Comparador de fotos. Nuevo sistema para comparar dos o mas fotos. Menu
                                        Pacientes-Documentos y en menu Historia Clínica-Documentos. Selecciona dos o más
                                        fotos y pulsa en "Abrir".
                                        Facturas con dos impuestos. Puedes indicar dos impuestos en las facturas.
                                        Consultas en grupo. Se añade la opción de crear turnos de consultas en grupo
                                        (Terapia de grupo, clases de yoga, pilates, clases de formación, etc). Al crear un
                                        turno, eligir "Consulta en Grupo".
                                        Varios. Recibe pagos online de pacientes con Stripe SCA (verificación 3D). Se
                                        elimiman las ventanas emergentes, ahora los documentos, facturas, recetas, etc se
                                        descargan directamente (muchos usuarios no sabían como permitir ventanas
                                        emergentes). Verificación de la configuración de la firma digital, SMS, citas online
                                        y envío por email (al introducir los datos se comprueban que son correctos). Aviso
                                        antes de eliminar una cita de la agenda. Búsqueda de facturas por fecha de
                                        vencimiento. Se añade Ortodoncia al odontograma. Los profesionales borrados ya no se
                                        muestran en la agenda. Ahora se puede editar un turno haciendo clic en el turno
                                        (modificar hora de inicio, fin y duración predeterminada de las citas).
                                        Borrado masivo de turnos. Se permite el borrado masivo de turnos que se han creado
                                        con la opción de repetir turnos.
                                        NUEVO! Odontograma & Periodontograma. El más avanzado odontograma ya en DriCloud.
                                        Más información - ¿Cómo configurar el odontograma? ver video.
                                        Formularios de HC asociado a especialidad. Ahora puedes asociar un formulario de HC
                                        a una especialidad (Menú Sistemas-Especialidades). Más información.
                                        Informe Consulta asociado a formulario de HC. Ahora puedes asociar un informe de
                                        consulta a un formulario de HC (Menú Configuración-Informe Consulta-Informes
                                        Personalizados). Más información.
                                        Stock en menú Pacientes. Accede al menu Pacientes-Stock para vender múltiples
                                        artículos de stock a un paciente. (Múltiples artículos en una sola factura).
                                        Check-list quirófano. Disponible en la historia clínica de quirofano.
                                        Financiación de pagos. Todo un nuevo y avanzado sistema para financiar pagos a tus
                                        clientes. Al crear una factura, puedes elegir "Pago Financiado". Podrás programar
                                        fechas de cobros, reflejar quien cobra cada uno de los pagos fraccionados, elegir
                                        forma de pago, etc. Cada pago parcial se refleja en el menu Cuentas-Caja en función
                                        de la fecha de cobro. En el menu Cuentas-Facturas tienes un listado con todos los
                                        pagos financiados actuales.
                                        Los mapas de Google vuelven a funcionar en la cita online, en el envío del mapa a
                                        pacientes y en la "App Vitales DriCloud".
                                        Nueva version de la APP VITALES ya disponible para IOS y Android. Gratuita para tus
                                        pacientes. La nueva versión envia los datos de la ubicación del despacho donde se ha
                                        citado el paciente.
                                        Añadir campos con memoria en los formularios de Historia Clinica. Además de
                                        Antecedentes y Alergias, ahora puedes añadir más campos con memoria en: Menu
                                        Configuración-Formularios HC-Campos a Medida.
                                        Añadir tipo de cita y tratamientos de forma rápida a los conceptos de las facturas.
                                        Busqueda de pacientes en el menu Agenda-Dietario. Nuevo cuadro con el que puedes
                                        buscar cualquier dato de los pacientes citados (nombre, apellido, telefono, etc).
                                        Optimización del sistema para aumentar la velocidad de búsqueda, presentación de
                                        estadísticas y tablas.
                                        Control de No Asistencias. En el menu Estadisticas-Consultas-Tipo de Cita, puedes
                                        elegir No Asistencia, para buscar los pacientes que se marcaron como No Asistencia.
                                        Tareas. Hemos mejorado muchísimo la funcionalidad de Tareas; ahora permite indicar
                                        quien puede ver una tarea y notificar a un usuario por email o SMS cuando llega la
                                        fecha de la tarea. Además hemos añadido un campo adicional con el cuerpo del
                                        mensaje.
                                        Página Web en Wordpress. Recuerda que DriCloud ofrece pagina web gratuita con la
                                        integración DNN-Microsofrt. Pero si necesitas una personalización total, pídenos una
                                        web en Wordpress. Solicitalo desde el menu Sistemas-Suscripción.
                                        Recetas OMC. Mejora de recetas OMC (España), diseño, textos y se añade el logo.
                                        SMS Mensajes. Desde ahora puedes usar SMS para enviar mensajes directos a tus
                                        pacientes, mensajes programados y mensajes automaticos recordatorios de cita. Puedes
                                        activar esta opción en el menu Sistemas-Suscripción. Ya puedes comunicarte con tus
                                        pacientes por SMS, email y notificaciones push.
                                        Sanitas. DriCloud y Sanitas/BUPA alcanzan un acuerdo de partnership y comienzan a
                                        trabajar para integrar los sistemas de cita online.
                                        Receta "cuartilla" personalizada. Ahora puedes personalizar las recetas. Crea un
                                        documento Word con el estilo, disposición de campos, tipo de letra y colores que
                                        quieras y úsalo como platilla para las recetas tipo "cuartilla".
                                        Informe completo de historia clínica. En el historial Clínico completo, encontraras
                                        ahora un botón que permite descargar un único informe en Word todas las visitas de
                                        un paciente.
                                        Informe alta hospitalaria. Dentro del formulario de cirugía, ahora puedes generar el
                                        informe quirúrgico en Word y además el informe de alta hospitalaria. Ambos en Word
                                        para que puedas editar la información que entregas al paciente.
                                        Cambio horario. Ahora puedes elegir tu franja horaria en el menú Configuración.
                                        Nueva versión 2.2. App Vitales para iPhone.
                                        Nuevo menu Suscripción dentro del menu Sistemas. Accede para controlar todo lo
                                        relacionado con tu suscripción, contratar servicios adicionales, descargar facturas,
                                        cambiar de plan, etc.
                                        Nueva versión 9. Esta nueva versión añade más de 40 nuevas funcionalidades y cambios
                                        en el software. DriCloud es ahora la versión más potente que has podido utilizar.
                                        Los cambios de la versión 9.00 se centran en mejorar la navegabilidad, en ayudas,
                                        avisos y alarmas para mejorar la experiencia de usuario y evitar errores en el
                                        trabajo diario. Y mejoras en la velocidad y tiempos de carga.
                                        Números en botón Agenda. Indica el número de consultas que faltan en el día.
                                        Check In / Check Out. Nuevo sistema de registro de entrada (Check In) y registro de
                                        salida (Check Out) de pacientes. Va a permitir disminuir el tráfico que se puede
                                        formar a la llegada de los pacientes a la clínica y evaluar la asistencia prestada
                                        al paciente. Más información.
                                        Arrastre de citas y turnos. Vuelve a estar disponible el arrastre de las citas en el
                                        menú "Agenda-Agenda", para cambiar la cita a otro día y para amplicar la duración. Y
                                        el arrastre de los turnos.
                                        Varios. Nueva forma de pago "financiación" en las facturas. Se recuerda la última
                                        cuenta bancaria al hacer la factura. El ratón parado sobre el nombre del paciente en
                                        agenda-dietario, muestra últimas visitas y el campo observaciones de la cita.
                                        Pago de % a profesiones. El nuevo menú "Cuentas-Pago Profesional", permite gestionar
                                        el pago de % a los profesionales y la creación de la factura con el pago al
                                        profesional con un solo clic. Más información.
                                        Agenda día 6 columnas. En la Agenda-Agenda vista Día, ahora se puede ver hasta 6
                                        profesionales juntos. Muy cómodo.
                                        Citas con colores en la agenda. Ahora puedes elegir el color de fondo de cada cita
                                        en agenda.
                                        Facturación 3.3 México. DriCloud actualiza la factura digital para generar el
                                        timbrado CFDI 3.3 exigido por el gobierno de México.
                                        Facturas con varias formas de pago. Se ha rediseñado el área de creación de
                                        facturas, con avisos, colores y aceptación de varias formas de pago en una misma
                                        factura.
                                        Condiciones Generales. DriCloud ya cumple con la nueva LOPD Europea, el RGPD. Toma
                                        unos minutos para revisar las nuevas condiciones generales. Continuar con el uso del
                                        Software implica la aceptación de los términos y condiciones de uso. Más
                                        información.
                                        Tratamientos en menu pacientes. En el menu pacientes-contabilidad, ahora también se
                                        pueden añadir tratamientos o pruebas realizadas dentro de la consulta, a efectos de
                                        contabilidad.
                                        Alerta morosos. En agenda-dietario puedes encontrar un símbolo de alerta sobre los
                                        pacientes que tienen facturas impagadas.
                                        App DriCloud v1.2.4. Hemos actualizado la App DriCloud para usuarios. Descarga la
                                        App DriCloud en tu iPhone y iPad, y accede con TouchID o con FaceID en tu nuevo
                                        iPhone X. La App es gratuita para todos nuestros clientes. Más información.
                                        Top Doctors. DriCloud entra en Partnership con Top Doctors y comienza a desarrollar
                                        su integración en DriCloud.
                                        Recordatorio por email. Mejora del diseño y posibilidad de personalizar
                                        completamente el recordatorio de cita por email.
                                        ¿Cómo nos ha conocido?. Nueva funcionalidad para llevar el control y tener
                                        estadísticas de los canales que traen pacientes a tu consulta.
                                        Importación/Exportación de documentos adjuntos.
                                        Carga de tratamientos. En el menú sistemas-tratamientos, se permite la importación
                                        masiva de tratamientos.
                                        Fusionar pacientes. Esta nueva funcionalidad permite fusionar toda la información de
                                        pacientes duplicados. La encontrarás en el menú Sistemas-Fusionar pacientes.
                                        Turnos repetidos. Cuando se crea un turno (agenda-turnos) se puede indicar si se
                                        quiere repetir el turno todos los días, todas las semanas o todos los meses. Esto
                                        ahorrará mucho trabajo en la creación de los turnos.
                                        Bloqueo de un paciente. En el menú de Pacientes, ahora se puede bloquear a un
                                        paciente para que no pueda ser citado. (Pacientes que no pagan, seguro vencido,
                                        conflictivos, etc)
                                        Paquetes de Medicación. Mejora que permite añadir varios medicamentos en un solo
                                        clic.
                                        Nuevo estilo iconos y colores.
                                        Grabación antes del logout, los campos escritos en la Historia Clínica se graban
                                        cada 15 minutos y antes de hacer un logout por inactividad.
                                        Nuevos campos de embarazo, en la historia clínica personalizable se pueden añadir
                                        nuevos campos para el seguimiento del embarazo.
                                        Facturas de Stock, se ha mejorado la creación de las facturas de stock y ahora se
                                        pueden ver y contabilizar en el menu de cuentas.
                                        Mejora del sistema de migración, importación y exportación.
                                        Rediseño de las facturas estilo actual con líneas rectas.
                                        LogOut, ahora se graba lo escrito en la historia clíncia antes de hacer un logout
                                        por inactividad.
                                        Exportacion de más datos a .CSV, se han añadido muchísimos mas datos al exportar
                                        tablas a CSV.
                                        Tickets. Al crear un albarán se puede elegir imprimir en A4 o en formato reducido
                                        "ticket de pago".
                                        Multiespecialidad, los doctores pueden tener diferentes especialidades.
                                        SAGE Contaplus, DriCloud se ha integrado con éxito con SAGE Contaplus. En el menu de
                                        Cuentas puedes encontrar un botón para enviar los datos de facturación a Contaplus.
                                        Además DriCloud os ha conseguido un 40% de descuento en la adquisición de Contaplus
                                        (sólo clientes). Contactanos !. Más información...
                                        Informe Médico en Word, ahora se puede subir una plantilla en Word con cualquier
                                        estilo, sobre la que se creará el informe médico. Más información...
                                        Varios. Mejora estética de los Consentimientos Informados personalizados.
                                        Actualización de la App VITALES para Android.
                                        Varios. Restaurar la página web, reload de agenda mantiene filtros, mejoras en la
                                        historia clínica personalizable, vacaciones totales por año, migración permite
                                        importar citas, envío de mensaje si se modifica una cita, opción de enviar
                                        recordatorio al hacer una cita, cuentas-gastos se añaden combos, aumento de la
                                        calidad de la imágenes subidas. En facturas se acepta todo tipo de impuestos (no
                                        solo IVA). Ingresos por cobrar contabiliza privados y bonos.
                                        Nuevo. Menu sistemas-despachos. Cada despacho se asocia a una localización
                                        geográfica diferente. Los mensajes recordatorios de cita envían al paciente a cada
                                        despacho.
                                        Nuevo. Menu sistemas-servicios. Activar o desactivar los servicios que se ofrecen en
                                        la clínica.
                                        Nuevo. Bonos de sesiones. Video
                                        Nuevo. Menu Pacientes-Visita Rápida. Permite asistir a un paciente sin necesidad de
                                        citarlo en la agenda.
                                        Nuevo. Agenda-Cita Repetida. Al crear una cita, se puede indicar que se repita cada
                                        día, semana o año.
                                        DriCloud ha crecido muy rápido gracias a vuestra colaboración y propuestas. Durante
                                        el 2016 hemos desarrollado más de 300 nuevas funcionalidades.
                                        ACCEDE AQUÍ para conocer las nuevas funciones en Facturación, Contabilidad,
                                        Estadísticas, Stock, Bonos, Firma Digital de Consentimientos y Apple Salud.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-envelope"></i>
                            <span>Mensajes</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><span>Tiene 0 Mensajes sin leer , clic aquí para ir al menú de
                                    Telemedicina</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-bookmark-fill"></i>
                            <span> Anulaciones de cita</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"><span>Tiene 0 anulaciones de cita, haga clic aquí para ir al menú de
                                    Confirmación de
                                    Asistencia</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-card-list"></i>
                            <span>Peticiones a laboratorios</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><span>Tiene 0 cambios de estado de sus pedidos a laboratorios. Haga clic
                                    aquí para ir
                                    al menú de Telemedicin</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 md-6 lg-6 xl-6 xxl-6" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header collapseBtn">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Consultas semanal</span>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><span>29/05/2023 - 04/06/2023</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
