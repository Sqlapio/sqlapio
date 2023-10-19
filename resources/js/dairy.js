import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import esLocale from '@fullcalendar/core/locales/es';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

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
let arrayAm = [{
  value: '',
  name: 'Seleccione...'
},
{
  value: '01:00-02:00-rgb(160,213,210)',
  name: "01:00 - 02:00",
  color: 'rgb(160,213,210)'
},
{
  value: '02:00-03:00-rgb(160,213,210)',
  name: '02:00 - 03:00',
  color: 'rgb(160,213,210)'

},
{
  value: '03:00-04:00-rgb(160,213,210)',
  name: '03:00 - 04:00',
  color: 'rgb(160,213,210)'

},
{
  value: '04:00-05:00-rgb(160,213,210)',
  name: '04:00 - 05:00',
  color: 'rgb(160,213,210)'

},
{
  value: '05:00-06:0-rgb(160,213,210)',
  name: '05:00 - 06:00',
  color: 'rgb(160,213,210)'

},
{
  value: '06:00-07:00-rgb(160,213,210)',
  name: '06:00 - 07:00',
  color: 'rgb(160,213,210)'

},
{
  value: '07:00-08:00-rgb(160,213,210)',
  name: '07:00 - 08:00',
  color: 'rgb(160,213,210)'

},
{
  value: '08:00-09:00-rgb(160,213,210)',
  name: '08:00 - 09:00',
  color: 'rgb(160,213,210)'

},
{
  value: '09:00-10:00-rgb(177,177,177)',
  name: '09:00 - 10:00',
  color: 'rgb(177,177,177)'

},
{
  value: '10:00-11:00-rgb(178,214,237)',
  name: '10:00 - 11:00',
  color: 'rgb(178,214,237)'

},
{
  value: '10:00-11:00-rgb(165,219,189)',
  name: '11:00 - 12:00',
  color: 'rgb(165,219,189)'

}
];
let arrayPm = [{
  value: '',
  name: 'Seleccione...'
},
{
  value: '12:00-13:00-rgb(252,208,212)',
  name: '12:00 - 01:00',
  color: 'rgb(252,208,212)'

},
{
  value: '13:00-14:00-rgb(244,201,240)',
  name: '01:00 - 02:00',
  color: 'rgb(244,201,240)'

},
{
  value: '14:00-15:00-rgbrgb(249,174,112)',
  name: '02:00 - 03:00',
  color: 'rgb(249,174,112)'

},
{
  value: '15:00-16:00-rgb(217,186,244)',
  name: '03:00 - 04:00',
  color: 'rgb(217,186,244)'

},
{
  value: '16:00-17:00-rgb(242,146,141)',
  name: '04:00 - 05:00',
  color: 'rgb(242,146,141)'

},
{
  value: '17:00-18:00-rgb(237,242,247)',
  name: '05:00 - 06:00',
  color: 'rgb(237,242,247)'

},
{
  value: '18:00-19:00-rgb(178,214,237)',
  name: '06:00 - 07:00',
  color: 'rgb(178,214,237)'

},
{
  value: '19:00-20:00-rgb(237,219,3)',
  name: '07:00 - 08:00',
  color: 'rgb(237,219,3)'

},
{
  value: '20:00-21:00-rgb(69,139,139',
  name: '08:00 - 09:00',
  color: 'rgb(69,139,139)'

},
{
  value: '21:00-22:00-rgb(139,136,191)',
  name: '09:00 - 10:00',
  color: 'rgb(139,136,191)'

},
{
  value: '22:00-23:00-rgb(175,170,4',
  name: '10:00 - 11:00',
  color: 'rgb(175,170,4)'

},
{
  value: '23:00-00:00-rgb(217,186,244)',
  name: '11:00 - 12:00',
  color: 'rgb(217,186,244)'

}
];

