var tabs;
var curso = 0;
var cursos = null;
var id_inf = null;

function initInfante (argument) {
  ruta = window.location.pathname.toString();
  rutaArray = ruta.split('/');
  id = rutaArray[rutaArray.length - 1];
  if(id != ""){
    id = id.substring(1,id.length);
    SolicitudAjax('../../Controllers/Details/InfantesTutorController.php','POST','id='+id);
  }
  else{
    if((redireccion = routeoFalse.get(ruta.toString())) != undefined){
      window.location = redireccion;
    }
  }
}

function ValidaTab(tab) {
  if(tab){
    link = tab.firstElementChild;
    if(link.className.search("active") < 0){
      SolicitudAjax('../../Controllers/Details/InfantesTutorController.php','POST','type=#'+tab.id+'&curso='+curso);
    }
  }
  else{
    tabs = tabs || document.querySelectorAll("li[id^=tab-li-]");
    for (var i = tabs.length - 1; i >= 0; i--) {
      tab = tabs[i];
      link = tab.firstElementChild;
      if(link.className.search("active") >= 0){
        SolicitudAjax('../../Controllers/Details/InfantesTutorController.php','POST',"type=#"+tab.id+"&curso="+curso);
      }
    }
}

function CheckDoc (doc) {
  if(doc.getAttribute('var') == ""){
    SolicitudAjax('../../Controllers/Add/CheckDController.php','POST','id='+doc.id+"&id_inf="+id_inf.value);
    doc.setAttribute('var', 1);
  }
}

function CheckVideo (doc) {
  if(doc.getAttribute('var') == ""){
    SolicitudAjax('../../Controllers/Add/CheckVController.php','POST','id='+doc.id+"&id_inf="+id_inf.value);
    doc.setAttribute('var', 1);
  }
}


function CheckGame (doc) {
  if(doc.getAttribute('var') == ""){
    SolicitudAjax('../../Controllers/Add/CheckGController.php','POST','id='+doc.id+"&id_inf="+id_inf.value);
    doc.setAttribute('var', 1);
  }
}

function ValidaCursos(col){
  if(col){
    cursos = cursos || document.querySelectorAll("#curso-coll");
    id_inf = id_inf || document.querySelector("#aidi");
    if(col.className.search("active") < 0){
      curso = col.getAttribute('val');
      for (var i = cursos.length - 1; i >= 0; i--) {
        c = cursos[i];
        c.classList.remove('active');
      }
      col.classList.add('active');
      ValidaTab();
    }
    else {
      col.classList.remove('active');
    }
  }
}

window.onload = function(){
  ValidaTab();
  initInfante();
}
