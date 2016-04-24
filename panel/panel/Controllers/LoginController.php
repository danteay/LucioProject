<?php
/**
 * Created by PhpStorm.
 * User: eduardoay
 * Date: 23/04/16
 * Time: 03:34 PM
 */

namespace Controllers;

require_once __DIR__."/../vendor/autoload.php";

use CorePHP\Core\MailUtils;
use CorePHP\Core\SessionUtils;
use CorePHP\Models\Administradores;

class LoginController
{

    public static function login($data)
    {
        $message = "";
        $error = false;

        if(!empty($data)){
            if(isset($data['correo']) && !empty($data['correo']) && isset($data['passwd']) && !empty($data['passwd'])){
                $mailobj = new MailUtils();
                if($mailobj->validarMail($data['correo'])){
                    $adminobj = new Administradores();
                    
                    try{
                        if($adminobj->getItemByUser($data['correo'])){
                            if($adminobj->passwd == $data['passwd']){
                                $sess = new SessionUtils();

                                $sess->admin = array(
                                    "id" => $adminobj->idAdministrador,
                                    "correo" => $adminobj->correo
                                );
                            }else{
                                $error = true;
                                $message = "Las contraseñas no coinciden";
                            }
                        }else{
                            $error = true;
                            $message = "El usuario no existe o es incorrecto";
                        }
                    }catch( \Exception $e){
                        $error = true;
                        $message = $e->getMessage();
                    }
                }else{
                    $error = true;
                    $message = "No se proporciono un correo valido";
                }
            }else{
                $error = true;
                $message = "LA informacion es incorrecta.";
            }
        }else{
            $error = true;
            $message = "No es posible leer la informacion del formulario";
        }

        if($error){
            header("Location: ../index.php?error=".$message);
        }else{
            header("Location: ../Views/");
        }
    }


    public static function loguot()
    {
        new SessionUtils();
        $_SESSION['admin'] = null;
    }
}

if($_POST){
    LoginController::login($_POST);
}else if($_GET && isset($_GET['logout'])){
    LoginController::loguot();
}else{
    $message = "Metodo no soportado";
    header("Location: ../index.php?error=".$message);
}