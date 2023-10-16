$('.mask-input').mask('000,00', {reverse: true });
$('.mask-input-price').mask('000.00', {reverse: true });
$('.mask-input-two').mask('000', {reverse: true });
$('.mask-input-height').mask('000,00 CM', {reverse: true });
$('.mask-input-strain').mask('000 / 000', {reverse: true });
$('.mask-input-por').mask('000%', {reverse: true });
$('.mask-only-number').mask('#', {reverse: true });
$('.mask-only-breaths').mask('000/Min', {reverse: true });
$('.mask-only-temperature').mask('00,00°', {reverse: true });
$('.phone').mask('(0000) 000-00-00');
$('.mask-only-text').mask('Z',{translation:  {'Z': {pattern: /[a-zA-Z0-9 ]/, recursive: true}}});
$('.mask-text').mask('Z',{translation:  {'Z': {pattern: /[áéíóúñüàèa-ñzA-Z\s]/, recursive: true}}}); 
$('.mask-rif').mask('Z-0000000000000000',{translation:  {'Z': {pattern: /[G-J-C-F]/, recursive: true}}}); 
$('.mask-alfa-numeric').mask('Z',{translation:{'Z': {pattern: /[a-zA-Z0-9-]/, recursive: true}}});
$('.alpha-no-spaces').mask("A", {
  translation: {
      "A": { pattern: /[a-z0-9@\-_.+]/, recursive: true }
  }
});
$("#datepicker").datepicker({
  language: 'es',
});   
$(document).ready(() => {           
  new DataTable('.table', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
    },
    reponsive: true,
    "searching": false,
    "bLengthChange": false,
  });
});

function calculateAge(e, id) {
  var date = new Date();
  var cumpleanos = new Date(e.target.value);  
  var edad = date.getFullYear() - cumpleanos.getFullYear();
  var m = date.getMonth() - cumpleanos.getMonth();
  if (m < 0 || (m === 0 && date.getDate() < cumpleanos.getDate())) {
    edad--;
  }
  $(`#${id}`).val(edad);
  return edad;
}
async function get_data(url) {
  console.log(url);
  // ajax para refrescar la tabla s
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
      return res;
    }   
  });
}
window.get_data = get_data;
window.calculateAge = calculateAge;
