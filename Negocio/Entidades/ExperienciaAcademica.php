<?php

/**
 * Clase que representa la clase "Experiencia Académica"
 */
class ExperienciaAcademica
{

    //-----------------------------------
    // Atributos
    //-----------------------------------

    /**
     * ID de la experiencia académica
     * 
     * @var int
     */
    private $id;

    /**
     * Nombre de la experiencia académica
     * 
     * @var String
     */
    private $nombre;

    /**
     * Descripción de la experienca académica
     * 
     * @var String
     */
    private $descripcion;

    /**
     * Institución de la experiencia académica
     * 
     * @var String
     */
    private $institucion;

    /**
     * Fecha de la experiencia académica
     * 
     * @var String
     */
    private $fecha;

    //---------------------------------
    // Métodos
    //---------------------------------

    /**
     * Método que obtiene el ID
     * 
     * @return int
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método que cambia el ID
     * 
     * @param $int
     */
    public function setId($pId)
    {
        $this->id = $pId;
    }

    /**
     * Método que obtiene el nombre
     * 
     * @return String
     *
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Método que cambia el nombre 
     * 
     * @param $String
     */
    public function setNombre($pNombre)
    {
        $this->nombre = $pNombre;
    }

    /**
     * Método que retorna la descripción
     * 
     * @return String
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Método que cambia la descripción
     * 
     * @param String
     */
    public function setDescripcion($pDescripcion)
    {
        $this->descripcion = $pDescripcion;
    }

    /**
     * Método que retorna la institución
     * 
     * @return String
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Método que cambia la institución
     * 
     * @param String
     */
    public function setInstitucion($pInstitucion)
    {
        $this->institucion = $pInstitucion;
    }


    /**
     * Método que obtiene la fecha
     * 
     * @return String
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Método que cambia la fecha
     * 
     * @param String
     */
    public function setFecha($pFecha)
    {
        $this->fecha = $pFecha;
    }
}