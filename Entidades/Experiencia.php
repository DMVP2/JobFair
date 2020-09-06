<?php

/**
 * Clase que representa la clase "Experiencia"
 */
class Experiencia
{

    //-----------------------------------
    // Atributos
    //-----------------------------------

    /**
     * ID de la experiencia
     * 
     * @var int
     */
    private $id;

    /**
     * Cargo de la experiencia
     * 
     * @var String
     */
    private $cargo;

    /**
     * Descripción de la experienca
     * 
     * @var String
     */
    private $descripcion;

    /**
     * Empresa de la experiencia
     * 
     * @var String
     */
    private $empresa;

    /**
     * Fecha de la experiencia
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
     * Método que obtiene el cargo
     * 
     * @return String
     *
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Método que cambia el cargo 
     * 
     * @param $String
     */
    public function setCargo($pCargo)
    {
        $this->cargo = $pCargo;
    }

    /**
     * Método que retorna la descripcion
     * 
     * @return String
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Método que cambia la descripcion
     * 
     * @param String
     */
    public function setDescripcion($pDescripcion)
    {
        $this->descripcion = $pDescripcion;
    }

    /**
     * Método que retorna la empresa
     * 
     * @return String
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Método que cambia la empresa
     * 
     * @param String
     */
    public function setEmpresa($pEmpresa)
    {
        $this->empresa = $pEmpresa;
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