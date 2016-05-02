var routeoFalse = new Map();
  routeoFalse.set("/LucioProject/Client/Views/Tutor/","/LucioProject/Client/");
var routeoTrue = new Map();
  routeoTrue.set("/LucioProject/Client/","/LucioProject/Client/Views/Tutor/");

function CheckSession () {
  return sessionStorage.getItem("idSession");
}

window.onload = function(){
  if (CheckSession()){
    if((ruta = routeoTrue.get(window.location.pathname.toString())) != undefined){
      window.location = ruta;
    }
  }  
  else{
    if((ruta = routeoFalse.get(window.location.pathname.toString())) != undefined){
      window.location = ruta;
    }
  }
}