<?php
/**
 * Created by PhpStorm.
 * User: eduardoay
 * Date: 1/05/16
 * Time: 01:47 AM
 */

namespace Utils;


class Validations
{
    public static function validatePost(array $fields, array $data)
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