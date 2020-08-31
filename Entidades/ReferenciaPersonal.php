<?php

/**
 * Clase que representa la clase "referenciaPersonal"
 */
class referenciaPersonal
{

	//----------------------------
	// Atributos
	//----------------------------

	/**
	 * Id de la referencia personal
	 * 
	 * @var Int
	 */
	private  $id;

	/**
	 * Nombre de la referencia personal
	 * 
	 * @var String
	 */
    private  $nombre;
    
   /**
	 * Telefono de la referencia personal
	 * 
	 * @var int
	 */
    private  $telefono;
    
    /**
	 * Parentesco de la referencia personal
	 * 
	 * @var String
	 */
    private  $parentesco;

    
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
	 * @param int
	 */
    public function setId(int $pId)
    {
		$this->id = $pId;
    }
    

    /**
	 * Método para obtener el nombre de la vacante
	 * 
	 * @return String
	 */
    public function getNombre()
    {
		return $this->nombre;
    }
    
    /**
	 * Método para establecer el Nombre de la vacante
	 * 
	 * @param String
	 */
    public function setNombre(String $pNombre)
    {
		$this->nombre = $pNombre;
    }


    /**
	 * Método para obtener el telefono de la referencia personal
	 * 
	 * @return String
	 */
    public function getTelefono()
    {
		return $this->descripcion;
    }
    
    /**
	 * Método para establecer el telefono de la referencia personal
	 * 
	 * @param int
	 */
    public function setTelefono(int $pTelefono)
    {
		$this->telefono = $pTelefono;
    }

    /**
	 * Método para obtener el parentesco de la referencia personal
	 * 
	 * @return String
	 */
    public function getParentesco()
    {
		return $this->parentesco;
    }
    
    /**
	 * Método para establecer el parentesco de la referencia personal
	 * 
	 * @param String
	 */
    public function setParentesco(String $pParentesco)
    {
		$this->parentesco = $pParentesco;
    }
   
   

}

?>