function getUrl(urlPostt, url2) {
  urlPost = urlPostt;
  urlDairy = url2
}
$(document).ready(() => {
  /////////// envio del formulario agenda//////////////
  $('#form-appointment').validate({
    rules: {
      date_start: {
        required: true,
      },
      hour_start: {
        required: true,
      },
      minFin: {
        required: true,

      },
      hour_end: {
        required: true,
      },
      minFin: {
        required: true,
      },
      timeFin: {
        required: true,
      },
      timeIni: {
        required: true,
      },
      center_id: {
        required: true,
      }
    },
    messages: {
      center_id: {
        required: "Campo es obligatorio",
      },
      date_start: {
        required: "Campo es obligatorio",
      },
      hour_start: {
        required: "Campo es obligatorio",
      },
      minFin: {
        required: "Campo es obligatorio",

      },
      hour_end: {
        required: "Campo es obligatorio",
      },
      minFin: {
        required: "Campo es obligatorio",
      },
      timeIni: {
        required: "Campo es obligatorio",
      },
      timeFin: {
        required: "Campo es obligatorio",
      }
    }
  });

  $("#form-appointment").submit(function (event) {
    event.preventDefault();
    $("#form-appointment").validate();
    if ($("#form-appointment").valid()) {
      $('#send').hide();
      $('#spinner').show();
      var data = $('#form-appointment').serialize();
      $.ajax({
        url: urlPost,
        type: 'POST',
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

          $('#send').show();
          $('#spinner').hide();
          $("#form-appointment").trigger("reset");
          Swal.fire({
            icon: 'success',
            title: 'Cita registrada exitosamente!',
            allowOutsideClick: false,
            confirmButtonColor: '#42ABE2',
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            $('#modalCenter').modal('toggle');
            window.location.href = urlDairy;

          });
        },
        error: function (error) {
          Swal.fire({
            icon: 'error',
            title: error.responseJSON.errors,
            allowOutsideClick: false,
            confirmButtonColor: '#42ABE2',
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            $('#spinner').hide();
            $('#send').show();
            $('#hour_start').focus();
            $('#exampleModal').modal('close');
          });

        }
      });
    }
  })
});

function getAppointments(appointments, route, routeCancelled, url2, ulrImge, updateAppointments, ulr_imge_avatar) {
  data = appointments;
  url = route;
  urlDairy = url2;
  urlCancelled = routeCancelled;
  ulrimge = ulrImge;
  ulrUpdate = updateAppointments;
  avatar_imge = ulr_imge_avatar;
  //
  const calendarEl = document.getElementById('calendar')
  calendar = new Calendar(calendarEl, {
    timeZone: 'America/Caracas',
    locales: [esLocale],
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    views: {
      timeGrid: {
        allDayText: 'Citas del dia',
        allDaySlot: false,
        slotLabelFormat: {
          hour: '2-digit',
          minute: '2-digit',
          hour12: true,
          meridiem: false,
        },

      }
    },
    eventDisplay: 'block',
    editable: true,
    selectable: true,
    dayMaxEventRows: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridDay,listWeek'
    },
    titleFormat: {
      month: 'short',
      year: 'numeric',
    },
    events: data,
    eventClick: function (info) {
      setValue(info.event._def.title, info);
      $('#exampleModal').modal('show');
    },
    dateClick: function (info) {
      clearInput(info.dateStr);
      $('#exampleModal').modal('show');
    },
    eventChange(info) {
      let data = {
        "_token": $('#token').val(),
        'id': info.event._def.extendedProps.id,
        "start": new Date(info.event._instance.range.start).toISOString().split('T')[0],
        "end": new Date(info.event._instance.range.end).toISOString().split('T')[0],
        "color": info.event._def.ui.backgroundColor,
        "extendedProps": info.event._def.extendedProps
      }
      update_appointments(ulrUpdate, data);
    }
  });

  calendar.render();
}

function clearInput(date) {
  $("#btn-con").find('a').remove();
  $("#btn-cancell").find('button').remove();
  $("#search-patients-show").show();
  $("#name").text('');
  $("#email").text('');
  $("#phone").text('');
  $("#ci").text('');
  $("#genere").text('');
  $("#age").text('');
  $("#form-appointment").trigger("reset");
  $("#date_start").val(new Date(date).toISOString().split('T')[0]);
  $("#patient_id").val('');
  $("#searchPatients").val('');
  $('#div-pat').hide();
}

function setValue(data, info) {
  // let dataPers = data.split(",");
  // datos del paciente
  $("#btn-con").find('a').remove();
  $("#btn-cancell").find('button').remove();
  url = url.replace(':id', info.event.extendedProps.patient_id);
  $("#btn-con").append(`<a href="${url}"><button type="button" class="btn btnSecond">Consulta medica</button></a>`);
  $("#btn-cancell").append(`<button type="button" onclick="cancelled_appointments(${info.event.extendedProps.id},'${urlCancelled}')" class="btn btnSecond">Cancelar Cita</button>`);
  $("#search-patients-show").hide();
  $("#center_id").val(info.event.extendedProps.center_id).change();
  $("#timeIni").val(info.event.extendedProps.time_zone_start).change();
  $("#name").text(info.event.extendedProps.name + ' ' + info.event.extendedProps.last_name);
  $("#email").text(info.event.extendedProps.email);
  $("#phone").text(info.event.extendedProps.phone);
  $("#ci").text(info.event.extendedProps.ci);
  $("#hour_start").val(info.event.extendedProps.data).change();
  $("#genere").text(info.event.extendedProps.genere);
  $("#age").text(info.event.extendedProps.age);
  $("#patient_id").val(info.event.extendedProps.patient_id);
  $("#date_start").val(new Date(info.event._instance.range.start).toISOString().split('T')[0]);
  $("#price").val(info.event.extendedProps.price);
  $('#div-pat').show();
  $("#img-pat").attr("src", `${ulrimge}/${info.event.extendedProps.img}`);
  ////
}

