var funciones = new Map();
  funciones.set("login", LoginAJAX);
  funciones.set("query", LoadAJAX);
  funciones.set("sesion", InitSession);
  funciones.set('mensaje', ShowMessage);

function ProcesaSolicitud(solicitud){
  for (argumento of solicitud) {
    let funcion = funciones.get(argumento[0]);
    if(funcion != undefined){
      funcion(argumento);
    }
    else{
      ShowMessage(argumento);
    }
  }
}
function ShowMessage (mensaje) {
  Materialize.toast(mensaje[1], 2000);
}
function LoginAJAX (ruta) {
  window.location = ruta[1];
}
function LoadAJAX (contenido) {
  contenedor = document.querySelector(contenido[1]);
  if(contenedor != undefined){
    if(contenido[3]){
      contenedor.insertAdjacentHTML(contenido[3], contenido[2]);
    }
    else{
      contenedor.innerHTML = contenido[2];
    }
  }
  else{
    console.log("Error [LoadAJAX]: Selector incorrecto");
  }
}
function InitSession(objeto){
  sessionStorage.setItem("idSession",objeto[1]);
}
function SolicitudAjax (ruta, metodo, parametros, funcion, header) {
  if(ruta && metodo && parametros){
    if (metodo == "POST" || metodo == "GET") {
      var ajax = new XMLHttpRequest();
      ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
          console.log("resultado: ", ajax.responseText);
          response = JSON.parse(ajax.responseText);
          if(response._estado){
            ProcesaSolicitud(response._mensaje);
          }
          else{
            ShowMessage(response._mensaje[0]);
          }
        }
      };
      if(header == null){
        if (metodo == 'POST'){
          header = "application/x-www-form-urlencoded";
        }
      }
      if(metodo == "GET"){
        ajax.open(metodo, ruta + "?" + parametros);
        if(header){
          ajax.setRequestHeader("Content-type", header);
        }
        ajax.send();
      }
      else{
        ajax.open(metodo, ruta);
        if(header != "void"){
          ajax.setRequestHeader("Content-type", header);
        }
        ajax.send(parametros);
      }
    }
    else {
      console.log("ERROR SAJAX: METODO DESCONOCIDO");
    }
  }
  else if(ruta == null){
    console.log("ERROR SAJAX: URL NULA");
  }
  else if(metodo == null){
    console.log("ERROR SAJAX: METODO NULO");
  }
  else{
    console.log("ERROR SAJAX: PARAMETROS NULOS");
  }
}
function ProcesaFormularioAJAX (idFormulario, tipoInput, url, metodo, funcion, header) {
  if(idFormulario && tipoInput && metodo){
    if((formulario = document.querySelector(idFormulario)) == undefined){
      console.log("ERROR PFORM: MAL SELECTOR FORMULARIO");
    }
    else{
      var seleccion = "";
      var parametros = "";
      tipoInput = tipoInput.split(",");
      if(tipoInput.length == 1 && tipoInput[0] == "normal"){
        seleccion += idFormulario + " input," + idFormulario + " select," + idFormulario + " textarea";
      }
      else{
        for (var item = 0; item < tipoInput.length; item++) {
          if(tipoInput[item] == "textarea"){
            seleccion += idFormulario + " " + "textarea";
          }
          else if(tipoInput[item] == "select"){
            seleccion += idFormulario + " " + "select";
          }
          else{
            seleccion += idFormulario + " " + "input[type=" + tipoInput[item] + "]";
          }
          if(tipoInput[item + 1]){
            seleccion += ', ';
          }
        }
      }
      if((inputs = document.querySelectorAll(seleccion)) == undefined ){
        console.log("ERROR PFORM: MALA SELECCION INPUTS");
      }
      else{
        if(header != "multipart/form-data"){
          console.log(inputs);
          for (var item = 0; item < inputs.length; item++) {
            inputIt = inputs[item];
            parametrosAnteriores = parametros;  
            if(inputIt.id != ""){
              if(inputIt.localName == "select" && inputIt.multiple){
                nameSelect = inputIt.name;
                numeroOption = 0;
                options = inputIt.childNodes;
                for (option of options) {
                  if(option.selected && option.disabled==false){
                    numeroOption++;
                    parametros += nameSelect + numeroOption + "=" + option.value;
                  }
                }
              }
              else if (inputIt.type == "radio" || inputIt.type == "checkbox") {
                if(nombreInput = inputIt.name){
                  if(inputIt.checked == true){
                    parametros += nombreInput + "=" + inputIt.value;
                  }
                  else{
                    parametros += nombreInput + "=";
                  }
                }
                else{
                  console.log("ERROR PFORM: FALTA NAME EN LOS INPUT");
                  console.log(inputIt);
                  break;
                }
              }
              else {             
                  if(nombreInput = inputIt.name){
                    parametros += nombreInput + "=" + inputIt.value;
                  }
                  else{
                    console.log("ERROR PFORM: FALTA NAME EN LOS INPUT");
                    console.log(inputIt);
                    break;
                  }
              }
              if((parametros != parametrosAnteriores) && (inputs[item + 1])){
                parametros += "&";
              }
            }            
          }
        }
        else{
          parametros = new FormData();
          header = "void";
          for (var item = 0; item < inputs.length; item++) {
            if(inputs[item].type == "file"){
              parametros.append(inputs[item].name,inputs[item].files[0]);
            }
            else{
              parametros.append(inputs[item].name,inputs[item].value);
            }
          }
        }
        console.log('anteriores ', parametrosAnteriores);
        console.log('parametros ', parametros);
        if(parametrosAnteriores != parametros){
          SolicitudAjax(url,metodo,parametros,funcion,header);
        }
        else {
          console.log("La carta!!!!")
        }
      }
    }
  }
}