<?php
/**
 * Created by PhpStorm.
 * User: eduardoay
 * Date: 23/04/16
 * Time: 08:19 PM
 */

namespace Controllers\Edit;

require_once __DIR__."/../../vendor/autoload.php";

use CorePHP\Models\Administradores;

class AdministradoresController
{
    private $message; 

    public function edit($data)
    {
        extract($data);

        if(isset($correo) && !empty($correo) && isset($passwd) && !empty($passwd) && isset($id) && is_numeric($id)){
            
        }else{
            $this->message = "La informacion es incorrecta";
        }
    }

}