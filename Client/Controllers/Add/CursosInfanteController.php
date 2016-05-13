<?php

namespace Client\Controllers\Add;

require_once __DIR__."/../../../panel/vendor/autoload.php";
require_once __DIR__."/../../Models/json.php";


use Client\Models\JSONResponse;
use CorePHP\Core\SessionUtils;
use CorePHP\Models\InscritosCurso;

header('Content-Type: application/json');

class CursosInfanteController
{
  private $_data = null;
  private $_session = null;
  private $_instance =  null;
  private $_message = null; 

  public function __construct($data)
  {
    $this->_data = $data;
    $this->_instance = new InscritosCurso();
    $this->_message = "";
    $this->__init__();
  }

  private function __init__(){
    if($this->validate()){

      extract($this->_data);

      $CursosId = explode(",", $curso);
      foreach ($CursosId as $value) {
        $insert = array(
          "curso" => $value,
          "infante" => $infante
        );
        try {
          $this->_instance->insertItem($insert);
        } catch (\Exception $e) {
          $this->_message = $e->getMessage();
        }
      }
      if(empty($this->_message)){
        $this->_response = new JSONResponse(true,[['mensaje', 'Asignación exitosa']]);
      }
      else {
        $this->_response = new JSONResponse(false,[['Error '.$this->_message]]);
      }
    }
    else {
      $this->_response = new JSONResponse(true,[['mensaje', $this->_message]]);
    }
    echo json_encode($this->_response);
  }

  private function validate(){
    if($this->validate_post(['curso','infante'])){
      return true;
    }
    else {
      return false;
    }
  }

  private function validate_post($nombres)
  {
    $error = array();
    foreach ($nombres as $nombre) {
      if(array_key_exists($nombre,$_POST)){
        if (empty($_POST[$nombre])) {
          $error[] = "falta ".$nombre;
        }
      } else{
        $error[] = $nombre." no existe";
      }
    }
    $this->_message = implode($error," ");
    return !sizeof($error);
  }
}
if($_POST){
  new CursosInfanteController($_POST);
} else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}