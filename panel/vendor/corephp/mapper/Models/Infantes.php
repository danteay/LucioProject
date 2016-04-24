<?php

namespace CorePHP\Models;

use CorePHP\Core\Libraries\ModelDefinition;

use CorePHP\Core\Conexion;
use CorePHP\Libraries\QueryMap;

class Infantes extends ModelDefinition {

    public $idInfante;
	public $nombre;
	public $paterno;
	public $materno;
	public $tutor;
	public $hashcode;

    public function __construct(&$conx = null)
    {
        $this->idInfante = null;
		$this->nombre = null;
		$this->paterno = null;
		$this->materno = null;
		$this->tutor = null;
		$this->hashcode = null;

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
        $this->query->InfantesQuery();
    }

    public function getItem($id)
    {
        $query = $this->query->queryList['Infantes']['getItem'];
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
        $query = $this->query->queryList['Infantes']['getAllItems'];

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

        if(isset($nombre) && !empty($nombre) && isset($paterno) && !empty($paterno) && isset($materno) && !empty($materno) && isset($tutor) && is_numeric($tutor) && isset($hashcode) && !empty($hashcode)){
            $query = $this->query->queryList['Infantes']['insertItem'];
            $insert = array(
                "[[nombre]]" => $nombre,
				"[[paterno]]" => $paterno,
				"[[materno]]" => $materno,
				"[[tutor]]" => $tutor,
				"[[hashcode]]" => $hashcode
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
        $query = $this->query->queryList['Infantes']['updateItem'];
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
        $query = $this->query->queryList['Infantes']['deleteItem'];
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
        $query = $this->query->queryList['Infantes']['getLastItem'];

        $this->conx->initializeQuery($query);

        try{
            $result = $this->conx->getRequest();
            $result = $result->fetch_object();

            return $result->last;
        }catch(\Exception $e){
            throw new \Exception($e);
        }
    }

}
