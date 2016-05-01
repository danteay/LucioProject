<?php

namespace Client\Details;

require_once __DIR__."/../../../panel/vendor/autoload.php";
include __DIR__."/../../Models/json.php";

use CorePHP\Models\Padres;
use Client\Models\JSONResponse;
use CorePHP\Core\SessionUtils;
use CorePHP\Models\Infantes;

header('Content-Type: application/json');

class PadresController
{
  private $_data = null;
  private $_session = null;
  private $_idPadre = null; 
  private $_reemplazo = null;
  public $response = array();
  private $_instance = null;
  private $_instanceInfantes = null;

  public function __construct($data)
  {
    $this->_data = $data;
    $this->_session = new SessionUtils();
    $this->_idPadre = $_SESSION['padre']['id'];
    $this->_reemplazo = array(
      "nombre" => "#username",
      "infantes" => "#tabla-infantes"
    );
    $this->_instance = new Padres();
    $this->_instanceInfantes = new Infantes();
    $this->__init__();
  }

  private function __init__()
  {

    extract($this->_data);
    
    if(isset($type)){

      $temp_response = array();

      if($type != 0){

      } else {
        foreach ($this->_reemplazo as $clave => $id) {
          $temp_response = null;
          $temp_response[] = "query";
          $temp_response[] = [$id];
          $temp_response[] = [$this->codegen($clave)];
          $this->response[] = $temp_response;
        }
      }
      $JSON_response = new JSONResponse(true,$this->response);
      echo json_encode($JSON_response);
    }
  }
  private function codegen($key)
  {
    $code = null;
    switch ($key) {
      case "nombre":
        $this->_instance->getItem($this->_idPadre);
        $code = $this->_instance->nombre;
        break;
      case "infantes":
        $infantes = $this->_instanceInfantes->getAllItemsByTutor($this->_idPadre);
        while($inf = $infantes->fetch_object()){
          $code .= "<tr>";
          $code .= "<td>".$inf->nombre."</td>";
          $code .= "<td>".$inf->paterno."</td>";
          $code .= "<td>".$inf->materno."</td>";
          $code .= "<td>".$inf->idInfante."</td>";
          $code .= "<td><a href='/LucioProject/Client/Views/Infante/!".$inf->hashcode."'>/LucioProject/Client/Views/Infante/!".$inf->hashcode."</td>";
          $code .= "</tr>";
        }
        break;
      default:
        $code = "error";
        break;
    }
    return $code;
  }
}
if($_POST){
  new PadresController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}