function searchPatients(res) {
  // if ($('#searchPatients').val() != '') {
  //   url = url.replace(':value', $('#searchPatients').val());
  //   $.ajax({
  //     url: url,
  //     type: 'GET',
  //     headers: {
  //       'X-CSRF-TOKEN': $(
  //         'meta[name="csrf-token"]').attr(
  //           'content')
  //     },
  //     success: function (res) {
  //       if (res != "") {
  //         if (res.is_minor) {
  //           $("#name").text(res.name + ' ' + res.last_name);
  //           $("#email").text(res.email);
  //           $("#phone").text(res.phone);
  //           $("#ci").text(res.ci);
  //           $("#genere").text(res.genere);
  //           $("#age").text(res.age);
  //           $("#patient_id").val(res.id);
  //         } else {
  //           $("#name").text(res.re_name + ' ' + res.re_last_name);
  //           $("#email").text(res.re_email);
  //           $("#phone").text(res.re_phone);
  //           $("#ci").text(res.re_ci);
  //           $("#genere").text(res.genere);
  //           $("#age").text(res.age);
  //           $("#patient_id").val(res.id);
  //         }
  //         $('#div-pat').show();
  //         $("#img-pat").attr("src", `${ulrimge}/${res.patient_img}`);
  //         $('#registrer-pac').attr("disabled", false);
  //         $('#timeIni').focus()
  //       } else {
  //         Swal.fire({
  //           icon: 'error',
  //           title: 'Paciente no encontrado!',
  //           allowOutsideClick: false,
  //           confirmButtonColor: '#42ABE2',
  //           confirmButtonText: 'Aceptar'
  //         }).then((result) => {
  //         });
  //       }

  //     }
  //   });
  // }
  if (res.is_minor) {
    $("#name").text(res.name + ' ' + res.last_name);
    $("#email").text(res.email);
    $("#phone").text(res.phone);
    $("#ci").text(res.ci);
    $("#genere").text(res.genere);
    $("#age").text(res.age);
    $("#patient_id").val(res.id);
  } else {
    $("#name").text(res.re_name + ' ' + res.re_last_name);
    $("#email").text(res.re_email);
    $("#phone").text(res.re_phone);
    $("#ci").text(res.re_ci);
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
  $('#div-pat').show();
  $("#img-pat").attr("src",);

  $('#registrer-pac').attr("disabled", false);
  $('#timeIni').focus();
}

function update_appointments(url, data) {
  $.ajax({
    url: url,
    type: 'PUT',
    data: data,
    success: function (res) {
      Swal.fire({
        icon: 'success',
        title: 'Cita actualizada exitosamente!',
        allowOutsideClick: false,
        confirmButtonColor: '#42ABE2',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
      });
    }, error: function (error) {
      Swal.fire({
        icon: 'error',
        title: error.responseJSON.errors,
        allowOutsideClick: false,
        confirmButtonColor: '#42ABE2',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        window.location.href = urlDairy;
      });
    }
  });

}

function cancelled_appointments(id, url, active = null) {

  Swal.fire({
    icon: 'warning',
    title: '¿Confirma que    desea ELIMINAR la cita?',
    allowOutsideClick: false,
    confirmButtonColor: '#42ABE2',
    confirmButtonText: 'Aceptar',
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $('#send').hide();
      $('#spinner').show();
      url = url.replace(':id', id);
      $.ajax({
        url: url,
        type: 'GET',
        headers: {
          'X-CSRF-TOKEN': $(
            'meta[name="csrf-token"]').attr(
              'content')
        },
        success: function (res) {
          console.log(res);
          Swal.fire({
            icon: 'error',
            title: 'Cita cancelada exitosamente!',
            allowOutsideClick: false,
            confirmButtonColor: '#42ABE2',
            confirmButtonText: 'Aceptar'
          }).then((result) => {
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
  $(`#hour_start`).find('option').remove().end()
  dataDos.map((item) => {
    $('#hour_start').append($('<option>', {
      style: `color:${item.color}`,
      value: item.value,
      text: item.name
    }));
  });
}

function handlerPrice(e) {
  if ($(`#${e.target.id}`).is(':checked')) {
    $('#div-price').show();
  } else {
    $('#div-price').hide();
  }
}
window.update_appointments = update_appointments;
window.cancelled_appointments = cancelled_appointments;
window.getAppointments = getAppointments;
window.searchPatients = searchPatients;
window.handlerPrice = handlerPrice;
window.handlerTime = handlerTime;
window.getUrl = getUrl;
