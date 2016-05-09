<?php

namespace Client\Details;

require_once __DIR__."/../../../panel/vendor/autoload.php";
require_once __DIR__."/../../Models/json.php";

use CorePHP\Models\Padres;
use Client\Models\JSONResponse;
use CorePHP\Core\SessionUtils;
use CorePHP\Models\Infantes;
use CorePHP\Models\Cursos;

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
  private $_instanceCursos = null;

  public function __construct($data)
  {
    $this->_data = $data;
    $this->_session = new SessionUtils();
    $this->_idPadre = $_SESSION['padre']['id'];
    $this->_reemplazo = array(
      "nombre" => "#username",
      "infantes" => "#tabla-infantes",
      "#update_infantes" => "#tabla-infantes",
      "#lista_infantes" => "#combo-infantes",
      "#check_cursos" => "#opciones-cursos"
    );
    $this->_instance = new Padres();
    $this->_instanceInfantes = new Infantes();
    $this->_instanceCursos = new Cursos();
    $this->__init__();
  }

  private function __init__()
  {
    extract($this->_data);
    
    if(isset($type)){
      $temp_response = array();

      if($type != ""){
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
        if($infantes->num_rows){
          while($inf = $infantes->fetch_object()){
            $code .= "<tr>";
            $code .= "<td>".$inf->nombre."</td>";
            $code .= "<td>".$inf->paterno."</td>";
            $code .= "<td>".$inf->materno."</td>";
            if($cursosinf = $inf->cursosinf){
              $code .= "<td>".$cursosinf."</td>";
            }else{
              $code .= "<td>No se han asignado cursos</td>";
            }
            $code .= "<td><a href='/LucioProject/Client/Views/Infante/index.php?id=".$inf->hashcode."'>Ingresar</td>";
            $code .= "<td><i class='material-icons'>delete</i><td>";
            $code .= "</tr>";
          }
        } else{
          $code = "<td class='tabla-vacia' colspan='6'><h4 class='center-align'>No se encontraron elementos</h4></td>";
        }
        break;

      case '#update_infantes':
        $inf = $this->_instanceInfantes->getLastItemByTutor($this->_idPadre);
        $this->_instanceInfantes->getItemByTutor($inf);
        $code_temp = "<tr>";
        $code_temp .= "<td>".$this->_instanceInfantes->nombre."</td>";
        $code_temp .= "<td>".$this->_instanceInfantes->paterno."</td>";
        $code_temp .= "<td>".$this->_instanceInfantes->materno."</td>";
        if($cursosinf = $this->_instanceInfantes->cursosinf){
          $code_temp .= "<td>".$cursosinf."</td>";
        }else{
          $code_temp .= "<td>No se han asignado cursos</td>";
        }
        $code_temp .= "<td><a href='/LucioProject/Client/Views/Infante/!".$this->_instanceInfantes->hashcode."'>/LucioProject/Client/Views/Infante/!".$this->_instanceInfantes->hashcode."</td>";
        $code_temp .= "<td><i class='material-icons'>delete</i><td>";
        $code_temp .= "</tr>";
        if (!$this->_data['replace']){
          $code[] = $code_temp;
          $code[] = "afterbegin";
        }
        else{
          $code = $code_temp;
        }
        break;

      case "#lista_infantes":
        $infantes = $this->_instanceInfantes->getAllItemsByTutor($this->_idPadre);
        if($infantes->num_rows){
          $code = "<option value='' disabled selected>Elige una opción</option>";
          while($inf = $infantes->fetch_object()){
            $code .= "<option value='".$inf->idInfante."'>".$inf->nombre." ".$inf->paterno." ".$inf->materno."</option>";
          }
        } else{
          $code = "<option value='' disabled selected>Primero debes registrar infantes</option>";      
        }
        break;

      case "#check_cursos":
        $cursos = $this->_instanceCursos->getAllItems();
        if($cursos->num_rows){
          while($inf = $cursos->fetch_object()){
            $code .= "<div class='input-field col l6'>
            <input type='checkbox' id='chkcurso".$inf->idCurso."' value='".$inf->idCurso."'/>
            <label for='chkcurso".$inf->idCurso."' class='texto'>
            <ul>
              <li><h5>".$inf->titulo."</h5></li>
              <li><span>".$inf->descripcion."</span></li>
            </ul>
            </label>
            </div>";
          }
        } else{
          $code = "<h4 class='center-align'>Primero debes registrar cursos</h4>"  ;          
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
  new PadresController($_POST);
}else{
  $response = new JSONResponse(false, [['Error metodo no soportado']]);
  echo json_encode($response);
}
