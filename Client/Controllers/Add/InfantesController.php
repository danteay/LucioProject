<?php

namespace Client\Controllers\Add;

require_once __DIR__."/../../../panel/vendor/autoload.php";
include __DIR__."/../../Models/json.php";

use CorePHP\Core\MailUtils;
use CorePHP\Models\Infantes;
use Client\Models\JSONResponse;

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
        $this->_data['hashcode'] = uniqid();
        $this->_response = new JSONResponse(true, [['mensaje',$this->_data]]);
        //$this->_instance->insertItem($this->_data);
      } else {
        $this->_response = new JSONResponse(false, [['Error',$this->_message]]);
      }
    } catch (\Exception $e) {
      $this->_message = $e->getMessage();
    }
    if(empty($this->_message)){
      $this->_response = new JSONResponse(true, [['mensaje', 'Registro Exitoso']]);
    }else{
      $this->_response = new JSONResponse(false, [['Error '.$this->_message]]);
    }
    echo json_encode($this->_response);
  }
  private function validate()
  {
    try {
      if(($this->validate_post(['nombre','paterno','materno','cursos','permiso']))[0]){
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
          $error[] = $nombre." vacio";
        }
      } else{
        $error[] = $nombre." no existe";
      }
    }
    $this->_message = implode($error);
    return sizeof($error);
  }
}
if($_POST){
  new InfantesController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}