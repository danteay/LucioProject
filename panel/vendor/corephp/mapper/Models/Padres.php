<?php

namespace CorePHP\Models;

use CorePHP\Core\Libraries\AdminDefinition;
use CorePHP\Core\Libraries\ModelDefinition;

use CorePHP\Core\Conexion;
use CorePHP\Libraries\QueryMap;

class Padres extends ModelDefinition implements AdminDefinition{

    public $idPadre;
	public $nombre;
	public $paterno;
	public $materno;
	public $correo;
	public $passwd;

    public function __construct(&$conx = null)
    {
        $this->idPadre = null;
		$this->nombre = null;
		$this->paterno = null;
		$this->materno = null;
		$this->correo = null;
		$this->passwd = null;

        $this->initConexion($conx);
    }

    private function initConexion(&$conx)
    {
        if(empty($conx)){
            try{
                $this->conx = new Conexion();
            }catch(\Exception $e){
                throw new \Exception($e);
            }

        }else{
            $this->conx = $conx;
        }

        $this->query = new QueryMap();
        $this->query->PadresQuery();
    }

    public function getItem($id)
    {
        $query = $this->query->queryList['Padres']['getItem'];
        $data = array(
            "[[id]]" => $id
        );

        $this->conx->initializeQuery($query, $data);
        try{
            $result = $this->conx->getRequest();
        }catch(\Exception $e){
            throw new \Exception($e);
        }

        if($result = $result->fetch_assoc()){
            foreach($result as $key => $value){
                $this->$key = $value;
            }

            return true;
        }else{
            return false;
        }
    }
    public function getAllItems()
    {
        $query = $this->query->queryList['Padres']['getAllItems'];

        $this->conx->initializeQuery($query);
        try{
            $result = $this->conx->getRequest();
            return $result;
        }catch(\Exception $e){
            throw new \Exception($e);
        }
    }

    public function insertItem(array $data)
    {
        extract($data);

        if(isset($nombre) && !empty($nombre) && isset($paterno) && !empty($paterno) && isset($materno) && !empty($materno) && isset($correo) && !empty($correo) && isset($passwd) && !empty($passwd)){
            $query = $this->query->queryList['Padres']['insertItem'];
            $insert = array(
                "[[nombre]]" => $nombre,
				"[[paterno]]" => $paterno,
				"[[materno]]" => $materno,
				"[[correo]]" => $correo,
				"[[passwd]]" => $passwd
            );

            $this->conx->initializeQuery($query, $insert);
            try{
                $this->conx->setRequest();
            }catch(\Exception $e){
                throw new \Exception($e);
            }
        }else{
            throw new \Exception("Los datos no son validos.");
        }
    }

    public function updateItem($id, array $data)
    {
        $query = $this->query->queryList['Padres']['updateItem'];
        $replace = "";

        if(empty($data)){
            throw new \Exception("Informacion de actualizacion invalida.");
        }

        foreach($data as $key => $value){
            if($replace == ""){
                $replace .= is_numeric($value) ? "$key = $value" : "$key = '$value'";
            }else{
                $replace .= is_numeric($value) ? ", $key = $value" : ", $key = '$value'";
            }
        }

        $query = str_replace("[[data]]",$replace,$query);
        $update = array(
            "[[id]]" => $id
        );

        $this->conx->initializeQuery($query, $update);

        try{
            $this->conx->setRequest();
        }catch(\Exception $e){
            throw new \Exception($e);
        }
    }

    public function deleteItem($id)
    {
        $query = $this->query->queryList['Padres']['deleteItem'];
        $data = array(
            "[[id]]" => $id
        );

        $this->conx->initializeQuery($query, $data);

        try{
            $this->conx->setRequest();
        }catch(\Exception $e){
            throw new \Exception($e);
        }
    }

    public function getLastItem()
    {
        $query = $this->query->queryList['Padres']['getLastItem'];

        $this->conx->initializeQuery($query);

        try{
            $result = $this->conx->getRequest();
            $result = $result->fetch_object();

            return $result->last;
        }catch(\Exception $e){
            throw new \Exception($e);
        }
    }

    /**
     * @param string $user
     * @return bool
     * @throws \Exception
     * Busca un elemento basado en el usuario
     */
    public function getItemByUser($user)
    {
        $query = $this->query->queryList['Padres']['getItemByUser'];
        $data = array(
            "[[user]]" => $user
        );

        $this->conx->initializeQuery($query, $data);
        try{
            $result = $this->conx->getRequest();
        }catch(\Exception $e){
            throw new \Exception($e);
        }

        if($result = $result->fetch_assoc()){
            foreach($result as $key => $value){
                $this->$key = $value;
            }

            return true;
        }else{
            return false;
        }
    }

    /**
     * @param string $pass
     * @return bool
     * @throws \Exception
     * Busca un elemento basado en el password, debe de estar declarado como unico en la base de datos
     * de lo contrario podria generar busquedas equibocadas.
     */
    public function getItemByPassword($pass)
    {
        throw new \Exception("Method not supported");
    }
}
