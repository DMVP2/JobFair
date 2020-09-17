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
	 * ID del usuario
	 * 
	 * @var int
	 */
	private  $id;

	/**
	 * Nickname (Nombre) de usuario
	 * 
	 * @var String
	 */
    private  $usuario;
    
    /**
	 * Estado del usuario
	 * 
	 * @var String
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
	 * @var String
	 */
    private  $rolUsuario;
    
	//---------------------
	// Métodos
	//---------------------

	/**
	 * Método para obtener el ID del usuario
	 * 
	 * @return int
	 */
    public function getId()
    {
		return $this->id;
    }
    
    /**
	 * Método para establecer el ID del usuario
	 * 
	 * @param int
	 */
    public function setId(int $pId)
    {
		$this->id = $pId;
    }
    
    /**
	 * Método para obtener nickname (Nombre) el usuario
	 * 
	 * @return String
	 */
    public function getUsuario()
    {
		return $this->usuario;
    }
    
    /**
	 * Método para establecer nickname (Nombre) el usuario
	 * 
	 * @param String
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
	 * @param Char
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
	 * @param String
	 */
    public function setPassword(String $pPassword)
    {
		$this->password = $pPassword;
    }


    /**
	 * Método para obtener el rol del usuario
	 * 
	 * @return String
	 */
    public function getRolUsuario()
    {
		return $this->rolUsuario;
    }

    /**
	 * Método para establecer el rol del usuario
	 * 
	 * @param String
	 */
    public function setRolUsuario(String $pRolUsuario)
    {
		$this->rolUsuario = $pRolUsuario;
	}
	
	/**
     * Método que genera una contraseña aleatoria para ser utilizada como la primera contraseña del usuario
     * Esta contraseña funcionara como una segunda validación puesto que verificara que el correo electronico ingresado efectivamente exista
     * 
     * @param String
     */
    public function crearPassword()
    {

        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudPass = 8;
        $longitudCadena = strlen($cadena);
        $password = "";

        for($i = 1 ; $i <= $longitudPass; $i++){

            $pos = rand(0, $longitudCadena - 1);
     
            $password .= substr($cadena, $pos, 1);
        }

        return $password;
    }
}