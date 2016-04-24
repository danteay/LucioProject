<?php
/**
 * Created by PhpStorm.
 * User: eduardoay
 * Date: 23/04/16
 * Time: 08:19 PM
 */

namespace Controllers\Edit;

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Cursos;

class CursosController
{
    public static function update($data)
    {
        extract($data);
        $message = null;

        if(isset($id) && is_numeric($id) && isset($titulo) && !empty($titulo) && isset($descripcion) && !empty($descripcion) && isset($temario) && !empty($temario)){
            $edit = array(
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "temario" => $temario
            );

            try{
                $instance = new Cursos();
                $instance->updateItem($id,$edit);
            }catch(\Exception $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "La informacion es incorrecta";
        }


        if(empty($message)){
            header("Location: ../../Views/Report/Cursos.php");
        }else{
            header("Location: ../../Views/Edit/Cursos.php?id=".$id."&error=".$message);
        }
    }


    public static function delete($id)
    {
        $message = null;
        if(is_numeric($id)){
            $instance = new Cursos();
            try{
                $instance->deleteItem($id);
            }catch(\Exception $e){
                $message = $e->getMessage();
            }
        }else{
            $message = "La informacion es incorrecta";
        }

        if(empty($message)){
            header("Location: ../../Views/Report/Cursos.php");
        }else{
            header("Location: ../../Views/Edit/Cursos.php?id=".$id."&error=".$message);
        }
    }

}

if($_POST){
    CursosController::update($_POST);
}else if($_GET && isset($_GET['id'])){
    CursosController::delete($_GET['id']);
}else{
    $message = "Metodo no permitido";
    header("Location: ../../Views/Edit/Cursos.php?id=&error=".$message);
}