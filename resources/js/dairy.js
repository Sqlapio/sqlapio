import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import esLocale from "@fullcalendar/core/locales/es";
import enLocale from "@fullcalendar/core/locales/en-nz";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";

let langJson = {};


$(document).ready(() => {

    const lang = document.getElementById("lang").value;

    langJson = JSON.parse(lang);

});

let calendar;
let data = [];
let url;
let urlCancelled;
let urlDairy;
let ulrimge;
let avatar_imge;
let ulrUpdate;
let urlPost;
let dataDos;
let urlPaciente;
let user;
let arrayAm = [
    {
        value: "",
        name: "Seleccione..."
    },
    {
        value: "06:00-07:00",
        name: "06:00 - 07:00"
    },
    {
        value: "07:00-08:00",
        name: "07:00 - 08:00"
    },
    {
        value: "08:00-09:00",
        name: "08:00 - 09:00"
    },
    {
        value: "09:00-10:00",
        name: "09:00 - 10:00"
    },
    {
        value: "10:00-11:00",
        name: "10:00 - 11:00"
    },
    {
        value: "10:00-11:00",
        name: "11:00 - 12:00"
    }
];

let arrayPm = [
    {
        value: "",
        name: "Seleccione..."
    },
    {
        value: "12:00-13:00",
        name: "12:00 - 01:00"
    },
    {
        value: "13:00-14:00",
        name: "01:00 - 02:00"
    },
    {
        value: "14:00-15:00",
        name: "02:00 - 03:00"
    },
    {
        value: "15:00-16:00",
        name: "03:00 - 04:00"
    },
    {
        value: "16:00-17:00",
        name: "04:00 - 05:00"
    },
    {
        value: "17:00-18:00",
        name: "05:00 - 06:00"
    },
    {
        value: "18:00-19:00",
        name: "06:00 - 07:00"
    },
    {
        value: "19:00-20:00",
        name: "07:00 - 08:00"
    },
    {
        value: "20:00-21:00",
        name: "08:00 - 09:00"
    }
];

let dateString = getDateWithoutTime(new Date()).toISOString().substring(0, 10);

function getUrl(urlPostt, url2) {
    urlPost = urlPostt;
    urlDairy = url2;
}
$(document).ready(() => {
    /////////// envio del formulario agenda//////////////
    $("#form-appointment").validate({
        rules: {
            date_start: {
                required: true
            },
            hour_start: {
                required: true
            },
            minFin: {
                required: true
            },
            hour_end: {
                required: true
            },
            minFin: {
                required: true
            },
            timeFin: {
                required: true
            },
            timeIni: {
                required: true
            },
            center_id: {
                required: true
            },
            id_select: {
                required: true
            },
            name_patient: {
                required: true
            },

            last_name_patient: {
                required: true
            },
            phone: {
                required: true
            },
            email_patient: {
                required: true
            }
            // birthdate_patient:{
            //   required: true,
            // }
        },
        messages: {
            center_id: {
                required: "Campo es obligatorio"
            },
            date_start: {
                required: "Campo es obligatorio"
            },
            hour_start: {
                required: "Campo es obligatorio"
            },
            minFin: {
                required: "Campo es obligatorio"
            },
            hour_end: {
                required: "Campo es obligatorio"
            },
            minFin: {
                required: "Campo es obligatorio"
            },
            timeIni: {
                required: "Campo es obligatorio"
            },
            timeFin: {
                required: "Campo es obligatorio"
            },
            id_select: {
                required: "Debe Seleccionar un paciente"
            },
            name_patient: {
                required: "Campo es obligatorio"
            },
            last_name_patient: {
                required: "Campo es obligatorio"
            },
            phone: {
                required: "Campo es obligatorio"
            },
            email_patient: {
                required: "Campo es obligatorio"
            }
            // birthdate_patient: {
            //   required: "Campo es obligatorio",
            // },
        }
    });

    $("#form-appointment").submit(function (event) {
        event.preventDefault();
        $("#form-appointment").validate();
        if ($("#form-appointment").valid()) {
            $("#send").hide();
            $("#spinner").show();
            var data = $("#form-appointment").serialize();
            $.ajax({
                url: urlPost,
                type: "POST",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    $("#send").show();
                    $("#spinner").hide();
                    $("#form-appointment").trigger("reset");
                    Swal.fire({
                        icon: "success",
                        title: "Cita registrada exitosamente!",
                        allowOutsideClick: false,
                        confirmButtonColor: "#42ABE2",
                        confirmButtonText: langJson.botton.aceptar
                    }).then(result => {
                        $("#modalCenter").modal("toggle");
                        window.location.href = urlDairy;
                    });
                },
                error: function (error) {
                    Swal.fire({
                        icon: "error",
                        title: error.responseJSON.errors,
                        allowOutsideClick: false,
                        confirmButtonColor: "#42ABE2",
                        confirmButtonText: langJson.botton.aceptar
                    }).then(result => {
                        $("#spinner").hide();
                        $("#send").show();
                        $("#hour_start").focus();
                        $("#exampleModal").modal("close");
                    });
                }
            });
        }
    });
});

