<?php

namespace Controllers\Add;

require_once __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Cursos;

class CursosController
{
    public $data;
    public $instance;

    public function __construct($data)
    {
        $this->data = $data;
        $this->instance = new Cursos();
        $this->__init__();
    }

    private function __init__()
    {
        extract($this->data);
        $message = null;

        if(isset($titulo) && !empty($titulo) && isset($descripcion) && !empty($descripcion) && isset($temario) && !empty($temario)){
            try{
                $this->instance->insertItem($this->data);
            }catch(\Exception $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "LA infomarcion es incorrecta";
        }

        if(empty($message)){
            header("Location: ../../Views/Report/Cursos.php");
        }else{
            header("Location: ../../Views/Add/Cursos.php?error=".$message);
        }
    }
}

if($_POST){
    new CursosController($_POST);
}else{
    $message = "Metodo no soportado";
    header("Location: ../../Views/Add/Cursos.php?error=".$message);
}