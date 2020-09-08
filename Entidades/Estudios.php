<?php

/**
 * Clase que representa la clase "Estudios"
 */
class Estudios
{

    //-----------------------------------
    // Atributos
    //-----------------------------------

    /**
     * ID de los estudios
     * 
     * @var int
     */
    private $id;

    /**
     * Nombre del estudio
     * 
     * @var String
     */
    private $nombre;

    /**
     * Área de los estudios
     * 
     * @var String
     */
    private $area;

    /**
     * Insitución de los estudios
     * 
     * @var String
     */
    private $institucion;

    /**
     * Nivel de los estudios
     * 
     * @var String
     */
    private $nivelEstudio;

    /**
     * Fecha de los estudios
     * 
     * @var String
     */
    private $fecha;

    //---------------------------------
    // Métodos
    //---------------------------------

    /**
     * Método que obtiene el ID de los estudios
     * 
     * @return int
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método que cambia el ID de los estudios
     * 
     * @param $int
     */
    public function setId($pId)
    {
        $this->id = $pId;
    }

    /**
     * Método que obtiene el nombre de los estudios
     * 
     * @return int
     *
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Método que cambia el nombre de los estudios
     * 
     * @param $int
     */
    public function setNombre($pNombre)
    {
        $this->nombre = $pNombre;
    }

    /**
     * Método que retorna el área de los estudios
     * 
     * @return String
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Método que cambia el área de los estudios
     * 
     * @param String
     */
    public function setArea($pArea)
    {
        $this->area = $pArea;
    }

    /**
     * Método que retorna la institución de los estudios
     * 
     * @return String
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Método que cambia la institución de los estudios
     * 
     * @param String
     */
    public function setInstitucion($pInstitucion)
    {
        $this->institucion = $pInstitucion;
    }

    /**
     * Método que obtiene el nivel de estudio
     * 
     * @return String
     */
    public function getNivelEstudio()
    {
        return $this->nivelEstudio;
    }

    /**
     * Método que cambia el nivel de estudio
     * 
     * @param String
     */
    public function setNivelEstudio($pNivelEstudio)
    {
        $this->nivelEstudio = $pNivelEstudio;
    }


    /**
     * Método que obtiene la fecha de estudio
     * 
     * @return String
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Método que cambia la fecha de estudio
     * 
     * @param String
     */
    public function setFecha($pFecha)
    {
        $this->fecha = $pFecha;
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
        $longitudPass = 10;
        $longitudCadena = strlen($cadena);
        $password = "";

        for($i = 1 ; $i <= $longitudPass; $i++){

            $pos = rand(0, $longitudCadena - 1);
     
            $password .= substr($cadena, $pos, 1);
        }

        return $password;
    }
}