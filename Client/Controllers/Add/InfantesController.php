<?php

namespace Client\Controllers\Add;

require_once __DIR__."/../../../panel/vendor/autoload.php";
require_once __DIR__."/../../Models/json.php";

use CorePHP\Core\MailUtils;
use CorePHP\Models\Infantes;
use Client\Models\JSONResponse;
use CorePHP\Core\SessionUtils;

header('Content-Type: application/json');

class InfantesController
{
  private $_data;
  private $_message;
  private $_instance;
  private $_response;

  public function __construct($data)
  {
    $this->_data = $data; 
    $this->_message = "";
    $this->_instance = new Infantes();
    $this->_response = null;
    $this->__init__();
  }
  private function __init__()
  {
    try {
      if ($this->validate()) {
        $sess = new SessionUtils();
        $this->_data['hashcode'] = uniqid();
        $this->_data['tutor'] = $_SESSION["padre"]["id"];
        $this->_instance->insertItem($this->_data);
        $this->_response = new JSONResponse(true, [['mensaje', 'Registro Exitoso'],['update_infantes','.tabla-vacia']]);
      }
    } catch (\Exception $e) {
      $this->_message = $e->getMessage();
    }
    echo json_encode($this->_response);
  }
  private function validate()
  {
    try {
      if($this->validate_post(['nombre','paterno','materno','permiso'])){
        return true;
      }
      else{
        $this->_response = new JSONResponse(true, [['mensaje', 'Verifica los campos']]);
      }
    } catch (\Exception $e) {
      $this->_message = $e->getMessage();
    }
    return false;
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
  new InfantesController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}