<?php

namespace Client\Details;

require_once __DIR__."/../../../panel/vendor/autoload.php";
require_once __DIR__."/../../Models/json.php";

use Client\Models\JSONResponse;
use CorePHP\Models\Infantes;
use CorePHP\Models\Cursos;

header('Content-Type: application/json');

class InfantesTutorController
{
  private $_data = null;
  private $_reemplazo = null;
  public $response = array();
  private $_instanceInfantes = null;
  private $_instanceCursos = null;
  private $_idInfante = null;

  public function __construct($data)
  {
    $this->_data = $data;
    $this->_reemplazo = array(
      "#nombre" => "#username",
      "cursos" => "#lista-cursos"
    );
    $this->_instanceInfantes = new Infantes();
    $this->_instanceCursos = new Cursos();
    $this->__init__();
  }

  private function __init__()
  {
    extract($this->_data);
    
    if(isset($id) && !empty(id)){

      $temp_response = array();

      if($this->valida_ID($id)){
        foreach ($this->_reemplazo as $clave => $id) {
          if(strpos($clave,'#') === false){
            if ($contenido = $this->codegen($clave)) {
              $temp_response = null;
              $temp_response[] = "query";
              $temp_response[] = $id;
              $temp_response[] = $this->codegen($clave);
              $this->response[] = $temp_response;
            }
          }
        }
        $JSON_response = new JSONResponse(true,$this->response);
      } else {
        $JSON_response = new JSONResponse(true,[['login','../../404.html']]);
      }
      /*if($type != ""){
        $temp_response = null;
        if($contenido = $this->codegen($type)){
          $temp_response[] = "query";
          $temp_response[] = $this->_reemplazo[$type];
          $temp_response[] = $contenido;
        } else if (!strcmp($type,"update-select")) {
          $temp_response[] = "init-select";
        } else {
          $temp_response[] = "mensaje";
          $temp_response[] = "Busqueda incorrecta verifique parametros";
        }
        $this->response[] = $temp_response;
      } else {
        foreach ($this->_reemplazo as $clave => $id) {
          if(strpos($clave,'#') === false){
            $temp_response = null;
            $temp_response[] = "query";
            $temp_response[] = $id;
            $temp_response[] = $this->codegen($clave);
            $this->response[] = $temp_response;
          }
        }
      }*/    
    } else {
      $JSON_response = new JSONResponse(true,[['login','LucioProject/Client/404.html']]);
    }
    echo json_encode($JSON_response);
  }

  private function valida_ID($id){
    if($this->_instanceInfantes->getItemByHashcode($id)){
      $this->_idInfante = $this->_instanceInfantes->idInfante;
      $temp_response = null;
      $temp_response[] = "query";
      $temp_response[] = $this->_reemplazo["#nombre"];
      $temp_response[] = $this->_instanceInfantes->nombre;
      $this->response[] = $temp_response;
      return true;
    }
    return false;
  }

  private function codegen($key)
  {
    $code = null;

    switch ($key) {

      case "cursos":
        $lista = $this->_instanceCursos->getAllItemsByInfante($this->_idInfante);
        if($lista->num_rows){
          while($inf = $lista->fetch_object()){
            $code .= "<a href id='".$inf->idCurso."' class='collection-item'>".$inf->titulo."</a>";
          }
        } else{
          $code = "<a href class='collection-item'>No tienes cursos <i class='material-icons'>sentiment_dissatisfied</i></a>";
        }
        break;
        
      default:
        $code = null;
        break;
    }
    return $code;
  }
}
if($_POST){
  new InfantesTutorController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}