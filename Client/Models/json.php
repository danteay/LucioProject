<?php

namespace Client\Models;
/**
 * Respuesta JSON estándar
 */
class JSONResponse
{
	public $_estado;
	public $_mensaje;

  	public function __construct($estado, $mensaje)
  	{
  		$this->_estado = $estado;
  		$this->_mensaje = $mensaje;
  	}
}