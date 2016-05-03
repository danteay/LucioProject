<?php

namespace Controllers\Add;

use CorePHP\Models\Cursos;
use CorePHP\Models\JuegosCurso;
use Utils\Validations;

require_once __DIR__."/../../vendor/autoload.php";


class JuegosCursoController
{
    private $data;

    public function __construct($data)
    {
        $fields = [
            "curso",
            "path",
            "titulo"
        ];
        $this->data = $data;
        $val = Validations::validatePost($fields,$data);

        if($val[0]){
            $this->__init__();
        }else{
            header("Location: ../../Report/Cursos.php?error={$val[1]}");
        }
    }

    private function __init__()
    {
        try{
            $instance = new JuegosCurso();
            $curso = new Cursos($instance->conx);

            if($curso->getItem($this->data['curso'])){
                $instance->insertItem($this->data);
                header("Location: ../../Views/Details/Cursos.php?id={$curso->idCurso}");
            }else{
                $error = "No se pudo ligar este elemento";
                header("Location: ../../Views/Report/Cursos.php?error={$error}");
            }
        }catch(\Exception $e){
            header("Location: ../../Views/Report/Cursos.php?error={$e->getMessage()}");
        }
    }
}

if($_POST){
    new JuegosCursoController($_POST);
}