function getAppointments(appointments, route, routeCancelled, url2, ulrImge, updateAppointments, ulr_imge_avatar, ulrPaciente, users) {
    data = appointments;
    url = route;
    urlDairy = url2;
    urlCancelled = routeCancelled;
    ulrimge = ulrImge;
    ulrUpdate = updateAppointments;
    avatar_imge = ulr_imge_avatar;
    urlPaciente = ulrPaciente;
    user = users;

    const calendarEl = document.getElementById("calendar");
    calendar = new Calendar(calendarEl, {
        timeZone: "America/Caracas",
        locales: lang_session == 'en' ? [enLocale] : [esLocale],
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        views: {
            timeGrid: {
                // allDayText: "Citas del dia",
                allDaySlot: false,
                slotLabelFormat: {
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: true,
                    meridiem: false
                }
            }
        },
        eventDisplay: "block",
        editable: true,
        selectable: true,
        dayMaxEventRows: true,
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridDay,listWeek"
        },
        titleFormat: {
            month: "short",
            year: "numeric"
        },
        events: data,
        eventClick: function (info) {
            setValue(info.event._def.title, info);
            $("#exampleModal").modal("show");
        },
        dateClick: function (info) {
            if (info.dateStr >= dateString === false) {
                Swal.fire({
                    icon: "warning",
                    title: langJson.alert.fecha_anterior,
                    allowOutsideClick: false,
                    confirmButtonColor: "#42ABE2",
                    confirmButtonText: langJson.botton.aceptar
                });
                return info.start >= getDateWithoutTime(new Date());
            } else {
                clearInput(info.dateStr);
                let date = new Date(info.dateStr);
                let formattedDate = `${date.getDate() + 1}/${date.getMonth() + 1}/${date.getFullYear()}`;

                $("#exampleModal").modal("show");
                $("#date").text(formattedDate);
            }
        },
        eventChange(info) {
            let data = {
                _token: $("#token").val(),
                id: info.event._def.extendedProps.id,
                start: new Date(info.event._instance.range.start).toISOString().split("T")[0],
                end: new Date(info.event._instance.range.end).toISOString().split("T")[0],
                color: info.event._def.ui.backgroundColor,
                extendedProps: info.event._def.extendedProps
            };

            let dateEnd = data.end && data.start;
            if (dateEnd >= dateString) {
                $("#spinner").show();
                update_appointments(ulrUpdate, data);
            } else if (data.extendedProps.data_app < dateEnd && dateEnd >= dateString) {
                $("#spinner").show();
                update_appointments(ulrUpdate, data);
            } else {
                Swal.fire({
                    icon: "warning",
                    title: langJson.alert.fecha_anterior,
                    allowOutsideClick: false,
                    confirmButtonColor: "#42ABE2",
                    confirmButtonText: langJson.botton.aceptar
                });
                info.revert();
                return false;
            }
        }
    });

    calendar.render();
}

function clearInput(date) {
    $("#handlerPetientRegister").show();

    $("#btn-con").find("button").remove();
    $("#btn-cancell").find("button").remove();
    $("#search-patients-show").show();
    $("#name").text("");
    $("#email").text("");
    $("#phone").text("");
    $("#ci").text("");
    $("#genere").text("");
    $("#age").text("");
    $("#form-appointment").trigger("reset");
    $("#date_start").val(new Date(date).toISOString().split("T")[0]).attr("disabled", false);
    $("#patient_id").val("");
    $("#searchPatients").val("");
    $("#div-pat").hide();
    $("#center_id").attr("disabled", false);
    $("#timeIni").attr("disabled", false);
    $("#registrer-pac").attr("disabled", false).show();
    $("#hour_start").attr("disabled", false);
    $("#title-modal").text(langJson.modal.titulo.agendar_cita);
    $("#appointment-data").hide();

    $("#FC").hide();
    $("#TH").show();
    $("#HS").show();
    $("#CM").show();
    $("#check-price").show();
    $("#inlineRadio1").show();
    $("#date").show();
}

