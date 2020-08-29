<?php

/**
 * Clase que representa la clase "Usuario"
 */
class Usuario
{

	//----------------------------
	// Atributos
	//----------------------------

	/**
	 * Id del usuario
	 * 
	 * @var Int
	 */
	private  $Id;

	/**
	 * Usuario
	 * 
	 * @var String
	 */
    private  $usuario;
    
    /**
	 * Estado del usuario
	 * 
	 * @var Char
	 */
    private  $estado;
    
    /**
	 * Contraseña del usuario
	 * 
	 * @var String
	 */
	private  $password;

    /**
	 * Rol del usuario
	 * 
	 * @var Int
	 */
    private  $rolUsuario;
    

    //---------------------
	// Constructor
    //---------------------
	
	/**
    * Método constructor de la clase Usuario
    */
    public function __construct()
    {

    }
    
	//---------------------
	// Métodos
	//---------------------

	/**
	 * Método para obtener el Id del usuario
	 * 
	 * @return int
	 */
    public function getId()
    {
		return $this->id;
    }
    
    /**
	 * Método para establecer el Id del usuario
	 * 
	 * @return int
	 */
    public function setId(int $pId)
    {
		$this->nit = $pId;
    }
    
    /**
	 * Método para obtener el usuario
	 * 
	 * @return String
	 */
    public function getUsuario()
    {
		return $this->usuario;
    }
    
    /**
	 * Método para establecer el usuario
	 * 
	 * @return String
	 */
    public function setUsuario(String $pUsuario)
    {
		$this->usuario = $pUsuario;
    }

    /**
	 * Método para obtener el estado del usuario
	 * 
	 * @return Char
	 */
    public function getEstado()
    {
		return $this->estado;
    }
    
    /**
	 * Método para establecer el estado del usuario
	 * 
	 * @return Char
	 */
    public function setEstado(String $pEstado)
    {
		$this->estado = $pEstado;
	}
	
	/**
	 * Método para obtener la contraseña del usuario
	 * 
	 * @return String
	 */
    public function getPassword()
    {
		return $this->password;
    }
    
    /**
	 * Método para establecer la contraseña del usuario
	 * 
	 * @return String
	 */
    public function setPassword(String $pPassword)
    {
		$this->password = $pPassword;
    }


    /**
	 * Método para obtener el rol del usuario
	 * 
	 * @return int
	 */
    public function getRolUsuario()
    {
		return $this->rolUsuario;
    }

    /**
	 * Método para establecer el rol del usuario
	 * 
	 * @return int
	 */
    public function setRolUsuario(int $pRolUsuario)
    {
		$this->rolUsuario = $pRolUsuario;
    }
}

?>