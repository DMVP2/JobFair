<?php

/**
 * Clase que representa la clase "Vacante"
 */
class Vacante
{

	//----------------------------
	// Atributos
	//----------------------------

	/**
	 * Id de la vacante
	 * 
	 * @var Int
	 */
	private  $id;

	/**
	 * Nombre de la vacante
	 * 
	 * @var String
	 */
    private  $nombre;
    
   /**
	 * Descripcion de la vacante
	 * 
	 * @var String
	 */
    private  $descripcion;
    
    /**
	 * Programa academico
	 * 
	 * @var String
	 */
    private  $programa_academico;

    /**
	 * Horario de la vacante
	 * 
	 * @var String
	 */
    private  $horario_vacante;

    /**
	 * Posibilidad de viaje
	 * 
	 * @var Boolean
	 */
    private  $posibilidad_viaje;

    /**
	 * Salario de la vacante
	 * 
	 * @var Int
	 */
    private  $salario_vacante;

    /**
	 * Experiencia requerida por la vacante
	 * 
	 * @var Boolean
	 */
    private  $experiencia;

    /**
	 * Categorias de la vacante
	 * 
	 * @var Int[]
	 */
    private  $categorias;

    /**
	 * Ciudad donde se encuentra la vacante
	 * 
	 * @var String
	 */
    private  $ciudad;
    

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
	 * Método para obtener la descripcion de la vacante
	 * 
	 * @return String
	 */
    public function getDescripcion()
    {
		return $this->descripcion;
    }
    
    /**
	 * Método para establecer la descripcion de la vacante
	 * 
	 * @param int
	 */
    public function setDescripcion(String $pDescripcion)
    {
		$this->descripcion = $pDescripcion;
    }

    /**
	 * Método para obtener el programa academico de la vacante
	 * 
	 * @return String
	 */
    public function getProgramaAcademico()
    {
		return $this->programa_academico;
    }
    
    /**
	 * Método para establecer el programa academico de la vacante
	 * 
	 * @param String
	 */
    public function setProgramaAcademico(String $pProgramaAcademico)
    {
		$this->programa_academico = $pProgramaAcademico;
    }
   
    /**
	 * Método para obtener el horario de la vacante
	 * 
	 * @return String 
	 */
    public function getHorarioVacante()
    {
		return $this->horario_vacante;
    }
    
    /**
	 * Método para establecer el horario de la vacante
	 * 
	 * @param String
	 */
    public function setHorarioVacante(String $pHorarioVacante)
    {
		$this->horario_vacante = $pHorarioVacante;
    }


    /**
	 * Método para obtener la posibilidad de viaje
	 * 
	 * @return Boolean
	 */
    public function getPosibilidadViaje()
    {
		return $this->posibilidad_viaje;
    }
    
    /**
	 * Método para establecer la posibilidad de viaje
	 * 
	 * @param Boolean
	 */
    public function setPosibilidadViaje(Boolean $pPosibilidadViaje)
    {
		$this->posibilidad_viaje = $pPosibilidadViaje;
    }

    /**
	 * Método para obtener el Salario de la vacante
	 * 
	 * @return int
	 */
    public function getSalarioVacante()
    {
		return $this->salario_vacante;
    }
    
    /**
	 * Método para establecer el Salario de la vacante
	 * 
	 * @param int
	 */
    public function setSalarioVacante(Boolean $pSalarioVacante)
    {
		$this->salario_vacante = $pSalarioVacante;
    }


    /**
	 * Método para obtener la experiencia de la vacante
	 * 
	 * @return Boolean
	 */
    public function getExperiencia()
    {
		return $this->experiencia;
    }
    
    /**
	 * Método para establecer la experiencia de la vacante
	 * 
	 * @param Boolean
	 */
    public function setExperiencia(Boolean $pExperiencia)
    {
		$this->experiencia = $pExperiencia;
    }

    /**
	 * Método para obtener las categorias de la vacante
	 * 
	 * @return int[]
	 */
    public function getCategorias()
    {
		return $this->categorias;
    }
    
    /**
	 * Método para establecer las categorias de la vacante
	 * 
	 * @param int[]
	 */
    public function setId(int $pCategorias)
    {
		$this->categorias = $pCategorias;
    }


    /**
	 * Método para obtener la ciudad de la vacante
	 * 
	 * @return String
	 */
    public function getCiudad()
    {
		return $this->ciudad;
    }
    
    /**
	 * Método para establecer la ciudad de la vacante
	 * 
	 * @param String
	 */
    public function setCiudad(String $pCiudad)
    {
		$this->ciudad = $pCiudad;
    }

}

?>