function setValue(data, info) {

    let img_url = `${ulrimge}/${info.event.extendedProps.img}`;

    if (info.event.extendedProps.img === null) {
        if (info.event.extendedProps.genere == "femenino") {
            img_url = `${avatar_imge}/avatar mujer.png`;
        } else {
            img_url = `${avatar_imge}/avatar hombre.png`;
        }
    }

    // datos del paciente
    $("#btn-con").find("button").remove();
    $("#btn-cancell").find("button").remove();
    url = url.replace(":id", info.event.extendedProps.patient_id);
    let item = JSON.stringify(info);

    if (info.event.extendedProps.age) {
        $("#btn-con").append(`<button onclick='handlerMedicalRecord(${item})' type="button" class="btn btnSecond">${langJson.botton.consulta_medica}</button>`);
    } else {
        urlPaciente = urlPaciente.replace(":id_patient", info.event.extendedProps.patient_id);

        $("#btn-con").append(`<a href='${urlPaciente}'><button type="button" class="btn btnPrimary">${langJson.botton.actualizar_datos}</button></a>`);
    }

    $("#btn-cancell").append(`<button type="button" onclick="cancelled_appointments(${info.event.extendedProps.id},'${urlCancelled}')" class="btn btnSecond">${langJson.botton.cancelar_cita}</button>`);
    $("#search-patients-show").hide();
    $("#center_id").val(info.event.extendedProps.center_id).change().attr("disabled", true);
    $("#timeIni").val(info.event.extendedProps.time_zone_start).change().attr("disabled", true);
    $("#name").text(info.event.extendedProps.name + " " + info.event.extendedProps.last_name);
    $("#email").text(info.event.extendedProps.email);
    $("#phone").text(info.event.extendedProps.phone);
    if (info.event.extendedProps.ci && user.contrie == '81') {
        $("#ci").text(info.event.extendedProps.ci.replace(/^(\d{3})(\d{7})(\d{1}).*/, '$1-$2-$3'));
    } else {
        $("#ci").text(info.event.extendedProps.ci);
    }
    $("#hour_start").val(info.event.extendedProps.data).change().attr("disabled", true);
    $("#genere").text(info.event.extendedProps.genere);
    $("#age").text(info.event.extendedProps.age);
    $("#patient_id").val(info.event.extendedProps.patient_id);
    $("#date_start").val(new Date(info.event._instance.range.start).toISOString().split("T")[0]);
    $("#price").val(info.event.extendedProps.price);
    $("#div-pat").show();
    $("#img-pat").attr("src", `${img_url}`);

    $("#registrer-pac").attr("disabled", false).hide();

    $("#handlerPetientRegister").hide();

    $("#title-modal").text(langJson.modal.titulo.cita);
    ////

    $("#appointment-data").show();
    $("#fecha").text(new Date(info.event._instance.range.start).toISOString().split("T")[0]);
    $("#hour").text(info.event.extendedProps.data + " " + info.event.extendedProps.time_zone_start);
    $("#center").text(info.event.extendedProps.center);

    $("#date-lb").hide();
    $("#FC").hide();
    $("#TH").hide();
    $("#HS").hide();
    $("#CM").hide();
    $("#check-price").hide();
    $("#inlineRadio1").hide();
    $("#date").hide();
}

function searchPatients(res) {
    if (res.is_minor === 'false') {
        if (user.contrie == '81') {
            $("#ci").text(res.ci.replace(/^(\d{3})(\d{7})(\d{1}).*/, '$1-$2-$3'));
        } else {
            $("#ci").text(res.ci);
        }
        $("#name").text(res.name + " " + res.last_name);
        $("#email").text(res.email);
        $("#phone").text(res.phone);
        $("#genere").text(res.genere);
        $("#age").text(res.age);
        $("#patient_id").val(res.id);
    } else {
        $("#name").text(res.name + " " + res.last_name);
        $("#email").text('***');
        $("#phone").text('***');
        $("#ci").text('***') ;
        $("#genere").text(res.genere);
        $("#age").text(res.age);
        $("#patient_id").val(res.id);
    }

    let img_url = `${ulrimge}/${res.patient_img}`;
    if (res.patient_img === null) {
        if (res.genere == "femenino") {
            img_url = `${avatar_imge}/avatar mujer.png`;
        } else {
            img_url = `${avatar_imge}/avatar hombre.png`;
        }
    }
    $("#img-pat").attr("src", `${img_url}`);
    $("#div-pat").show();
    $("#img-pat").attr("src");

    $("#registrer-pac").show();
    $("#timeIni").focus();
    $("#title-modal").text(langJson.modal.titulo.agendar_cita);
    $("#appointment-data").hide();
}

