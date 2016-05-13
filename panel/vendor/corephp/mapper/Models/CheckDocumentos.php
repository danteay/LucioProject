<?php

namespace CorePHP\Models;

use CorePHP\Core\Libraries\ModelDefinition;

use CorePHP\Core\Conexion;
use CorePHP\Libraries\QueryMap;

class CheckDocumentos extends ModelDefinition {

    public $idCheckDocumento;
	public $documento;
	public $infante;

    public function __construct(&$conx = null)
    {
        $this->idCheckDocumento = null;
		$this->documento = null;
		$this->infante = null;

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
        $this->query->CheckDocumentosQuery();
    }

    public function getItem($id)
    {
        $query = $this->query->queryList['CheckDocumentos']['getItem'];
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
        $query = $this->query->queryList['CheckDocumentos']['getAllItems'];

        $this->conx->initializeQuery($query);
        try{
            $result = $this->conx->getRequest();
            return $result;
        }catch(\Exception $e){
            throw new \Exception($e);
        }
    }

    public function getAllItemsByInfante($id)
    {
        $query = $this->query->queryList['CheckDocumentos']['getAllItemsByInfante'];
        $insert = array(
            "[[id]]" => $id
        );

        $this->conx->initializeQuery($query,$insert);
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

        if(isset($documento) && is_numeric($documento) && isset($infante) && is_numeric($infante)){
            $query = $this->query->queryList['CheckDocumentos']['insertItem'];
            $insert = array(
                "[[documento]]" => $documento,
				"[[infante]]" => $infante
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
        $query = $this->query->queryList['CheckDocumentos']['updateItem'];
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
        $query = $this->query->queryList['CheckDocumentos']['deleteItem'];
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
        $query = $this->query->queryList['CheckDocumentos']['getLastItem'];

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
