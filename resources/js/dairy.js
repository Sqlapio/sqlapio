import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import esLocale from '@fullcalendar/core/locales/es';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import moment from 'moment/moment';

let calendar;
let newEvent;
let ActiveChech = false;

// $('#dateNacNew').datepicker('refresh')
// $('#dateNacNew').datepicker($.datepicker.regional['es']);

var data = [
  {
    title: 'Kleyner Villegas , Kleyner@gmail.com,  0424221255, Matrix',
    start: new Date(),
    end: new Date(),
    // startTime: '01:00',
    // endtTime: '01:30',
    backgroundColor: '#38ACE3',

  },
  {
    title: 'Diego Villegas , Diego@gmail.com,  0424221255, Cualita',
    start: new Date('2023-06-27'),
    end: new Date('2023-06-27'),
    // startTime: '03:00',  
    // endtTime: '03:30',
    backgroundColor: '#38ACE3',

  },
  {
    title: 'Camila Villegas , Camila@gmail.com,  0424221255, Horizaontes',
    start: new Date('2023-06-28'),
    end: new Date('2023-06-28'),
    // startTime: '05:00',
    // endtTime: '05:30',

    backgroundColor: '#38ACE3',

  }];
///
document.addEventListener('DOMContentLoaded', function () {

  const calendarEl = document.getElementById('calendar')
  calendar = new Calendar(calendarEl, {
    locales: [esLocale],
    plugins: [timeGridPlugin, listPlugin, interactionPlugin, dayGridPlugin],
    initialView: 'timeGridDay',
    editable: true,
    selectable: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'timeGridDay,dayGridMonth,listWeek'
    },
    eventTimeFormat: { hour: "numeric", minute: "2-digit", timeZoneName: "short" },
    events: data,
    eventClick: function (info) {
      console.log("eventClick");
      setValue(info.event._def.title);
      $("#activaCreate").val(1)
      $('#exampleModal').modal('show');
    },
    dateClick: function (info) {
      console.log("dateClick");
      newEvent = info;
      clearInput();
      $("#activaCreate").val(0)
      $('#exampleModal').modal('show');
    },
  })
  calendar.render()
});

function addCita(info) {
  $('#exampleModal').modal('toggle');

  // let date = moment($("#dateCita").val()).format('YYYY-MM-DD');

  if (Number($("#activaCreate").val()) === 0) {
    $("#activaCreate").val(1);
    $('#row-form-paciente').hide();
    $('#img-hide').show();
    let event = {}

    if (ActiveChech) {
      event = {
        title: `${$('#nameNew').val()} ${$('#lastNameNew').val()},${$('#emailNew').val()},${$('#phoneNew').val()},${$("#asegNew option:selected").text()}`,
        start: new Date(`${$("#dateCita").val()} ${$("#hrInit").val()}:${$("#minInit").val()}`),
        end: new Date(`${$("#dateCita").val()} ${$("#hrIEnd").val()}:${$("#MinEnd").val()}`),
        allDay: false,
        backgroundColor: '#38ACE3',
      }
    } else {
      event = {
        title: `Pedro Perez, Pedro@gmail.com, 04248857489, Horizontes`,
        start: new Date(`${$("#dateCita").val()} ${$("#hrInit").val()}:${$("#minInit").val()}`),
        end: new Date(`${$("#dateCita").val()} ${$("#hrIEnd").val()}:${$("#MinEnd").val()}`),
        allDay: false,
        backgroundColor: '#38ACE3',
      }
    }
    calendar.addEvent(event);
  } else {
    console.log("editar");
  }


}
window.addCita = addCita;

function clearInput() {
  $("#btn-guardar").text("Añadir cita");
  $("#btn-imprimir").text("Añadir cita e imprimir");
  $("#name").text("");
  $("#email").text("");
  $("#phone").text("");
  $("#aseg").text("");
  $("#Private").text("");
  $("#dateCita").val("");
  $("#hrInit").val('');
  $("#minInit").val('');
  $("#dateFin").val("");
  $("#MinFin").val('');
  $("#minutos").val('');
  $("#controlCitas").val("");
  $("#doctor").val("");
  $("#estadoCita").val("");
  $("#conocio").val("");
  $("#precio").val("");
  $("#div-img").hide();
  $("#Videollamada").hide();
  $("#footer-button").hide();
  $("#row-check").show();
}

function setValue(data) {
  let dataPers = data.split(",");
  $("#row-check").hide();
  $("#div-img").show();
  $("#Videollamada").show();
  $("#footer-button").show();
  $("#btn-guardar").text("Guardar");
  $("#btn-imprimir").text("Guardar e Imprimir");
  $("#name").text(dataPers[0]);
  $("#email").text(dataPers[1]);
  $("#phone").text(dataPers[2]);
  $("#aseg").text(dataPers[3]);
  $("#Private").text("Private");
  $("#dateCita").val("2023-06-11");
  $("#hrInit").val('10');
  $("#minInit").val('10');
  $("#dateFin").val("2023-06-11");
  $("#MinFin").val('10');
  $("#minutos").val('10');
  $("#controlCitas").val();
  $("#doctor").val();
  $("#estadoCita").val();
  $("#conocio").val();
  $("#precio").val("15,5");
}

function changeCheck(event) {
  if ($("#activePacient").is(':checked')) {
    ActiveChech = true;
    $('#img-hide').hide();
    $('#row-form-paciente').show();
  }
  else {
    ActiveChech = false;
    $('#row-form-paciente').hide();
    $('#img-hide').show();

  }
}
window.changeCheck = changeCheck;
