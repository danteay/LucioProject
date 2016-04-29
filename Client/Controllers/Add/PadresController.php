<?php

namespace Client\Controllers\Add;

require_once __DIR__."/../../../panel/vendor/autoload.php";
include __DIR__."/../../Models/json.php";

use CorePHP\Core\MailUtils;
use CorePHP\Models\Padres;
use Client\Models\JSONResponse;
use CorePHP\Core\SessionUtils;

header('Content-Type: application/json');

class PadresController
{
  private $_data;
  private $_message;
  private $_instance;
  private $_response;

  public function __construct($data)
  {
    $this->_data = $data; 
    $this->_message = "";
    $this->_instance = new Padres();
    $this->_response = null;
    $this->__init__();
  }
  private function __init__()
  {
    try {
      if ($this->validate()) {
        $this->_instance->insertItem($this->_data);
      } else {
        $this->_response = new JSONResponse(false, [['error',$this->_message]]);
      }
    } catch (\Exception $e) {
      $this->_message = $e->getMessage();
    }
    if(empty($this->_message)){
      $sess = new SessionUtils();
      $sess->padre = array(
        "id" => md5($this->_instance->idPadre),
        "correo" => $this->_instance->correo
      );
      $this->_response = new JSONResponse(true, [['sesion',$_SESSION["padre"]["id"]],['login', 'Views/Tutor']]);
    }else{
      $this->_response = new JSONResponse(false, [['Error '.$this->_message]]);
    }
    echo json_encode($this->_response);
  }
  private function validate()
  {
    extract($this->_data);
    
    if(isset($correo) && !empty($correo) && isset($passwd) && !empty($passwd)){
      $mailobj = new MailUtils();
      if($mailobj->validarMail($correo)){
          if(!$this->_instance->getItemByUser($correo)){
              return true;
          }else{
              $this->_message = "El usuario ya existe";
          }
      }else{
          $this->_message = "El formato del correo es incorrecto";
      }
    }else{
        $this->_message = "Verifica los campos";
    }
    
    return false;
  }
}
if($_POST){
  new PadresController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}