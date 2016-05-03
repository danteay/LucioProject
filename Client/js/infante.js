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

window.onload = function(){
  initInfante();
}
