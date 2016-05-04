<?php

namespace Client\Details;

require_once __DIR__."/../../../panel/vendor/autoload.php";
require_once __DIR__."/../../Models/json.php";

use Client\Models\JSONResponse;
use CorePHP\Models\Infantes;
use CorePHP\Models\Cursos;
use CorePHP\Models\DocumentosCurso;
use CorePHP\Models\VideosCurso;
use CorePHP\Models\JuegosCurso;

header('Content-Type: application/json');

class InfantesTutorController
{
  private $_data = null;
  private $_reemplazo = null;
  public $response = array();
  private $_curso = null;
  private $_instanceInfantes = null;
  private $_instanceCursos = null;
  private $_instanceDoc = null;
  private $_instanceVideos = null;
  private $_instanceJuegos = null;
  private $_idInfante = null;

  public function __construct($data)
  {
    $this->_data = $data;
    $this->_reemplazo = array(
      "#nombre" => "#username",
      "cursos" => "#lista-cursos",
      "#tab-li-documentos" => "#test1 ul",
      "#tab-li-videos" => "#test2 ul",
      "#tab-li-juegos" => "#test3 ul"
    );
    $this->_instanceInfantes = new Infantes();
    $this->_instanceCursos = new Cursos();
    $this->_instanceDoc = new DocumentosCurso;
    $this->_instanceVideos = new VideosCurso;
    $this->_instanceJuegos = new JuegosCurso;
    $this->__init__();
  }

  private function __init__()
  {
    extract($this->_data);
    if(isset($type)){
      if($type != ""){
        if($curso != 0){
          $this->_curso = $curso;
          $temp_response = null;
          if($contenido = $this->codegen($type)){
            $temp_response[] = "query";
            $temp_response[] = $this->_reemplazo[$type];
            $temp_response[] = $contenido;
          } else {
            $temp_response[] = "mensaje";
            $temp_response[] = "Busqueda incorrecta verifique parametros";
          }
          $this->response[] = $temp_response;
        } else {
          $this->response[] = ['query',$this->_reemplazo[$type],"<h5 class='center-align'>Selecciona un curso de la izquierda</h5>"];
        }
      } 
    } else if(isset($id) && !empty(id)){
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
      } else {
        $this->response = [['login','../../404.html']];
      }    
    } else {
      $this->response = [['login','LucioProject/Client/404.html']];
    }
    $JSON_response = new JSONResponse(true,$this->response);
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
      $this->response[] = ["query","#clave","<input id='aidi' type='hidden' value='".$this->_idInfante."'>"];
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
            $code .= "<a id='curso-coll' val='".$inf->idCurso."' class='collection-item' onclick='ValidaCursos(this)'>".$inf->titulo."</a>";
          }
        } else{
          $code = "<a class='collection-item dismissable cont-inline mid'>No tienes cursos <i class='material-icons'>sentiment_dissatisfied</i></a>";
        }
        break;

      case "#tab-li-documentos":
        $lista = $this->_instanceDoc->getAllItemsByCurso($this->_curso);
        if($lista->num_rows){
          while($inf = $lista->fetch_object()){
            $code .= " <li>
               <a class='collection-item avatar waves-effect waves-purple oculto' href='../../../panel/Repo/Documents/".$inf->documento."' download id='".$inf->idDocumentoCurso."' onclick='CheckDoc(this)' var=''>
                 <i class='material-icons circle indigo darken-4'>description</i>
                 <span class='title'>".$inf->titulo."</span>        
               <a>
             </li>";
          }
        } else{
          $code = "<li><h5 class='center-align'>Por el momento este curso no tiene documentos <i class='material-icons'>sentiment_dissatisfied</i></h5></li>";
        }
        break;

      case "#tab-li-videos":
        $lista = $this->_instanceVideos->getAllItemsByCurso($this->_curso);
        if($lista->num_rows){
          while($inf = $lista->fetch_object()){
            $code .= " <li>
               <a class='collection-item avatar waves-effect waves-purple' id='".$inf->idVideoCurso."' onclick='CheckVideo(this)' var=''>
                 <i class='material-icons circle indigo darken-4'>movie</i>
                 <span class='title'>".$inf->titulo."</span>".$inf->frame."    
               <a>
             </li>";
          }
        } else{
          $code = "<li><h5 class='center-align'>Por el momento este curso no tiene videos <i class='material-icons'>sentiment_dissatisfied</i></h5></li>";
        }
        break;

      case "#tab-li-juegos":
        $lista = $this->_instanceJuegos->getAllItemsByCurso($this->_curso);
        if($lista->num_rows){
          while($inf = $lista->fetch_object()){
            $code .= "<li>
               <a href='../../../panel/Repo/Games/".$inf->path."' class='collection-item avatar waves-effect waves-purple' id='".$inf->idJuegoCurso."' onclick='CheckGame(this)' var=''>
                 <i class='material-icons circle indigo darken-4'>games</i>
                 <span class='title'>".$inf->titulo."</span>    
               <a>
             </li>";
          }
        } else{
          $code = "<li><h5 class='center-align'>Por el momento este curso no tiene videos <i class='material-icons'>sentiment_dissatisfied</i></h5></li>";
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