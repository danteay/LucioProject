<?php

namespace Controllers\Edit;

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Administradores;

class AdministradoresController
{
    public static function update($data)
    {
        extract($data);
        $message = null;

        if(isset($passwd) && !empty($passwd) && isset($id) && is_numeric($id)){
            $edit = array(
                "passwd" => $passwd
            );

            try{
                $instance = new Administradores();
                $instance->updateItem($id,$edit);
            }catch(\Exception $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "La informacion es incorrecta";
        }


        if(empty($message)){
            header("Location: ../../Views/Report/Administradores.php");
        }else{
            header("Location: ../../Views/Edit/Administradores.php?id=".$id."&error=".$message);
        }
    }


    public static function delete($id)
    {
        $message = null;
        if(is_numeric($id)){
            $instance = new Administradores();
            try{
                $instance->deleteItem($id);
            }catch(\Exception $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "La informacion es incorrecta";
        }

        if(empty($message)){
            header("Location: ../../Views/Report/Administradores.php");
        }else{
            header("Location: ../../Views/Edit/Administradores.php?id=".$id."&error=".$message);
        }
    }

}

if($_POST){
    AdministradoresController::update($_POST);
}else if($_GET && isset($_GET['id'])){
    AdministradoresController::delete($_GET['id']);
}else{
    $message = "Metodo no permitido";
    header("Location: ../../Views/Edit/Administradores.php?id=&error=".$message);
}