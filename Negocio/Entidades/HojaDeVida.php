<?php

/**
 * Clase que representa la clase "HojaDeVida"
 */
class HojaDeVida
{

    //-----------------------------------
    // Atributos
    //-----------------------------------

    /**
     * ID de la hoja de vida
     * 
     * @var int
     */
    private $id;

    /**
     * Descripción de la hoja de vida
     * 
     * @var String
     */
    private $perfilProfesional;

    /**
     * Disponibilidad de viaje por parte del estudiante
     * 
     * @var String
     */
    private $disponibilidadViaje;

    /**
     * Certificaciones realizadas por el estudiante
     * 
     * @var String
     */
    private $certificaciones;

    /**
     * Idiomas que habla el estudiante
     * 
     * @var ArregloDeDosDimensiones
     */
    private $idiomas;

    /**
     * Estudios que posee el estudiante
     * 
     * @var ArregloDeDosDimensiones
     */
    private $estudios;

    /**
     * Referencias personales del estudiante
     * 
     * @var ArregloDeDosDimensiones
     */
    private $referencias;

    /**
     * Experiencia laboral que posea el estudiante
     * 
     * @var ArregloDeDosDimensiones
     */
    private $experienciaLaboral;

    /**
     * Experiencia académica que posea el estudiante
     * 
     * @var ArregloDeDosDimensiones
     */
    private $experienciaAcademica;

    /**
     * Referencias personales del estudiante
     * 
     * @var Documento
     */
    private $documento;



    //---------------------------------
    // Métodos
    //---------------------------------

    /**
     * Método que obtiene el ID de la hoja de vida
     * 
     * @return int
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método que establece el ID de la hoja de vida
     * 
     * @param int
     */
    public function setId($pId)
    {
        $this->id = $pId;
    }

    /**
     * Método que obtiene la descripción de la hoja de vidas
     * 
     * @return String
     */
    public function getPerfilProfesional()
    {
        return $this->perfilProfesional;
    }

    /**
     * Método que establece la descripción de la hoja de vida
     * 
     * @param String
     */
    public function setPerfilProfesional($pPerfilProfesional)
    {
        $this->perfilProfesional = $pPerfilProfesional;
    }

    /**
     * Método que obtiene la disponibilida de viaje del estudiante
     * 
     * @return String
     */
    public function getDisponibilidadViaje()
    {
        return $this->disponibilidadViaje;
    }

    /**
     * Método que establece la disponibilidad de viaje del estudiante
     * 
     * @param String
     */
    public function setDisponibilidadViaje($pDisponibilidadViaje)
    {
        $this->disponibilidadViaje = $pDisponibilidadViaje;
    }

    /**
     * Método que obtiene las certificaciones realizadas por el estudiante
     * 
     * @return String
     */
    public function getCertificaciones()
    {
        return $this->certificaciones;
    }

    /**
     * Método que establece las certificaciones realizadas por el estudiante
     * 
     * @param String
     */
    public function setCertificaciones($pCertificaciones)
    {
        $this->certificaciones = $pCertificaciones;
    }


    /**
     * Método que obtiene el documento
     * 
     * @return String
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Método que establece el documento
     * 
     * @param String
     */
    public function setDocumento($pDocumento)
    {
        $this->documento = $pDocumento;
    }

    /**
     * Método que obtiene los idiomas que habla el estudiante
     * 
     * @return ArregloDeDosDimensiones
     */
    public function getIdiomas()
    {
        return $this->idiomas;
    }

    /**
     * Método que establece los idiomas que habla el estudiante
     * 
     * @param ArregloDeDosDimensiones
     */
    public function setIdiomas($pIdiomas)
    {
        $this->idiomas = $pIdiomas;
    }

    /**
     * Método que obtiene los estudios que ha realizado el estudiante
     * 
     * @return ArregloDeDosDimensiones
     */
    public function getEstudios()
    {
        return $this->estudios;
    }

    /**
     * Método que establece los estudios que ha realizado el estudiante
     * 
     * @param ArregloDeDosDimensiones
     */
    public function setEstudios($pEstudios)
    {
        $this->estudios = $pEstudios;
    }

    /**
     * Método que obtiene las referencias personales del estudiante
     * 
     * @return ArregloDeDosDimensiones
     */
    public function getReferenciasPersonales()
    {
        return $this->referencias;
    }

    /**
     * Método que establece las referencias personales del estudiante
     * 
     * @param ArregloDeDosDimensiones
     */
    public function setReferenciasPersonales($pReferencias)
    {
        $this->referencias = $pReferencias;
    }

    /**
     * Método que obtiene la experiencia laboral del estudiante
     * 
     * @return ArregloDeDosDimensiones
     */
    public function getExperienciaLaboral()
    {
        return $this->experienciaLaboral;
    }

    /**
     * Método que establece la experiencia laboral del estudiante
     * 
     * @param ArregloDeDosDimensiones
     */
    public function setExperienciaLaboral($pExperiencia)
    {
        $this->experienciaLaboral = $pExperiencia;
    }

    /**
     * Método que obtiene la experiencia académica del estudiante
     * 
     * @return ArregloDeDosDimensiones
     */
    public function getExperienciaAcademica()
    {
        return $this->experienciaAcademica;
    }

    /**
     * Método que establece la experiencia académica del estudiante
     * 
     * @param ArregloDeDosDimensiones
     */
    public function setExperienciaAcademica($pExperiencia)
    {
        $this->experienciaAcademica = $pExperiencia;
    }
}