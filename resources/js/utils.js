$('.mask-input').mask('000,00', { reverse: true });
$('.mask-input-price').mask('000.00', { reverse: true });
$('.mask-input-two').mask('000', { reverse: true });
$('.mask-input-height').mask('000,00 Mts', { reverse: true });
$('.mask-input-strain').mask('000 / 000', { reverse: true });
$('.mask-input-por').mask('000%', { reverse: true });
$('.mask-only-number').mask('#', { reverse: true });
$('.mask-only-breaths').mask('000/Min', { reverse: true });
$('.mask-only-temperature').mask('00,00°', { reverse: true });
$('.phone').mask('(000) 000-00-00');
$('.mask-only-text').mask('Z', { translation: { 'Z': { pattern: /[a-zA-Z0-9-,. ]/, recursive: true } } });
$('.mask-text').mask('Z', { translation: { 'Z': { pattern: /[áéíóúñüàèa-ñzA-Z\s]/, recursive: true } } });
$('.mask-rif').mask('Z-0000000000000000', { translation: { 'Z': { pattern: /[G-J-C-F]/, recursive: true } } });
$('.mask-id-dom').mask('000-0000000-0');
$('.mask-alfa-numeric').mask('Z', { translation: { 'Z': { pattern: /[a-zA-Z0-9- ]/, recursive: true } } });
$('.alpha-no-spaces').mask("A", {
  translation: {
    "A": { pattern: /[a-z0-9@\-_.+]/, recursive: true }
  }
});

$("#datepicker").datepicker({
  language: 'es',
});

$("textarea").each(function () {
    if(!this.value){
        this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    }
  }).on("input", function () {
    this.style.height = 0;
    this.style.height = (this.scrollHeight) + "px";
  });

$(document).ready(() => {
  // selec dos
  $(".select_dos").select2({
    matcher: matchCustom
  });
  ////end
  new DataTable('.table', {
    language: {
        url: url,
    },
    reponsive: true,
    "searching": true,
    "bLengthChange": false,
    "bDestroy": true,
    "ordering": false,
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
  if (Number(edad) >= 18) {
    $(`#is_minor`).val(false);

  } else {
    $(`#is_minor`).val(true)

  }

  return edad;
}

function matchCustom(params, data) {
  // If there are no search terms, return all of the data
  if ($.trim(params.term) === '') {
    return data;
  }

  // Do not display the item if there is no 'text' property
  if (typeof data.text === 'undefined') {
    return null;
  }

  // `params.term` should be the term that is used for searching
  // `data.text` is the text that is displayed for the data object
  if (data.text.indexOf(params.term) > -1) {
    var modifiedData = $.extend({}, data, true);
    modifiedData.text += ' (matched)';

    // You can return modified objects from here
    // This includes matching the `children` how you want in nested data sets
    return modifiedData;
  }

  // Return `null` if the term should not be displayed
  return null;
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

async function triggerExample(token) {
  let link = `${token}`;
  try {
    await navigator.clipboard.writeText(link);
    $("#icon-copy").css("background", "#04AA6D");

    $("#copied").text('Enlace copiado!');

    setTimeout(function () {
      $('#copied').hide();
    }, 2000);

  } catch (err) {
    console.error('Failed to copy: ', err);
    $("#copied").text('Error al copiar enlace!');
  }
}
window.triggerExample = triggerExample;
window.get_data = get_data;
window.calculateAge = calculateAge;
window.matchCustom = matchCustom;

