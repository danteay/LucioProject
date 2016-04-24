<?php
/**
 * Created by PhpStorm.
 * User: eduardoay
 * Date: 23/04/16
 * Time: 05:27 PM
 */

namespace Controllers\Add;

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Core\MailUtils;
use CorePHP\Models\Administradores;

class AdministradoresController
{
    private $data;
    private $message;
    private $instance;

    public function __construct($data)
    {
        $this->data = $data;
        $this->message = "";
        $this->instance = new Administradores();
        $this->__init__();
    }

    private function __init__()
    {
        try{
            if($this->validate()){
                $this->instance->insertItem($this->data);
            }
        }catch(\Exception $e){
            $this->message = $e->getMessage();
        }

        if(empty($this->message)){
            header("Location: ../../Views/Report/Administradores.php");
        }else{
            header("Location: ../../Views/Add/Administradores.php?error=".$this->message);
        }
    }

    private function validate()
    {
        extract($this->data);
        
        if(isset($correo) && !empty($correo) && isset($passwd) && !empty($passwd)){
            $mailobj = new MailUtils();
            if($mailobj->validarMail($correo)){
                if(!$this->instance->getItemByUser($correo)){
                    return true;
                }else{
                    $this->message = "El usuario ya existe";
                }
            }else{
                $this->message = "El formato del correo es incorrecto";
            }
        }else{
            $this->message = "La informacion es incorrecta";
        }
        
        return false;
    }
}

if($_POST){
    new AdministradoresController($_POST);
}else{
    $message = "Metodo no soportado";
    header("Location: ../../Views/Add/Administradores.php?error=".$message);
}