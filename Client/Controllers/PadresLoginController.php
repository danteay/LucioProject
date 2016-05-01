<?php

namespace Client\Controllers;

require_once __DIR__."/../../panel/vendor/autoload.php";
include __DIR__."/../Models/json.php";
include __DIR__."/Details/PadresController.php";

use CorePHP\Core\MailUtils;
use CorePHP\Models\Padres;
use Client\Models\JSONResponse;
use CorePHP\Core\SessionUtils;
use Client\Details\PadresController;

header('Content-Type: application/json');

class PadresLoginController
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
        $sess = new SessionUtils();
        $sess->padre = array(
          "id" => $this->_instance->idPadre,
          "correo" => $this->_instance->correo
        );
        $this->_response = new JSONResponse(true, [['sesion',md5($_SESSION["padre"]["id"])],['login', 'Views/Tutor']]);
      } else {
        $this->_response = new JSONResponse(false, [['Error '.$this->_message]]);
      }
    } catch (\Exception $e) {
      $this->_message = $e->getMessage();
    }
    echo json_encode($this->_response);
  }
  private function validate()
  {    
    extract($this->_data);
    
    if(isset($correo) && !empty($correo) && isset($passwd) && !empty($passwd)){
      if($this->_instance->getItemByUser($correo)){
        if ($this->_instance->passwd == $passwd) {          
          return true;
        }
        else{
          $this->_message = "Contraseña Incorrecta";
        }
      }else{
        $this->_message = "Correo no registrado";
      }
    }else{
        $this->_message = "Verifica los campos";
    }
    return false;
  }
}
if($_POST){
  new PadresLoginController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}