<?php

namespace Controllers\Add;

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Cursos;
use CorePHP\Models\VideosCurso;

class VideosCursoController
{
    private $data;
    private $instance;
    private $curso;

    public function __construct($data)
    {
        $this->data = $data;
        $this->instance = new VideosCurso();
        $this->curso = new Cursos($this->instance->conx);
        $this->__init__();
    }

    public function __init__()
    {
        extract($this->data);
        $message = null;

        if(isset($curso) && is_numeric($curso) && isset($titulo) && !empty($titulo) && isset($frame) && !empty($frame)){
            try{
                if($this->curso->getItem($curso)){
                    $frame = str_replace('"',"",$frame);
                    $frame = str_replace("'","",$frame);
                    $this->data['frame'] = $frame;

                    $this->instance->insertItem($this->data);
                }else{
                    $message = "No fu posible localizar el curso";
                }
            }catch (\Exception $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "La informacion es incorrecta";
        }

        if(empty($message)){
            header("Location: ../../Views/Details/Cursos.php?id=".$curso);
        }else{
            header("Location: ../../Views/Add/VideosCurso.php?curso=".$curso."&error=".$message);
        }
    }
}

if($_POST){
    new VideosCursoController($_POST);
}else{
    $message = "Metodo no soportado";
    header("Location: ../../Views/Report/Cursos.php?error=".$message);
}