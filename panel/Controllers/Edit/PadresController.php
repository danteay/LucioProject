<?php

namespace Controllers\Edit;

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Padres;
use CorePHP\Models\Infantes;
use CorePHP\Models\CheckDocumentos;
use CorePHP\Models\CheckJuegos;
use CorePHP\Models\CheckVideos;
use CorePHP\Models\InscritosCurso;

class PadresController
{
    public static function delete($id)
    {
        try{
            $instance = new Padres();
            if($instance->getItem($id)){
                self::deleteInfantes($instance);
                $instance->deleteItem($id);
                header("Location: ../../Views/Report/Padres.php");
            }else{
                throw new \Exception("No se localizo el elemento");
            }
        }catch(\Exception $e){
            echo "<pre>";
            echo $e->getMessage();
            print_r($e->getTrace());
            header("Location: ../../Views/Report/Padres.php?error={$e->getMessage()}");
        }
    }

    private static function deleteInfantes($padre)
    {
        $obj = new Infantes($padre->conx);
        $hijos = $obj->getAllItemsByTutor($padre->idPadre);

        while($fila = $hijos->fetch_object()){
            $obj->getItem($fila->idInfante);
            self::deleteChecks($obj);
            self::deleteInscritos($obj);
            $obj->deleteItem($obj->idInfante);
        }
    }

    private static function deleteChecks($hijo)
    {
        $documentos = new CheckDocumentos($hijo->conx);
        $juegos = new CheckJuegos($hijo->conx);
        $videos = new CheckVideos($hijo->Conx);

        $alldocs = $documentos->getAllItemsByInfante($hijo->idInfante);
        $allgame = $juegos->getAllItemsByInfante($hijo->idInfante);
        $allvide = $videos->getAllItemsByInfante($hijo->idInfante);

        while($fila = $alldocs->fetch_object()){
            $documentos->deleteItem($fila->idCheckDocumento);
        }
        while($fila = $allgame->fetch_object()){
            $juegos->deleteItem($fila->idCheckJuego);
        }
        while($fila = $allvide->fetch_object()){
            $videos->deleteItem($fila->idCheckVideos);
        }
    }

    private static function deleteInscritos($hijo)
    {
        $cursos = new InscritosCurso($hijo->conx);
        $all = $cursos->getAllItemsByInfante($hijo->idInfante);

        while($fila = $all->fetch_object()){
            $cursos->deleteItem($fila->idInscritoCurso);
        }
    }
}

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    PadresController::delete($_GET['id']);
}