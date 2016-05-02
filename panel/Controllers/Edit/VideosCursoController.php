<?php

namespace Controllers\Edit;

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\VideosCurso;

class VideosCursoController
{
    public static function update($data)
    {
        $fields = [
            "id",
            "frame",
            "titulo"
        ];

        $val = self::validatePost($fields, $data);

        if($val[0]){
            $update = [
                "frame" => $data['frame'],
                "titulo" => $data['titulo']
            ];

            try{
                $instance = new VideosCurso();
                $instance->getItem($data['id']);
                $instance->updateItem($data['id'],$update);

                header("Location: ../../Views/Details/Cursos.php?id={$instance->curso}");
            }catch (\Exception $e){
                header("Location: ../../Views/Edit/VideosCurso.php?id={$data['id']}&error=ss{$e->getMessage()}");
            }
        }else{
            $err = null;
            foreach ($val[1] as $texterr){
                $err = empty($err) ? $texterr : $err." ".$texterr;
            }

            header("Location: ../../Views/Edit/VideosCurso.php?id={$data['id']}&error=ss{$err}");
        }
    }

    public static function delete($id)
    {
        try{
            $instance = new VideosCurso();
            if($instance->getItem($id)){
                $instance->deleteItem($id);
                header("Location: ../../Views/Details/Cursos.php?id={$instance->curso}");
            }else{
                $error = "No se localizo el elemento";
                header("Location: ../../Views/Report/Cursos.php?error=$error");
            }

        }catch (\Exception $e){
            header("Location: ../../Views/Report/Cursos.php?error={$e->getMessage()}");
        }
    }

    private static function validatePost(array $fields, array $data)
    {
        $error = array();
        foreach ($fields as $field) {
            if(array_key_exists($field,$data)) {
                if (empty($data[$field])) {
                    $error[] = "El campo ".$field." esta vacio.";
                }
            }else{
                $error[] = "El campo ".$field." no existe.";
            }
        }

        return sizeof($error) ? [false,$error] : [true,null];
    }
}

if($_POST){
    VideosCursoController::update($_POST);
}else if(isset($_GET['id']) && is_numeric($_GET['id'])){
    VideosCursoController::delete($_GET['id']);
}