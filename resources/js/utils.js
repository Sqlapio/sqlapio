function calculateAge(e,id){
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
window.calculateAge = calculateAge;
