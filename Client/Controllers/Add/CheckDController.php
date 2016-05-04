<?php

namespace Client\Controllers\Add;

require_once __DIR__."/../../../panel/vendor/autoload.php";
require_once __DIR__."/../../Models/json.php";

use Client\Models\JSONResponse;
use CorePHP\Models\CheckDocumentos;

header('Content-Type: application/json');

class CheckDController
{
  private $_data;
  private $_message;
  private $_instance;
  private $_response;

  public function __construct($data)
  {
    $this->_data = $data;
    $this->_instance = new CheckDocumentos();
    $this->__init__();
  }

  private function __init__()
  {
    extract($this->_data);

    if(isset($id) && !empty($id) && isset($id_inf) && !empty($id_inf)){
      try {
        $param = array(
          "documento" => $id,
          "infante" => $id_inf
        );
        $this->_instance->insertItem($param);
      } catch (\Exception $e) {
        $this->_message = $e->getMessage();
      }
      if($this->_message){
        $this->_response = new JSONResponse(false,[['Error '.$this->_message]]);
      }
      else{
        $this->_response = new JSONResponse(true,[['Void']]);
      }
      echo json_encode($this->_response);
    }
  }
} 
if($_POST){
  new CheckDController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}
  