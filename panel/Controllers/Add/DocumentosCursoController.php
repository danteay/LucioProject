<?php
/**
 * Created by PhpStorm.
 * User: eduardoay
 * Date: 24/04/16
 * Time: 06:16 PM
 */

namespace Controllers\Add;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Cursos;
use CorePHP\Models\DocumentosCurso;
use CorePHP\Core\PasswordGenerator;

class DocumentosCursoController
{
    private $data;
    private $file;
    private $instance;
    private $curso;
    
    public function __construct($data,$file)
    {
        $this->data = $data;
        $this->file = $file;
        $this->instance = new DocumentosCurso();
        $this->curso = new Cursos($this->instance->conx);
        $this->__init__();
    }
    
    private function __init__()
    {
        extract($this->data);
        $message = null;

        echo "<pre>";
        print_r($this->file);
        print_r($this->data);

        if(isset($curso) && is_numeric($curso) && isset($titulo) && !empty($titulo) && !empty($this->file['documento']['name'])){
            try{
                if($this->curso->getItem($curso)){
                    $newname = $this->nameGenerate();

                    if(move_uploaded_file($this->file['documento']['tmp_name'], __DIR__."/../../Repo/Documents/".$newname)){
                        $insert = array(
                            "curso" => $curso,
                            "titulo" => $titulo,
                            "documento" => $newname
                        );

                        $this->instance->insertItem($insert);
                    }else{
                        $message = "Error al cargar el archivo";
                    }
                }else{
                    $message = "No se localizo el curso";
                }
            }catch(\Exception $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "La informacion es incorecta";
        }

        if(empty($message)){
            #header("Location: ../../Views/Details/Cursos.php?id=".$curso);
        }else{
            #header("Location: ../../Views/Add/DocumentosCurso.php?curso=".$curso."&error=".$message);
        }
    }

    private function nameGenerate()
    {
        $args = array(
            'lenght'				=>	10,     // Tamaño de la cadena resultante
            'alpha_upper_include'	=>	TRUE,   // Incluir letras mayusculas
            'alpha_lower_include'	=>	TRUE,	// Incluir letras minusculas
            'number_include'		=>	TRUE,   // Incluir numeros
            'symbol_include'		=>	FALSE,	// Incluir caracteres especiales
        );

        $random = new PasswordGenerator($args);
        $ext = explode(".",$this->file['documento']['name']);
        $ext = $ext[count($ext)-1];

        $newname = $random->get_password().".".$ext;

        if(file_exists("../../Repo/Documents/".$newname)){
            $this->nameGenerate();
        }else{
            return $newname;
        }
    }
}

if($_POST && !empty($_FILES['documento'])){
    new DocumentosCursoController($_POST, $_FILES);
}else{
    $message = "Metodo no soportado";
    header("Location: ../../Views/Report/Cursos.php?error".$message);
}