function update_appointments(url, data) {
    $("#spinner2").show();
    $.ajax({
        url: url,
        type: "PUT",
        data: data,
        success: function (res) {
            $("#spinner2").hide();
            Swal.fire({
                icon: "success",
                title: langJson.alert.cita_actualizada,
                allowOutsideClick: false,
                confirmButtonColor: "#42ABE2",
                confirmButtonText: langJson.botton.aceptar
            }).then(result => {
                window.location.href = urlDairy;
            });
        },
        error: function (error) {
            $("#spinner2").hide();
            Swal.fire({
                icon: "error",
                title: error.responseJSON.errors,
                allowOutsideClick: false,
                confirmButtonColor: "#42ABE2",
                confirmButtonText: langJson.botton.aceptar
            }).then(result => {
                window.location.href = urlDairy;
            });
        }
    });
}

function cancelled_appointments(id, url, active = null) {
    Swal.fire({
        icon: "warning",
        title: langJson.alert.cancelar_cita,
        allowOutsideClick: false,
        confirmButtonColor: "#42ABE2",
        confirmButtonText: langJson.botton.aceptar,
        showCancelButton: true,
        cancelButtonText: langJson.botton.cancelar
    }).then(result => {
        if (result.isConfirmed) {
            $("#send").hide();
            $("#spinner").show();
            url = url.replace(":id", id);
            $.ajax({
                url: url,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (res) {
                    $("#spinner").hide();
                    Swal.fire({
                        icon: "error",
                        title: langJson.alert.cita_cancelada,
                        allowOutsideClick: false,
                        confirmButtonColor: "#42ABE2",
                        confirmButtonText: langJson.botton.aceptar
                    }).then(result => {
                        if (active) {
                            window.location.href = active;
                        } else {
                            window.location.href = urlDairy;
                        }
                    });
                }
            });
        }
    });
}

function finalizar_appointments(id, url, active = null) {
    Swal.fire({
        icon: "warning",
        title: langJson.alert.finalizar_cita,
        allowOutsideClick: false,
        confirmButtonColor: "#42ABE2",
        confirmButtonText: langJson.botton.aceptar,
        showCancelButton: true,
        cancelButtonText: langJson.botton.cancelar
    }).then(result => {
        if (result.isConfirmed) {
            $("#send").hide();
            $("#spinner").show();
            url = url.replace(":id", id);
            $.ajax({
                url: url,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (res) {
                    $("#spinner").hide();

                    Swal.fire({
                        icon: "success",
                        title: langJson.alert.cita_finalizada,
                        allowOutsideClick: false,
                        confirmButtonColor: "#42ABE2",
                        confirmButtonText: langJson.botton.aceptar
                    }).then(result => {
                        if (active) {
                            window.location.href = active;
                        } else {
                            window.location.href = urlDairy;
                        }
                    });
                }
            });
        }
    });
}

function handlerTime(e) {
    if (e.target.value == "am") {
        dataDos = arrayAm;
    } else {
        dataDos = arrayPm;
    }
    $(`#hour_start`).find("option").remove().end();
    dataDos.map(item => {
        $("#hour_start").append(
            $("<option>", {
                style: `color:${item.color}`,
                value: item.value,
                text: item.name
            })
        );
    });
}

function handlerPrice(e) {
    if ($(`#${e.target.id}`).is(":checked")) {
        $("#div-price").show();
    } else {
        $("#div-price").hide();
    }
}

function handlerMedicalRecord(item) {
    if (dateString === new Date(item.event.extendedProps.data_app).toISOString().substring(0, 10)) {
        url = url.replace(":id", item.event.extendedProps.patient_id);
        window.location.href = url;
    } else {
        Swal.fire({
            icon: "warning",
            title: langJson.alert.cambiar_fecha,
            allowOutsideClick: false,
            confirmButtonColor: "#42ABE2",
            confirmButtonText: langJson.botton.aceptar
        });
    }
}

window.update_appointments = update_appointments;
window.cancelled_appointments = cancelled_appointments;
window.finalizar_appointments = finalizar_appointments;
window.getAppointments = getAppointments;
window.searchPatients = searchPatients;
window.handlerPrice = handlerPrice;
window.handlerTime = handlerTime;
window.getUrl = getUrl;
window.handlerMedicalRecord = handlerMedicalRecord;

function getDateWithoutTime(dt) {
    dt.setHours(0, 0, 0, 0);
    return dt;
}
