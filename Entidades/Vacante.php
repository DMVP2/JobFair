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
	 * ID de la vacante
	 * 
	 * @var int
	 */
	private  $id;

	/**
	 * Nombre de la vacante
	 * 
	 * @var String
	 */
    private  $nombre;
    
   /**
	 * Descripción de la vacante
	 * 
	 * @var String
	 */
    private  $descripcion;
    
    /**
	 * Programa acadámico de la vacante
	 * 
	 * @var String
	 */
    private  $programaAcademico;

    /**
	 * Horario de la vacante
	 * 
	 * @var String
	 */
    private  $horarioVacante;

    /**
	 * Posibilidad de viaje
	 * 
	 * @var String
	 */
    private  $posibilidadViaje;

    /**
	 * Salario de la vacante
	 * 
	 * @var String
	 */
    private  $salarioVacante;

    /**
	 * Experiencia requerida por la vacante
	 * 
	 * @var String
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
	 * Método para obtener el nombre de la vacante
	 * 
	 * @return String
	 */
    public function getNombre()
    {
		return $this->nombre;
    }
    
    /**
	 * Método para establecer el nombre de la vacante
	 * 
	 * @param String
	 */
    public function setNombre(String $pNombre)
    {
		$this->nombre = $pNombre;
    }


    /**
	 * Método para obtener la descripción de la vacante
	 * 
	 * @return String
	 */
    public function getDescripcion()
    {
		return $this->descripcion;
    }
    
    /**
	 * Método para establecer la descripción de la vacante
	 * 
	 * @param int
	 */
    public function setDescripcion(String $pDescripcion)
    {
		$this->descripcion = $pDescripcion;
    }

    /**
	 * Método para obtener el programa académico de la vacante
	 * 
	 * @return String
	 */
    public function getProgramaAcademico()
    {
		return $this->programa_academico;
    }
    
    /**
	 * Método para establecer el programa académico de la vacante
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
	 * @return String
	 */
    public function getPosibilidadViaje()
    {
		return $this->posibilidadViaje;
    }
    
    /**
	 * Método para establecer la posibilidad de viaje
	 * 
	 * @param String
	 */
    public function setPosibilidadViaje(String $pPosibilidadViaje)
    {
		$this->posibilidadViaje = $pPosibilidadViaje;
    }

    /**
	 * Método para obtener el Salario de la vacante
	 * 
	 * @return String
	 */
    public function getSalarioVacante()
    {
		return $this->salarioVacante;
    }
    
    /**
	 * Método para establecer el Salario de la vacante
	 * 
	 * @param String
	 */
    public function setSalarioVacante(String $pSalarioVacante)
    {
		$this->salarioVacante = $pSalarioVacante;
    }

    /**
	 * Método para obtener la experiencia de la vacante
	 * 
	 * @return String
	 */
    public function getExperiencia()
    {
		return $this->experiencia;
    }
    
    /**
	 * Método para establecer la experiencia de la vacante
	 * 
	 * @param String
	 */
    public function setExperiencia(String $pExperiencia)
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
    public function setCategorias(int $pCategorias)
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