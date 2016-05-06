function enviaIC () {
  infante = document.querySelectorAll("#combo-infantes option");
  cursos = document.querySelectorAll("[id^=chkcurso]");

  var parametros = "curso=";

  for (var i = 0; i < cursos.length; i++) {
    if(cursos[i].checked){
      parametros += cursos[i].value;
      if(prx = cursos[i + 1]){
        if(prx.checked)
          parametros += ',';
      }
    }
  }
  for (option of infante) {
    if(option.selected == true){
      parametros += "&infante=" + option.value;
    }
  }
  SolicitudAjax('../../Controllers/Add/CursosInfanteController.php','POST',parametros);
}